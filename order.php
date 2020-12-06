<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./front-end/css/style.css">
    <script src="https://kit.fontawesome.com/d210984464.js" crossorigin="anonymous"></script>
    <script src="./front-end/js/functions.js"></script>
    <script src="./front-end/js/jquery-3.5.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    <?php 
        ob_start();
        if(!isset($_SESSION)){session_start();}
        require "./back-end/Category_class.php";
        require "./back-end/Product_class.php";
        require "./back-end/Order_class.php";
        require "./back-end/Customer_class.php";
        require "./back-end/Status_class.php";
        $_product = new Product();
        $_order=new Order();
        $_status = new Status();
        $_customer= new Customer();
    ?>
        <div class="container container--biggest">
        <header id="header">
            <?php include "./front-end/src/include/navbar.php" ?>
        </header>
        <main id="main">
                <script src="./front-end/js/cartEvents.js"></script>
                <script src="./front-end/js/showform.js"></script>
                <script src="./front-end/js/navbar.js"></script>
                <script src="./front-end/js/search.js"></script>
        <?php 
        // Nhận Request thêm sản phẩm vào giỏ hàng
            if(isset($_POST['pid'])){
                $pid = $_POST["pid"];
                $curProduct = $_product->getProductById($pid);
                if(!isset($_SESSION["cart"])){
                    // lần đầu thêm vào giỏ
                    $cartArr = array();
                    $cartArr[$pid] = [
                        "name"=> $curProduct[0]["product_name"],
                        "price" => $curProduct[0]["product_originprice"],
                        "sale" => $curProduct[0]["product_sale"],
                        "thumbnail" => $curProduct[0]["product_thumb"],
                        "number"=>1,
                        "producer"=>$curProduct[0]["producer_name"],
                        "category" => $curProduct[0]["category_name"]
                    ];
                }else{
                    $cartArr= $_SESSION["cart"];
                    if(array_key_exists($pid,$cartArr)){
                        $prevNumber = (int)$cartArr[$pid]["number"];
                        // action (tăng hoặc giảm) chỉ xảy ra khi sản phẩm đã có trong cart
                        if(isset($_POST["action"])){
                            $action = $_POST["action"];
                            if($action==="decre"){
                                $prevNumber-=1;
                            }
                            if($action==="incre"){
                                $prevNumber+=1;
                            }
                        }else{
                            // nếu pid đã tồn tại và không action request thì số lượng +1
                            if($prevNumber<4){
                                $prevNumber+=1;
                            }
                        }
                        $cartArr[$pid]["number"] = $prevNumber;
                    }else{
                        // nếu chưa thực hiện thêm vào bình thường
                        $cartArr[$pid] = [
                        "name"=> $curProduct[0]["product_name"],
                        "price" => $curProduct[0]["product_originprice"],
                        "sale" => $curProduct[0]["product_sale"],
                        "thumbnail" => $curProduct[0]["product_thumb"],
                        "number"=>1,
                        "producer"=>$curProduct[0]["producer_name"],
                        "category" => $curProduct[0]["category_name"]];
                    }
                }
                $_SESSION["cart"]=$cartArr;
            }

            // nhận Request xóa sản phẩm khỏi giỏ hàng
            if(isset($_POST["removeId"])){
                echo "Xóa khỏi giỏ hàng";
                $rmid = $_POST["removeId"];
                $tempCart = $_SESSION["cart"];
                unset($tempCart[$rmid]);
                $_SESSION["cart"]=$tempCart;
            }


            // Đặt hàng, thêm vào DB
            $name="";
            $phone="";
            $email="";
            $deadline="";
            $address="";
            $services = new DBServices();
            if(isset($_POST["buying"])){
                if(isset($_SESSION["cart"])){
                    $cartArr = $_SESSION["cart"];

                    $deadline = $_POST["order_deadline"];
                    $payment = $_POST["payments"];
                    $address=$_POST["location"][0]=="other"?$_POST["customer_address"]:$_POST["location"][0];
                    $err=array();


                    if(!$services->checkAddress($address)){
                        $err[]= "Địa chỉ không hợp lệ";
                    }
                    
                    if($services->checkDate($deadline)==false){
                        $err[]="Ngày không hợp lệ";
                    }
                    if(count($err)===0 && isset($cartArr)){
                        $cemail = isset($_SESSION['user']["email"])?$_SESSION['user']["email"]:"";
                        $cid=$_customer-> getCIdByEmail($cemail);
                        if($cid!==""){
                            $isSuccess=$_order->createOrder($cid, $deadline,$address,$cartArr);
                            if($isSuccess){
                                echo "<h1 class='text--notify'>Đặt hàng thành công, quay về <a href='index.php'>Trang chủ</a></h1>";
                                unset($_SESSION["cart"]);
                                unset($cartArr);
                                exit();
                            }
                        }
                    }
                }
            }

            // yêu cầu thay đổi trạng thái đơn hàng của khách hàng
            if(isset($_POST["userAction"])){
                $oid = $_POST["oid"];
                $statusName = $_POST["userAction"];
                $statusId= $_status->getStatusIdByName($statusName);
                $_order->updateOrderStatusById($oid,$statusId);
            }

            // yêu càu xem đơn hàng của khách hàng
            if(isset($_GET["action"])){
                $action = $_GET["action"];
                if($action=="myorders"){
                    $cid = $_customer->getColumnByEmail("id",$_SESSION["user"]["email"]);
                    $customer_orders = $_order->getCustomerOrders($cid);
                    include "./front-end/src/screen/customerordersscreen.php";
                    exit();
                }
            }

            // lấy danh sách trong giỏ hàng để in ra
            if(isset($_SESSION["cart"])){
                $saleTotal=0;
                $priceTotal=0;
                $cartArr = $_SESSION["cart"];
                if(count($cartArr)===0){
                    exit("<h1 class='text--notify'>Giỏ hàng rỗng</h1>");
                }
            }else{
                exit("<h1 class='text--notify'>Giỏ hàng rỗng</h1>");
            }
        ?>
        <?php 
            include "./front-end/src/screen/orderscreen.php";
        ?>
        </main>
        <?php 
            include "./front-end/src/include/footer.php";
        ?>
    </div>
</body>
</html>