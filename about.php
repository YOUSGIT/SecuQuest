<?php
require_once("_init.php");
require_once("./lang/index.lang.php");
define("CAT", 4);

$about = New About;
$about_arr = $about->get_all_front();
if (!$_GET['id'])
    $id = (int) $about_arr[0]['id'];
$ret = $about->get_detail_front($id);
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
                <li><?php echo $_LANG['btn']['About Us'][LANG]; ?></li>
            </ul>
            <div class="title">
                <div class="intro">
                    <h1><?php echo $_LANG['btn']['About Us'][LANG]; ?></h1>                        
                </div>                           
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container clearfix">
            <div class="left-col">
                <ul class="side-nav">
                    <?php
                    foreach ($about_arr as $v)
                    {
                        ?>
                        <li <?php echo $v['id'] == $ret['id'] ? 'class="active"' : '' ?>><a href="about.php?id=<?php echo $v['id']; ?>"><?php echo $v['title']; ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
                <ul class="side-news">
                    <?php include_once("inc/side.news.inc.php"); ?>
                </ul>
            </div>
            <div class="right-col">
                <div class="static-html">
                    <legend><?php echo $ret['title']; ?></legend>
                    <p><?php echo nl2br($ret['content']); ?></p>
                </div>
            </div>
        </div>            	            
    </div>
</div>
<?php
require_once("inc/footer.inc.php");