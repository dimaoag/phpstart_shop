<?php

//include_once ROOT . '/models/Category.php';
//include_once ROOT . '/models/Product.php';

class SiteController{



    public function actionIndex(){

        $categories = array();
        $categories = Category::getCategoriesList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(6);


        $sliderProducts = Product::getRecommendedProducts();
        $activeProducts = Product::getActiveProducts();


        require_once (ROOT . '/views/site/index.php');
        return true;
    }

    public function actionContact(){
        $userEmail = '';
        $userText = '';
        $result = false;


        if (isset($_POST['submit'])){
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            $errors = false;

            if (!User::checkEmail($userEmail)){
                $errors[] = 'Неправильный email';
            }


            if ($errors == false){
                $adminEmail = 'dimaoag@gmail.com';
                $message = "<p>$userText</p><br>From: <p>$userEmail</p>";
                $subject = 'Тема письма';

                $headers = "From: The Sender Name <mysite.loc>\r\n";
                $headers .= "Reply-To: $userEmail\r\n";
                $headers .= "Content-type: text/html\r\n";
                $result = mail($adminEmail, $subject, $message, $headers);
            }
        }

        require_once (ROOT . '/views/site/contact.php');
        return true;
    }






}