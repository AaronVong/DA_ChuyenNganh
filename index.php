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
        if(!isset($_SESSION)){
            session_start();
        }

        if(isset($_POST["signout"])){
            unset($_SESSION["user"]);
            exit("");
        }
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
            <?php include "./front-end/src/screen/homescreen.php"; ?>
        </main>
        <footer id="footer"></footer>
    </div>
    <script src="./front-end/slick/slick.min.js"></script>
    <script src="./front-end/js/cartEvents.js"></script>
    <script src="./front-end/js/slickSetting.js"></script>
    <script src="./front-end/js/hamburger.js"></script>
<script src="./front-end/js/search.js"></script>
</body>

</html>