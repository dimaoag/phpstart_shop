<?php

class UserController{


    public function actionRegister(){
        $name = '';
        $email = '';
        $password = '';
        $result = false;


        if (isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkName($name)){
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }

            if (!User::checkEmail($email)){
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)){
                $errors[] = 'Пароль не должно быть короче 6-х символов';
            }

            if (User::checkEmailExist($email)){
                $errors[] = 'Такой email уже существует';
            }


            if ($errors == false){
                $result = User::register($name, $email, $password);
                $lastUser = User::getLastUser();
                if ($result){
                    User::auth($lastUser['id']);
                    header("Location: /cabinet/");
                }

            }


        }


        require_once ROOT .'/views/user/register.php';

        return true;
    }

    public function actionLogin(){

        $email = '';
        $password = '';

        if (isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkEmail($email)){
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)){
                $errors[] = 'Пароль не должно быть короче 6-х символов';
            }

            $userId = User::checkUserData($email, $password);

            if ($userId == false){
                $errors[] = 'Неправильный логин или пароль!';

            }else{
                User::auth($userId);

                header("Location: /cabinet/");
            }



        }

        require_once ROOT .'/views/user/login.php';

        return true;
    }


    public function actionRemind(){

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];

            $errors = false;

            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!User::checkEmailExist($email)) {
                $errors[] = 'Неправильный email';
            } else {

                $password= User::getPasswordByEmail($email);


//                $adminEmail = 'dimaoag@gmail.com';
//                $message = "<h3>Пароль от vpsground.site: </h3><p>$password</p>";
//                $subject = 'Ввостановление пароля';
//
//                $headers = "From:  <vpsground.site>\r\n";
//                $headers .= "Reply-To: $adminEmail\r\n";
//                $headers .= "Content-type: text/html\r\n";
//                $result = mail($email, $subject, $message, $headers);

                $result = 1;

                if ($result){
                    header("Location: /user/login");
                }
            }
        }

        require_once ROOT . '/views/user/remindPassword.php';

        return true;
    }


    public function actionLogout(){
        session_start();
        unset($_SESSION['user']);
        Cart::clear();
        header("Location: /");

        return true;
    }





}