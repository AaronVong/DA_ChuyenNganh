<?php 
    require_once "./back-end/DbServices.php";;
    $db = new DbServices();
    $rs = $db->executeQuery("select * from tn_customer");
    var_dump($rs);
    $rs[0]["customer_name"]="Hirai Momo";
    var_dump($rs);
?>