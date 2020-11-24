<div class="producer-navbar">
    <ul class="producer-list">
<?php
    $perRow = 6;
    $i=0;
    $amount = count($producers);
    while($i< $amount){
        if($i >= $perRow){
            break;
        }
?>
        <li>
            <a href="<?php echo "category.php?type=".$catid."&producer=".$producers[$i]["producer_id"]; ?>" class="links">
                <img class="fluid-img" src="<?php echo "./front-end/images/brands/".$producers[$i]["producer_thumb"];?>">
            </a>
        </li>
<?php
        $i++;
    }
    if($i >= $perRow){
        echo "<button class=\"btn links--showmore showmore-producer\">Xem thêm</button>";
    }
?>
        <div class="hidden-producer">
<?php 
    while($i < $amount){
?>
            <li>
                <a href="<?php echo "category.php?type=".$catid."&producer=".$producers[$i]["producer_id"]; ?>" class="links">
                    <img class="fluid-img" src="<?php echo "./front-end/images/brands/".$producers[$i]["producer_thumb"];?>">
                </a>
            </li>            
<?php
$i++;
    }
?>
        </div>
    </ul>
</div>