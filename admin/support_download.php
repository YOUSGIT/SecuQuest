<?php
require_once("/var/www/html/secuquest/_init.php");
define("CAT", 4);

$obj = new Support;
$crumb = $obj->get_down_crumb_html();
$toolbar = $obj->get_down_toolbar_html();
$ret = $obj->get_down_all();
$catalog = new Catalog;
$bcatalog_arr = $catalog->get_all_for_product(0);
require_once(INC_ADMIN . "head.inc.php");
?> 
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
                    分類 <select class="span4" data-target="catalog">                        	
                        <option value="0" <?php echo $_GET['c'] == 0 || !$_GET['c'] ? 'selected="selected"' : ''; ?>>全部</option>
                        <?php
                        foreach ($bcatalog_arr as $v)
                        {
                            ?>
                            <option value="<?php echo $v['id']; ?>" <?php echo $_GET['c'] == $v['id'] ? 'selected="selected"' : ''; ?>><?php echo $v['title']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>                    
            </div>
            <div class="module-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mheader">
                    <tr>
                        <td width="30"><input type="checkbox" class="check-all" /></td>
                        <td width="100">分類</td>
                        <td width="200">產品</td>
                        <td>名稱</td>
                        <td width="200">簡述</td>
                        <td width="100">檔案大小</td>
                        <td width="100">日期</td>
                        <td width="50">編輯</td>
                    </tr>
                </table>
                <div class="main-container">
                    <form data-target="form" method="post" action="func.php">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mbody">
                            <?php
                            foreach ($ret as $v)
                            {
                                ?>
                                <tr>
                                    <td width="30" align="center"><input name="delid[]" type="checkbox" class="check-item" value="<?php echo $v['id']; ?>" /></td>
                                    <td width="100"><?php echo $v['c_title']; ?></td>
                                    <td width="200"><?php echo $v['p_title']; ?></td>
                                    <td><?php echo $v['title']; ?></td>
                                    <td width="200"><?php echo $v['brief']; ?></td>
                                    <td width="100" align="center"><?php echo file_size($obj->get_dir() . $v['path']); ?> MB</td>
                                    <td width="100" align="center"><?php echo date("Y-m-d", strtotime($v['dates'])); ?></td>
                                    <td width="50"><a class="btn btn-info btn-small" type="button" href="support_download_detail.php?id=<?php echo $v['id']; ?>">編輯</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <input type="hidden" name="func" value="support_down"/>
                        <input type="hidden" name="doit" value="del"/>
                        <input type="hidden" name="parent" value="<?php echo $_GET['c']; ?>"/>
                    </form>
                </div>
            </div>
        </td>
    </tr>
</table>
<script>
    $(function ()
    {
        sel_catalog()
    });
    
    function del()
    {
        var form = $('form[data-target="form"]');
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
    
    function sel_catalog()
    {
        $("select[data-target='catalog']").on("change", function ()
        {
            window.location = '?c=' + $(this).val();
        });
    }
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");