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


    public function actionLogout(){
        session_start();
        unset($_SESSION['user']);
        Cart::clear();
        header("Location: /");

        return true;
    }





}