<?php

namespace Module\Api\Helper; 


class Json  {
  
   public static function encode( $data ) {
     
        return json_encode( $data );
     
   }
  
   public static function decode( $data ) {
     
        return json_decode( $data );
     
   }
   
  
}
