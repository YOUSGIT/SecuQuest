<?php
require_once("_init.php");
require_once("./lang/index.lang.php");
define("CAT", 2);

$news = New News;
$news_arr = $news->get_all_front(10);
$id = (!$_GET['id']) ? (int) $news_arr[0]['id'] : $_GET['id'];
$ret = $news->get_detail_front($id);
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
                <li><?php echo $_LANG['btn']['News'][LANG]; ?></li>
            </ul>
            <div class="title">
                <div class="intro">
                    <h1><?php echo $_LANG['btn']['News'][LANG]; ?></h1>                        
                </div>                           
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container clearfix">
            <div class="left-col">
                <ul class="side-nav">
                    <?php
                    foreach ($news_arr as $v)
                    {
                        ?>
                        <li <?php echo $id == $v['id'] ? 'class="active"' : ''; ?>><a href="?id=<?php echo $v['id']; ?>"><?php echo mb_substr($v['title'], 0, 30) . '...'; ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="right-col">
                <div class="static-html">
                    <legend><?php echo $ret['title']; ?></legend>
                    <small><?php echo $ret['dates']; ?></small>
                    <p><?php echo ($ret['content']); ?></p>
                </div>
            </div>
        </div>            	            
    </div>
</div>
<?php
require_once("inc/footer.inc.php");