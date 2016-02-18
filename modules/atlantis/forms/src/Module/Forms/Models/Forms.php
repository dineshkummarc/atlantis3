<?php

namespace Module\Forms\Models;

use Atlantis\Models\Base as Base;

class Forms extends Base {

  protected $table = "forms";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name',
      'message',
      'email_check',
      'emails',
      'form_class',
      'btn_value',
      'btn_class',
      'captcha',
      'ga',
      'before_form_text',
      'after_form_text',
      'use_custom_form',
      'custom_form'
  ];

}
