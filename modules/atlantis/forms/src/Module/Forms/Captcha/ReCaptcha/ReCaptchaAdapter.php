<?php

namespace Module\Forms\Captcha\ReCaptcha;

class ReCaptchaAdapter implements \Module\Forms\Interfaces\CaptchaAdapterInterface {

  /**
   * Register API keys at https://www.google.com/recaptcha/admin
   * 
   * @var String
   */
  private $site_key = '6LduMRkTAAAAABdjo1UHU-7WIFzeXu8z5Augq8ZI';
  private $secret = '6LduMRkTAAAAAC6sp-dCNJRzbtYkIj2t7rxgISGQ';

  /**
   * reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
   * 
   * @var String
   */
  private $lang = 'en';
  
  private $fails = TRUE;

  public function build($captchaPath) {

    if (request()->method() == \App\Http\Requests\Request::METHOD_POST && request()->has('g-recaptcha-response')) {

      require_once $captchaPath . 'ReCaptcha/vendor/src/autoload.php';

      $recaptcha = new \ReCaptcha\ReCaptcha($this->secret);

      $resp = $recaptcha->verify(request()->get('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);
      
      if ($resp->isSuccess()) {
        $this->fails = FALSE;
      } else {
        $this->fails = TRUE;
        $aErrors["captcha"] = "Wrong captcha";
      }
    }

    $aData = array();
    $aData['site_key'] = $this->site_key;
    $aData['lang'] = $this->lang;

    return $view = view()->file($captchaPath . 'ReCaptcha/Views/ReCaptcha.blade.php', $aData);
  }

  public function fails() {

    return $this->fails;
  }

}
