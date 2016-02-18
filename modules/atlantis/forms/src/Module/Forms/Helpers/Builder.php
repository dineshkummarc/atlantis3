<?php

namespace Module\Forms\Helpers;

class Builder {

  public static $field_types = [
      'input:text' => 'Text',
      'input:password' => 'Password',
      'textarea' => 'TextArea',
      'checkbox' => 'Checkbox',
      'radio' => 'Radio button',
      'select' => 'Dropdown'
  ];
  public static $validations = [
      'required' => 'Not empty',
      'required|email' => 'Email',
      'required|numeric' => 'Numeric',
      'required|alpha_num' => 'Alpha Numeric'
  ];

  public static function getPostItems() {

    return [
        [
            'label' => 'Name',
            'field_type' => 'input:text',
            'field_name' => 'name',
            'validation' => 'required',
            'attributes' => [
                'class' => 'test-class',
                'placeholder' => 'Name'
            ],
            'validation_msg' => 'Name must not be empty',
            'field_value' => '',
            'weight' => 1
        ],
        [
            'label' => 'Password',
            'field_type' => 'input:password',
            'field_name' => 'password',
            'validation' => 'required',
            'attributes' => [
                'class' => 'test-class',
                'placeholder' => 'Password'
            ],
            'validation_msg' => 'Password must not be empty',
            'field_value' => '',
            'weight' => 2
        ],
        [
            'label' => 'Gender',
            'field_type' => 'select',
            'field_name' => 'gender',
            'validation' => '',
            'attributes' => [
                'class' => 'test-class'
            ],
            'validation_msg' => '',
            'field_value' => [
                'male' => 'Male',
                'female' => 'Female'
            ],
            'weight' => 3
        ],
    ];
  }

}
