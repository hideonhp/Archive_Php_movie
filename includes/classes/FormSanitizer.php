<?php
class FormSanitizer {
     public static function sanFormString($ipText)
     {
          $ipText = strip_tags($ipText);
          $ipText = str_replace(" ", "", $ipText);
          $ipText = strtolower($ipText);
          $ipText = ucfirst($ipText);
     
          return $ipText;
     }
     public static function sanFormUser($ipText)
     {
          $ipText = strip_tags($ipText);
          $ipText = str_replace(" ", "", $ipText);
    
          return $ipText;
     }
     public static function sanFormPwd($ipText)
     {
          $ipText = strip_tags($ipText);
    
          return $ipText;
     }
     public static function sanFormEmail($ipText)
     {
          $ipText = strip_tags($ipText);
          $ipText = str_replace(" ", "", $ipText);
          return $ipText;
     }
}
