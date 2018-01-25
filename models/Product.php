<?php



class Product{

    /*
     * SHOW_BY_DEFAULT number show products
     *
     */

    const SHOW_BY_DEFAULT = 6;


    /*
     *
     * Return is array of products;
     */

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT, $page = 1){

        $count = intval($count);
        $page = intval($page);
        $offset = $page * $count;

        $db = Db::getConnection();

        $productList = array();

        $result = $db->query('SELECT id, name, price, image, is_new FROM product '
            . 'WHERE status = "1" '
            . 'ORDER BY id DESC '
            . 'LIMIT ' . $count
            . ' OFFSET '. $offset);

        $i = 0;
        while ($row = $result->fetch()){
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['image'] = $row['image'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productList;
    }

    public static function getProductsListByCategory($categoryId = false, $page = 1){

        if ($categoryId){

            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();

            $products = array();

            $result = $db->query("SELECT id, name, price, image, is_new FROM product "
                . "WHERE status = '1' AND category_id = '$categoryId' "
                . "ORDER BY id ASC "
                . "LIMIT ".self::SHOW_BY_DEFAULT
                . " OFFSET ". $offset);

            $i = 0;
            while ($row = $result->fetch()){
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }

        return $products;
        }


    }




    public static function getProductById($id){
        $id = intval($id);

        if ($id){

            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM product WHERE id = ' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }

    }


    public static function getTotalProductsInCategory($categoryId){

        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
            . 'WHERE status = "1" AND category_id ='.$categoryId);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }


    public static function getProductsByIds($idsArray)
    {
        $products = array();

        $db = Db::getConnection();

        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }

        return $products;
    }

    public static function getRecommendedProducts()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, name, price, is_new FROM product '
            . ' WHERE status = "1" AND is_recommended = "1" '
            . ' ORDER BY id DESC');
        $i = 0;
        $productsList = array();

        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }









}