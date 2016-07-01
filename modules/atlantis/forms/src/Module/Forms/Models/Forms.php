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
      'email_from',
      'emails',
      'form_class',
      'btn_value',
      'btn_class',
      'captcha',
      'captcha_namespace',
      'ga',
      'before_form_text',
      'after_form_text',
      'redirect_url',
      'redirect_url_error',
      'use_custom_form',
      'custom_form'
  ];

}
