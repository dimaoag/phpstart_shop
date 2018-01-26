<?php


class AdminCategoryController extends AdminBase{


    public function actionIndex(){

        self::checkAdmin();

        $categoriesList = Category::getCategoriesListAdmin();

        require_once ROOT . '/views/admin_category/index.php';
        return true;
    }


    public function actionCreate(){

        self::checkAdmin();

        $options = array();

        if (isset($_POST['submit'])){

            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];

            $errors = false;

            if (!isset($options['name']) || empty($options['name'])){
                $errors[] = 'Заполните поля';
            }

            if ($errors == false){

                $result = Category::createCategory($options);

                if ($result){
                    header("Location: /admin/category");
                }

                echo 'Error!';

            }
        }


        require_once ROOT . '/views/admin_category/create.php';
        return true;
    }


    public function actionUpdate($id){

        self::checkAdmin();

        $category = Category::getCategoryById($id);

        $options = array();

        if (isset($_POST['submit'])){

            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];

            $errors = false;

            if (!isset($options['name']) || empty($options['name'])){
                $errors[] = 'Заполните поля';
            }

            if ($errors == false){

                $result = Category::updateCategory($id, $options);

                if ($result){
                    header("Location: /admin/category");
                }

                echo 'Error!';

            }
        }

        require_once ROOT . '/views/admin_category/update.php';
        return true;
    }


    public function actionDelete($id){


        self::checkAdmin();

        if (isset($_POST['submit'])){
            $result = Category::deleteCategoryById($id);
            if ($result){
                header("Location: /admin/category");
            }
        }

        require_once ROOT . '/views/admin_category/delete.php';
        return true;
    }










}