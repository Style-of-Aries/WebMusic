<?php
require_once "./../models/authModel.php";
class authController
{


    private $authModel;

    public function __construct()
    {
        $this->authModel = new authModel();
    }
    
    public function login()
    {
        $errorLogin="";
        require_once "./../views/auth/login.php";
    }
    public function auth_login(){
        $errorLogin="";
        echo "<br>". __METHOD__;
        if(isset($_POST['btn_login'])){
            $emailLogin=$_POST['email'];
            $passLogin=$_POST['password'];
            if($emailLogin=="admin123" && $passLogin=="123"){
                header('location:index.php?controller=admin&action=index');
            }
            $user=$this->authModel->authUsersLogin($emailLogin,$passLogin);
            // var_dump($user);
            if($user){
                header('location:index.php?controller=user&action=index');
            }else{
                $errorLogin="Thông tin tài khoản mật khẩu không chính xác";
                include_once "./../views/auth/login.php";
            }
                // header('location:index.php?controller=user&action=index');
            
        }
    }

    //Xử lí chức năng đăng ký
    public function register()
    {
        $vlName = $vlEmail = $vlPass = $vlCfPass = $vlSdt = "";
        $error = $errorPass = $errorName = $errorEmail = $errorCfPass = $errorsdt = "";
        require_once "./../views/auth/register.php";
    }
    public function auth_register()
    {
        $vlName = $vlEmail = $vlPass = $vlCfPass = $vlSdt = "";
        $error = $errorPass = $errorName = $errorEmail = $errorCfPass = $errorsdt = "";
        // $authError = 0;

        if (isset($_POST['btn_register'])) {
            $userNameRegister = $_POST['username'];
            $emailRegister = $_POST['email'];
            $passRegister = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $sdtRegister = $_POST['phone'];

            if ($userNameRegister == "") {
                $errorName = "Vui lòng không để trống";
            } elseif ($this->authModel->authUserName($userNameRegister)) {
                $errorName = "Tài khoản đã tồn tại";
            } else {
                $vlName = $userNameRegister;
            }
            if ($emailRegister == "") {
                $errorEmail = "Vui lòng không để trống";
            } elseif ($this->authModel->authEmail($emailRegister)) {
                $errorEmail = "Email đã tồn tại";
            } else {
                $vlEmail = $emailRegister;
            }
            if ($passRegister == "") {
                $errorPass = "Vui lòng không để trống";
            } else {
                $vlPass = $passRegister;
            }
            if ($confirm_password != $passRegister) {
                $errorCfPass = "Mật khẩu không chính xác";
            } else {
                $vlCfPass = $confirm_password;
            }
            if ($sdtRegister == "") {
                $errorsdt = "Vui lòng không để trống";
            } else {
                $vlSdt = $sdtRegister;
            }
            if ($vlName = $vlEmail = $vlPass = $vlCfPass = $vlSdt != "") {
                $this->authModel->authUsers($userNameRegister, $emailRegister, $passRegister, $sdtRegister);
                $this->login();
            }
            include_once "./../views/auth/register.php";
        }
    }

    //Xử lý chức năng đăng nhập

}
