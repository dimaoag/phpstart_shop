<?php


class AdminProductController extends AdminBase{

    public function actionIndex(){

        self::checkAdmin();

        $productsList = Product::getProductsList();

        require_once ROOT . '/views/admin_product/index.php';
        return true;
    }



    public function actionCreate(){

        self::checkAdmin();

        $categoriesList = Category::getCategoriesListAdmin();

        $options = array();

        if (isset($_POST['submit'])){

            $options['name'] = $_POST['name'];
            $options['category_id'] = $_POST['category_id'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['availability'] = $_POST['availability'];
            $options['brand'] = $_POST['brand'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];


            $errors = false;

            if (!isset($options['name']) || empty($options['name'])){
                $errors[] = 'Заполните поля';
            }

            if ($errors == false){

                $idNewProduct = Product::createProduct($options);

                if ($idNewProduct){


                }

                header("Location: /admin/product");
            }
        }

        require_once ROOT . '/views/admin_product/create.php';
        return true;
    }


    public static function actionUpdate($id){

        self::checkAdmin();

        $categoriesList = Category::getCategoriesListAdmin();

        $product = Product::getProductById($id);

        $options = array();

        if (isset($_POST['submit'])){

            $options['name'] = $_POST['name'];
            $options['category_id'] = $_POST['category_id'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['availability'] = $_POST['availability'];
            $options['brand'] = $_POST['brand'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            $errors = false;

            if (!isset($options['name']) || empty($options['name'])){
                $errors[] = 'Заполните поля';
            }

            if ($errors == false){

                $idNewProduct = Product::updateProduct($id ,$options);

                if ($idNewProduct){


                }

                header("Location: /admin/product");
            }

        }


        require_once ROOT . '/views/admin_product/update.php';
        return true;
    }


    public function actionDelete($id){

        self::checkAdmin();

        if (isset($_POST['submit'])){
            $result = Product::deleteProductById($id);
            if ($result){
                header("Location: /admin/product");
            }
        }

        require_once ROOT . '/views/admin_product/delete.php';
        return true;
    }


}