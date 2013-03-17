<?php
require_once("/var/www/html/secuquest/_init.php");
define("CAT", 3);

$obj = new Catalog;
$crumb = $obj->get_cat_detail_crumb_html();
$ret = $obj->get_cat_detail();
$bcatalog = $obj->get_all();
require_once(INC_ADMIN . "head.inc.php");
?>
<script type="text/javascript" src='../script/jquery.validate.js'></script>
<script type="text/javascript" src='../script/jquery.form.js'></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="product_bcatalog.php">大分類列表</a></li>
                <li><a href="product_catalog.php" class="active">子分類列表</a></li>
                <li><a href="product.php">產品列表</a></li>
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
                    <li><a href="#" class="active">新增子分類/修改子分類</a></li>                        
                </ul>
                <div class="main-container">
                    <div class="mbody">
                        <form data-target="form" method="post" action="func.php">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th width="100" align="right">分類名稱</th>
                                    <td><input type="text" placeholder="請輸入名稱…" name="title" value="<?php echo $ret['title']; ?>" class="span10" required/></td>
                                </tr>
                                <tr>
                                    <th align="right">大分類</th>
                                    <td>
                                        <select name="parent" class="span5 required catalog_confirm">       
                                            <option value="0">請選擇分類</option>
                                            <?php
                                            foreach ($bcatalog as $v)
                                            {
                                                ?>
                                                <option value="<?php echo $v['id']; ?>" <?php echo $ret['parent'] == $v['id'] ? 'selected="selected"' : ''; ?>><?php echo $v['title']; ?></option>
                                                <?php
                                            }
                                            ?>
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
                            </table>
                            <input type="hidden" name="func" value="catalog"/>
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
    
    $.validator.addMethod("catalog_confirm", function (value)
    {
        return value != "0";
    }, "請選擇分類");
    

    $(document).ready(function (e)
    {
        validator = _FORM.validate();
    });

    function save()
    {
        if (_FORM.valid()) _FORM.submit();

        return false;
    }
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");