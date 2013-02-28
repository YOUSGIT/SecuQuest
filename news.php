<?php
require_once("_init.php");
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
                <li><a href="index.php">Home</a>/</li>
                <li>News</li>
            </ul>
            <div class="title">
                <div class="intro">
                    <h1>News</h1>                        
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
                        <li <?= $id == $v['id'] ? 'class="active"' : ''; ?>><a href="?id=<?= $v['id']; ?>"><?= mb_substr($v['title'], 0, 30) . '...'; ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="right-col">
                <div class="static-html">
                    <legend><?= $ret['title']; ?></legend>
                    <small><?= $ret['dates']; ?></small>
                    <p><?= ($ret['content']); ?></p>
                </div>
            </div>
        </div>            	            
    </div>
</div>
<?php
require_once("inc/footer.inc.php");