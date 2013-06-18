<?php

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//header("Content-Type:text/html; charset=utf-8");
ob_start();
ini_set('display_errors', '1');
session_start();
error_reporting(E_ALL ^ E_NOTICE);

if (true)
{
    // define('myDB', 'Secuquest');
    define('Debug', true);
    // $root_f = '/_offline/';
    $root_f = '/';
}
else
{
    // define('myDB', 'sqi2');
    define('Debug', false);
    $root_f = '/';
}

#############################################
$_lang = array(
    'cht',
    'cn',
    'en',
    'db' => array(
        'cht' => '_cht',
        'cn' => '_cn',
        'en' => ''
    ),
    'title' => array(
        'cht' => '正體中文',
        'cn' => '简体中文',
        'en' => 'English'
    )
);

if (file_exists("admin.admin"))
{
    $root = '../';
    $_LANG_KEY = "ADM_LANG";

// front
}
else
{
    $root = '';
    $_LANG_KEY = "FRONT_LANG";
}

$_SESSION[$_LANG_KEY] = (isset($_REQUEST['LANG']) && in_array($_REQUEST['LANG'], $_lang)) ? $_REQUEST['LANG'] : $_SESSION[$_LANG_KEY];

if ($_SESSION[$_LANG_KEY] == '')
    $_SESSION[$_LANG_KEY] = 'en';

define('LANG', $_SESSION[$_LANG_KEY]);
// exit(LANG);
define('myDB', 'Secuquest' . $_lang['db'][LANG]);

//========定義資料表之通用名
define('CUSTOMER', 'customer');
define('ADM', 'admin');
define('ADV', 'adv');
define('ABOUT', 'about');
define('NEWS', 'news');
define('CATALOG', 'catalog');
define('PRODUCT', 'product');
define('PRODUCT_IMG', 'product_img');
define('CONTACT', 'contact');
define('CONTACT_INFO', 'contact_info');
define('SUPPORT_CAT', 'support_catalog');
define('SUPPORT', 'support');
define('SUPPORT_DOWN', 'support_download');

####################################################
// $root_f = '/SecuQuest/';
$inPage = pathinfo($_SERVER["PHP_SELF"]);
define('this_Page', $inPage["basename"]); //本頁檔名
define('_ROOT', "/var/www/html/secuquest" . $root_f); //根目錄
// exit(_ROOT);
#################圖片存放位置
define('ADM_Image', $root . 'images/user_images/ad/');
define('NEWS_Image', $root . 'images/user_images/news/');
define('PD_Image', $root . 'images/user_images/pd/');
define('BC_Image', $root . 'images/user_images/bc/');
define('TEMP_Image', $root . 'images/user_images/temp/');
define('FILES_down', $root . 'download/');
define('INC_CLASS', 'inc/class/');
define('INC_ADMIN', _ROOT . 'admin/inc/');
define('IMAGES', $root . 'images/');
define('WEB', 'http://www.secuquest.com' . $root_f);

$image_Prefix = array("s_", "m_", "l_", "ss_", ""); //圖檔名前綴
#######################################################
$Allp = 9; //每頁筆數
####################################################
require_once(_ROOT . "inc/function.php"); //引入常用功能函數
####################################################
if (!is_object(unserialize($_SESSION['loginObj'])))
    Site::checkLogin();
else
    unserialize($_SESSION['loginObj'])->checkLogin();

##########################################################
$_POST = TrimArray($_POST);
TrimArray($_GET);