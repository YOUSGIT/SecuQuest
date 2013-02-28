<?

ob_start();

$fname = base64_decode($_GET['title']) . base64_decode($_GET['t1']);

$fname2 = base64_decode($_GET['b']);
header('Content-Type:charset=utf-8');
header("Content-type:application/octet-stream");
header("Content-Disposition: attachment; filename=" . $fname);
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($fname2));
readfile($fname2);