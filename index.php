<?php
require_once("_init.php");
require_once("./lang/index.lang.php");
require_once("inc/head.inc.php");
// print_r($_LANG);
$banner = new Banner;
$banner_arr = $banner->get_all_front();

$product = new Product;
$product_arr = $product->get_all_front('', 20);

$news = new News;
$news_arr = $news->get_front(3);
?>
<div class="body">
    <div class="banner index">
        <div class="container">
            <div class="gallery">
                <?php
                foreach ($banner_arr as $v)
                {
                    if ($v['type'] == '0')
                    {
                        ?>
                        <div class="media" data-type="image" style="background-image:url(<?php echo $banner->get_dir() . $v['path']; ?>);"></div>
                        <?php
                    }
                    elseif ($v['type'] == '1')
                    {
                        ?>
                        <div class="media" data-type="video" ><div id="<?php echo $banner->get_youtubeID($v['path']); ?>"></div></div>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
            foreach ($banner_arr as $v)
            {
                ?>
                <div class="title">
                    <div class="intro">
                        <h1><?php echo $v['title']; ?></h1>
                        <div class="content"><?php echo strip_tags($v['content']) . '...'; ?></div>
                        <a href="<?php echo $v['link']; ?>" target="_blank" class="more">Learn More</a>
                    </div>                           
                </div>
                <?php
            }
            ?>
            <div class="pager">  
                <?php
                foreach ($banner_arr as $v)
                {
                    ?>
                    <div>
                        <div class="pop">
                            <div class="bg">
                                <h1><?php echo $v['title']; ?></h1>
                                <p><?php echo mb_substr(strip_tags($v['content']), 0, 50) . '...'; ?></p>
                            </div>
                            <span class="arrow"></span>
                        </div>
                        <a href="#" class="stick"><img src="<?php echo $banner->get_pre_img($v['type'], $v['path']); ?>" width="50"/></a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container clearfix">
            <div class="index-new-products">
                <a href="#" class="prev"><span class="arrow"></span></a>
                <div class="frame">
                    <?php
                    $counts = count($product_arr);
                    foreach ($product_arr as $k => $v)
                    {
                        if (($k) % 5 == 0 || $k == 0)
                            echo'<div class="group">';
                        ?>
                        <?php echo $k; ?><a class="item" href="product_detail.php?id=<?php echo $v['id']; ?>">
                            <span class="photo"><img src="<?php echo $product->get_pre_img($v['path']); ?>" /></span>
                            <span class="name"><?php echo $v['title']; ?></span>
                        </a>
                        <?php
                        if (($k + 1) % 5 == 0 || (($k + 1) == $counts))
                            echo '</div>';
                    }
                    ?>
                </div>
                <a href="#" class="next"><span class="arrow"></span></a>
            </div>
            <div class="index-news">
                <?php
                foreach ($news_arr as $k => $v)
                {
                    ?>
                    <div class="item <?php echo $k == 2 ? "lst" : "" ?>">
                        <div class="photo" style="background-image:url(<?php echo $news->get_pre_img($v['path']); ?>)"></div>
                        <a href="news.php?id=<?php echo $v['id']; ?>" class="content">
                            <h1><?php echo $v['title']; ?></h1>
                            <p><?php echo mb_substr(strip_tags($v['content']), 0, 50); ?></p>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>            
    </div>
</div>
<?php
require_once("inc/footer.inc.php");