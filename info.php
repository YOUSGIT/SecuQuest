<?php
require_once("_init.php");
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
                <li><a href="index.php">Home</a>/</li>
                <li>Contact</li>
            </ul>
            <div class="title">
                <div class="intro">
                    <h1>Contact</h1>                        
                </div>                           
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container clearfix">
            <div class="left-col">
                <ul class="side-nav">                    	
                    <li><a href="contact.php">Contact Us</a></li>
                    <li class="active"><a href="contact.php">General Info</a></li>
                </ul>
                <ul class="side-news">
                    <?php include_once("inc/side.news.inc.php"); ?>
                </ul>
            </div>
            <div class="right-col">
                <div class="location-list">
                    <legend>General Info</legend>
                    <?= ($ret['content']); ?>
                </div>
            </div>
        </div>            	            
    </div>
</div>
<?php
require_once("inc/footer.inc.php");