<?php
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/FormSanitizer.php");

$account = new Account($con);

if (isset($_POST["sm"])) {

    $uName = FormSanitizer::sanFormUser($_POST["uName"]);
    $pwd = FormSanitizer::sanFormPwd($_POST["pwd"]);

    $success = $account->login($uName, $pwd);

    if ($success) {
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
    <title>Welcome to Reeceflix</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
</head>

<body>

    <div class="sICon">

        <div class="col">

            <div class="hd">
                <img src="assets/images/logo.png" title="Logo" alt="Site logo" />
                <h3>Đăng Nhập</h3>
                <span>Để sử dụng hệ thống!!!</span>
            </div>

            <form method="POST">

                <?php echo $account->getErr(Constants::$logFailed); ?>
                <input type="text" name="uName" placeholder="Tài Khoản Là ?" value="<?php getInputValue("uName");?>" required>

                <input type="password" name="pwd" placeholder="Mật Khẩu Là ?" required>

                <input type="submit" name="sm" value="Đăng Nhập">

            </form>

            <a href="register.php" class="sIMes">Chưa có tài khoản? Đăng ký tại đây!</a>

        </div>

    </div>

</body>

</html>