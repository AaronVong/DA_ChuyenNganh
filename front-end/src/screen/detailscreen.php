<?php 
  if(isset($_GET["pid"])){
    $pid = $_GET["pid"];
    $service = new DbServices();
    $productDetail = $service->getProductById($pid);
    if(count($productDetail)<=0){
      die("<h1>Không có kết quả phù hợp</h1>");
    }
  }else die("<h1>Trang Không tồn tại!</h1>");
?>
<div class="detail-screen">
    <div class="detail">
      <div class="detail__header">
        <h2 class="product__name"><?php echo $productDetail[0]["product_name"]; ?></h2>
      </div>
      
      <div class="detail__body">
        <div class="detail__image">
          <div>
            <img src="<?php echo "./front-end/images/products/".$productDetail[0]["producer_name"]."/".$productDetail[0]["category_name"]."s/".$productDetail[0]["product_thumb"];  ?>"></img>
          </div>
        </div>
        <div class="detail__describe">
          <h6>Thông số cơ bản</h6>
          <ul class="describe__list">
            <li>
              Nhà sản xuất:<span><?php echo $productDetail[0]["producer_name"];?></span>
            </li>
            <li>
              độ rộng:<span>6.1"</span>
            </li>
            <li>
              Độ phân giải: <span>828 x 1792 Pixels</span>
            </li>
            <li>
              Camera trước: <span>12 MP</span>
            </li>
            <li>
              Camera sau:<span>12 MP</span>
            </li>
            <li>
              Hệ điều hành:<span>Android 10</span>
            </li>
            <li>
              Chip:<span>Snap Dragon</span>
            </li>
            <li>
              RAM:<span>4GB</span>
            </li>
            <li>
              ROM:<span>128GB</span>
            </li>
            <li>
              Sim:<span>2 Sims</span>
            </li>
            <li>
              lorem posem:<span>lorem posem</span>
            </li>
            <li>
              lorem posem:<span>lorem posem</span>
            </li>
            <li>
              lorem posem:<span>lorem posem</span>
            </li>
            <li>
              lorem posem:<span>lorem posem</span>
            </li>
          </ul>
        </div>
        <div class="detail__info">
          <div class="info__price">        
            <?php 
            $sale =$productDetail[0]["product_sale"];
            ?>
            <?php
                if($sale>0){
            ?>
            <span class="product__price--old"><?php echo "<script>document.write(stringToMoney(".$productDetail[0]["product_originprice"]."));</script>";?></span>
            <span class="product__sale"><?php echo $sale*100; ?>%</span>
            <?php
                }
            ?>
            <span class="product__price">
                <?php echo "<script>document.write(stringToMoney(".$productDetail[0]["product_originprice"]*(1-$sale)."));</script>"; ?>
            </span>  
          </div>
          <div class="info__more">
            <ul class="more__list">
              <li>khuyến mãi 1</li>
              <li>khuyến mãi 2</li>
              <li>khuyến mãi 3</li>
              <li>khuyến mãi 4</li>
              <li>khuyến mãi 5</li>
              <li>khuyến mãi 5</li>
              <li>khuyến mãi 5</li>
              <li>khuyến mãi 5</li>
              <li>khuyến mãi 5</li>
            </ul>
          </div>
          <div class="detail__action">
            <a href="#" class="pay-btn links">
                <span>Mua Ngay</span>
            </a>

            <a href="#" class="cart-btn links">
                <span>thêm vào giỏ hàng</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <section class="related_products">
        <h3>Sản phẩm liên quan</h3>
        <!-- thêm danh sách sản phẩm dạng Carousel ở đây-->
    </section>
</div>