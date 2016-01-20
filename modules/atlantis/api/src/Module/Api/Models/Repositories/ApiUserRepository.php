<?php

namespace Module\Api\Models\Repositories;

use Illuminate\Support\Facades\DB;

use Module\Api\Models\ApiUsers as ApiUsers;
use Module\Api\Models\ApiTokens as ApiTokens;

class ApiUserRepository  {
  
   public static function login( $user, $password ) {
     
      $user = DB::table("api_users")
              ->select("api_users.*", "api_tokens.token", "api_tokens.user_agent")
              ->leftJoin("api_tokens", "user_id", "=" , "api_users.id")
              ->where("api_users.username", "=" , $user)
              ->where("api_users.password", "=" , $password)
              ->first();
      
      
      //we found a valid user with a matching token
      if ( !empty( $user->token )) {
        
        return [  "token" => $user->token,  "user_agent" => $user->user_agent ];        
 
     }
      else {

          //first time login 
        
          $tokenModel = new ApiTokens();
        
          $token = self::makeToken($user->username, $user->password);
          $user_agent = self::makeToken($user->username, $user->password, rand( 1 , 25343242));

          $tokenModel->user_id = $user->id;
          $tokenModel->token = $token;
          $tokenModel->user_agent = $user_agent;
        
          $tokenModel->save();
          
          return [  "token" => $token,  "user_agent" => $user_agent ];        
          
        
      }
     
   }
   
   public static function makeToken ( $username, $password, $seed = null ) {
     
     return bcrypt( $username.$password . $seed);
     
   }
   
   public static function isValidToken( $token , $user_agent ) {
     
       $model = new ApiTokens();
       
       $model->where("token" , "=" , $token)
               ->where("user_agent", "=", $user_agent)
               ->first();
       
       return count($model);
       
     
   }
   

   
   
  
  
}