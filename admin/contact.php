<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                <li><a href="website_banner.php" >網站管理</a></li>
                <li><a href="news.php">新聞管理</a></li>
                <li><a href="product_bcatalog.php">產品管理</a></li>
                <li><a href="support.php">支援管理</a></li>
                <li><a href="contact.php" class="active">聯絡我們</a></li>                
                <li><a href="about.php">關於我們</a></li>
            </ul>
            <div class="tool-bar clearfix">            	            	
                <ul class="group">
                    <li><a href="#" class="file-delete">批次刪除</a></li>
                </ul>                
            </div>
            <div class="info-bar">
                <ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="product_bcatalog.php">聯絡我們</a></li>                    
                    <li><span>客服列表</span></li>
                </ul>
            </div>
        </div>
        
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
          <tr>
            <td class="left-col">
            	<ul class="side-bar">
                    <li><a href="contact.php" class="active">客服列表</a></li>
                    <li><a href="contact_info.php">聯絡資訊</a></li>
                </ul>
            </td>
            <td class="middle-col">&nbsp;</td>
            <td class="right-col">            
              <div class="module-list">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mheader">
                      <tr>
                        <td width="30"><input type="checkbox" class="check-all" /></td>
                        <td width="200">姓名</td>
                        <td width="250">郵件</td>
                        <td>主旨</td>
                        <td width="100">日期</td>
                        <td width="50">編輯</td>
                      </tr>
                    </table>
                    <div class="main-container">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mbody">
                          <tr>
                            <td width="30" align="center"><input type="checkbox" class="check-item"  /></td>
                            <td width="200">xmimicx</td>
                            <td width="250"><a href="mailto:xmimicx@gmail.com">xmimicx@gmail.com</a></td>
                            <td>How to connect a microphone to DVR</td>
                            <td width="100" align="center" class="date">2012/12/12</td>
                            <td width="50"><button class="btn btn-info btn-small" type="button" onclick="window.location='contact_detail.php'">編輯</button></td>
                          </tr>
                          <tr>
                            <td align="center"><input type="checkbox" class="check-item"  /></td>
                            <td>alan</td>
                            <td><a href="mailto:xmimicx@gmail.com">alan@gmail.com</a></td>
                            <td>How to remote review 7900/2300/2400/2500 series DVR with a Mac.</td>
                            <td align="center" class="date">2012/12/12</td>
                            <td><button class="btn btn-info btn-small" type="button" onclick="window.location='contact_detail.php'">編輯</button></td>
                          </tr>
                        </table>
               	  </div>
                </div>
                

            </td>
          </tr>
        </table>
        <div class="footer">
        	Power By YOUS
        </div>
    </div>
</body>
</html>
