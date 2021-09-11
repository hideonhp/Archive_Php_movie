<?php
class Account
{

     private $con;
     private $errArr = array();

     public function __construct($con)
     {
          $this->con = $con;
     }

     public function register($fn, $ln, $un, $em, $conEm, $pwd, $conPwd)
     {
          $this->valFName($fn);
          $this->valLName($ln);
          $this->valUName($un);
          $this->valEmail($em, $conEm);
          $this->valPwd($pwd, $conPwd);

          if (empty($this->errArr)){
               return $this->insUser($fn, $ln, $un, $em, $pwd);
          }

          return false;
     }

     public function login($un, $pwd){
          $pwd = hash("sha512", $pwd);
          $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pwd ");
          $query->bindValue(":un", $un);
          $query->bindValue(":pwd", $pwd);

          $query->execute();

          if ($query->rowCount()==1){
               return true;
          }

          array_push($this->errArr, Constants::$logFailed);
          return false;
     }

     private function insUser($fn, $ln, $un, $em, $pwd)
     {
          $pwd = hash("sha512", $pwd);
          $query = $this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password)
          VALUES (:fn, :ln, :un, :em, :pwd) ");
          $query->bindValue(":fn", $fn);
          $query->bindValue(":ln", $ln);
          $query->bindValue(":un", $un);
          $query->bindValue(":em", $em);
          $query->bindValue(":pwd", $pwd);

          return $query->execute();
          //debug
          //var_dump($query->errorInfo());
     }

     private function valFName($fn)
     {
          if (strlen($fn) <= 1 || strlen($fn) > 8) {
               array_push($this->errArr, Constants::$fNameChar);
          }
     }
     private function valLName($ln)
     {
          if (strlen($ln) <= 1 || strlen($ln) > 16) {
               array_push($this->errArr, Constants::$lNameChar);
          }
     }
     private function valUName($un)
     {
          if (strlen($un) <= 5 || strlen($un) > 25) {
               array_push($this->errArr, Constants::$uNameChar);
               return;
          }

          $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
          $query->bindValue(":un", $un);
          $query->execute();

          if ($query->rowCount() != 0) {
               array_push($this->errArr, Constants::$uNameTaken);
          }
     }
     private function valEmail($conEm, $em)
     {
          if ($em != $conEm) {
               array_push($this->errArr, Constants::$emailMatch);
               return;
          }

          if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
               array_push($this->errArr, Constants::$emailInvail);
               return;
          }

          $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
          $query->bindValue(":em", $em);
          $query->execute();

          if ($query->rowCount() != 0) {
               array_push($this->errArr, Constants::$emailTaken);
          }
     }

     private function valPwd($pwd, $conPwd)
     {
          if ($pwd != $conPwd) {
               array_push($this->errArr, Constants::$pwdMatch);
               return;
          }
          if (strlen($pwd) <= 5 || strlen($pwd) > 25) {
               array_push($this->errArr, Constants::$pwdChar);
               return;
          }
     }

     public function getErr($err)
     {
          if (in_array($err, $this->errArr)) {
               return "<span class='errMess'>$err</span>";
          }
     }
}
