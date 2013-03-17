<?php
require_once("/var/www/html/secuquest/_init.php");
define("CAT", 6);

$obj = new About;
$crumb = $obj->get_crumb_html();
$ret = $obj->get_detail();
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
                <li><a href="about.php" class="active">內容列表</a></li>
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
                    <li><a href="#" class="active">新增內容/編輯內容</a></li>                        
                </ul>
                <div class="main-container">
                    <div class="mbody">
                        <form data-target="form" method="post" action="func.php">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th width="100" align="right">項目名稱</th>
                                    <td><input type="text" name="title" value="<?php echo $ret['title']; ?>" placeholder="請輸入名稱…" class="span10" required/></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><textarea rows="10" name="content" class="span6" required><?php echo ($ret['content']); ?></textarea></td>
                                </tr>
                            </table>
                            <input type="hidden" name="func" value="about"/>
                            <input type="hidden" name="doit" value="renew"/>
                            <input type="hidden" name="sequ" value="<?php echo $ret['sequ'] ? $ret['sequ'] : 999; ?>"/>
                            <input type="hidden" name="id" value="<?php echo $ret['id']; ?>"/>
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