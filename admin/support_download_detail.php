<?php
require_once("/var/www/html/secuquest/_init.php");
define("CAT", 4);

$obj = new Support;
$crumb = $obj->get_down_detail_crumb_html();
$ret = $obj->get_down_detail();

$catalog = new Catalog;
$bcatalog_arr = $catalog->get_all_for_product(0);

$pd = new Product;
$pd_arr = $pd->get_product($ret['parent']);
require_once(INC_ADMIN . "head.inc.php");
?>
<script type="text/javascript" src='../script/jquery.validate.js'></script>
<script type="text/javascript" src='../script/jquery.form.js'></script>
<script type="text/javascript" src="./inc/fineuploader.jquery/jquery.fineuploader-3.0.min.js"></script>
<link href="inc/fineuploader.jquery/fineuploader.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="support.php">支援列表</a></li>
                <li><a href="support_catalog.php">支援分類</a></li>
                <li><a href="support_download.php" class="active">檔案下載列表</a></li>
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
                    <li><a href="#" class="active">新增檔案/修改檔案</a></li>
                </ul>
                <div class="main-container">
                    <div class="mbody">
                        <form data-target="form" method="post" action="func.php">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th width="100" align="right">名稱</th>
                                    <td><input type="text" placeholder="請輸入名稱…" name="title" class="span10" value="<?php echo $ret['title']; ?>" required/></td>
                                </tr>
                                <tr>
                                    <th align="right">分類</th>
                                    <td>
                                        <select data-target="bcatalog" class="span4">
                                            <option value="">請選擇分類</option>
                                            <?php
                                            foreach ($bcatalog_arr as $v)
                                            {
                                                ?>
                                                <option value="<?php echo $v['id']; ?>" <?php echo ($ret['parent'] == $v['id']) ? 'selected="selected"' : ''; ?>><?php echo $v['title']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th align="right">產品</th>
                                    <td><select name="pid" data-target="product" class="span2 required catalog_confirm">
                                            <option value="0" selected="selected">請選擇分類</option>
                                            <?php
                                            foreach ($pd_arr as $v)
                                            {
                                                ?>
                                                <option value="<?php echo $v['id']; ?>" <?php echo $ret['pid'] == $v['id'] ? 'selected="selected"' : ''; ?>><?php echo $v['title']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th align="right">簡述</th>
                                    <td><input type="text" name="brief" placeholder="請輸入簡述…" class="span10" value="<?php echo $ret['brief']; ?>" required/></td>
                                </tr>
                                <tr>
                                    <th rowspan="2" align="right">檔案上傳</th>
                                    <td><div <?php echo !$ret['path'] ? 'style="display:none;"' : ''; ?> data-target="download">
                                            <a href="#" class="remove word" data-target="link_path"><span data-target="pre_path"><?php echo $ret['path']; ?></span><span class="text" onclick="return file_remove(this,<?php echo $v['id']; ?>);">移除</span></a>
                                            <a data-target="download"  href="<?php echo $obj->get_dir() . $ret['path']; ?>" target="_blank"> (開啟檔案)</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><div id="jquery-wrapped-fine-uploader"></div>( 上限:<?php echo ini_get('upload_max_filesize'); ?> )</td>
                                </tr>
                            </table>
                            <input type="hidden" name="func" value="support_down"/>
                            <input type="hidden" name="doit" value="renew"/>
                            <input type="hidden" name="dates" value=""/>
                            <input type="hidden" name="path" value="<?php echo $ret['path']; ?>"/>
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
    var _path_url = "<?php echo $obj->get_dir(); ?>";
    var file_path = $("input[name='path']");
    var pre_link = $('a[data-target="link_path"]');
    var pre_download = $('div[data-target="download"]');
    var link_download = $('a[data-target="download"]');
    var pre_path = $('span[data-target="pre_path"]');

    $.validator.addMethod("catalog_confirm", function (value)
    {
        return value != "0";
    }, "請選擇產品");

    $(document).ready(function (e)
    {
        validator = _FORM.validate();
        init_file_upload();
        get_products();
        // validator.resetForm();
    });

    function save()
    {
        if (_FORM.valid()) _FORM.submit();

        return false;
    }

    function init_file_upload()
    {
        // var addedFiles=1;
        // var fileLimit=1;
        $('#jquery-wrapped-fine-uploader').fineUploader(
        {
            request: {
                endpoint: 'inc/fineuploader.jquery/upload.php?func=down'
            },
            debug: true
        }).on('complete', function (event, id, fileName, responseJSON)
        {
            if (responseJSON.success)
            {
                alert("上傳成功");
                file_path.val(responseJSON.filename);
                pre_path.text(fileName);
                pre_download.fadeIn();
                link_download.prop("href", _path_url + responseJSON.filename);
                // addedFiles++;
            }
            else alert("上傳失敗: " + responseJSON.error);
        });

        // alert(upload_temp_path);
        return;
    }

    function file_remove(id)
    {
        if (!confirm("確認刪除?")) return false;

        file_path.val("");
        pre_download.fadeOut();
        pre_path.text("");
        alert("請儲存以設定變更");
        return false;
    }

    function get_products()
    {
        $('select[data-target="bcatalog"]').on("change", function ()
        {
            var self = $(this);
            self.css("cursor", "wait");
            $('select[name="pid"]').css("cursor", "wait");

            $.post("func.php",
            {
                func: 'product',
                doit: 'product',
                p: self.val()
            }, function (ret)
            {
                $('select[data-target="product"]').html(ret);
                self.css("cursor", "auto");
                $('select[name="pid"]').css("cursor", "auto");
                return;
            }, 'html');

            return false;
        });
    }
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");