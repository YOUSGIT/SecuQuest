<?php

require_once("./_init.php");
header('Content-Type: text/html; charset=utf-8');
$back = './';

$FUNC = trim($_REQUEST['func']);
$DOIT = trim($_REQUEST['doit']);

if ($FUNC)
{
    switch ($FUNC)
    {
        case "contact":

            if ($_POST['check'] == '1')
            {
                if (($_POST['imgcode'] != $_SESSION['IMGCODE'] || time() >= $_SESSION['IMGCODE_EXPIRED']))
                    exit("vcode");
                exit;
            }
            $func = new Contact;
            break;

        default:

            break;
    }
}

switch ($DOIT)
{
    case "renew":

        $func->renew();
        $title = '感謝您的來信，我們將在最短的時間內給予您回覆。';

        break;
}

$func->goback('', $title);