<?php
require_once("/Hosting/9606194/html/SecuQuest/_init.php");
define("CAT", 3);

$obj = new Catalog;
// $catalog = $obj->get_all();
$crumb = $obj->get_cat_crumb_html();
$toolbar = $obj->get_cat_toolbar_html();
$bcatalog = $obj->get_all();
$ret = $obj->get_cat_all();
require_once(INC_ADMIN . "head.inc.php");
?> 
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
                    大分類 <select class="span5" data-target="bcatalog">                        	
                        <option>全部</option>
                        <?php
                        foreach ($bcatalog as $v)
                        {
                            ?>
                            <option value="<?= $v['id']; ?>" <?= $_GET['bc'] == $v['id'] ? 'selected="selected"' : ''; ?>><?= $v['title']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="group">
                    狀態 <select class="span2" data-target="status">
                        <option>全部</option>
                        <option value="1" <?= $_GET['cs'] == "1" ? 'selected="selected"' : ''; ?>>上架</option>
                        <option value="0" <?= $_GET['cs'] == "0" ? 'selected="selected"' : ''; ?>>下架</option>
                    </select>
                </div>
                <?php if (is_numeric($_GET['bc']) && $_GET['cs'] != '1' && $_GET['cs'] != '0'): ?>
                    <div class="group">
                        <button class="btn btn-info" onclick="return save();" type="button">儲存順序</button>
                    </div>
                <?php endif; ?>
            </div> 
            <div class="module-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mheader">
                    <tr>
                        <td width="30"><input type="checkbox" class="check-all" /></td>
                        <td width="200">大分類名稱</td>
                        <td>子分類名稱</td>
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
                                    <td width="200"><?= $v['bc']; ?></td>
                                    <td><a href="product.php?c=<?= $v['id']; ?>"><?= $v['title']; ?></a></td>
                                    <td width="100" align="center"><?= $obj->get_status($v['status']); ?></td>
                                    <td width="50"><a class="btn btn-info btn-small" type="button" href="product_catalog_detail.php?id=<?= $v['id']; ?>">編輯</a></td>
                                <input type="hidden" name="sort_arr[]" value="<?= $v['id']; ?>"/>
                                </tr>
                            <?php }
                            ?>
                        </table>
                        <input type="hidden" name="parent" value=""/>
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
    var bc_e = $('select[data-target="bcatalog"]');
    var status_e = $("select[data-target='status']");
    
    $(function ()
    {
        sel_status();
        sel_bc();
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
        $("input[name='parent']").val(bc_e.val());
        form.submit();
        return false;
    }
    
    function sel_status()
    {
        status_e.on("change", function ()
        {
            window.location = '?bc=' + bc_e.val() + '&cs=' + $(this).val();
        });
    }
    
    function sel_bc()
    {
        bc_e.on("change", function ()
        {
            window.location = '?bc=' + $(this).val() + '&cs=' + status_e.val();
        });
    }
    
    function save()
    {
        $("input[name='doit']").val("sort");
        $("input[name='parent']").val(bc_e.val());
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
        $("input[name='parent']").val(bc_e.val());
        form.submit();
        return false;
    }
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");