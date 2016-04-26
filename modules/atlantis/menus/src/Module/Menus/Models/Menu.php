<?php

namespace Module\Menus\Models;

use Atlantis\Models\Base;

class Menu extends Base {

  protected $table = "menus";
  protected $guarded = [ 'id'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name',
      'css',
      'element_id'
  ];

}
