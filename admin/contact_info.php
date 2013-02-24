<?php
require_once("/Hosting/9606194/html/SecuQuest/_init.php");
define("CAT", 5);

$obj = new Contact;
$obj->set_field(CONTACT_INFO);
$crumb = $obj->get_info_crumb_html();
$ret = $obj->get_info_detail();
require_once(INC_ADMIN . "head.inc.php");
?>
<script type="text/javascript" src='../script/jquery.validate.js'></script>
<script type="text/javascript" src='../script/jquery.form.js'></script>
<script type="text/javascript" src="./inc/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="./inc/ckfinder/ckfinder.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="contact.php" >客服列表</a></li>
                <li><a href="contact_info.php" class="active">聯絡資訊</a></li>
            </ul>
        </td>
        <td class="middle-col">&nbsp;</td>
        <td class="right-col">   
            <div class="module-tool">
                <div class="group">
                    <button class="btn btn-info" type="button" onclick="return save();">儲存</button>
                    <!-- <button class="btn" type="button">取消</button>-->
                </div>
            </div>     
            <div class="module-form">
                <ul class="mheader">
                    <li><a href="#" class="active">聯絡資訊</a></li>                        
                </ul>
                <div class="main-container">
                    <div class="mbody">
                        <form data-target="form" method="post" action="func.php">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td><textarea rows="14" name="content" class="span6" required><?= ($ret['content']); ?></textarea></td>
                                </tr>
                            </table>
                            <input type="hidden" name="func" value="contact" />
                            <input type="hidden" name="doit" value="info" />
                            <input type="hidden" name="dates" value="" />
                            <input type="hidden" name="id" value="<?= !$ret['id'] ? '' : $ret['id']; ?>" />
                        </form>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>
<script type="text/javascript">
    var validator;
    var _FORM = $("form[data-target='form']");
    
    $(document).ready(function (e)
    {
        validator = _FORM.validate();
        var editor = CKEDITOR.replace( 'content' );
        CKFinder.setupCKEditor( editor, 'inc/ckfinder/' ) ;
        // init_file_upload();
        // validator.resetForm();
    });
    
    function save()
    {
        if (_FORM.valid()) _FORM.submit();
        
        return false;
    }
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");