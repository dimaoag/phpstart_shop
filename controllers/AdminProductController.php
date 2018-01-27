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

                    if (is_uploaded_file($_FILES['image']['tmp_name'])){
                        $image = "/upload/images/products/{$idNewProduct}.jpg";
                        $fullPathImage = $_SERVER['DOCUMENT_ROOT'] . $image;
                        move_uploaded_file($_FILES['image']['tmp_name'], $fullPathImage);
                        Product::setImageById($idNewProduct, $image);

                    } else {
                        $image = "/upload/images/products/no-image.jpg";
                        Product::setImageById($idNewProduct, $image);
                    }

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

                $idUpdateProduct = Product::updateProduct($id ,$options);

                if ($idUpdateProduct){

                    if (is_uploaded_file($_FILES['image']['tmp_name'])){

                        $noneImage = "/upload/images/products/no-image.jpg";
                        $oldImage = Product::getImageById($id);

                        if (!$oldImage['image'] == $noneImage){
                            Product::deleteImageById($id);

                            $image = "/upload/images/products/{$id}.jpg";
                            $fullPathImage = $_SERVER['DOCUMENT_ROOT'] . $image;
                            move_uploaded_file($_FILES['image']['tmp_name'], $fullPathImage);
                            Product::setImageById($id, $image);

                        } else {

                            Product::deleteImageById($id);
                            $image = "/upload/images/products/{$id}.jpg";
                            $fullPathImage = $_SERVER['DOCUMENT_ROOT'] . $image;
                            move_uploaded_file($_FILES['image']['tmp_name'], $fullPathImage);
                            Product::setImageById($id, $image);
                        }


                    } else {
                        $image = "/upload/images/products/no-image.jpg";
                        Product::setImageById($idUpdateProduct, $image);
                    }
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
            Product::deleteImageById($id);
            if ($result){
                header("Location: /admin/product");
            }
        }

        require_once ROOT . '/views/admin_product/delete.php';
        return true;
    }


}