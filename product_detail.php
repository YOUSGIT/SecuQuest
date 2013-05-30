<?php
require_once("_init.php");
require_once("./lang/index.lang.php");
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
        <div class="container block">            	
            <div class="gallery">
                <?php
                foreach ($pro_imgs as $v)
                {
                    ?>
                    <div class="media" data-type="image" style="background-image:url(<?php echo $product->get_dir() . $v['path']; ?>);"></div>
                    <?php
                }
                ?>
            </div>
            <ul class="crumb">
                <li><a href="index.php"><?php echo $_LANG['btn']['Home'][LANG]; ?></a>/</li>
                <li><?php echo $_LANG['btn']['Products'][LANG]; ?></li>
            </ul>
            <div class="title">
                <div class="intro">
                    <h1><?php echo $ret['title'] ?></h1>
                    <div class="content"><?php echo $ret['brief']; ?></div>               
                </div>                           
            </div>
            <div class="pager">   
                <?php
                foreach ($pro_imgs as $v)
                {
                    ?>
                    <div>
                        <a href="#" class="stick"><img src="<?php echo $product->get_pre_img($v['path']); ?>" width="50"/></a>
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
                    <li>
                        <a href="products.php"><?php echo $_LANG['Products']['New Item'][LANG]; ?></a>
                    </li>
                    <?php
                    foreach ($bc_arr as $v)
                    {
                        ?>
                        <li <?php echo $v['id'] == $catalog->get_parent_for_product($ret['parent']) ? 'class="active"' : ''; ?>>
                            <a href="products.php?c=<?php echo $v['id']; ?>"><?php echo $v['title']; ?></a>
                            <ul>
                                <?php
                                $cat_arr = $catalog->get_cat_all_front($v['id']);

                                foreach ($cat_arr as $v2)
                                {
                                    ?>
                                    <li <?php echo $v2['id'] == $ret['parent'] ? 'class="active"' : ''; ?>><a href="products.php?c=<?php echo $v2['id']; ?>"><?php echo $v2['title']; ?></a></li>
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
                    <li><a href="#" class="active" data-target="features"><?php echo $_LANG['Products']['Features'][LANG]; ?></a></li>
                    <li><a href="#" data-target="specifications"><?php echo $_LANG['Products']['Specifications'][LANG]; ?></a></li>
                    <li><a href="#" data-target="downloads"><?php echo $_LANG['Support']['Download'][LANG]; ?></a></li>
                </ul>
                <div id="features" class="product-detail">
                    <p><?php echo $ret['feature']; ?></p>
                </div>
                <div id="specifications" class="product-detail">
                    <p><?php echo $ret['spec']; ?></p>                   	
                </div>
                <div id="downloads" class="product-detail">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-normal">
                        <tr>
                            <th><?php echo $_LANG['Products']['Name'][LANG]; ?></th>
                            <th><?php echo $_LANG['Products']['Description'][LANG]; ?></th>
                            <th><?php echo $_LANG['Products']['Date'][LANG]; ?></th>
                            <th><?php echo $_LANG['Products']['Size'][LANG]; ?></th>
                            <th><?php echo $_LANG['Support']['Download'][LANG]; ?></th>
                        </tr>
                        <?php
                        foreach ($downloads as $v)
                        {
                            ?>
                            <tr>
                                <td><?php echo $v['title']; ?></td>
                                <td><?php echo $v['brief']; ?></td>
                                <td align="center"><?php echo date('Y-m-d', strtotime($v['dates'])); ?></td>
                                <td align="center"><?php echo file_size($support->get_dir() . $v['path']); ?> MB</td>
                                <td align="center"><a class="btn btn-warning" href="readfile.php?title=<?php echo base64_encode($v['title']); ?>&t1=<?php echo base64_encode(Extension($v['path'])); ?>&b=<?php echo base64_encode($support->get_dir() . $v['path']); ?>" class="download"><i class="icon-download-alt icon-white"></i><?php echo $_LANG['Support']['Download'][LANG]; ?></a></td>
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
            
        $('.banner .gallery').cycle({
            fx:'fade',
            pager:'.pager',
            timeout:0,
            autostop:1,
            pagerAnchorBuilder: function(index, element) {				
                return $(".pager A:eq("+(index)+")");
            }
        });
		
		$("#features").show();
		
		$(".product-switch a").on("click",function(){
			$(".product-switch a").removeClass("active");
			$(this).addClass("active");
			$(".product-detail").hide();
			$("#"+$(this).attr("data-target")).fadeIn();
			return false;
			});
    }); 
        
</script>
<?php
require_once("inc/footer.inc.php");