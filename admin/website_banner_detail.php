<?php
require_once("/Hosting/9606194/html/SecuQuest/_init.php");
define("CAT", 1);

$obj = new Banner;
$crumb = $obj->get_crumb_html();
$ret = $obj->get_detail();
require_once(INC_ADMIN . "head.inc.php");
?>
<script type="text/javascript" src='../script/jquery.validate.js'></script>
<script type="text/javascript" src='../script/jquery.form.js'></script>
<script type="text/javascript" src="./inc/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="./inc/fineuploader.jquery/jquery.fineuploader-3.0.min.js"></script>
<link href="inc/fineuploader.jquery/fineuploader.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="website_banner.php" class="active">首頁廣告設定</a></li>
                <li><a href="website_password.php">管理者密碼</a></li>
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
                    <li><a href="#" class="active">新增廣告/修改廣告</a></li>                        
                </ul>
                <div class="main-container">
                    <div class="mbody">
                        <form data-target="form" method="post" action="func.php">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th width="100" align="right">標題</th>
                                    <td><input value="<?= $ret['title']; ?>" type="text" placeholder="請輸入標題…" name="title" class="span10" required></td>
                                </tr>
                                <tr>
                                    <th align="right">媒體類型</th>
                                    <td>
                                        <select name="type" id="media_type" class="span2">
                                            <option value="0" <?= $ret['type'] == 0 ? 'selected="selected"' : ''; ?>>圖片</option>
                                            <option value="1" <?= $ret['type'] == 1 ? 'selected="selected"' : ''; ?>>影片</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th align="right">連結</th>
                                    <td><input type="text" placeholder="請輸入連結…" name="link" value="<?= $ret['link']; ?>" class="span6" required/><?= $ret['link'] ? '<a href="' . $ret['link'] . '" target="_blank">( Open link )</a>' : '' ?></td>
                                </tr>
                                <tr class="tr_image">
                                    <th rowspan="2" align="right">圖片</th>
                                    <td><input name="path" type="hidden" readonly required /><a data-target="remove" href="#" class="remove" onclick="return pic_remove();"><span class="text">移除</span><img data-target="pre_img" src="<?= ADM_Image . $ret['path']; ?>" <?= (!$ret['path']) ? 'style="display:none;"' : ''; ?>/></a>                                	
                                    </td>
                                </tr>
                                <tr class="tr_image">
                                    <td><div id="jquery-wrapped-fine-uploader"></div></td>
                                </tr>
                                <tr class="tr_vedio">
                                    <th align="right">影片</th>
                                    <td><input type="text" placeholder="請輸入Youtube連結…" class="span6" name="path" required value="<?= $ret['path']; ?>"/></td>
                                </tr>
                                <tr>
                                    <th align="right">內容</th>
                                    <td><textarea rows="10" name="content" class="span6" required><?= htmlentities($ret['content']); ?></textarea></td>
                                </tr>
                            </table>
                            <input type="hidden" name="func" value="adv"/>
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
    var adv_image_url = "<?= ADM_Image; ?>";
    var path = $("input[name='path']");
    var pre_img = $('img[data-target="pre_img"]');
    
    $(document).ready(function (e)
    {
        
        MediaTypeChange();
        $("#media_type").change(MediaTypeChange);
        validator = _FORM.validate();
        CKEDITOR.replace('content');
        init_file_upload();
        // validator.resetForm();
    });
    
    function MediaTypeChange()
    {
        $(".tr_image").toggle($("#media_type").children("option:selected").val() == "0");
        $(".tr_vedio").toggle($("#media_type").children("option:selected").val() == "1");
    }
    
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
            request: {
                endpoint: 'inc/fineuploader.jquery/upload.php?func=adv'
            },
            debug: true
        }).on('complete', function (event, id, fileName, responseJSON)
        {
            if (responseJSON.success)
            {
                // alert(responseJSON.filename);
                // newimgArray.push(upload_temp_path + responseJSON.filename);
                path.val(responseJSON.filename);
                pre_img.prop("src", adv_image_url + responseJSON.filename).fadeIn();
                // addedFiles ++;
                // if(addedFiles >= fileLimit) {
                // $('#jquery-wrapped-fine-uploader').hide();
                // }
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