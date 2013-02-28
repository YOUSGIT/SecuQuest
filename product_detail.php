<?php
require_once("_init.php");
define("CAT", 1);

$catalog = new Catalog;
$bc_arr = $catalog->get_all_front();

$product = New Product;
$id = (!$_GET['id']) ? (int) $ret['id'] : $_GET['id'];
$ret = $product->get_detail_front($id);

$pro_imgs = $product->get_img_detail_front($id);

$support = new Support;
$downloads = $support->get_down_product_front($id);
require_once("inc/head.inc.php");
?>
<div class="body">
    <div class="banner product">
        <div class="container">            	
            <div class="gallery">
                <?php
                foreach ($pro_imgs as $v)
                {
                    ?>
                    <div class="media" data-type="image" style="background-image:url(<?= $product->get_dir() . $v['path']; ?>);"></div>
                    <?php
                }
                ?>
            </div>
            <ul class="crumb">
                <li><a href="index.php">Home</a>/</li>
                <li>Products</li>
            </ul>
            <div class="title">
                <div class="intro">
                    <h1><?= $ret['title'] ?></h1>
                    <div class="content"><?= nl2br($ret['brief']); ?></div>               
                </div>                           
            </div>
            <div class="pager">   
                <?php
                foreach ($pro_imgs as $v)
                {
                    ?>
                    <div>
                        <a href="#" class="stick"><img src="<?= $product->get_pre_img($v['path']); ?>" width="50"/></a>
                    </div>
                    <?php
                }
                ?>
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
                        <li <?= $v['id'] == $catalog->get_parent_for_product($ret['parent']) ? 'class="active"' : ''; ?>>
                            <a href="products.php?c=<?= $v['id']; ?>"><?= $v['title']; ?></a>
                            <ul>
                                <?php
                                $cat_arr = $catalog->get_cat_all_front($v['id']);

                                foreach ($cat_arr as $v2)
                                {
                                    ?>
                                    <li <?= $v2['id'] == $ret['parent'] ? 'class="active"' : ''; ?>><a href="products.php?c=<?= $v2['id']; ?>"><?= $v2['title']; ?></a></li>
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
                <ul class="product-switch">
                    <li><a href="#features" class="active">Features</a></li>
                    <li><a href="#specifications">Specifications</a></li>
                    <li><a href="#downloads">Downloads</a></li>
                </ul>
                <div id="features" class="product-detail">
                    <p><?= nl2br($ret['feature']); ?></p>
                </div>
                <div id="specifications" class="product-detail">
                    <p><?= nl2br($ret['spec']); ?></p>                   	
                </div>
                <div id="downloads" class="product-detail">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-normal">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Size</th>
                            <th>Download</th>
                        </tr>
                        <?php
                        foreach ($downloads as $v)
                        {
                            ?>
                            <tr>
                                <td><?= $v['title']; ?></td>
                                <td><?= $v['brief']; ?></td>
                                <td align="center"><?= date('Y-m-d', strtotime($v['dates'])); ?></td>
                                <td align="center"><?= file_size($support->get_dir() . $v['path']); ?> MB</td>
                                <td align="center"><a class="btn btn-warning" href="readfile.php?title=<?= base64_encode('attach'); ?>&t1=<?= base64_encode(Extension($v['path'])); ?>&b=<?= base64_encode($support->get_dir() . $v['path']); ?>" class="download"><i class="icon-download-alt icon-white"></i>Download</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>            	            
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(e) {
            
        setPage();
        $(".product-switch a").click(setPage);
            
        $('.banner .gallery').cycle({
            fx:'fade',
            pager:'.pager',
            timeout:0,
            autostop:1,
            pagerAnchorBuilder: function(index, element) {				
                return $(".pager A:eq("+(index)+")");
            }
        });
    });
        
    function setPage(){
        $(".product-detail").hide();		
        if(window.location.hash=="") window.location.hash = "#features";
        var t;
        try{
            t="#"+$(this).prop("href").split('#')[1];
        }catch(e){ t=window.location.hash;}
        $(t).fadeIn();
            
            
            
        $(".product-switch a").removeClass("active");
            
        $(".product-switch a").each(function(index, element) {
            if("#"+$(this).prop("href").split('#')[1]==t)
                $(this).addClass("active");
        });		
            
        return false;
            
    }
        
</script>
<?php
require_once("inc/footer.inc.php");