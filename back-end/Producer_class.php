<?php 
    require_once "./back-end/DbServices.php";
    class Producer extends DbServices{
        function getAllProducers(){
            $query = "SELECT * FROM tn_producer 
            WHERE (SELECT COUNT(product_id) FROM tn_product WHERE tn_producer.producer_id = tn_product.producer_id) > 0";
            $result = $this->executeQuery($query);
            if($result===null){
                die("Lỗi khi thực hiện câu truy vấn");
            }
            return $result;
        }
    }
?>