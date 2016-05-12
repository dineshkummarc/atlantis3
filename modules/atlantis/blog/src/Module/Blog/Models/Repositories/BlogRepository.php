<?php

namespace Module\Blog\Models\Repositories;

use Module\Blog\Models\Blog;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BlogRepository {

  public static $_POSTED_DATE_FORMAT_VIEW = 'm/d/Y';

  public function validationCreate($data, $id = NULL) {

    $rules_create = [
        'title' => 'required',
        'url' => 'required|unique:blog,url,' . $id . '|valid_url',
        'nickname' => 'required',
        'posted_date' => 'date_format:' . self::$_POSTED_DATE_FORMAT_VIEW,
    ];

    $messages = [
        'required' => trans('blog::validation.required'),
        'unique' => trans('blog::validation.unique'),
        'valid_url' => trans('blog::validation.valid_url'),
        'date_format' => trans('blog::validation.date_format')
    ];

    return Validator::make($data, $rules_create, $messages);
  }

  public function validationEdit($data) {

    return Validator::make($data, $this->rules_create);
  }

  public function add($data) {

    if (empty($data['posted_date'])) {
      $data['posted_date'] = NULL;
    } else {
      $data['posted_date'] = Carbon::createFromFormat(self::$_POSTED_DATE_FORMAT_VIEW . ' H:i:s', $data['posted_date'] . ' 00:00:01')->toDateTimeString();
    }
    
    $model = Blog::create($data);
    
    \Atlantis\Models\Repositories\TagRepository::addTagsWithDelimiter(',', $data['tags'], $model->id, 'blog');
    
    return $model->id;
  }

  public function edit($id, $data) {

    if (empty($data['posted_date'])) {
      $data['posted_date'] = NULL;
    } else {
      $data['posted_date'] = Carbon::createFromFormat(self::$_POSTED_DATE_FORMAT_VIEW . ' H:i:s', $data['posted_date'] . ' 00:00:01')->toDateTimeString();
    }
    
    if (!isset($data['use_blurb'])) {
      $data['use_blurb'] = 0;
    }
    
    $model = Blog::findOrNew($id);

    if ($model != NULL) {
      $model->update($data);

      \Atlantis\Models\Repositories\TagRepository::updateTagsWithDelimiter(',', $data['tags'], $model->id, 'blog');
      
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public static function getAll() {

    return Blog::all();
  }

  public static function get($id) {

    return Blog::find($id);
  }

  public static function deleteEntry($id) {

    $model = Blog::findOrNew($id);

    if ($model != NULL) {
      $model->delete();

      \Atlantis\Models\Repositories\TagRepository::deleteTag('blog', $id);
      
      return TRUE;
    } else {
      return FALSE;
    }
  }

}
