<?php
require_once("_init.php");
require_once("./lang/index.lang.php");
define("CAT", 2);

$support = New Support;
$support_arr = $support->get_cat_all_front();
$c = (!$_GET['c']) ? (int) $support_arr[0]['id'] : $_GET['c'];
$qsk_arr = $support->get_all_front($c);

$catalog = new Catalog;
$catalog_arr = $catalog->get_all_front();
require_once("inc/head.inc.php");
?>
<div class="body">
    <div class="banner">
        <div class="container">            	
            <div class="gallery">
                <div class="media"></div>                
            </div>
            <ul class="crumb">
                <li><a href="index.php"><?php echo $_LANG['btn']['Home'][LANG]; ?></a>/</li>
                <li><?php echo $_LANG['btn']['Support'][LANG]; ?></li>
            </ul>
            <div class="title">
                <div class="intro">
                    <h1><?php echo $_LANG['btn']['Support'][LANG]; ?></h1>                        
                </div>                           
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container clearfix">
            <div class="left-col">
                <ul class="side-nav">
                    <li class="active"><a href="support.php"><?php echo $_LANG['Support']['FAQ'][LANG]; ?></a>
                        <ul>
                            <?php
                            foreach ($support_arr as $v)
                            {
                                ?>
                                <li <?php echo $v['id'] == $c ? 'class="active"' : ''; ?>><a href="support.php?c=<?php echo $v['id']; ?>"><?php echo $v['title']; ?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li><a href="download.php"><?php echo $_LANG['Support']['Download'][LANG]; ?></a>
                        <ul>
                            <?php
                            foreach ($catalog_arr as $v)
                            {
                                ?>
                                <li><a href="download.php?c=<?php echo $v['id']; ?>"><?php echo $v['title']; ?></a></li>
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
                <div class="faq-list">
                    <legend><?php echo $_LANG['Support']['FAQ'][LANG]; ?></legend>
                    <?php
                    foreach ($qsk_arr as $v)
                    {
                        ?>
                        <div class="item">
                            <h1><?php echo $v['title']; ?></h1>
                            <div class="content">
                                <?php echo nl2br($v['content']); ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>            	            
    </div>
</div>
<?php
require_once("inc/footer.inc.php");