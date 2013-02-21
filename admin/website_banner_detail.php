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
	$(document).ready(function(e) {
		MediaTypeChange();
        $("#media_type").change(MediaTypeChange);
    });
	function MediaTypeChange(){
		$(".tr_image").toggle($("#media_type").children("option:selected").val()=="image");
		$(".tr_vedio").toggle($("#media_type").children("option:selected").val()=="vedio");
	}
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
                <li><a href="website_banner.php" class="active">網站管理</a></li>
                <li><a href="news.php">新聞管理</a></li>
                <li><a href="product_bcatalog.php">產品管理</a></li>
                <li><a href="support.php">支援管理</a></li>
                <li><a href="contact.php">聯絡我們</a></li>                
                <li><a href="about.php">關於我們</a></li>
            </ul>
            <div class="tool-bar clearfix">            	            	            
            </div>
            <div class="info-bar">
                <ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="website_banner.php">網站管理</a></li>                    
                    <li><span>首頁廣告設定</span></li>
                </ul>
            </div>
        </div>
        
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="body">
          <tr>
            <td class="left-col">
            	<ul class="side-bar">
                    <li><a href="website_banner.php" class="active">首頁廣告設定</a></li>
                    <li><a href="website_password.php">管理者密碼</a></li>
                </ul>
            </td>
            <td class="middle-col">&nbsp;</td>
            <td class="right-col">
            	<div class="module-tool">
                    <div class="group">
                	<button class="btn btn-info" type="button">儲存</button>
                    <button class="btn" type="button">取消</button>
                    </div>
                </div> 
              <div class="module-form">
                    <ul class="mheader">
                    	<li><a href="#" class="active">新增廣告/修改廣告</a></li>                        
                    </ul>
                    <div class="main-container">
                    	<div class="mbody">
                          <table width="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <th width="100" align="right">標題</th>
                                <td><input type="text" placeholder="請輸入標題…" class="span10"></td>
                              </tr>
                              <tr>
                                <th align="right">媒體類型</th>
                                <td>
                                	<select id="media_type" class="span2">
                                      <option value="image" selected="selected">圖片</option>
                                      <option value="vedio">影片</option>
                                    </select>
                                </td>
                              </tr>
                              <tr>
                                <th align="right">連結</th>
                                <td><input type="text" placeholder="請輸入連結…" class="span6" /></td>
                              </tr>
                              <tr class="tr_image">
                                <th rowspan="2" align="right">圖片</th>
                                <td><a href="#" class="remove"><span class="text">移除</span><img src="../images/temp_banner01.png" width="300" /></a>                                	
                                </td>
                              </tr>
                              <tr class="tr_image">
                                <td><input type="file" /></td>
                              </tr>
                              <tr class="tr_vedio">
                                <th align="right">影片</th>
                                <td><input type="text" placeholder="請輸入Youtube連結…" class="span6" /></td>
                              </tr>
                              <tr>
                                <th align="right">內容</th>
                                <td><textarea rows="10" class="span6">編輯器</textarea></td>
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
