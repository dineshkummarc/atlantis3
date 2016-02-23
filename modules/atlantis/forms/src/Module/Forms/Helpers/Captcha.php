<?php

namespace Module\Forms\Helpers;

class Captcha {

  private $adapterNamespace;

  public function __construct($captchaConfig) {

    $this->adapterNamespace = $captchaConfig['adapterNamespace'];
  }

  /**
   * Return captcha
   * 
   * @return captcha view
   */
  public function get() {

    $captcha = new $this->adapterNamespace();
    return $captcha->build();
  }

  /**
   * Check if captcha is valid
   * 
   * @return BOOL
   */
  public function isValid() {
    
  }

  /**
   * Get error message
   * 
   * @return \Illuminate\Support\MessageBag
   */
  public function getErrors() {
    
  }

  /**
   * Find all in /Captcha folder and return in array with configs
   * 
   * @return array
   */
  public static function getAll($formsSetup) {

    $captchaPath = base_path() . \Config::get('modules_dir') . $formsSetup['path'] . '/Module/Forms/Captcha';

    $dirs = array_diff(scandir($captchaPath), array('.', '..'));

    $aCaptchas = array();

    foreach ($dirs as $dir) {

      $path = $captchaPath . '/' . $dir;

      if (is_dir($path)) {

        $configFile = $path . '/config.php';

        if (is_file($configFile)) {

          $captchaConfig = require_once($configFile);
          array_push($aCaptchas, $captchaConfig);
        }
      }
    }

    return $aCaptchas;
  }

}
