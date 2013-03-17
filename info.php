<?php
require_once("_init.php");
require_once("./lang/index.lang.php");
define("CAT", 3);
$contact = new Contact;
$ret = $contact->get_info_detail_front();

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
                <li><?php echo $_LANG['btn']['Contact'][LANG]; ?></li>
            </ul>
            <div class="title">
                <div class="intro">
                    <h1><?php echo $_LANG['btn']['Contact'][LANG]; ?></h1>                        
                </div>                           
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container clearfix">
            <div class="left-col">
                <ul class="side-nav">                    	
                    <li><a href="contact.php"><?php echo $_LANG['btn']['Contact'][LANG]; ?></a></li>
                    <li class="active"><a href="info.php"><?php echo $_LANG['btn']['General Info'][LANG]; ?></a></li>
                </ul>
                <ul class="side-news">
                    <?php include_once("inc/side.news.inc.php"); ?>
                </ul>
            </div>
            <div class="right-col">
                <div class="location-list">
                    <legend><?php echo $_LANG['btn']['General Info'][LANG]; ?></legend>
                    <?php echo ($ret['content']); ?>
                </div>
            </div>
        </div>            	            
    </div>
</div>
<?php
require_once("inc/footer.inc.php");