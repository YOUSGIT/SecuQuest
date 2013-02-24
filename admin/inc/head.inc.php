<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        
        <title>SecuQuest 網站管理系統</title>
        <link href="theme/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="theme/core/admin.css" rel="stylesheet" type="text/css" />
        <link href="theme/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="script/jquery1.9.min.js"></script>
        <script type="text/javascript" src="script/jquery-ui-1.10.0.custom.min.js"></script>
        <script type="text/javascript" src="theme/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="script/admin.js"></script>
    </head>

    <body>
        <div class="global-container">
            <div class="header">
                <div class="guide clearfix">
                    <div class="logo"><img src="images/logo.png" height="25" /></div>
                    <ul class="guide-nav">
                        <li>登入中</li>
                        <li><a href="../index.php" target="_blank">首頁</a></li>
                    </ul>
                </div>
                <ul class="nav">
                    <li><a href="website_banner.php" <?= CAT == 1 ? 'class="active"' : ''; ?>>網站管理</a></li>
                    <li><a href="news.php" <?= CAT == 2 ? 'class="active"' : ''; ?>>新聞管理</a></li>
                    <li><a href="product_bcatalog.php" <?= CAT == 3 ? 'class="active"' : ''; ?>>產品管理</a></li>
                    <li><a href="support.php" <?= CAT == 4 ? 'class="active"' : ''; ?>>支援管理</a></li>
                    <li><a href="contact.php" <?= CAT == 5 ? 'class="active"' : ''; ?>>聯絡我們</a></li>                
                    <li><a href="about.php" <?= CAT == 6 ? 'class="active"' : ''; ?>>關於我們</a></li>
                </ul>
                <div class="tool-bar clearfix">            	
                    <?= $toolbar; ?>             
                </div>
                <div class="info-bar">
                    <?= $crumb; ?>
                </div>
            </div>