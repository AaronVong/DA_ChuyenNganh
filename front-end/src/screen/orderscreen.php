<div class="cart-screen">
    <?php
        $cartArr=[["product_id"=>"99", "product_name"=>"Iphone 11 plus", "product_originprice"=>"499999000","product_sale"=>"0.04"],
    ["product_id"=>"99", "product_name"=>"Iphone 8 plus", "product_originprice"=>"399999000","product_sale"=>"0.02"],
    ["product_id"=>"99", "product_name"=>"Iphone 7 plus", "product_originprice"=>"299999000","product_sale"=>"0.01"]
    ];
    include "./front-end/src/include/orderDetail.php";
    ?>
    <div class="payment">
        <div class="payment__row">
            <span>
                Tổng giá trị ban đầu:
            </span>
            <span>
                <?php echo "<script>document.write(stringToMoney("."9999999999"."));</script>"; ?>
            </span>
        </div>
        <div class="payment__row">
            <span>
                Giảm giá:
            </span>
            <span>
                <?php echo "<script>document.write(stringToMoney("."1000000"."));</script>"; ?>
            </span>
        </div>
        <div class="payment__row">
            <span>
                Phải trả:
            </span>
            <span>
                <?php echo "<script>document.write(stringToMoney("."9999999999"."));</script>"; ?>
            </span>
        </div>
    </div>
    <button class="btn showform" type="button">Mua bây giờ</button>
        <form action="order.php" method="post" class="order__form">
            <h3>Thông tin khách hang</h3>
            <div class="input-group">
                <label for="customer_name" class="label">Họ tên:</label>
                <input type="text" name="customer_name" id="customer_name" value="">
            </div>
            <div class="input-group">
                <label for="customer_phone" class="label">Số điện thoại:</label>
                <input type="text" name="customer_phone" id="customer_phone" value="">
            </div>
            <div class="input-group">
                <label for="customer_email" class="label">Email:</label>
                <input type="text" name="customer_email" id="customer_email" value="">
            </div>
            <div class="input-group">
                <label class="label">Địa chỉ nhận:</label>
                <label class="label">
                    <span>Tại của hàng</span>
                    <input type="radio" name="location" value="store" checked>
                </label>
                <label class="label">
                    <span>Khác</span>
                    <input type="radio" name="location" value="other">
                </label>
            </div>
            <div class="input-group" id="address" style="display:none">
                <label for="customer_address" class="label">Địa chỉ nhận hàng:</label>
                <input type="text" name="customer_address" id="customer_address" value="">
            </div>
            <div class="input-group">
                <label for="order_deadline" class="label">Ngày nhận hàng:</label>
                <input type="date" id="order_deadline" name="order_deadline" value="2018-11-23"
                    max="2020-12-31">
            </div>
            <div class="input-group">
                <label for="payments" class="label">Hình thức thanh toán:</label>
                <label for="payment--cod" class="label">
                    <span>COD:</span>
                    <input type="radio" name="payments" id="payments" value="cod" checked>
                </label>
            </div>
            <div class="input-group">
                <button type="submit" value="buying" name="buying" class="btn btn--buying">Đặt hàng</button>
            </div>
        </form>
</div>
<script src="./front-end/js/showform.js"></script>