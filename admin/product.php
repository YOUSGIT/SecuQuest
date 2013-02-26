<?php
require_once("/Hosting/9606194/html/SecuQuest/_init.php");
define("CAT", 3);

$obj = new Product;
$crumb = $obj->get_crumb_html();
$toolbar = $obj->get_toolbar_html();
$catalog = new Catalog;
$bcatalog_arr = $catalog->get_all_for_product(0);
$bcatalog = $catalog->get_parent_for_product($_GET['p']);
$catalog_arr = $bcatalog > 0 ? $catalog->get_all_for_product($bcatalog) : $catalog->get_all_for_product($_GET['p']);
$ret = $obj->get_all();
$parent_title_arr = $catalog->get_parent_title_arr_for_product();
require_once(INC_ADMIN . "head.inc.php");
?> 
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
                    大分類 <select class="span5" data-target="bcatalog">                        	
                        <option>請選擇...</option>
                        <option value="0" <?= $_GET['p'] == 0 ? 'selected="selected"' : ''; ?>>全部</option>
                        <?php
                        foreach ($bcatalog_arr as $v)
                        {
                            ?>
                            <option value="<?= $v['id']; ?>" <?= $_GET['p'] == $v['id'] || ($bcatalog == $v['id']) ? 'selected="selected"' : ''; ?>><?= $v['title']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="group">
                    子分類 <select class="span5" data-target="bcatalog">                        	
                        <option value="<?= $bcatalog; ?>">請選擇大分類</option>
                        <?php
                        foreach ($catalog_arr as $v)
                        {
                            ?>
                            <option value="<?= $v['id']; ?>" <?= $_GET['p'] == $v['id'] ? 'selected="selected"' : ''; ?>><?= $v['title']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="group">
                    狀態 <select class="span2" data-target="status">
                        <option>全部</option>
                        <option value="1" <?= $_GET['s'] == "1" ? 'selected="selected"' : ''; ?>>上架</option>
                        <option value="0" <?= $_GET['s'] == "0" ? 'selected="selected"' : ''; ?>>下架</option>
                    </select>
                </div>                    
            </div> 
            <div class="module-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mheader">
                    <tr>
                        <td width="30"><input type="checkbox" class="check-all" /></td>
                        <td width="100">預覽</td>
                        <td width="200">大分類</td>
                        <td width="200">子分類</td>                        
                        <td>產品名稱</td>
                        <td width="100">狀態</td>
                        <td width="50">編輯</td>
                    </tr>
                </table>
                <div class="main-container">
                    <form data-target="form" method="post" action="func.php">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mbody">
                            <?php
                            foreach ($ret as $v)
                            {
                                $bc = $catalog->get_parent_for_product($v['parent']);
                                ?>
                                <tr>
                                    <td width="30" align="center"><input name="delid[]" type="checkbox" class="check-item"  value="<?= $v['id']; ?>"/></td>
                                    <td width="100"><img src="<?= $obj->get_pre_img($v['type'], $v['path']); ?>" width="100" /></td>
                                    <td width="200"><?= $bc > 0 ? $parent_title_arr[$bc] : $parent_title_arr[$v['parent']]; ?></td>
                                    <td width="200"><?= $bc > 0 ? $parent_title_arr[$v['parent']] : ''; ?></td>
                                    <td><?= $v['title']; ?></td>
                                    <td width="100" align="center"><?= $obj->get_status($v['status']); ?></td>
                                    <td width="50"><a class="btn btn-info btn-small" type="button" href="product_detail.php?id=<?= $v['id']; ?>">編輯</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <input type="hidden" name="status" value="0"/>
                        <input type="hidden" name="func" value="product"/>
                        <input type="hidden" name="doit" value="del"/>
                        <input type="hidden" name="parent" value="<?= $_GET['p']; ?>"/>
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
            window.location = '?p=' + $("input[name='parent']").val() + '&s=' + $(this).val();
        });
    }
    
    function sel_bc()
    {
        bc_e.on("change", function ()
        {
            window.location = '?p=' + $(this).val() + '&s=' + status_e.val();
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