<?php
require_once("_init.php");
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
                <li><a href="index.php">Home</a>/</li>
                <li>About Us</li>
            </ul>
            <div class="title">
                <div class="intro">
                    <h1>About Us</h1>                        
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
                        <li <?= $v['id'] == $ret['id'] ? 'class="active"' : '' ?>><a href="about.php?id=<?= $v['id']; ?>"><?= $v['title']; ?></a></li>
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
                    <legend><?= $ret['title']; ?></legend>
                    <p><?= nl2br($ret['content']); ?></p>
                </div>
            </div>
        </div>            	            
    </div>
</div>
<?php
require_once("inc/footer.inc.php");