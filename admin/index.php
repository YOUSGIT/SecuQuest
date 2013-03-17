<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SecuQuest 網站管理系統</title>
        <link href="theme/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="theme/core/admin.css" rel="stylesheet" type="text/css" />
        <link href="theme/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="script/jquery1.9.min.js"></script>
        <script type="text/javascript" src="script/jquery-ui-1.10.0.custom.min.js"></script>
        <script type="text/javascript" src="theme/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="script/admin.js"></script>
    </head>

    <body>
        <div class="module-login">
            <div><img src="images/logo.png" width="96" height="40" /></div>
            <div>secuQuest-網站管理系統</div>
            <div>
                <form method="post" action="logincheck.php">
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <th width="60" align="right">帳號</th>
                            <td colspan="2"><input name="id" type="text" size="40" /></td>
                        </tr>
                        <tr>
                            <th align="right">密碼</th>
                            <td colspan="2"><input name="pw" type="password" size="40" /></td>
                        </tr>
                        <tr>
                            <th align="right">驗証</th>
                            <td><input name="imgcode" type="text" size="20" /></td>
                            <td align="right" valign="middle"><img  src="../inc/imgcode.php" alt="" width="90" height="32" /></td>
                        </tr>
                        <tr>
                            <th align="right">位置</th>
                            <td>
                                <select name="LANG" id="select">
                                    <option value="en">英文網站</option>
                                    <option value="cn">簡體中文網站</option>
                                </select>
                            </td>
                            <td align="right"><input type="submit" value="登入" class="btn btn-info" /></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="copyright">YOUS © 2013</div>
        </div>
    </body>
</html>
