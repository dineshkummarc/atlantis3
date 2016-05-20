<?php

namespace Module\Colorbox\Models;

use Atlantis\Models\Base;

class Colorbox extends Base {

  protected $table = "colorbox";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

    protected $fillable = [
    'name',
    'gallery_id'
    ];
   
}