<?php 
    foreach($cartArr as $product){
    ?>
    <div class="order-detail">
        <button class="btn btn--rmorder" type="button" name="remove-item" value="<?php echo $product["product_id"]; ?>">X</button>
        <h5><?php echo $product["product_name"]; ?></h5>
        <div class="order">
            <div class="order__thumb">
                <img src="https://via.placeholder.com/200x200">
            </div>
            <div class="order__info">
                <label class="label">
                    Số lượng:
                    <input type="number" min="1" max="10" value="1" class="order-number input">
                </label>
                <span class="order__price"><?php echo "<script>document.write(stringToMoney(".$product["product_originprice"]."));</script>"; ?></span>
            </div>
        </div>
    </div>
<?php
    }
?>