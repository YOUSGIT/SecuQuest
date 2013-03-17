<?php

require_once("/var/www/html/secuquest/_init.php");
define("CAT", 1);

$obj = new Banner;
$ret = $obj->get_all();
$toolbar = $obj->get_toolbar_html();
$crumb = $obj->get_crumb_html();

require_once(INC_ADMIN . "head.inc.php");
?>
<script type="text/javascript" src='../script/jquery.validate.js'></script>
<script type="text/javascript" src='../script/jquery.form.js'></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td class="left-col">
            <ul class="side-bar">
                <li><a href="website_banner.php">首頁廣告設定</a></li>
                <li><a href="website_password.php" class="active">管理者密碼</a></li>
            </ul>
        </td>
        <td class="middle-col">&nbsp;</td>
        <td class="right-col">
            <div class="module-tool">
                <div class="group">
                    <button class="btn btn-info" type="button" onclick="return save();">儲存</button>
                    <!--<button class="btn" type="reset">取消</button>-->
                </div>
            </div> 
            <div class="module-form">
                <ul class="mheader">
                    <li><a href="#" class="active">管理者密碼</a></li>                        
                </ul>
                <div class="main-container">
                    <div class="mbody">
                        <form data-target="form" method="post" action="func.php">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th width="100" align="right">原密碼</th>
                                    <td><input name='pw' type="password" placeholder="請輸入密碼…" class="span3" required></td>
                                </tr>
                                <tr>
                                    <th align="right">新密碼</th>
                                    <td>
                                        <input name='npw1' type="password" placeholder="請輸入密碼…" class="span3" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <th align="right">確認密碼</th>
                                    <td><input name='npw2' type="password" placeholder="請輸入密碼…" class="span3" required/></td>
                                </tr>
                            </table>
                            <input type="hidden" name="func" value="password"/>
                        </form>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>
<script type="text/javascript">
    var validator;
    var _FORM = $("form[data-target='form']");
    
    $(function(){
        validator = _FORM.validate();
    });
                        function save()
                        {
                            if (_FORM.valid())
                                _FORM.submit();

                            return false;
                        }
</script>
<?php

require_once(INC_ADMIN . "footer.inc.php");