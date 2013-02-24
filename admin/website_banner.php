<?php
require_once("/Hosting/9606194/html/SecuQuest/_init.php");
define("CAT", 1);

$obj = new Banner;
$ret = $obj->get_all();
$toolbar = $obj->get_toolbar_html();
$crumb = $obj->get_crumb_html();

require_once(INC_ADMIN . "head.inc.php");
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="website_banner.php" class="active">首頁廣告設定</a></li>
                <li><a href="website_password.php">管理者密碼</a></li>
            </ul>
        </td>
        <td class="middle-col">&nbsp;</td>
        <td class="right-col">
            <div class="module-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mheader">
                    <tr>
                        <td width="30"><input type="checkbox" class="check-all" /></td>
                        <td width="150">預覽</td>
                        <td width="100">媒體類型</td>                        
                        <td>標題</td>
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
                                    <td width="150"><img src="<?= $obj->get_pre_img($v['type'], $v['path']); ?>" width="150" /></td>
                                    <td width="100" align="center"><?= $obj->get_type($v['type']); ?></td>
                                    <td><?= $v['title']; ?></td>
                                    <td width="50"><a class="btn btn-info btn-small" type="button" href="website_banner_detail.php?id=<?= $v['id']; ?>">編輯</a></td>
                                </tr>
                            <?php }
                            ?>
                        </table>
                        <input type="hidden" name="func" value="adv"/>
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