<style>
    .error{
    color: red;
    margin-left: 98px;
    margin-bottom: 10px;
}
</style>
<link rel="stylesheet" href="./css/register.css">
<link rel="stylesheet" href="./css/loginBtn.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</style>
<div class="khung">
    <div class="logoWeb">
        <img src="./img/logoT1.jpg" alt="">
    </div>
    <h2>Đăng ký tài khoản</h2>
    <form action="index.php?action=auth_register" method="post">
        <input type="text" name="username" placeholder="Tên đăng nhập" value="<?php echo $vlName; ?>" >
        <span class="error"><?php echo $errorName ?></span>
        <input type="email" name="email" placeholder="Email" value="<?php echo $vlEmail; ?>">
        <span class="error"><?php echo $errorEmail ?></span>
        <input type="password" name="password" placeholder="Mật khẩu"value="<?php echo $vlPass; ?>">
        <span class="error"><?php echo $errorPass ?></span>
        <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" value="<?php echo $vlCfPass; ?>">
        <span class="error"><?php echo $errorCfPass ?></span>
        <input type="number" name="phone" placeholder="Số điện thoại" value="<?php echo $vlSdt; ?>">
        <span class="error"><?php echo $errorsdt ?></span>
        <button type="submit" name="btn_register">Đăng ký</button>
    </form>
    <!-- <p>Hoặc</p>
        <button class="login-btn google">
            <i class="fab fa-google"></i> Đăng ký bằng Google
        </button>

        <button class="login-btn facebook">
            <i class="fab fa-facebook"></i> Đăng ký bằng Facebook
        </button>

        <button class="login-btn apple">
            <i class="fab fa-apple"></i> Đăng ký bằng Apple
        </button> -->
    <p>Đã có tài khoản? <a href="index.php?controller=auth&action=login">Đăng nhập</a></p>
</div>