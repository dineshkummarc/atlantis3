<?php

namespace Module\Forms\Helpers;

use Illuminate\Support\Facades\Validator as BaseValidator;
use Illuminate\Support\MessageBag;

class Validator {

  private $oItems;
  private $rules = array();
  private $messages = array();
  private $baseValidator;
  private $fails = TRUE;
  
  public function __construct($oItems) {
  
    $this->oItems = $oItems;
    $this->setRules();
    
  }
  
  public function make($data) {
    
    $this->baseValidator = BaseValidator::make($data, $this->rules);
    $this->fails = $this->baseValidator->fails();
    
  }
  
  public function getErrors() {
    
    $errors = $this->baseValidator->errors();
    
    $aMsgs = array();
    
    foreach ($this->messages as $key => $message) {
      
      if ($errors->has($key)) {
        $aMsgs[$key] = $message;
      }      
    }  
    
    return new MessageBag($aMsgs);
  }

    public function fails() {
    
    return $this->fails;
    
  }

    private function setRules() {
    
    foreach ($this->oItems as $item) {
    
      if (!empty($item->validation)) {
        
        $this->rules[$item->field_name] = $item->validation;
        $this->messages[$item->field_name] = $item->validation_msg;
        
      }
      
    }
    
  }

}
