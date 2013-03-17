<?php
require_once("/var/www/html/secuquest/_init.php");
define("CAT", 4);

$obj = new Support;
$obj->set_field(SUPPORT_CAT);
$catalog = $obj->get_cat_all();
unset($obj);
$obj = new Support;
$crumb = $obj->get_crumb_html();
$toolbar = $obj->get_toolbar_html();
$ret = $obj->get_all();
require_once(INC_ADMIN . "head.inc.php");
?> 
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="support.php" class="active">支援列表</a></li>
                <li><a href="support_catalog.php">支援分類</a></li>
                <li><a href="support_download.php">檔案下載列表</a></li>
            </ul>
        </td>
        <td class="middle-col">&nbsp;</td>
        <td class="right-col">
            <div class="module-tool">
                <div class="group">
                    分類 <select data-target="catalog" class="span4">                        	
                        <option value="0" <?php echo $_GET['c'] == '0' || $_GET['c'] == '' ? 'selected="selected"' : ''; ?>>全部</option>
                        <?php
                        foreach ($catalog as $v)
                        {
                            ?>
                            <option value="<?php echo $v['id']; ?>" <?php echo $_GET['c'] == $v['id'] ? 'selected="selected"' : ''; ?>><?php echo $v['title']; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>                    
            </div>
            <div class="module-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mheader">
                    <tr>
                        <td width="30"><input type="checkbox" class="check-all" /></td>
                        <td width="200">分類</td>
                        <td>問題</td>
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
                                    <td width="200"><?php echo $obj->get_catalog($v['catalog']); ?></td>
                                    <td><?php echo $v['title']; ?></td>
                                    <td width="50"><a class="btn btn-info btn-small" type="button" href="support_detail.php?id=<?php echo $v['id']; ?>">編輯</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <input type="hidden" name="func" value="support"/>
                        <input type="hidden" name="doit" value="del"/>
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