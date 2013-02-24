<?php
require_once("/Hosting/9606194/html/SecuQuest/_init.php");
define("CAT", 4);

$obj = new Support;
$obj->set_field(SUPPORT_CAT);
$catalog = $obj->get_cat_all();
unset($obj);
$obj = new Support;
$crumb = $obj->get_crumb_html();
// $toolbar = $obj->get_toolbar_html();
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
                <li><a href="support.php" class="active">支援列表</a></li>
                <li><a href="support_catalog.php">支援分類</a></li>
                <li><a href="support_download.php">檔案下載列表</a></li>
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
                    <li><a href="#" class="active">新增問題/修改問題</a></li>                        
                </ul>
                <div class="main-container">
                    <div class="mbody">
                        <form data-target="form" method="post" action="func.php">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th width="100" align="right">標題</th>
                                    <td><input type="text" placeholder="請輸入問題…" name="title" value="<?= $ret['title']; ?>" class="span10" required/></td>
                                </tr>
                                <tr>
                                    <th align="right">分類</th>
                                    <td>
                                        <select data-target="catalog" name="catalog" class="span4 required catalog_confirm">                        	
                                            <option value="0">請選擇分類</option>
                                            <?php
                                            foreach ($catalog as $v)
                                            {
                                                ?>
                                                <option value="<?= $v['id']; ?>" <?= $ret['catalog'] == $v['id'] ? 'selected="selected"' : ''; ?>><?= $v['title']; ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th align="right">問題解答</th>
                                    <td><textarea rows="14" name="content" class="span6" required><?= ($ret['content']); ?></textarea></td>
                                </tr>
                            </table>
                            <input type="hidden" name="func" value="support"/>
                            <input type="hidden" name="doit" value="renew"/>
                            <input type="hidden" name="id" value="<?= $ret['id']; ?>"/>
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

    $.validator.addMethod("catalog_confirm", function (value)
    {
        return value != "0";
    }, "請選擇分類");

    $(document).ready(function (e)
    {
        validator = _FORM.validate();
        var editor = CKEDITOR.replace('content');
        CKFinder.setupCKEditor(editor, 'inc/ckfinder/');
    });

    function save()
    {
        if (_FORM.valid()) _FORM.submit();

        return false;
    }
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");