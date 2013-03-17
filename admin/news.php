<?php
require_once("/var/www/html/secuquest/_init.php");
define("CAT", 2);

$obj = new News;
$ret = $obj->get_all();
$toolbar = $obj->get_toolbar_html();
$crumb = $obj->get_crumb_html();

require_once(INC_ADMIN . "head.inc.php");
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="news.php" class="active">新聞列表</a></li>
            </ul>
        </td>
        <td class="middle-col">&nbsp;</td>
        <td class="right-col">
            <div class="module-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mheader">
                    <tr>
                        <td width="30"><input type="checkbox" class="check-all" /></td>
                        <td width="100">預覽</td>
                        <td>標題</td>
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
                                    <td width="30" align="center"><input name="delid[]" type="checkbox" class="check-item"  value="<?php echo $v['id']; ?>"/></td>
                                    <td width="100"><img src="<?php echo $obj->get_pre_img($v['path']); ?>" width="150"/></td>
                                    <td><?php echo $v['title']; ?></td>
                                    <td width="100" align="center" class="date"><?php echo date("Y-m-d", strtotime($v['dates'])); ?></td>
                                    <td width="50"><a class="btn btn-info btn-small" type="button" href="news_detail.php?id=<?php echo $v['id']; ?>">編輯</a></td>
                                </tr>
                            <?php }
                            ?>
                        </table>
                        <input type="hidden" name="func" value="news"/>
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