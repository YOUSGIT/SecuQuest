<?php
#
# ImgCode  -  用于评论的图像验证码
#
# Copyright (c) 2005 dualface
# <http://www.dualface.com/>
#

/**
 * 显示验证码
 *
 * @copyright Copyright (c) 2004 dualface.com
 * @author 廖宇雷 &lt;daut@dualface.com&gt;
 * @package register
 * @version $Id$
 */

/**
 * 生成随机数种子
 *
 * @return float
 *
 * @access public
 */
function make_seed()
{
    list($usec, $sec) = explode(' ', microtime());
    return (float)$sec + ((float)$usec * 100000);
}


// 生成 4 位随机数
mt_srand(make_seed());
$number = '';
$number_len = 4;
$stuff = '012345678901234567890123456789012345678901234567890123456789';
$stuff_len = strlen($stuff) - 1;
for ($i = 0; $i < $number_len; $i++) {
	$number .= substr($stuff, mt_rand(0, $stuff_len), 1);
}

// 把随机数存入 session
@session_start();
$_SESSION['IMGCODE'] = $number;
$_SESSION['IMGCODE_EXPIRED'] = time() + 1 * 600; // 15分钟后该验证码失效
//$_SESSION['color']= $number;
// 生成验证码图片
$img_width = 90;
$img_height = 32;

$img = imagecreate($img_width, $img_height);
imagecolorallocate($img, 0x66, 0x66, 0x66);
$white = imagecolorallocate($img, 0xff, 0xff, 0xff);

$ix = 5;
$iy = 2;
$fontid = imageloadfont(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'sketchey.gdf');
imagestring($img, $fontid, $ix, $iy, $number, $white);

// 输出图片
//header("Content-type: " . image_type_to_mime_type(IMAGETYPE_PNG));
imagejpeg($img);
imagedestroy($img);

?>