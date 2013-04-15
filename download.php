<?php
require_once("_init.php");
require_once("./lang/index.lang.php");
define("CAT", 2);

$support = New Support;
$support_arr = $support->get_cat_all_front();


$catalog = new Catalog;
$catalog_arr = $catalog->get_all_front();

$c = (!$_GET['c']) ? (int) $catalog_arr[0]['id'] : $_GET['c'];
$pd = new Product;
$pd_arr = $pd->get_product($c);


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
                <li>Support</li>
            </ul>
            <div class="title">
                <div class="intro">
                    <h1>Support</h1>                        
                </div>                           
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container clearfix">
            <div class="left-col">
                <ul class="side-nav">
                    <li><a href="support.php">FAQ</a>
                        <ul>
                            <?php
                            foreach ($support_arr as $v)
                            {
                                ?>
                                <li><a href="support.php?c=<?php echo $v['id']; ?>"><?php echo $v['title']; ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="active"><a href="download.php">Download</a>
                        <ul>
                            <?php
                            foreach ($catalog_arr as $v)
                            {
                                ?>
                                <li <?php echo $v['id'] == $c ? 'class="active"' : ''; ?>><a href="download.php?c=<?php echo $v['id']; ?>"><?php echo $v['title']; ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
                <ul class="side-news">
                    <?php include_once("inc/side.news.inc.php"); ?>
                </ul>
            </div>
            <div class="right-col">
                <div class="download-list">
                    <legend>Download</legend>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-normal">
                        <?php
                        foreach ($pd_arr as $v)
                        {
                            ?>
                            <tr>                          
                                <th colspan="5" align="left"><?php echo $v['title']; ?></th>
                            </tr>
                            <?php
                            $down_arr = $support->get_down_all_front($c, $v['id']);
                            foreach ($down_arr as $v2)
                            {
                                ?>
                                <tr>
                                    <td><?php echo $v2['title']; ?></td>
                                    <td><?php echo $v2['brief']; ?></td>
                                    <td align="center"><?php echo date('Y-m-d', strtotime($v2['dates'])); ?></td>
                                    <td align="center"><?php echo file_size($support->get_dir() . $v2['path']); ?> MB</td>
                                    <td align="center"><a href="readfile.php?title=<?php echo base64_encode($v2['title']); ?>&t1=<?php echo base64_encode(Extension($v2['path'])); ?>&b=<?php echo base64_encode($support->get_dir() . $v2['path']); ?>" class="download">Download</a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>            	            
    </div>
</div>
<?php
require_once("inc/footer.inc.php");