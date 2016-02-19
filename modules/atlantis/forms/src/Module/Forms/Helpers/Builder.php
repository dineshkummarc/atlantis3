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

  /**
   * Validation rules
   */
  public static $_VALIDATION_NOT_EMPTY = 'required';
  public static $_VALIDATION_EMAIL = 'required|email';
  public static $_VALIDATION_NUMERIC = 'required|numeric';
  public static $_VALIDATION_ALPHA_NUMERIC = 'required|alpha_num';

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
        self::$_TYPE_SELECT => 'Dropdown'
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
        self::$_VALIDATION_ALPHA_NUMERIC => 'Alpha Numeric'
    ];
  }

  /**
   * 
   * Build form items
   * 
   * @return  array
   * @param \Module\Forms\Models\FormsItems $items
   */
  public static function buildItems($items) {

    $data = array();

    foreach ($items as $k => $item) {

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

        $data[$k] = view('forms::items/input-text', ['item' => $item, 'required' => $required, 'value' => $value]);

        /** <input type="password"> */
      } else if ($item->field_type == self::$_TYPE_INPUT_PASSWORD) {

        if (isset(array_values($aFieldValues)[0])) {
          $value = array_values($aFieldValues)[0];
        } else {
          $value = '';
        }

        $data[$k] = view('forms::items/input-password', ['item' => $item, 'required' => $required, 'value' => $value]);

        /** <textarea></textarea> */
      } else if ($item->field_type == self::$_TYPE_TEXTAREA) {

        if (isset(array_values($aFieldValues)[0])) {
          $value = array_values($aFieldValues)[0];
        } else {
          $value = '';
        }

        $data[$k] = view('forms::items/textarea', ['item' => $item, 'required' => $required, 'value' => $value]);
        
        /** <input type="checkbox"> */
      } else if ($item->field_type == self::$_TYPE_CHECKBOX) {

        $data[$k] = view('forms::items/checkbox', ['item' => $item, 'required' => $required, 'checkboxes' => $aFieldValues]);
        
        /** <input type="radio"> */
      } else if ($item->field_type == self::$_TYPE_RADIO) {
        
        $data[$k] = view('forms::items/radio', ['item' => $item, 'required' => $required, 'radios' => $aFieldValues]);
        
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
            $checked = $k;
            $value = str_replace('::checked', '', $value);
          }
          
          $aSelects[$k] = $value;
          
        }
        
        $data[$k] = view('forms::items/select', ['item' => $item, 'required' => $required, 'selects' => $aSelects, 'checked' => $checked]);
      }
    }

    return $data;
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
            'field_value' => [],
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
            'field_name' => 'checkboxes', //is not required
            'validation' => '',
            'attributes' => [
                'class' => 'checkbox-class'
            ],
            'validation_msg' => '',
            'field_value' => [
                'send_detail_mail_1' => 'send_details to mail1::checked',
                'send_detail_mail_2' => 'send details to mail2'
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
    ];
  }

}
