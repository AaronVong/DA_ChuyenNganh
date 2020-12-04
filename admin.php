<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./front-end/css/admin.css">
    <title>Admin</title>
    <script src="./front-end/js/jquery-3.5.0.min.js"></script>
    <script src="https://kit.fontawesome.com/d210984464.js" crossorigin="anonymous"></script>
    <script src="./front-end/js/functions.js"></script>
</head>
<body>
    <?php 
        require "./back-end/Category_class.php";
        require "./back-end/Producer_class.php";
        require "./back-end/Product_class.php";
        require "./back-end/Status_class.php";
        require "./back-end/Order_class.php";
        require "./back-end/Customer_class.php";
        $_order= new Order();
        $_customer = new Customer();
        $_producer= new Producer();
        $_product = new Product();
        $_category = new Category();
        $_status = new Status();

    ?>
   <div class="container">
        <?php include "./front-end/src/include/admin/navbar.php";?>
        <main id="main">
            <?php
                $fnc = isset($_GET['fnc'])?$_GET['fnc']:"";
                switch($fnc){
                    case 'qlsp':{
                        $products = $_product->getAllProducts();
                        $categories = $_category->getAllCategories();
                        $producers = $_producer->getAllProducers();
                        $statuses = $_status->getAllStatuses();
                        include "./front-end/src/screen/admin/qlspscreen.php";
                    }
                    break;
                    case 'qldh':{
                        $orders = $_order->getAllOrders();
                        include "./front-end/src/screen/admin/qldhscreen.php";
                    }
                    break;
                    case "qlkh":{
                        $customers = $_customer->getAllCustomers();
                        include "./front-end/src/screen/admin/qlkhscreen.php";
                    }
                break;
                    default:
                break;
                }
            ?>
        </main>
        <footer>
            <h1>Made By AaronVong</h1>
        </footer>
   </div>
   <script src="./front-end/js/admin.js"></script>
</body>
</html>