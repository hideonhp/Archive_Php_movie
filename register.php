<?php
if (isset($_POST["sm"])) {
     echo "ok";
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

                    <input type="text" name="fName" placeholder="Họ!" required />

                    <input type="text" name="lName" placeholder="Tên!" required />

                    <input type="text" name="uName" placeholder="Tài Khoản!" required />

                    <input type="email" name="email" placeholder="Email!" required />

                    <input type="email" name="conEmail" placeholder="Nhập Lại Email!" required />

                    <input type="password" name="pwd" placeholder="Mật Khẩu Là ?" required />

                    <input type="password" name="conPwd" placeholder="Nhập Lại Mật Khẩu" required />

                    <input type="submit" name="sm" value="Đăng Ký" />

               </form>

               <a href="login.php" class="sIMes">Đã có tài khoản? Đăng Nhập ở đây!</a>

          </div>
     </div>
</body>

</html>