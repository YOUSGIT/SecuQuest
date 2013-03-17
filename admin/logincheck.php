<?php

// ini_set('display_errors', '1');

require_once("../_init.php");
if (($_POST['imgcode'] != $_SESSION['IMGCODE'] || time() >= $_SESSION['IMGCODE_EXPIRED']))
{
    header("Location: ./ ");
    exit;
}

$obj = new Site;

if (!$ret = $obj->login())
{
    header("Location: ./ ");
    exit;
}
else
{
    if ($obj->setSession($ret))
        header("Location: ./website_banner.php");
    else
        header("Location: ./index.php");
    exit;
}