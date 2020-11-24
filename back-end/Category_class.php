<?php 
    require_once "./back-end/DbServices.php";
    class Category extends DbServices{
        function getAllCategories(){
            $query = "SELECT * FROM tn_category";
            $result = $this->executeQuery($query);
            if($result===null){
                die("Lỗi khi thực hiện câu truy vấn");
            }
            return $result;
        }
    }
?>