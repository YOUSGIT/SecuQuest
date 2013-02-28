<?php
require_once("/Hosting/9606194/html/SecuQuest/_init.php");
define("CAT", 5);

$obj = new Contact;
$crumb = $obj->get_crumb_html();
$toolbar = $obj->get_toolbar_html();
$ret = $obj->get_all();
require_once(INC_ADMIN . "head.inc.php");
?>      
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="contact.php" class="active">客服列表</a></li>
                <li><a href="contact_info.php">聯絡資訊</a></li>
            </ul>
        </td>
        <td class="middle-col">&nbsp;</td>
        <td class="right-col">            
            <div class="module-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mheader">
                    <tr>
                        <td width="30"><input type="checkbox" class="check-all" /></td>
                        <td width="200">姓名</td>
                        <td width="250">郵件</td>
                        <td>主旨</td>
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
                                    <td width="30" align="center"><input name="delid[]" type="checkbox" class="check-item" value="<?= $v['id']; ?>" /></td>
                                    <td width="200"><?= $v['name']; ?></td>
                                    <td width="250"><a href="mailto:<?= $v['email']; ?>"><?= $v['email']; ?></a></td>
                                    <td><?= $v['subject']; ?></td>
                                    <td width="100" align="center" class="date"><?= date('Y-m-d', strtotime($v['dates'])); ?></td>
                                    <td width="50"><a class="btn btn-info btn-small" type="button" href="contact_detail.php?id=<?= $v['id']; ?>">內容</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <input type="hidden" name="func" value="contact"/>
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
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");