<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechNow</title>
    <link rel="stylesheet" href="./front-end/css/style.css">
    <link rel="stylesheet" href="./front-end/slick/slick-theme.css">
    <link rel="stylesheet" href="./front-end/slick/slick.css">
    <script src="./front-end/js/functions.js"></script>
    <script src="./front-end/js/jquery-3.5.0.min.js"></script>
    <script src="https://kit.fontawesome.com/d210984464.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php 
        require "./back-end/Product_class.php";
        require "./back-end/Category_class.php";
        require "./back-end/Producer_class.php";
    ?>
    <div class="container container--biggest">
        <header id="header">
            <?php include "./front-end/src/include/navbar.php" ?>
        </header>
        <main id="main">
            <section class="section" id="banner">
                <div class="banner__carousel">
                    <?php include "./front-end/src/include/bannerCarousel.php" ?>
                </div>
                <div class="banner__news">
                    <?php include "./front-end/src/include/news.php"?>
                </div>
            </section>
            <!-- Vì có die() nên đặt ở đây để không bị lỗi-->
            <script src="./front-end/slick/slick.min.js"></script>
            <?php 
                if(isset($_GET["type"])){
                    $catid = $_GET["type"];
                    $_product = new Product();
                    $products = $_product->getProductsByCategoryId($catid);
                    if(count($products)<=0){
                        die("<h1>$catid không có sản phẩm nào cả</h1>");
                    }
                    $_producer=new Producer();
                    $producers = $_producer->getAllProducers();
            ?>

            <?php include "./front-end/src/include/producerNavbar.php"; ?>

            <div class="category">
                <?php include "./front-end/src/include/products.php";?>
            </div>
            <?php
                }else exit("<h1>Trang Không tồn tại!</h1>");
            ?>
        </main>
        <footer id="footer"></footer>
    </div>
    <script src="./front-end/js/showmoreproducers.js"></script>
</body>

</html>