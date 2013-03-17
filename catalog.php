<?php
require_once("_init.php");
define("CAT", 1);

$catalog = new Catalog;
$bc_arr = $catalog->get_all_front();

$product = New Product;
$product_arr = $product->get_all_front($_GET['c']);

require_once("inc/head.inc.php");
?>
<div class="body">
    <div class="banner">
        <div class="container">            	
            <div class="gallery">
                <div class="media"></div>                
            </div>
            <ul class="crumb">
                <li><a href="index.php">Home</a>/</li>
                <li>Products</li>
            </ul>
            <div class="title">
                <div class="intro">
                    <h1>Products</h1>                        
                </div>                           
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container clearfix">
            <div class="left-col">
                <ul class="side-nav">
                    <?php
                    foreach ($bc_arr as $v)
                    {
                        ?>
                        <li <?php echo $v['id'] == $_GET['c'] ? 'class="active"' : ''; ?>>
                            <a href="products.php?c=<?php echo $v['id']; ?>"><?php echo $v['title']; ?></a>
                            <ul>
                                <?php
                                $cat_arr = $catalog->get_cat_all_front($v['id']);

                                foreach ($cat_arr as $v2)
                                {
                                    ?>
                                    <li <?php echo $v2['id'] == $_GET['c'] ? 'class="active"' : ''; ?>><a href="products.php?c=<?php echo $v2['id']; ?>"><?php echo $v2['title']; ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <ul class="side-news">
                    <?php include_once("inc/side.news.inc.php"); ?>
                </ul>
            </div>
            <div class="right-col">
                <ul class="products-list">
                    <?php
                    foreach ($cat_arr = $catalog->get_cat_all_front($_GET['c']) as $v)
                    {
                        ?>
                        <li class="item">
                            <a href="products.php?c=<?php echo $v['id']; ?>">
                                <img src="<?php echo $catalog->get_pre_img($v['path']); ?>" />
                                <h1><?php echo $v['title']; ?></h1>
                                <!--<p><?php echo mb_substr(strip_tags($v['brief']), 0, 50) . '...'; ?></p>-->
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>            	            
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(e) {
        $('.products-list .item:nth-child(3n)').addClass('lst');
    });
</script>
<?php
require_once("inc/footer.inc.php");