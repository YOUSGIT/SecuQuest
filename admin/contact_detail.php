<?php
require_once("/Hosting/9606194/html/SecuQuest/_init.php");
define("CAT", 4);

$obj = new Contact;
$crumb = $obj->get_detail_crumb_html();
$ret = $obj->get_detail();
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
            <div class="module-tool">
                <div class="group">
                    <button class="btn" type="button" onclick="location='contact.php';">返回</button>
                </div>
            </div> 
            <div class="module-form">
                <ul class="mheader">
                    <li><a href="#" class="active">詳細內容</a></li>                        
                </ul>
                <div class="main-container">
                    <div class="mbody">
                        <form data-target="form" method="post" action="func.php">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th width="100" align="right">姓名</th>
                                    <td><?= $ret['name']; ?></td>
                                </tr>
                                <tr>
                                    <th align="right">郵件</th>
                                    <td><a href="mailto:<?= $ret['email']; ?>"><?= $ret['email']; ?></a></td>
                                </tr>
                                <tr>
                                    <th align="right">日期</th>
                                    <td class="date"><?= $ret['dates']; ?></td>
                                </tr>
                                <tr>
                                    <th align="right">主旨</th>
                                    <td><?= $ret['subject']; ?></td>
                                </tr>
                                <tr>
                                    <th align="right">內容</th>
                                    <td><?= nl2br($ret['content']); ?></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>
<?php
require_once(INC_ADMIN . "footer.inc.php");