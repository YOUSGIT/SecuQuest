<?php

/* * **************************************
  Example of how to use this uploader class...
  You can uncomment the following lines (minus the require) to use these as your defaults.

  // list of valid extensions, ex. array("jpeg", "xml", "bmp")
  $allowedExtensions = array();
  // max file size in bytes
  $sizeLimit = 10 * 1024 * 1024;

  require('valums-file-uploader/server/php.php');
  $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);

  // Call handleUpload() with the name of the folder, relative to PHP's getcwd()
  $result = $uploader->handleUpload('uploads/');

  // to pass data through iframe you will need to encode all html tags
  echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);

  /***************************************** */
require_once("/Hosting/9606194/html/SecuQuest/_init.php");

switch ($_GET['func'])
{
    case "adv":
        $obj = new Banner;
        $f = $obj->get_dir();
        $s_size = $obj->get_s_size();
        break;

    case "news":
        $obj = new News;
        $f = $obj->get_dir();
        $s_size = $obj->get_s_size();
        break;

    case "pd":
        $obj = new Product;
        $f = $obj->get_dir();
        $s_size = $obj->get_s_size();
        break;

    case "down":
        $obj = new Support;
        $f = $obj->get_dir();
        $s_size = $obj->get_s_size();
        break;

    default:
        $f = TEMP_Image;
        break;
}

define("pin_upload_path", _ROOT . $f);
require_once("class_qqUploaded.php");
$uploader = new qqFileUploader;
// echo(pin_upload_path);
usleep(mt_rand(500000, 1000000));
$result = $uploader->handleUpload(pin_upload_path, $s_size);
echo json_encode($result);