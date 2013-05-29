<?php
require_once("/var/www/html/secuquest/_init.php");
define("CAT", 3);

$obj = new Product;
$crumb = $obj->get_detail_crumb_html();
$ret = $obj->get_detail();
$catalog = new Catalog;
$bcatalog_arr = $catalog->get_all_for_product(0);
$bcatalog = $catalog->get_parent_for_product($ret['parent']) == 0 ? $ret['parent'] : $catalog->get_parent_for_product($ret['parent']);
$catalog_arr = $bcatalog > 0 ? $catalog->get_all_for_product($bcatalog) : $catalog->get_all_for_product($ret['parent']);
$product_arr = $obj->get_all($ret['parent']);
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
                <li><a href="product_bcatalog.php">大分類列表</a></li>
                <li><a href="product_catalog.php">子分類列表</a></li>
                <li><a href="product.php" class="active">產品列表</a></li>
            </ul>
        </td>
        <td class="middle-col">&nbsp;</td>
        <td class="right-col">
            <div class="module-tool">
                <div class="group">
                    <button class="btn btn-info" type="button" onclick="return save();">儲存</button>
                    <!--<button class="btn" type="button">取消</button>-->
                </div>
                <div class="group">
                    大分類 <select class="span5" data-target="bcatalog">
                        <option>請選擇...</option>
                        <!--<option value="" <?php echo ($_GET['p'] == 0 && $bcatalog == 0) ? 'selected="selected"' : ''; ?>>全部</option>-->
                        <?php
                        foreach ($bcatalog_arr as $v)
                        {
                            ?>
                            <option value="<?php echo $v['id']; ?>" <?php echo $_GET['p'] == $v['id'] || ($bcatalog == $v['id']) ? 'selected="selected"' : ''; ?>><?php echo $v['title']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="group">
                    子分類 <select class="span5" data-target="catalog">
                        <option value="<?php echo $bcatalog; ?>">請選擇大分類</option>
                        <?php
                        foreach ($catalog_arr as $v)
                        {
                            ?>
                            <option value="<?php echo $v['id']; ?>" <?php echo $ret['parent'] == $v['id'] ? 'selected="selected"' : ''; ?>><?php echo $v['title']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="group">
                    商品 <select class="span2" data-target="products_list">
                        <option>請選擇</option>
                        <?php
                        foreach ($product_arr as $v)
                        {
                            $status = $v['status'] != '1' ? '(下架) ' : '';
                            ?>
                            <option value="<?php echo $v['id']; ?>" <?php echo $_GET['id'] == $v['id'] ? 'selected="selected"' : ''; ?>><?php echo $status; ?><?php echo $v['title']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="module-form">
                <ul class="mheader">
                    <li><a href="product_detail.php" class="active">新增產品/修改產品</a></li>
                    <?php if ($ret['id']): ?>
                        <li><a href="product_detail_photo.php?p=<?php echo $ret['id']; ?>">產品圖片</a></li>
                        <?php
                    endif;
                    ?>
                </ul>
                <div class="main-container">
                    <div class="mbody">
                        <form data-target="form" method="post" action="func.php">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th width="100" align="right">產品名稱</th>
                                    <td><input name="title" type="text" placeholder="請輸入名稱…" value="<?php echo strip_tags($ret['title']); ?>" class="span10" required/></td>
                                </tr>
                                <tr>
                                    <th align="right">大分類</th>
                                    <td>
                                        <select data-target="bcatalog" class="span5 required catalog_confirm">
                                            <option value="">請選擇分類</option>
                                            <?php
                                            foreach ($bcatalog_arr as $v)
                                            {
                                                ?>
                                                <option value="<?php echo $v['id']; ?>" <?php echo $ret['parent'] == $v['id'] || ($bcatalog == $v['id']) ? 'selected="selected"' : ''; ?>><?php echo $v['title']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th align="right">子分類</th>
                                    <td>
                                        <select class="span5" data-target="catalog">
                                            <option value="<?php echo $bcatalog; ?>">請選擇子分類(可不選)</option>
                                            <?php
                                            foreach ($catalog_arr as $v)
                                            {
                                                ?>
                                                <option value="<?php echo $v['id']; ?>" <?php echo $ret['parent'] == $v['id'] ? 'selected="selected"' : ''; ?>><?php echo $v['title']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th align="right">狀態</th>
                                    <td>
                                        <select name="status" class="span2">
                                            <option value="1" <?php echo $ret['status'] == "1" ? 'selected="selected"' : ''; ?>>上架</option>
                                            <option value="0" <?php echo $ret['status'] == "0" ? 'selected="selected"' : ''; ?>>下架</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th align="right">產品概述</th>
                                    <td><textarea name="brief" class="span10" rows="5"><?php echo ($ret['brief']); ?></textarea></td>
                                </tr>
                                <tr>
                                    <th align="right">特色</th>
                                    <td><textarea name="feature" class="span10" rows="10"><?php echo ($ret['feature']); ?></textarea></td>
                                </tr>
                                <tr>
                                    <th align="right">規格</th>
                                    <td><textarea name="spec" class="span10" rows="10"><?php echo ($ret['spec']); ?></textarea></td>
                                </tr>
                            </table>
                            <input type="hidden" name="func" value="product"/>
                            <input type="hidden" name="sequ" value="<?php echo $ret['sequ'] > 0 ? $ret['sequ'] : 0; ?>"/>
                            <input type="hidden" name="parent" value="<?php echo $ret['parent']; ?>"/>
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
    var parent = $("input[name='parent']");
    var pid = $("input[name='id']", _FORM);
    var product = $(".module-tool select[data-target='products_list']");

    $.validator.addMethod("catalog_confirm", function (value)
    {
        return (value != "0" && value != "");
    }, "請選擇分類");

    $(document).ready(function (e)
    {
        validator = _FORM.validate();

        /* init ckeditor */
        var editor1 = CKEDITOR.replace('brief');
        var editor2 = CKEDITOR.replace('feature');
        var editor3 = CKEDITOR.replace('spec');
        CKFinder.setupCKEditor(editor1, 'inc/ckfinder/');
        CKFinder.setupCKEditor(editor2, 'inc/ckfinder/');
        CKFinder.setupCKEditor(editor3, 'inc/ckfinder/');

        set_parent();
        get_catalog();
        fast_get_catalog();
        fast_get_product();
    });

    function save()
    {
        if (_FORM.valid()) _FORM.submit();

        return false;
    }

    function set_parent()
    {
        $("select[data-target]").on("change", function ()
        {
            parent.val($(this).val());
        });
    }

    function get_catalog()
    {
        $("select[data-target='bcatalog']", _FORM).on("change", function ()
        {
            var s = $("select[data-target='catalog']", _FORM);
            s.prop("disabled", true).css("cursor", "wait");

            $.post("func.php",
            {
                func: 'product',
                doit: 'catalog',
                p: $(this).val()
            }, function (ret)
            {
                s.html(ret);
                s.prop("disabled", false).css("cursor", "auto");
                return;
            }, "html");
        });
    }

    function fast_get_catalog()
    {
        $(".module-tool select[data-target='bcatalog']").on("change", function ()
        {
            get_products_ajax($(this).val());

            var s = $(".module-tool select[data-target='catalog']");
            s.prop("disabled", true).css("cursor", "wait");

            $.post("func.php",
            {
                func: 'product',
                doit: 'catalog',
                p: $(this).val()
            }, function (ret)
            {
                s.html(ret);
                s.prop("disabled", false).css("cursor", "auto");
                return;
            }, "html");
        });
    }

    function get_products_ajax($p)
    {
        product.prop("disabled", true).css("cursor", "wait");
        $.post("func.php",
        {
            func: 'product',
            doit: 'product',
            p: $p
        }, function (ret)
        {
            product.html(ret);
            product.prop("disabled", false).css("cursor", "auto");
            return;
        }, "html");

    }

    function fast_get_product()
    {
        $(".module-tool select[data-target='catalog']").on("change", function ()
        {
            get_products_ajax($(this).val());
        });

        product.on("change", function()
        {
            window.location = '?id=' + $(this).val();
        });
    }
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");