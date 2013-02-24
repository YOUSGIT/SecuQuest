<?php
require_once("/Hosting/9606194/html/SecuQuest/_init.php");
define("CAT", 4);

$obj = new Support;
$obj->set_field(SUPPORT_CAT);
$crumb = $obj->get_cat_crumb_html();
$toolbar = $obj->get_cat_toolbar_html();
$ret = $obj->get_cat_all();
require_once(INC_ADMIN . "head.inc.php");
?>        
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="support.php">支援列表</a></li>
                <li><a href="support_catalog.php" class="active">支援分類</a></li>
                <li><a href="support_download.php">檔案下載列表</a></li>
            </ul>
        </td>
        <td class="middle-col">&nbsp;</td>
        <td class="right-col">            
            <div class="module-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mheader">
                    <tr>
                        <td width="30"><input type="checkbox" class="check-all" /></td>
                        <td>分類名稱</td>
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
                                    <td width="30" align="center"><input name="delid[]" type="checkbox" class="check-item" value="<?= $v['id']; ?>" /></td>
                                    <td><?= $v['title']; ?></td>
                                    <td width="50"><a class="btn btn-info btn-small" type="button" href="support_catalog_detail.php?id=<?= $v['id']; ?>">編輯</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <input type="hidden" name="func" value="support_cat"/>
                        <input type="hidden" name="doit" value="del"/>
                    </form>
                </div>
            </div>
        </td>
    </tr>
</table>
<script>
    function del()
    {
        var form=$('form[data-target="form"]');
        var ret = form.find("input[type='checkbox']:checked");
        
        if (!ret.length > 0)
        {
            alert("Please select item");
            return false;
        }
        
        if(!confirm("Confirm to delete ?"))
            return false;
        
        form.submit();
        return false;
    }
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");