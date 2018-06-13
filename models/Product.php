<?php



class Product{

    /*
     * SHOW_BY_DEFAULT number show products
     *
     */

    const SHOW_BY_DEFAULT = 3;


    /*
     *
     * Return is array of products;
     */

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT, $page = 1){

        $count = intval($count);
        $page = intval($page);
        $offset = ($page - 1) * $count;

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
            . ' ORDER BY id DESC LIMIT 3;');
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

    public static function getActiveProducts()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, name, price, is_new, image FROM product '
            . ' WHERE status = "1" AND is_active = "1" '
            . ' ORDER BY id DESC LIMIT 3;');
        $i = 0;
        $productsList = array();

        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $productsList[$i]['image'] = $row['image'];
            $i++;
        }
        return $productsList;
    }





    public static function getProductsList(){

        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, name, price, is_active,code FROM product '
            . ' ORDER BY id ASC');

        $i = 0;
        $productsList = array();

        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['is_active'] = $row['is_active'];
            $i++;
        }
        return $productsList;
    }


    public static function deleteProductById($id){

        $db = Db::getConnection();

        $sql = 'DELETE FROM product '
            . 'WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);

        return $result->execute();
    }


    public static function createProduct($options){

        $db = Db::getConnection();

        $sql = 'INSERT INTO product '
            . '(name, category_id, code, price, availability, brand, description, is_new, is_recommended, is_active, status) '
            . 'VALUES '
            . '(:name, :category_id, :code, :price, :availability, :brand, :description, :is_new, '
            . ':is_recommended, :is_active, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':is_active', $options['is_active'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()){
            return $db->lastInsertId();
        }

        return 0;
    }



    public static function updateProduct($id ,$options){

        $db = Db::getConnection();


        $sql = 'UPDATE product SET
                  name = :name,
                  category_id = :category_id,
                  code = :code,
                  price = :price,
                  availability = :availability,
                  brand = :brand,
                  description = :description,
                  is_new = :is_new,
                  is_recommended = :is_recommended,
                  is_active = :is_active,
                  status = :status
                  WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':code', $options['code'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':is_active', $options['is_active'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();

    }


    /**
     * Возвращает список товаров с указанными индентификторами
     * @param array $idsArray <p>Массив с идентификаторами</p>
     * @return array <p>Массив со списком товаров</p>
     */
    public static function getProdustsByIds($idsArray)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(',', $idsArray);

        // Текст запроса к БД
        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результатов
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }

    public static function setImageById($id, $image){

        $db = Db::getConnection();


        $sql = 'UPDATE product SET
                  image = :image
                  WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':image', $image, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }



    public static function deleteImageById($id){

        unlink($_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");

        unlink($_SERVER['DOCUMENT_ROOT'] . "/upload/images/products_resize/{$id}.jpg");
    }



    public static function getImageById($id){

        $id = intval($id);

        if ($id){

            $db = Db::getConnection();

            $result = $db->query('SELECT image FROM product WHERE id = ' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }

    }

}