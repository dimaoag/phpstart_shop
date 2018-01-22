<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 19.01.18
 * Time: 21:15
 */


class Router{
    private $routes;

    public function __construct(){
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }


    /*
     * Return request string
     *
     * */

    private function getURI(){
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'],'/');
        }

    }

    public function run(){

        // Получить строку запроса

        $uri = $this->getURI();

        // проверить наличие такаго запроса в routes.php

        foreach ($this->routes as $uriPattern => $path){
            if (preg_match("~$uriPattern~", $uri)){

                //определить какой контролер и метод обробатывает запрос

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                // разделения строки в масив

                $segments = explode('/', $internalRoute);

                // получаеи первый елемент масива и формируем имя контролера

                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action'.ucfirst(array_shift($segments));

                $parameters = $segments;


                //Подключить файл класса-контролера

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                //проверяем существует ли такой файл на диске

                if (file_exists($controllerFile)){
                    include_once($controllerFile);
                }

                //создание обекта, вызов метода(action)

                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null){ //выход с цикла foreach;
                    break;
                }


            }
        }
    }

}