<?php

namespace Module\Blog\Models;

use Atlantis\Models\Base as Base;

class Blog extends Base {

  protected $table = "blog";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'title',
      'body',
      'blurb',
      'user_id',
      'url',
      'nickname',
      'allow_comments',
      'use_blurb',
      'body_words',
      'posted_date',
      'status',
      'gallery_id'
  ];

}
