<?php
    $news=[
        "Sam-samsung-398-110-398x110.png",
        "398-110-398x110-1.png",
        "Sam-samsung-398-110-398x110.png"
    ];
?>
<article class="news">
    <h4 class="title--news title">
        <span>Tin Khuyến mãi</span>
    </h4>
    <div class="posts">
    <?php
        foreach ($news as $image) {
    ?>
        <a href="#news" class="post__links"><img class="fluid-img post__images" src="<?php echo "https://via.placeholder.com/398x110"; ?>"></a>
    <?php
        }
    ?>
    </ul>
</div>