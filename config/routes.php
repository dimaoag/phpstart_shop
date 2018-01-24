<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 19.01.18
 * Time: 21:26
 */

return array(
    'product/([0-9]+)' => 'product/view/$1',


    'catalog' => 'catalog/index',

    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',

    'user/register' => 'user/register',
    'user/login' => 'user/login',


    'cabinet' => 'cabinet/index',



    '' => 'site/index',

);
