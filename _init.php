<?php

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//header("Content-Type:text/html; charset=utf-8");
ob_start();
ini_set('display_errors', '1');
session_start();
// error_reporting(); #-1

if (true)
{
    define('myDB', 'Secuquest');
    define('Debug', true);
    $root_f = '/SecuQuest/';
}
else
{
    define('myDB', 'Secuquest');
    define('Debug', false);
    $root_f = '/';
}

#########################
$_lang = array('cht', 'cn', 'en');

if (isset($_GET['LANG']) && in_array($_GET['LANG'], $_lang))
    $_SESSION['LANG'] = $_GET['LANG'];


if (trim($_SESSION['LANG']) == '')
    $_SESSION['LANG'] = 'cht';

define('LANG', $_SESSION['LANG']);


//========定義資料表之通用名
define('CUSTOMER', 'customer');
define('ADM', 'admin');

if (LANG != 'en')
{

    define('ADV', 'adv');
    define('ABOUT', 'about');
    define('NEWS', 'news');
    define('CATALOG', 'catalog');
    define('PRODUCT', 'product_p');
    define('CUSTOMER', 'customer');
    define('CONTACT_INFO', 'contact_info');
    define('SUPPORT_CAT', 'support_catalog');
    define('SUPPORT', 'support');
}
else
{

    define('ADV', 'en_adv');
    define('ABOUT', 'en_about');
    define('NEWS', 'en_news');
    define('CATALOG', 'en_catalog');
    define('PRODUCT', 'en_product_p');
    define('CUSTOMER', 'en_customer');
    define('CONTACT_INFO', 'en_contact_info');
    define('SUPPORT_CAT', 'en_support_catalog');
    define('SUPPORT', 'en_support');
}


define("_KEY", 192); //編號編碼
####################################################
$root_f = '/SecuQuest/';
$inPage = pathinfo($_SERVER["PHP_SELF"]);
define('this_Page', $inPage["basename"]); //本頁檔名
define('_ROOT', "/Hosting/9606194/html" . $root_f); //根目錄
// exit(_ROOT);

if (file_exists("admin.admin"))
    $root = '../';
else
    $root = '';


#################圖片存放位置
define('ADM_Image', $root . 'images/user_images/ad/');
define('NEWS_Image', $root . 'images/user_images/news/');
define('PD_Image', $root . 'images/user_images/pd/');
//define('SPEC_Image',$root.'images/user_images/spec/');
//define('PACK_Image',$root.'images/user_images/pack/');
define('BC_Image', $root . 'images/user_images/bc/');
define('TEMP_Image', $root . 'images/user_images/temp/');
define('FILES_down', $root . 'download/');
define('INC_CLASS', 'inc/class/');
define('INC_ADMIN', _ROOT . 'admin/inc/');
define('IMAGES', $root . 'images/');
define('WEB', 'http://www.besdon.com.tw' . $root_f);

$image_Prefix = array("s_", "m_", "l_", "ss_", ""); //圖檔名前綴
#######################################################

$Allp = 9; //每頁筆數
#############################	
/*
  if(@$_SESSION['AdmiN'])
  $AdmiN=$_SESSION['AdmiN'];

  if((!isset($AdmiN) || empty($AdmiN)) && file_exists("admin.admin")==true)
  if(($inPage["basename"]!='index.php')&&($inPage["basename"]!='logincheck.php') &&($inPage["basename"]!='logout.php'))
  header("Location:  index.php");
 */

####################################################
require_once(_ROOT . "inc/function.php"); //引入常用功能函數
// if(file_exists("admin.admin"))
// require_once(_ROOT."admin/inc/lang/global.php");
##########################################################
#require_once(_ROOT."inc/addslashes.php");
TrimArray($_POST);
TrimArray($_GET);
// $_GET = @array_map('trim', $_GET);