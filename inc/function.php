<?php

function __autoload($class_name)
{

    $path = INC_CLASS . $class_name . '.php';

    //if(substr_count(	$_SERVER["PHP_SELF"],'admin')>0 && $class_name !='DB')
    //	include_once _ROOT.'admin/'.$path;
    //else
    include_once _ROOT . $path;
}

function file_size($path, $unit = "MB")
{
    $unit_arr = array("MB" => 1048576, "KB" => 1024);

    if (trim($path) != '')
        return round((filesize($path) / $unit_arr[strtoupper($unit)]), 2);

    return "0";
}

function convert_mem($size)
{
    $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
    return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
}

function Crumbs($arg)
{

    if (file_exists("admin.admin"))
        $root = "網站管理系統";
    else
        $root = "首頁";

    $ret = '<li><a href="./" class="icon home-s">' . $root . '</a> ></li>';
    if (is_array($arg))
    {

        foreach ($arg as $k => $v)
        {

            $a = '';
            $arrow = '';
            if (trim($v) != '')
            {
                $a = '<a href="' . $v . '">';
                $arrow = '>';
            }

            $ret.='<li>' . $a . $k . '</a> ' . $arrow . '</li>';
        }
    }
    // $ret.='  <li>首頁廣告設定</li>';
    return $ret;
}

function send_no_cache_header()
{
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0, false');
    header('Pragma: no-cache');
}

//================================================================================================================

function AddLink2Text($str)
{ //==============自動判斷超聯結
    $str = preg_replace("<a href=\"\\1\">\\1</a>", "<a href=\"" . urlencode("\\1") . "\" target=\"_blank\">\\1</a>", $str);

    $str = preg_replace("#([0-9a-z._]+@[0-9a-z._?=]+)#i", "<a href=\"mailto:\\1\">\\1</a>", $str);
    return $str;
}

function AddLink2Textencode($str)
{ //==============自動判斷超聯結
    $str = preg_replace("#(http://[0-9a-z._/?=&;]+)#i", "<a href=\"\\1\" target=\"_blank\">\\1</a>", $str);

    $str = preg_replace("#([0-9a-z._]+@[0-9a-z._?=]+)#i", "<a href=\"mailto:\\1\">\\1</a>", $str);
    return $str;
}

function qsql($sql)
{//查詢SQL成功則返回前頁
    if (mysql_query($sql))
        return true;
    else
        die($sql);
    //echo '資料更新中...';
    // 查詢執行成功，重導網頁位址到 index.php
//	echo '<META HTTP-EQUIV="refresh" CONTENT="3; URL=pictures.php?albumid='.$pid.'">';
}

function maxmin($obj, $maxin, $table)
{//查詢最大或最小函數 目標欄位,最大或最小,資料表名稱
    $sql = 'select ' . $maxin . '(' . $obj . ') from ' . $table;
    mysql_query($sql) || die('die');
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row[0];
}

function goback($url, $sec, $title)
{

    //if (!headers_sent()){    //If headers not sent yet... then do php redirect
    //header('Location: '.$url); exit;
    //}else{                    //If headers are sent... do java redirect... if java disabled, do html redirect.
    echo '<script type="text/javascript">';

    if (trim($title) != '')
        echo 'alert(\'' . trim($title) . '\');';
    echo 'window.location="' . $url . '";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
    echo '</noscript>';
    exit;
}

function RemoveExtension($fileName)
{
    return substr($fileName, 0, strrpos($fileName, '.'));
}

function Extension($fileName)
{
    return substr($fileName, strrpos($fileName, '.'), strlen($fileName));
}

function resizeimage($dir, $sor, $new_w, $new_h, $new_name, $thumbnail = false, $prefix = "s")
{//縮圖程式區段=====================================
    $newi = $dir . 'test.jpg';
    $pics_img = $new_name;
    $sorsize = getimagesize($sor);
    $img_ratio = $sorratio = $sorsize[0] / $sorsize[1]; //寬/高
    $target_ratio = $newratio = $new_w / $new_h;

    if ($sorsize[2] == '2')
    {
        $newsize[0] = $ow = $sorsize[0];
        $newsize[1] = $oh = $sorsize[1];

        // 橫
        if ($img_ratio > 1)
        {
            if ($ow > $new_w)
            {
                $target_ratio = $ow / $new_w;
                $newsize[0] = $new_w;
                $newsize[1] = $oh / $target_ratio;

                if ($newsize[1] > $new_h)
                {
                    $target_ratio = $newsize[1] / $new_h;
                    $newsize[1] = $new_h;
                    $newsize[0] = $newsize[0] / $target_ratio;
                }
            }
        }
        // 直
        else
        {
            if ($oh > $new_h)
            {
                $target_ratio = $oh / $new_h;
                $newsize[1] = $new_h;
                $newsize[0] = $ow / $target_ratio;

                if ($newsize[0] > $new_w)
                {
                    $target_ratio = $newsize[0] / $new_w;
                    $newsize[0] = $new_w;
                    $newsize[1] = $newsize[1] / $target_ratio;
                }
            }
        }

        /*
          if ($target_ratio > $img_ratio)
          {
          $newsize[1] = $new_h;
          $newsize[0] = $img_ratio * $new_h;
          }
          else
          {
          $newsize[1] = $new_w / $img_ratio;
          $newsize[0] = $new_w;
          }

          if ($newsize[1] > $new_h)
          {
          $newsize[1] = $new_h;
          }
          if ($newsize[0] > $new_w)
          {
          $newsize[1] = $new_w;
          }
         */
        //=======判斷開始=================================================
        #$newsize[1]=$new_h;
        #$newsize[0]=$new_h*$sorratio;

        $newimage = imagecreatetruecolor($newsize[0], $newsize[1]);
        switch ($sorsize[2])
        {
            case 1: $srcimage = imagecreatefromgif($sor);
                break;
            case 2: $srcimage = imagecreatefromjpeg($sor);
                break;
            case 3: $srcimage = imagecreatefrompng($sor);
                break;
            //case 6: $srcimage = imagecreatefromwjpeg($sor); break;
            default: return false;
                break;
        }

        imagecopyresampled($newimage, $srcimage, 0, 0, 0, 0, $newsize[0], $newsize[1], $sorsize[0], $sorsize[1]);

        switch ($sorsize[2])
        {
            case 1: imagegif($newimage, $newi, 100);
                break;
            case 2: imagejpeg($newimage, $newi, 100);
                break;
            case 3:
                $black = imagecolorallocate($newimage, 0, 0, 0);
                imagecolortransparent($newimage, $black);
                imagepng($newimage, $newi);
                break;

            default: return false;
                break;
        }


        //echo $sor;
    }else
        copy($sor, $newi);

    if ($thumbnail)
        $new_name = $prefix . '_' . $new_name;
    else
        @unlink($sor);

    rename($newi, $dir . $new_name);
    $pics_img = $new_name;

    return $pics_img;
}

/*
 * Add the quote "`" to the input string
 *
 * @param {String} $str - the database or table name
 *
 * @return {String} $ret - the added quote string
 *
 * Input: database.table
 * Output: `database`.`table`
 *
 * */
function add_field_quotes($str)
{
    $str = str_replace('`', '', $str);
    $str_arr = explode(".", $str);

    $ret_arr = array();
    foreach ($str_arr as $v)
        if (mb_substr($v, 0, 1) != '`' || mb_substr($v, -1, 1) != '`')
            array_push($ret_arr, '`' . $v . '`');


    $ret = implode('.', $ret_arr);
    // print_r( $ret);
    return trim($ret);
}

function TrimArray(&$Input)
{
    if (!is_array($Input))
    {
        // $Input = trim($Input);
        return trim($Input);
    }

    return array_map('TrimArray', $Input);
}