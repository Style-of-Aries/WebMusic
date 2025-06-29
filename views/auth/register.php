<link rel="stylesheet" href="./css/register.css">
<link rel="stylesheet" href="./css/loginBtn.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<div class="khung">
    <div class="logoWeb">
        <img src="./img/logoT1.jpg" alt="">
    </div>
    <h2>Đăng ký tài khoản</h2>
    <form action="index.php?controller=auth&action=login" method="post">
        <input type="text" name="username" placeholder="Tên đăng nhập" >
        <input type="email" name="email" placeholder="Email" >
        <input type="password" name="password" placeholder="Mật khẩu" >
        <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" >
        <input type="text" name="phone" placeholder="Số điện thoại" >
        <button type="submit">Đăng ký</button>
    </form>
    <p>Hoặc</p>
        <button class="login-btn google">
            <i class="fab fa-google"></i> Đăng ký bằng Google
        </button>

        <button class="login-btn facebook">
            <i class="fab fa-facebook"></i> Đăng ký bằng Facebook
        </button>

        <button class="login-btn apple">
            <i class="fab fa-apple"></i> Đăng ký bằng Apple
        </button>
    <p>Đã có tài khoản? <a href="index.php?controller=auth&action=login">Đăng nhập</a></p>
</div>