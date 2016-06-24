<?php

namespace Module\Forms\Controllers;

use Module\Forms\Models\Repositories\FormsRepository;
use Module\Forms\Models\Repositories\FormsItemsRepository;
use Module\Forms\Models\Repositories\FormsResultsRepository;
use Module\Forms\Helpers\Builder as FormsBuilder;
use Module\Forms\Helpers\Validator as FormsValidator;
use Illuminate\Support\MessageBag;
/**
 * Controller: Forms
 * @Atlantis CMS
 * v 1.0
 */
use App\Http\Controllers\Controller;

class FormsController extends Controller {

  public function __construct() {
    
  }

  /**
   * <div data-pattern-func="module:forms@build-1"></div>
   */
  public function build($aParams = NULL) {

    if (isset($aParams[0])) {

      $form_id = $aParams[0];

      $form = FormsRepository::get($form_id);

      if ($form != NULL) {

        $formItems = FormsItemsRepository::getItems($form_id);

        if ($form->use_custom_form == 0) {
          return $this->normalBuild($form, $formItems);
        } else {
          return $this->customTemplateBuild($form, $formItems);
        }
      } else {
        abort(404, "form with ID: " . $form_id . " not found");
      }
    } else {
      abort(404, "form ID is missing");
    }
  }

  private function normalBuild($form, $formItems) {

    $aData = array();
    $captcha = NULL;
    $captchaView = NULL;

    if ($form->captcha == 1) {

      $captcha = new \Module\Forms\Helpers\Captcha($form->captcha_namespace);
      $captchaView = $captcha->get();
    }

    $formsBuilder = new FormsBuilder($form, $formItems, $captchaView);

    $aData['form'] = $form;
    $aData['escaped_name'] = strtolower(str_replace(" ", "-", $form->name));
    $aData['url'] = str_replace(url(), '', request()->fullUrl());
    $aData['items'] = $formsBuilder->buildItems();
    $aData['custom_form_attributes'] = $formsBuilder->getCustomFormAttributes();
    $aData['submit_button'] = FormsBuilder::createSubmitButton($form);
    $aData['captcha'] = $captchaView;

    if (request()->method() == \App\Http\Requests\Request::METHOD_POST && request()->get('form_id') == $form->id) {

      $validator = new FormsValidator($formItems);
      $validator->make(request()->all());

      $captchaFails = FALSE;
      if ($captcha != NULL) {
        $captchaFails = $captcha->fails();
      }

      $form->redirect_url = str_replace('{{url}}', str_replace(url(), '', request()->fullUrl()), $form->redirect_url);

      if (!$validator->fails() && !$captchaFails) {
        //save post data in DB 
        FormsResultsRepository::saveResults(request());
        request()->session()->flash('success', $form->message);

        /**
         * fire submit event with POST data
         */
        \Event::fire('form.submitted', [request()->all()]);

        $this->sendMail($form, request()->all());

        if (empty($form->redirect_url)) {
          return redirect()->back()->send();
        } else {
          return redirect($form->redirect_url)->send();
        }
      } else {

        $messageBag = $validator->getErrors(new MessageBag());
        if ($captcha != NULL) {
          $messageBag = $captcha->getErrors($messageBag);
        }

        return redirect()->back()->withErrors($messageBag)->withInput()->send();
      }
    }
    return view('forms::form-builder', $aData);
  }

  /*
   * {{submit_button}} - add submit button / always needed
   */

  private function customTemplateBuild($form, $formItems) {

    $aData = array();
    $captcha = NULL;
    $captchaView = NULL;

    if ($form->captcha == 1) {

      $captcha = new \Module\Forms\Helpers\Captcha($form->captcha_namespace);
      $captchaView = $captcha->get();
    }

    $formsBuilder = new FormsBuilder($form, $formItems, $captchaView);

    $aData['content'] = $formsBuilder->buildCustomTemplate();
    $aData['custom_form_attributes'] = $formsBuilder->getCustomFormAttributes();
    $aData['form'] = $form;
    $aData['escaped_name'] = strtolower(str_replace(" ", "-", $form->name));
    $aData['url'] = str_replace(url(), '', request()->fullUrl());

    if (request()->method() == \App\Http\Requests\Request::METHOD_POST && request()->get('form_id') == $form->id) {

      $validator = new FormsValidator($formItems);
      $validator->make(request()->all());

      $captchaFails = FALSE;
      if ($captcha != NULL) {
        $captchaFails = $captcha->fails();
      }

      $form->redirect_url = str_replace('{{url}}', str_replace(url(), '', request()->fullUrl()), $form->redirect_url);

      if (!$validator->fails() && !$captchaFails) {
        //save post data in DB 
        FormsResultsRepository::saveResults(request());
        request()->session()->flash('success', $form->message);

        /**
         * fire submit event with POST data
         */
        \Event::fire('form.submitted', [request()->all()]);

        $this->sendMail($form, request()->all());

        if (empty($form->redirect_url)) {
          return redirect()->back()->send();
        } else {
          return redirect($form->redirect_url)->send();
        }
      } else {

        $messageBag = $validator->getErrors(new MessageBag());
        if ($captcha != NULL) {
          $messageBag = $captcha->getErrors($messageBag);
        }

        return redirect()->back()->withErrors($messageBag)->withInput()->send();
      }
    }

    return view('forms::form-builder-custom', $aData);
  }

  private function sendMail($form, $data) {

    if ($form->email_check == 1) {

      $aData['post'] = $data;

      $aMails = array_filter(explode(',', $form->emails));

      foreach ($aMails as $mail_to) {

        \Illuminate\Support\Facades\Mail::send('forms::form-email', $aData, function ($message) use ($mail_to, $form) {

          if (empty($form->email_from)) {
            $form->email_from = 'noreply@atlantis-cms.com';
          }

          $message->to(trim($mail_to))->from($form->email_from, 'AtlantisCMS WebMaster')->subject($form->name . ' form');
        });
      }
    }
  }

}
