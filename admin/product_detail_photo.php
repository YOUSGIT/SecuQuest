<?php
require_once("/var/www/html/secuquest/_init.php");
define("CAT", 3);

$obj = new Product;
if (!$check = $obj->get_detail($_GET['p']))
{
    header("location: product_detail.php");
    exit;
}

$ret = $obj->get_img_detail();
$crumb = $obj->get_detail_crumb_html();
require_once(INC_ADMIN . "head.inc.php");
?>         
<script type="text/javascript" src="./inc/fineuploader.jquery/jquery.fineuploader-3.0.min.js"></script>
<link href="inc/fineuploader.jquery/fineuploader.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="product_bcatalog.php">大分類列表</a></li>
                <li><a href="product_catalog.php">子分類列表</a></li>
                <li><a href="product.php" class="active">產品列表</a></li>
            </ul>
        </td>
        <td class="middle-col">&nbsp;</td>
        <td class="right-col">
            <div class="module-tool">
                <div class="group">
                    <button style="display:none;" data-target="upload-btn" class="btn btn-info" type="button" onclick="return save();">儲存</button>
                    <button style="display:none;" data-target="upload-btn" class="btn" type="button" onclick="return cancel();">取消</button>
                </div>
            </div> 
            <div class="module-form">
                <ul class="mheader">
                    <li><a href="product_detail.php?id=<?php echo $_GET['p']; ?>">新增產品/修改產品</a></li>
                    <li><a href="product_detail_photo.php?p=<?php echo $_GET['p']; ?>" class="active">產品圖片</a></li>                        
                </ul>
                <div class="main-container">
                    <div class="mbody">
                        <form data-target="form" method="post" action="func.php">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr data-target="upload">
                                    <th width="100" align="right">上傳圖片</th>
                                    <td><div id="jquery-wrapped-fine-uploader"></div><div target="input"></div></td>
                                </tr>
                                <tr data-target="setup">
                                    <th align="right">主圖設定</th>
                                    <td>
                                        <?php
                                        foreach ($ret as $v)
                                        {
                                            ?>
                                            <span data-target="imgs" style="display:inline-block;">
                                                <input type="radio" value="<?php echo $v['id']; ?>" <?php echo $v['master'] == '1' ? 'checked="checked"' : ''; ?> name="master" data-target="master"/>
                                                <a href="#" class="remove" onclick="return pic_remove(this,<?php echo $v['id']; ?>);"><span class="text">移除</span><img src="<?php echo PD_Image . 's_' . $v['path']; ?>" width="150" /></a>
                                            </span>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="func" value="product_img"/>
                            <input type="hidden" name="parent" value="<?php echo (int) $_GET['p']; ?>"/>
                            <input type="hidden" name="doit" value="renew"/>
                        </form>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>
<script type="text/javascript">
    var _FORM = $("form[data-target='form']");
    var _image_url = "<?php echo $obj->get_dir(); ?>";
    var pre_img = $('img[data-target="pre_img"]');
    var setup = $('tr[data-target="setup"]');
    var upload = $('tr[data-target="upload"]');
    var inputs = $('div[target="input"]');
    var btns = $('button[data-target="upload-btn"]');
    var parent = $('input[name="parent"]');
    var master_radio = $("input[data-target='master']");
    var flag;
        
    $(document).ready(function (e)
    {
        init_file_upload();
        set_master();
    });
        
    function init_file_upload()
    {
        $('#jquery-wrapped-fine-uploader').fineUploader(
        {
            request: {
                endpoint: 'inc/fineuploader.jquery/upload.php?func=pd'
            },
            debug: true
        }).on('complete', function (event, id, fileName, responseJSON)
        {
            if (responseJSON.success)
            {
                setup.fadeOut();
                btns.slideDown();
                inputs.append('<input name="path[]" type="hidden" value="' + responseJSON.filename + '"/>');
                flag = true;
            }
                
        });
        // alert(upload_temp_path);
        return;
    }
        
    function save()
    {
        if (!flag)
        {
            alert("請上傳圖片");
            return false;
        }
        setup.remove();
        _FORM.submit();
        return false;
    }
        
    function pic_remove(e, id)
    {
        if (!confirm("確認刪除?")) return false;
            
        $.post("func.php",
        {
            func: "product_img",
            doit: "del",
            parent: parent.val(),
            delid: id
        }, function (ret)
        {
            if (ret == 'ok') $(e).parent().fadeOut("slow", function ()
            {
                $(this).remove();
            });
        }, "html");
            
        return false;
    }
        
    function cancel()
    {
        btns.slideUp();
        $('li[class=" qq-upload-success"]').fadeOut();
        setup.fadeIn();
        // upload.fadeOut();
        inputs.empty();
    }
        
    function set_master()
    {
        master_radio.on("click", function ()
        {
            master_radio.css("cursor", "wait");;
            
            $.post("func.php",
            _FORM.serializeArray(), function (ret)
            {
                // if (ret == 'ok')
                alert("已設定主圖");
                master_radio.css("cursor", "auto");;
            }, "html");
        });
            
    }
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");