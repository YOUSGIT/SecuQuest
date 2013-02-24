<?php

require_once("/Hosting/9606194/html/SecuQuest/_init.php");
// header('Content-Type: text/html; charset=utf-8');
$back = './';

$FUNC = trim($_REQUEST['func']);
$DOIT = trim($_REQUEST['doit']);

if ($FUNC)
{

    switch ($FUNC)
    {

        case "adv":

            $func = new Banner;
            break;

        case "news":

            $func = new News;
            break;

        case "about":

            $func = new About;
            break;

        case "pdp":

            $func = new Product;
            break;

        case "bcd":

            $func = new Catalog_d;
            break;

        case "pdd":

            $func = new Product_d;
            break;

        case "sv":

            $func = new Service;
            break;

        case "svf":

            $func = new Service_files;
            break;

        case "custom":

            $func = new Custom;
            break;


        default:

            break;
    }
}

switch ($DOIT)
{

    case "renew":

        $func->renew();
        if ($func->is_sort())
            $func->resort();

        break;

    case "del":

        $r = $func->killu();
        if ($func->is_sort())
            $func->resort();

        break;

    case "delp":

        foreach ($image_Prefix as $v)
            @unlink($_POST['dir'] . $v . $_POST['file']);

        $ret = array('ret' => 'ok');

        echo json_encode($ret);
        exit;

        break;

    case "move":

        $func->move_sequ();
        break;

    case "sale":

        $func->sale();
        break;

    case "status":

        $func->status();
        break;

    case "sort":
        $func->sortable();

        break;
}

$func->goback();