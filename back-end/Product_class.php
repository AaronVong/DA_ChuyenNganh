<?php
    require_once "./back-end/DbServices.php";
    class Product extends DbServices{
        function getAllProducts(){
            $query = "select * from tn_product";
            $result = $this->executeQuery($query);
            if($result===null){
                die("Lỗi khi thực hiện câu truy vấn");
            }
            return $result;
        }

        function getHighlightProducts($number=4){
            $query = "SELECT product_id,product_name,product_thumb,product_originprice,product_sale,producer_name,category_name FROM tn_product
            INNER JOIN tn_producer ON tn_product.producer_id = tn_producer.producer_id
            INNER JOIN tn_category ON tn_product.category_id = tn_category.category_id
            WHERE tn_product.status_id = 1 AND tn_product.product_ishighlight = 1
            LIMIT 0,:number";
            
            // because the param (:number) is a number, so it have to using prepareQuery() from the DbServices class
            // and then use method bindValue() like normal
            $stament = $this->prepareQuery($query);
            $stament->bindValue(':number',$number,PDO::PARAM_INT);
            $result = $stament->execute()?$stament->fetchAll():null;
            if($result===null){
                die("Lỗi khi thực hiện câu truy vấn");
            }
            return $result;
        }

        function getProductsByCategoryId($categoryId){
            $query = "SELECT product_id,product_name,product_thumb,product_originprice,product_sale,producer_name,category_name, tn_product.category_id FROM tn_product
            INNER JOIN tn_producer ON tn_product.producer_id = tn_producer.producer_id
            INNER JOIN tn_category ON tn_product.category_id = tn_category.category_id
            WHERE tn_product.category_id=?";

            $result = $this->executeQuery($query,[$categoryId]);

            if($result===null){
                die("Lỗi khi thực hiện câu truy vấn");
            }
            return $result;
        }

        function getProductbyId($id){
            $query = "SELECT product_id,product_name,product_thumb,product_originprice,product_sale,producer_name,category_name,tn_product.category_id FROM tn_product
            INNER JOIN tn_producer ON tn_product.producer_id = tn_producer.producer_id
            INNER JOIN tn_category ON tn_product.category_id = tn_category.category_id
            WHERE product_id=:id";
            
            $result = $this->executeQuery($query, ["id"=>$id]);
            if($result===null){
                die("Lỗi khi thực hiện câu truy vấn");
            }
            return $result;
        }
    }
?>