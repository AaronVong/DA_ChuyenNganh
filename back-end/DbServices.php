<?php 
    require "./back-end/DbVariables.php";

    class DbServices{
        private $pdo=null;

        function __construct(){
            if($this->pdo==null){
                $this->pdo = new PDO(getDSN(), DB_USER, DB_PASSWORD);
            }
        }
        function getAllProductsByCategory($type){
            $query = "CALL getAllProductsByCategory(?);";
            $stament = $this->pdo->prepare($query);
            $stament->execute([$type]);
            $rs = $stament->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }

        function getHighlightProducts(){
            $query = "CALL getHighLightProducts();";
            $stament = $this->pdo->prepare($query);
            $stament->execute();
            $rs = $stament->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }

        function getAllCategories(){
            $query = "CALL getAllCategories();";
            $stament = $this->pdo->prepare($query);
            $stament->execute();
            $rs = $stament->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }

        function getProductById($pid){
            $query = "CALL getProductById(?);";
            $stament = $this->pdo->prepare($query);
            $stament->execute([$pid]);
            $rs = $stament->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }

    }
?>