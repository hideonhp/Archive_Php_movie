<?php
    if(isset($_POST["submitButton"])) {
        echo "Form was submitted";
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

                    <input type="text" name="uName" placeholder="Tài Khoản Là ?" required>

                    <input type="password" name="pwd" placeholder="Mật Khẩu Là ?" required>

                    <input type="submit" name="sm" value="Đăng Nhập">

                </form>

                <a href="register.php" class="sIMes">Chưa có tài khoản? Đăng ký tại đây!</a>

            </div>

        </div>

    </body>
</html>