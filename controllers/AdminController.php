<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 26.01.18
 * Time: 16:06
 */

class AdminController extends AdminBase
{

    public function actionIndex(){


        self::checkAdmin();



        require_once ROOT . '/views/admin/index.php';

        return true;

    }


    public static function getIsAdmin(){

        $isAdmin =  self::checkAdmin();

        return $isAdmin;
    }



}