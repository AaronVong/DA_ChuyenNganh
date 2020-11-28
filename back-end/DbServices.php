<?php 
    require_once "./back-end/DbVariables.php";

    class DbServices{
        private $pdo=null;
        function __construct(){
            if($this->pdo==null){
               try{
                    $this->pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASSWORD, PDOATTRS);
                    $this->pdo->query("set names utf8");
               }catch(PDOException $exception){
                    echo $exception->getMessage();
               } 
            }
        }

        function executeQuery($query, $params=[], $fetchMode=PDO::FETCH_ASSOC){
            // for SELECT, COUNT,... the staments fetch data from DB
            if($this->pdo===null){
                die("Oops! Không kết nối được với Cơ Sở Dữ Liệu");
            }
            $stament = $this->pdo->prepare($query);
            return $stament->execute($params)?$stament->fetchAll($fetchMode):null;
            // return Associative Array on SUCCESS or null if FAIL
        }

        function executeChangeDataQuery($query, $params=[], $fetchMode=PDO::FETCH_ASSOC){
            // for INSERT, UPDATE,... the staments that making change to the DB
            if($this->pdo===null){
                die("Oops! Không kết nối được với Cơ Sở Dữ Liệu");
            }
            $stament = $this->pdo->prepare($query);
            return  $stament->execute($params)?$stament->rowCount():null;
            // 0 for FAIL and POSITIVE number for SUCCESS

        }
        
        function prepareQuery($query){
            // using when the params in the query is a number or the executeQuery() way can't be done
            return $this->pdo->prepare($query);
            // return the stament;
        }
    }
?>