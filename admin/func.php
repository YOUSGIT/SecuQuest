<?php

require_once("/var/www/html/secuquest/_init.php");
header('Content-Type: text/html; charset=utf-8');
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

        case "contact":

            $func = new Contact;
            break;

        case "support_cat":

            $func = new Support;
            $func->set_field(SUPPORT_CAT);
            break;

        case "support":

            $func = new Support;
            break;

        case "catalog":

            $func = new Catalog;
            break;

        case "product_img":

            $func = new Product;
            $func->set_field(PRODUCT_IMG);
            break;

        case "product":

            $func = new Product;
            break;

        case "support_down":

            $func = new Support;
            $func->set_field(SUPPORT_DOWN);
            break;

        case "password":
            $func = new Site;
            $func->modPW();

            exit;
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

    case "info":
        $func->renew_info();
        break;

    case "catalog":
        $func->get_catalog();
        break;

    case "product":
        $func->get_product();
        exit;
        break;
}

$func->goback();