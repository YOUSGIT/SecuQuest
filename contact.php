<?php
require_once("_init.php");
require_once("./lang/index.lang.php");
define("CAT", 3);

require_once("inc/head.inc.php");
?>
<script type="text/javascript" src='./script/jquery.validate.js'></script>
<script type="text/javascript" src='./script/jquery.form.js'></script>
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
                    <li class="active"><a href="contact.php"><?php echo $_LANG['btn']['Contact'][LANG]; ?></a></li>
                    <li><a href="info.php"><?php echo $_LANG['btn']['General Info'][LANG]; ?></a></li>
                </ul>
                <ul class="side-news">
                    <?php include_once("inc/side.news.inc.php"); ?>
                </ul>
            </div>
            <div class="right-col">
                <div class="contact">
                    <form data-target='form' method="post" action="func.php">
                        <fieldset>
                            <legend><?php echo $_LANG['btn']['Contact'][LANG]; ?></legend>
                            <p><?php echo $_LANG['notice']['Contact'][LANG]; ?></p>
                            <label>Name</label>
                            <input name="name" type="text" required/>
                            <label>EMail</label>
                            <input name="email" type="text" class="span5 required email"/>
                            <label>Subject</label>
                            <input name="subject" type="text" class="span8 required"/>
                            <label>Body</label>
                            <textarea rows="5" class="span8 required" name="content"></textarea>
                            <label>Verification Code</label>
                            <img src="inc/imgcode.php" width="90" height="32"/>
                            <input name="imgcode" type="text" class="span1" required/>
                            <div class="help-block"><?php echo $_LANG['notice']['verify'][LANG]; ?></div>
                            <div>
                                <button type="button" onclick='return save();' class="btn btn-warning">Submit</button>
                            </div>
                        </fieldset>
                        <input type="hidden" name="func" value="contact"/>
                        <input type="hidden" name="doit" value="renew"/>
                        <input type="hidden" name="check" value="1"/>
                    </form>
                </div>
            </div>
        </div>            	            
    </div>
</div>
<script type="text/javascript">
    var validator;
    var _FORM = $("form[data-target='form']");
    
    $(document).ready(function (e)
    {
        validator = _FORM.validate();
    });
    
    function save()
    {
        if (_FORM.valid()){

            $.post("func.php",_FORM.serializeArray(),function(ret){
                if(ret=='vcode'){
                    alert("Please input the correct verify code.");
                    return false;
                }
                
                $('input[name="check"]').val("0");
                if (_FORM.valid()) _FORM.submit();
                
            },"html");
        }        
        
        return false;
    }
</script>
<?php
require_once("inc/footer.inc.php");