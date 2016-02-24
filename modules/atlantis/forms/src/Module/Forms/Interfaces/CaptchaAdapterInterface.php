<?php

namespace Module\Forms\Interfaces;

interface CaptchaAdapterInterface {

  /**
   * 
   * @param String $captchaPath
   * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory || String
   */
  public function build($captchaPath);

  /**
   * @return Bool
   */
  public function fails();
}
