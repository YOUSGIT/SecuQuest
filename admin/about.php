<?php
require_once("/var/www/html/secuquest/_init.php");
define("CAT", 6);

$obj = new About;
$ret = $obj->get_all();
$toolbar = $obj->get_toolbar_html();
$crumb = $obj->get_crumb_html();

require_once(INC_ADMIN . "head.inc.php");
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="about.php" class="active">內容列表</a></li>
            </ul>
        </td>
        <td class="middle-col">&nbsp;</td>
        <td class="right-col">   
            <div class="module-tool">                    
                <div class="group">
                    <button class="btn btn-info" type="button" onclick="return save();">儲存順序</button>
                </div>
            </div>          
            <div class="module-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mheader">
                    <tr>
                        <td width="30"><input type="checkbox" class="check-all" /></td>
                        <td>項目</td>
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
                                    <td width="30" align="center"><input name="delid[]" type="checkbox" class="check-item"  value="<?php echo $v['id']; ?>"/></td>
                                    <td><?php echo $v['title']; ?></td>
                                    <td width="50"><a class="btn btn-info btn-small" type="button" href="about_detail.php?id=<?php echo $v['id']; ?>">編輯</a></td>
                                <input type="hidden" name="sort_arr[]" value="<?php echo $v['id']; ?>"/>
                                </tr>
                            <?php }
                            ?>
                        </table>
                        <input type="hidden" name="func" value="about"/>
                        <input type="hidden" name="doit" value="del"/>
                    </form>
                </div>
            </div>
        </td>
    </tr>
</table>
<script>
    var form=$('form[data-target="form"]')
    
    function del()
    {
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
    
    function save(){
        $("input[name='doit']").val("sort");
        form.submit();
        return false;
    }
</script>
<?php
require_once(INC_ADMIN . "footer.inc.php");