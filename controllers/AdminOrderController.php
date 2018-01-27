<?php


class AdminOrderController extends AdminBase {


    public function actionIndex(){


        self::checkAdmin();

        $ordersList = Order::getOrdersList();



        require_once ROOT . '/views/admin_order/index.php';
        return true;
    }


    public function actionView($id){

        self::checkAdmin();

        $order = Order::getOrderById($id);

        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products'], true);

        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
        $products = Product::getProdustsByIds($productsIds);




        require_once ROOT . '/views/admin_order/view.php';
        return true;
    }



    public function actionUpdate($id){

        self::checkAdmin();

        $order = Order::getOrderById($id);

        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $date = $_POST['date'];
            $status = $_POST['status'];

            // Сохраняем изменения
            Order::updateOrderById($id, $userName, $userPhone, $userComment, $date, $status);

            header("Location: /admin/order/view/$id");
        }


        require_once ROOT . '/views/admin_order/update.php';
        return true;
    }



    public function actionDelete($id){

        self::checkAdmin();

        if (isset($_POST['submit'])){

            $result = Order::deleteOrderById($id);
            if ($result){
                header("Location: /admin/order");
            }

        }

        require_once ROOT . '/views/admin_order/delete.php';
        return true;
    }



}