<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 25.01.18
 * Time: 12:48
 */

class CartController
{
    public function actionAdd($id){

        Cart::addProduct($id);

        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    public function actionDelete($id)
    {
        // Удалить товар из корзины
        // Возвращаем пользователя на страницу
        Cart::deleteProductById($id);

        header("Location: /cart");
    }

    public function actionAddAjax($id){
        echo Cart::addProduct($id);
        return true;
    }

    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $productsInCart = false;

        // Получим данные из корзины
        $productsInCart = Cart::getProducts();

        if ($productsInCart) {
            // Получаем полную информацию о товарах для списка
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);

            // Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once(ROOT . '/views/cart/index.php');

        return true;
    }


    public function actionCheckout(){

        $categories = array();
        $categories = Category::getCategoriesList();

        $result = false;



        if (isset($_POST['submit'])){

            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];


            $errors = false;

            if (!User::checkName($userName)){
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }

            if (!User::checkPhone($userPhone)){
                $errors[] = 'Неправильный телефон';
            }


            if ($errors == false){

                $productsInCart = Cart::getProducts();


                if (User::isGuest()){
                    $userId = false;
                } else {
                    $userId = User::checkLogged();
                }

                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                $lastOrder = Order::getLastItem();

                if ($result){
//                    $adminEmail = 'dimaoag@gmail.com';
//                    $message = "<p>Link</p>";
//                    $subject = "Новый заказ: #ID {$lastOrder['id']}";
//
//                    $headers = "From: The Sender Name <vpsground.site>\r\n";
//                    $headers .= "Reply-To: mysite.loc\r\n";
//                    $headers .= "Content-type: text/html\r\n";
//                    $result = mail($adminEmail, $subject, $message, $headers);



                    Cart::clear();
                }

            } else {
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProdustsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
            }

        } else {

            $productsInCart = Cart::getProducts();

            if ($productsInCart == false){

                header("Location: /");

            } else {
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();

                $userName = false;
                $userPhone = false;
                $userComment = false;

                if (User::isGuest()){

                } else {

                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);

                    $userName = $user['name'];

                }

            }

        }

        require_once(ROOT . '/views/cart/checkout.php');

        return true;
    }





}