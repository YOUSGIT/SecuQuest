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
<script type="text/javascript">
	
</script>
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
                <li><a href="website_banner.php">網站管理</a></li>
                <li><a href="news.php">新聞管理</a></li>
                <li><a href="product_bcatalog.php" class="active">產品管理</a></li>
                <li><a href="support.php">支援管理</a></li>
                <li><a href="contact.php">聯絡我們</a></li>                
                <li><a href="about.php">關於我們</a></li>
            </ul>
            <div class="tool-bar clearfix">            	            	            
            </div>
            <div class="info-bar">
                <ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="product_bcatalog.php">產品管理</a></li>                    
                    <li><span>產品列表</span></li>
                </ul>
            </div>
        </div>
        
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
          <tr>
            <td class="left-col">
            	<ul class="side-bar">
                    <li><a href="product_bcatalog.php">大分類列表</a></li>
                    <li><a href="product_catalog.php">子分類列表</a></li>
                    <li><a href="product.php" class="active">產品列表</a></li>
                </ul>
            </td>
            <td class="middle-col">&nbsp;</td>
            <td class="right-col">
            	<div class="module-tool">
                    <div class="group">
                	<button class="btn btn-info" type="button">上傳</button>
                    <button class="btn" type="button">取消</button>
                    </div>
                </div> 
              <div class="module-form">
                    <ul class="mheader">
                    	<li><a href="product_detail.php">新增產品/修改產品</a></li>
                        <li><a href="product_detail_photo.php" class="active">產品圖片</a></li>                        
                    </ul>
                    <div class="main-container">
                    	<div class="mbody">
                          <table width="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <th width="100" align="right">上傳圖片</th>
                                <td><input type="file"></td>
                              </tr>
                              <tr>
                                <th align="right">主圖設定</th>
                                <td>
                                	<input type="radio" name="photo" />
                                	<a href="#" class="remove"><span class="text">移除</span><img src="../images/temp_new_product01.jpg" width="150" /></a>
                                    <input type="radio" name="photo" />
                                	<a href="#" class="remove"><span class="text">移除</span><img src="../images/temp_new_product01.jpg" width="150" /></a>
                                    <input type="radio" name="photo" />
                                	<a href="#" class="remove"><span class="text">移除</span><img src="../images/temp_new_product01.jpg" width="150" /></a>
                                    <input type="radio" name="photo" />
                                	<a href="#" class="remove"><span class="text">移除</span><img src="../images/temp_new_product01.jpg" width="150" /></a>
                                </td>
                              </tr>
                            </table>
						</div>
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
