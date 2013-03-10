<?php
require_once("/Hosting/9606194/html/SecuQuest/_init.php");
define("CAT", 3);

$obj = new Catalog;
// $catalog = $obj->get_all();
$crumb = $obj->get_crumb_html();
$toolbar = $obj->get_toolbar_html();
$ret = $obj->get_all();
require_once(INC_ADMIN . "head.inc.php");
?> 
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="product_bcatalog.php" class="active">大分類列表</a></li>
                <li><a href="product_catalog.php">子分類列表</a></li>
                <li><a href="product.php">產品列表</a></li>
            </ul>
        </td>
        <td class="middle-col">&nbsp;</td>
        <td class="right-col">
            <div class="module-tool">
                <div class="group">
                    狀態 <select class="span2" data-target="status">
                        <option>全部</option>
                        <option value="1" <?= $_GET['s'] == "1" ? 'selected="selected"' : ''; ?>>上架</option>
                        <option value="0" <?= $_GET['s'] == "0" ? 'selected="selected"' : ''; ?>>下架</option>
                    </select>
                </div>
                <?php if (!is_numeric($_GET['s'])): ?>
                    <div class="group">
                        <button class="btn btn-info" onclick="return save();" type="button">儲存順序</button>
                    </div>
                <?php endif; ?>
            </div> 
            <div class="module-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mheader">
                    <tr>
                        <td width="30"><input type="checkbox" class="check-all" /></td>
                        <td width="100">預覽</td>
                        <td>大分類名稱</td>
                        <td width="100">狀態</td>
                        <td width="50">編輯</td>
                    </tr>
                </table>
                <div class="main-container">
                    <form data-target="form" method="post" action="func.php">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mbody sortable">
                            <?php
                            foreach ($ret as $v)
                            {
                                ?>
                                <tr>
                                    <td width="30" align="center"><input name="delid[]" type="checkbox" class="check-item"  value="<?= $v['id']; ?>"/></td>
                                    <td width="100"><img src="<?= $obj->get_pre_img($v['path']); ?>" width="100"/></td>
                                    <td><a href="product_catalog.php?bc=<?= $v['id']; ?>"><?= $v['title']; ?></a></td>
                                    <td width="100" align="center"><?= $obj->get_status($v['status']); ?></td>
                                    <td width="50"><a class="btn btn-info btn-small" type="button" href="product_bcatalog_detail.php?id=<?= $v['id']; ?>">編輯</a></td>
                                <input type="hidden" name="sort_arr[]" value="<?= $v['id']; ?>"/>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <input type="hidden" name="status" value="0"/>
                        <input type="hidden" name="func" value="catalog"/>
                        <input type="hidden" name="doit" value="del"/>
                    </form>
                </div>
            </div>
        </td>
    </tr>
</table>
<script>
    var form = $('form[data-target="form"]');
    
    $(function ()
    {
        sel_status();
    });
    
    function del()
    {
        
        var ret = form.find("input[type='checkbox']:checked");
        
        if (!ret.length > 0)
        {
            alert("Please select item");
            return false;
        }
        
        if (!confirm("Confirm to delete ?")) return false;
        
        form.submit();
        return false;
    }
    
    function sel_status()
    {
        $("select[data-target='status']").on("change", function ()
        {
            window.location = '?s=' + $(this).val();
        });
    }
    
    function save()
    {
        $("input[name='doit']").val("sort");
        form.submit();
        return false;
    }
    
    function sale(status)
    {
        if (isNaN(status))
        {
            alert("Error");
            return false;
        }
        
        var ret = form.find("input[type='checkbox']:checked");
        
        if (!ret.length > 0)
        {
            alert("Please select item");
            return false;
        }
        
        if (!confirm("Confirm to update ?")) return false;
        $("input[name='doit']").val("sale");
        $("input[name='status']").val(status);
        form.submit();
        return false;
    }
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");