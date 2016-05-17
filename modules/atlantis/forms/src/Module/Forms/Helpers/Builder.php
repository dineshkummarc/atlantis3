<?php

namespace Module\Forms\Helpers;

class Builder {

  /**
   * Field types
   */
  public static $_TYPE_INPUT_TEXT = 'input:text';
  public static $_TYPE_INPUT_PASSWORD = 'input:password';
  public static $_TYPE_TEXTAREA = 'textarea';
  public static $_TYPE_CHECKBOX = 'checkbox';
  public static $_TYPE_RADIO = 'radio';
  public static $_TYPE_SELECT = 'select';
  public static $_TYPE_FILE = 'file';

  /**
   * Validation rules
   */
  public static $_VALIDATION_NOT_EMPTY = 'required';
  public static $_VALIDATION_EMAIL = 'required|email';
  public static $_VALIDATION_NUMERIC = 'required|numeric';
  public static $_VALIDATION_ALPHA_NUMERIC = 'required|alpha_num';
  public static $_VALIDATION_IMAGE = 'image';
  public static $_VALIDATION_IMAGE_1M = 'image|max:1000';
  public static $_VALIDATION_IMAGE_2M = 'image|max:2000';
  public static $_VALIDATION_PDF = 'mimes:pdf';
  public static $_VALIDATION_PDF_1M = 'mimes:pdf|max:1000';
  public static $_VALIDATION_PDF_2M = 'mimes:pdf|max:2000';
  public static $_VALIDATION_EXCEL = 'mimes:xlsx,xls';
  public static $_VALIDATION_EXCEL_1M = 'mimes:xlsx,xls|max:1000';
  public static $_VALIDATION_EXCEL_2M = 'mimes:xlsx,xls|max:2000';
  public static $_VALIDATION_CSV = 'mimes:csv,txt';
  public static $_VALIDATION_CSV_1M = 'mimes:csv,txt|max:1000';
  public static $_VALIDATION_CSV_2M = 'mimes:csv,txt|max:2000';

  /**
   * Private variables 
   */
  private $form;
  private $formItems;
  private $captcha;
  private $customFormAttributes = array();

  public function __construct($form, $formItems, $captcha = NULL) {

    $this->form = $form;
    $this->formItems = $formItems;
    $this->captcha = $captcha;
  }

  /**
   * Get Filed Types
   * 
   * @return array
   */
  public static function getFieldTypes() {

    return [
        self::$_TYPE_INPUT_TEXT => 'Text',
        self::$_TYPE_INPUT_PASSWORD => 'Password',
        self::$_TYPE_TEXTAREA => 'TextArea',
        self::$_TYPE_CHECKBOX => 'Checkbox',
        self::$_TYPE_RADIO => 'Radio button',
        self::$_TYPE_SELECT => 'Dropdown',
        self::$_TYPE_FILE => 'File'
    ];
  }

  /**
   * Get validation rules
   * 
   * @return array
   */
  public static function getValidationRules() {

    return [
        self::$_VALIDATION_NOT_EMPTY => 'Not empty',
        self::$_VALIDATION_EMAIL => 'Email',
        self::$_VALIDATION_NUMERIC => 'Numeric',
        self::$_VALIDATION_ALPHA_NUMERIC => 'Alpha Numeric',
        self::$_VALIDATION_IMAGE => 'Image file',
        self::$_VALIDATION_IMAGE_1M => 'Image file - 1 Megabyte',
        self::$_VALIDATION_IMAGE_2M => 'Image file - 2 Megabytes',
        self::$_VALIDATION_PDF => 'PDF file',
        self::$_VALIDATION_PDF_1M => 'PDF file - 1 Megabyte',
        self::$_VALIDATION_PDF_2M => 'PDF file - 2 Megabytes',
        self::$_VALIDATION_EXCEL => 'MS Excel file',
        self::$_VALIDATION_EXCEL_1M => 'MS Excel file - 1 Megabytes',
        self::$_VALIDATION_EXCEL_2M => 'MS Excel file - 2 Megabytes',
        self::$_VALIDATION_CSV => 'CSV file',
        self::$_VALIDATION_CSV_1M => 'CSV file - 1 Megabytes',
        self::$_VALIDATION_CSV_2M => 'CSV file - 2 Megabytes',
    ];
  }

  /**
   * 
   * Build form items
   * 
   * @return  array
   * @param \Module\Forms\Models\FormsItems $items
   */
  public function buildItems() {

    $data = array();

    foreach ($this->formItems as $k => $item) {

      $aFieldValues = unserialize($item->field_value);

      if (empty($item->validation)) {
        $required = '';
      } else {
        $required = ' required';
      }

      /** <input type="text"> */
      if ($item->field_type == self::$_TYPE_INPUT_TEXT) {

        if (isset(array_values($aFieldValues)[0])) {
          $value = array_values($aFieldValues)[0];
        } else {
          $value = '';
        }

        $data[$k] = view('forms::items/input-text', ['item' => $item, 'required' => $required, 'field' => self::createInputText($item, $value)]);

        /** <input type="password"> */
      } else if ($item->field_type == self::$_TYPE_INPUT_PASSWORD) {

        if (isset(array_values($aFieldValues)[0])) {
          $value = array_values($aFieldValues)[0];
        } else {
          $value = '';
        }

        $data[$k] = view('forms::items/input-password', ['item' => $item, 'required' => $required, 'field' => self::createInputPassword($item, $value)]);

        /** <textarea></textarea> */
      } else if ($item->field_type == self::$_TYPE_TEXTAREA) {

        if (isset(array_values($aFieldValues)[0])) {
          $value = array_values($aFieldValues)[0];
        } else {
          $value = '';
        }

        $data[$k] = view('forms::items/textarea', ['item' => $item, 'required' => $required, 'field' => self::createTextarea($item, $value)]);

        /** <input type="checkbox"> */
      } else if ($item->field_type == self::$_TYPE_CHECKBOX) {

        $data[$k] = view('forms::items/checkbox', ['item' => $item, 'required' => $required, 'checkboxes' => self::createCheckbox($aFieldValues, $item)]);

        /** <input type="radio"> */
      } else if ($item->field_type == self::$_TYPE_RADIO) {

        $data[$k] = view('forms::items/radio', ['item' => $item, 'required' => $required, 'radios' => self::createRadio($aFieldValues, $item)]);

        /**
         * <select name="gender">
         * <option value="male">Male</option>
         * <option value="female">Female</option>
         * </select>
         */
      } else if ($item->field_type == self::$_TYPE_SELECT) {

        $aSelects = array();
        $checked = NULL;
        foreach ($aFieldValues as $k => $value) {

          if (stristr($value, '::checked')) {
            $value = str_replace('::checked', '', $value);
            $checked = '[' . $k . '] => [' . $value . ']';
          }

          $aSelects['[' . $k . '] => [' . $value . ']'] = $value;
        }

        $data[$k] = view('forms::items/select', ['item' => $item, 'required' => $required, 'field' => self::createSelect($item, $aSelects, $checked)]);

        /**
         * <input type="file">
         */
      } else if ($item->field_type == self::$_TYPE_FILE) {

        $data[$k] = view('forms::items/file', ['item' => $item, 'required' => $required, 'field' => self::createFile($item)]);

        $this->addCustomFormAttributtes('enctype', 'multipart/form-data');
      }
    }

    return $data;
  }

  public function buildCustomTemplate() {

    /** find all input fields */
    preg_match_all('/{{(\w+)}}/im', $this->form->custom_form, $aMatchesFunc);
    /** find all error fields */
    preg_match_all('/{!!(\w+)!!}/im', $this->form->custom_form, $aMatchesFuncError);

    $customBody = $this->form->custom_form;

    /** check for errors from validation */
    $errors = \Session::get('errors');
    if ($errors != NULL) {
      foreach ($aMatchesFuncError[1] as $err) {

        foreach ($errors->getMessages() as $key => $err_message) {

          if ($key == $err) {

            $customBody = preg_replace('/{!!' . $err . '!!}/im', $err_message[0], $customBody);
          }
        }
        $customBody = preg_replace('/{!!' . $err . '!!}/im', '', $customBody);
      }
    } else {

      foreach ($aMatchesFuncError[1] as $err) {
        /** remove error tags */
        $customBody = preg_replace('/{!!' . $err . '!!}/im', '', $customBody);
      }
    }

    /** {{submit_button}} - always needed */
    $customBody = preg_replace('/{{' . 'submit_button' . '}}/im', self::createSubmitButton($this->form), $customBody);
    /** {{before_form_text}} - always needed */
    $customBody = preg_replace('/{{' . 'before_form_text' . '}}/im', $this->form->before_form_text, $customBody);
    /** {{after_form_text}} - always needed */
    $customBody = preg_replace('/{{' . 'after_form_text' . '}}/im', $this->form->after_form_text, $customBody);
    /** {{captcha}} - always needed */
    if ($this->captcha != NULL) {
      $customBody = preg_replace('/{{' . 'captcha' . '}}/im', $this->captcha, $customBody);
    } else {
      $customBody = preg_replace('/{{' . 'captcha' . '}}/im', '', $customBody);
    }

    foreach ($aMatchesFunc[1] as $k => $token) {

      foreach ($this->formItems as $item) {

        $aFieldValues = unserialize($item->field_value);

        if (isset(array_values($aFieldValues)[0])) {
          $value = array_values($aFieldValues)[0];
        } else {
          $value = '';
        }

        if ($token == $item->field_name) {

          $buildItem = '';

          /** <input type="text"> */
          if ($item->field_type == self::$_TYPE_INPUT_TEXT) {

            $buildItem = self::createInputText($item, $value);

            /** <input type="password"> */
          } else if ($item->field_type == self::$_TYPE_INPUT_PASSWORD) {

            $buildItem = self::createInputPassword($item, $value);

            /** <textarea></textarea> */
          } else if ($item->field_type == self::$_TYPE_TEXTAREA) {

            $buildItem = self::createTextarea($item, $value);

            /** <input type="checkbox"> */
          } else if ($item->field_type == self::$_TYPE_CHECKBOX) {

            $buildItem = self::createCheckbox($aFieldValues, $item);

            /** <input type="radio"> */
          } else if ($item->field_type == self::$_TYPE_RADIO) {

            $buildItem = self::createRadio($aFieldValues, $item);

            /**
             * <select name="gender">
             * <option value="male">Male</option>
             * <option value="female">Female</option>
             * </select>
             */
          } else if ($item->field_type == self::$_TYPE_SELECT) {

            $aSelects = array();
            $checked = NULL;
            foreach ($aFieldValues as $k => $value) {

              if (stristr($value, '::checked')) {
                $value = str_replace('::checked', '', $value);
                $checked = '[' . $k . '] => [' . $value . ']';
              }

              $aSelects['[' . $k . '] => [' . $value . ']'] = $value;
            }

            $buildItem = self::createSelect($item, $aSelects, $checked);

            /**
             * <input type="file">
             */
          } else if ($item->field_type == self::$_TYPE_FILE) {

            $buildItem = self::createFile($item);
            $this->addCustomFormAttributtes('enctype', 'multipart/form-data');
          }

          $customBody = preg_replace('/{{' . $token . '}}/im', $buildItem, $customBody);
        }
      }
    }

    return $customBody;
  }

  /**
   * Always use after buildItems() or buildCustomTemplate()
   * 
   * @return array
   */
  public function getCustomFormAttributes() {

    return $this->customFormAttributes;
  }

  private function addCustomFormAttributtes($key, $value) {

    $this->customFormAttributes = array_merge($this->customFormAttributes, [$key => $value]);
  }

  public static function createInputText($item, $value) {

    return \Form::input('text', $item->field_name, old($item->field_name, $value), unserialize($item->attributes));
  }

  public static function createInputPassword($item, $value) {

    return \Form::input('password', $item->field_name, old($item->field_name, $value), unserialize($item->attributes));
  }

  public static function createTextarea($item, $value) {

    return \Form::textarea($item->field_name, old($item->field_name, $value), unserialize($item->attributes));
  }

  public static function createSelect($item, $aSelects, $checked) {

    return \Form::select($item->field_name, $aSelects, $checked, unserialize($item->attributes));
  }

  public static function createFile($item) {

    return \Form::file($item->field_name, unserialize($item->attributes));
  }

  public static function createCheckbox($checkboxes, $item) {

    $fields = '';

    foreach ($checkboxes as $k => $checkbox) {
      $fields .= '<label for="' . $k . '">';
      if (stristr($checkbox, '::checked')) {
        $fields .= \Form::checkbox($item->field_name . '[' . $k . ']', '[' . str_replace('::checked', '', $checkbox) . ']', TRUE, array_merge(unserialize($item->attributes), ['id' => $k])) . str_replace('::checked', '', $checkbox);
      } else {
        $fields .= \Form::checkbox($item->field_name . '[' . $k . ']', '[' . $checkbox . ']', FALSE, array_merge(unserialize($item->attributes), ['id' => $k])) . $checkbox;
      }
      $fields .= '</label>';
    }

    return $fields;
  }

  public static function createRadio($radios, $item) {

    $fields = '';

    foreach ($radios as $k => $radio) {
      $fields .= '<label for="' . $k . '">';
      if (stristr($radio, '::checked')) {
        $fields .= \Form::radio($item->field_name, '[' . $k . '] => [' . str_replace('::checked', '', $radio) . ']', TRUE, array_merge(unserialize($item->attributes), ['id' => $k])) . str_replace('::checked', '', $radio);
      } else {
        $fields .= \Form::radio($item->field_name, '[' . $k . '] => [' . $radio . ']', FALSE, array_merge(unserialize($item->attributes), ['id' => $k])) . $radio;
      }
      $fields .= '</label>';
    }

    return $fields;
  }

  public static function createSubmitButton($form) {

    if ($form->ga == 1) {
      return '<input type="submit" class="' . $form->btn_class . '" value="' . $form->btn_value . '" onClick="' . "ga('send', 'event', 'Forms', '" . $form->name . "', '" . $form->btn_value . "');" . '">';
    } else {
      return '<input type="submit" class="' . $form->btn_class . '" value="' . $form->btn_value . '">';
    }
  }

  public static function getPostItems() {

    return [

        [
            'label' => 'Name',
            'field_type' => self::$_TYPE_INPUT_TEXT,
            'field_name' => 'name',
            'validation' => self::$_VALIDATION_NOT_EMPTY,
            'attributes' => [
                'class' => 'name-class',
                'placeholder' => 'Name'
            ],
            'validation_msg' => 'Name must not be empty',
            'field_value' => 'Angel Bangel',
            'weight' => 1
        ],
        [
            'label' => 'Password',
            'field_type' => self::$_TYPE_INPUT_PASSWORD,
            'field_name' => 'password',
            'validation' => self::$_VALIDATION_NOT_EMPTY,
            'attributes' => [
                'class' => 'pass-class',
                'placeholder' => 'Password'
            ],
            'validation_msg' => 'Password must not be empty',
            'field_value' => '',
            'weight' => 2
        ],
        [
            'label' => 'Email',
            'field_type' => self::$_TYPE_INPUT_TEXT,
            'field_name' => 'email',
            'validation' => self::$_VALIDATION_EMAIL,
            'attributes' => [
                'class' => 'pass-class',
                'placeholder' => 'Email'
            ],
            'validation_msg' => 'Please add valid email',
            'field_value' => '',
            'weight' => 7
        ],
        [
            'label' => 'Gender',
            'field_type' => self::$_TYPE_SELECT,
            'field_name' => 'gender',
            'validation' => '',
            'attributes' => [
                'class' => 'test-class'
            ],
            'validation_msg' => '',
            'field_value' => [
                'male' => 'Male',
                'female' => 'Female::checked'
            ],
            'weight' => 3
        ],
        [
            'label' => 'Details',
            'field_type' => self::$_TYPE_TEXTAREA,
            'field_name' => 'details',
            'validation' => self::$_VALIDATION_NOT_EMPTY,
            'attributes' => [
                'class' => 'details-class',
                'rows' => '8'
            ],
            'validation_msg' => 'Details must not be empty',
            'field_value' => '',
            'weight' => 4
        ],
        [
            'label' => 'Send me details',
            'field_type' => self::$_TYPE_CHECKBOX,
            'field_name' => 'send_details',
            'validation' => '',
            'attributes' => [
                'class' => 'checkbox-class'
            ],
            'validation_msg' => '',
            'field_value' => [
                'send_details_mail_1' => 'send details to mail1::checked',
                'send_details_mail_2' => 'send details to mail2'
            ],
            'weight' => 5
        ],
        [
            'label' => 'Select option',
            'field_type' => self::$_TYPE_RADIO,
            'field_name' => 'options',
            'validation' => '',
            'attributes' => [
                'class' => 'options-class'
            ],
            'validation_msg' => '',
            'field_value' => [
                'option_1' => 'Option 1::checked',
                'option_2' => 'Option 2',
                'option_3' => 'Option 3',
            ],
            'weight' => 6
        ],
            /**
              [
              'label' => 'Upload file',
              'field_type' => self::$_TYPE_FILE,
              'field_name' => 'file',
              'validation' => self::$_VALIDATION_CSV_2M,
              'attributes' => [
              'class' => 'file-class'
              ],
              'validation_msg' => 'Please add valid file',
              'field_value' => [],
              'weight' => 7
              ]
             * 
             */
    ];
  }

}
