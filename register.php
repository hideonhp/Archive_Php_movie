<?php
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/FormSanitizer.php");

$account = new Account($con);

if (isset($_POST["sm"])) {
     $fName = FormSanitizer::sanFormString($_POST["fName"]);
     $lName = FormSanitizer::sanFormString($_POST["lName"]);
     $uName = FormSanitizer::sanFormUser($_POST["uName"]);
     $email = FormSanitizer::sanFormEmail($_POST["email"]);
     $conEmail = FormSanitizer::sanFormEmail($_POST["conEmail"]);
     $pwd = FormSanitizer::sanFormPwd($_POST["pwd"]);
     $conPwd = FormSanitizer::sanFormPwd($_POST["conPwd"]);

     $success = $account->register($fName, $lName, $uName, $email, $conEmail, $pwd, $conPwd);

     if ($success){
          $_SESSION["userLoggedIn"] = $uName;
          header("Location: index.php");
     }
}
function getInputValue($name){
     if (isset($_POST[$name])){
         echo $_POST[$name];
     }
 }
?>

<!DOCTYPE html>
<html>

<head>
     <title>Đăng Ký Tài Khoản</title>
     <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
</head>

<body>
     <div class="sICon">
          <div class="col">
               <div class="hd">
                    <img src="assets/images/logo.png" title="Logo" alt="logo">
                    <h3>Đăng Ký Tài Khoản</h3>
                    <span>Để có thể sử dụng hệ thống !!!</span>
               </div>

               <form method="POST">

                    <?php echo $account->getErr(Constants::$fNameChar); ?>
                    <input type="text" name="fName" placeholder="Họ!" value="<?php getInputValue("fName");?>" required />

                    <?php echo $account->getErr(Constants::$lNameChar); ?>
                    <input type="text" name="lName" placeholder="Tên!" value="<?php getInputValue("lName");?>" required />

                    <?php echo $account->getErr(Constants::$uNameChar); ?>
                    <?php echo $account->getErr(Constants::$uNameTaken); ?>
                    <input type="text" name="uName" placeholder="Tài Khoản!" value="<?php getInputValue("uName");?>" required />

                    <?php echo $account->getErr(Constants::$emailMatch); ?>
                    <?php echo $account->getErr(Constants::$emailInvail); ?>
                    <input type="email" name="email" placeholder="Email!" value="<?php getInputValue("email");?>" required />

                    <input type="email" name="conEmail" placeholder="Nhập Lại Email!" value="<?php getInputValue("conEmail");?>" required />

                    <?php echo $account->getErr(Constants::$pwdMatch); ?>
                    <?php echo $account->getErr(Constants::$pwdChar); ?>
                    <input type="password" name="pwd" placeholder="Mật Khẩu Là ?" required />

                    <input type="password" name="conPwd" placeholder="Nhập Lại Mật Khẩu" required />

                    <input type="submit" name="sm" value="Đăng Ký" />

               </form>

               <a href="login.php" class="sIMes">Đã có tài khoản? Đăng Nhập ở đây!</a>

          </div>
     </div>
</body>

</html>