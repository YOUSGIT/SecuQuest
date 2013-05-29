<?php
require_once("/var/www/html/secuquest/_init.php");
define("CAT", 2);

$obj = new News;
$crumb = $obj->get_crumb_html();
$ret = $obj->get_detail();
require_once(INC_ADMIN . "head.inc.php");
?>
<script type="text/javascript" src='../script/jquery.validate.js'></script>
<script type="text/javascript" src='../script/jquery.form.js'></script>
<script type="text/javascript" src="./inc/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="./inc/ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="./inc/fineuploader.jquery/jquery.fineuploader-3.0.min.js"></script>
<link href="inc/fineuploader.jquery/fineuploader.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="news.php" class="active">新聞列表</a></li>
            </ul>
        </td>
        <td class="middle-col">&nbsp;</td>
        <td class="right-col">
            <div class="module-tool">
                <div class="group">
                    <button class="btn btn-info" type="button" onclick="return save();">儲存</button>
                    <!--<button class="btn" type="button">取消</button>-->
                </div>
            </div>
            <div class="module-form">
                <ul class="mheader">
                    <li><a href="#" class="active">新增新聞</a></li>
                </ul>
                <div class="main-container">
                    <div class="mbody">
                        <form data-target="form" method="post" action="func.php">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th align="right">標題</th>
                                    <td><input type="text" value="<?php echo $ret['title']; ?>" name="title" placeholder="請輸入標題…" class="span10" required/></td>
                                </tr>
                                <tr>
                                    <th align="right">發佈日期</th>
                                    <td><input name="dates" data-target="dates" type="text" value="<?php echo !$ret['dates'] ? date("Y-m-d") : date("Y-m-d", strtotime($ret['dates'])); ?>" placeholder="請輸入日期…" class="span4" readonly required/></td>
                                </tr>
                                <tr class="tr_image">
                                    <th rowspan="2" align="right">圖片</th>
                                    <td><input name="path" value="<?php echo $ret['path']; ?>" type="hidden" readonly required /><a data-target="remove" href="#" class="remove" onclick="return pic_remove();"><span class="text">移除</span><img data-target="pre_img" src="<?php echo $obj->get_dir() . $ret['path']; ?>" <?php echo (!$ret['path']) ? 'style="display:none;"' : ''; ?>/></a> </td>
                                </tr>
                                <tr class="tr_image">
                                    <td><div id="jquery-wrapped-fine-uploader"></div></td>
                                </tr>
                                <tr class="tr_image">
                                    <th align="right">內容</th>
                                    <td><textarea rows="10" name="content" class="span6" required><?php echo ($ret['content']); ?></textarea></td>
                                </tr>
                            </table>
                            <input type="hidden" name="func" value="news"/>
                            <input type="hidden" name="doit" value="renew"/>
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
    var _image_url = "<?php echo $obj->get_dir(); ?>";
    var path = $("input[name='path']");
    var pre_img = $('img[data-target="pre_img"]');

    $(document).ready(function (e)
    {
        validator = _FORM.validate();
        var editor = CKEDITOR.replace('content');
        CKFinder.setupCKEditor(editor, 'inc/ckfinder/');
        init_file_upload();
        // validator.resetForm();
        $("input[data-target='dates']").datepicker(
        {
			gotoCurrent: true,
            dateFormat: "yy-mm-dd"
        });
    });

    function save()
    {
        if (_FORM.valid()) _FORM.submit();

        return false;
    }

    function init_file_upload()
    {
        // var addedFiles=0;
        // var fileLimit=1;
        $('#jquery-wrapped-fine-uploader').fineUploader(
        {
            request:
                {
                endpoint: 'inc/fineuploader.jquery/upload.php?func=news'
            },
            debug: true
        }).on('complete', function (event, id, fileName, responseJSON)
        {
            if (responseJSON.success)
            {
                path.val(responseJSON.filename);
                pre_img.load(_image_url + responseJSON.filename, function ()
                {
                    $(this).prop("src", _image_url + responseJSON.filename).fadeIn();
                    $('li[class=" qq-upload-success"]').fadeOut("slow");
                });
            }

        });

        // alert(upload_temp_path);
        return;
    }

    function pic_remove()
    {
        path.val("");
        pre_img.prop("src", "").fadeOut();
        return false;
    }
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");