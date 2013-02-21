<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SecuQuest</title>
<link href="css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" type="text/css" />
<link href="css/core/core.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" language="javascript" src="script/jquery1.9.min.js"></script>
<script type="text/javascript" language="javascript" src="script/jquery.backgroundpos.min.js"></script>
<script type="text/javascript" language="javascript" src="script/jquery-ui-1.10.0.custom.min.js"></script>
<script type="text/javascript" language="javascript" src="script/jquery.cycle.all.js"></script>
<script type="text/javascript" language="javascript" src="css/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="script/global.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {

		setPage();
		$(".product-switch a").click(setPage);

		$('.banner .gallery').cycle({
			fx:'fade',
			pager:'.pager',
			timeout:0,
			autostop:1,
			pagerAnchorBuilder: function(index, element) {				
							return $(".pager A:eq("+(index)+")");
			}
		});
	});
	
	function setPage(){
		$(".product-detail").hide();		
		if(window.location.hash=="") window.location.hash = "#features";
		var t;
		try{
			t="#"+$(this).prop("href").split('#')[1];
		}catch(e){ t=window.location.hash;}
		$(t).fadeIn();
		
		
		
		$(".product-switch a").removeClass("active");
		
		$(".product-switch a").each(function(index, element) {
            if("#"+$(this).prop("href").split('#')[1]==t)
				$(this).addClass("active");
        });		
		
		return false;

	}
	
</script>

</head>

<body>
	<div class="header">
    	<div class="fire f1">
            <div class="bar">
                <ul class="guide">
                    <li><a href="index.php" title="Home">Home</a></li>
                    <li>
                    	<div class="btn-group">
                          <a class="btn dropdown-toggle btn-small btn-inverse" data-toggle="dropdown" href="#">English -Change <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="#">English</a></li>
                            <li><a href="#">繁體中文</a></li>
                            <li><a href="#">簡体中文</a></li>
                          </ul>
                        </div>
                    	
                    </li>
                </ul>
            </div>
            <div class="menu">        	
                <ul class="nav">        	
                    <li class="logo"><a href="index.php" title="SecuQuest">&nbsp;</a></li>
                    <li><a href="products.php" title="Products" class="active">Products</a></li>
                    <li><a href="support.php" title="Support">Support</a></li>
                    <li><a href="contact.php" title="Contact">Contact</a></li>
                    <li><a href="about.php" title="About Us">About Us</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="body">
    	<div class="banner product">
        	<div class="container">            	
                <div class="gallery">
                    <div class="media" data-type="image" style="background-image:url(images/temp_product_l01.jpg);"></div>
                    <div class="media" data-type="image" style="background-image:url(images/temp_product_l02.jpg);"></div>
                </div>
                <ul class="crumb">
                	<li><a href="index.php">Home</a>/</li>
                    <li>Products</li>
                </ul>
                <div class="title">
                    <div class="intro">
                        <h1>CMT2141 / CMT2141B</h1>
                        <div class="content">700TV Lines,SONY 1/3" EX-view HAD CCD Ⅱ,SONY Effio-S DSP,0.03Lux/F1.2，
0.00006Lux slow shutter, 2.8 ~ 12mm varifocal lens,built in multi-language OSD,indoor & 
outdoor application,white color aluminum housing, DC 12V input</div>               
                    </div>                           
                </div>
                <div class="pager">                	
                    <div>
                    	<a href="#" class="stick"><img src="images/temp_product_l01.jpg" width="50"/></a>
                    </div>
                     <div>
                    	<a href="#" class="stick"><img src="images/temp_product_l02.jpg" width="50"/></a>
                    </div>                     
                </div>
			</div>
        </div>
        
        <div class="main">
        	<div class="container clearfix">
            	<div class="left-col">
                	<ul class="side-nav">
                    	<li><a href="products.php">New Items</a></li>
                    	<li class="active">
                        	<a href="products.php">Camerra</a>
                            <ul>
                            	<li><a href="products.php">HD-SDI Camera</a></li>
                                <li class="active"><a href="products.php">Turret Camera</a></li>
                                <li><a href="products.php">Bullet Camera</a></li>
                                <li><a href="products.php">Dome Camera</a></li>
                                <li><a href="products.php">WDR and Starlight Camera</a></li>
                                <li><a href="products.php">PTZ Speed Dome</a></li>
                                <li><a href="products.php">HD-SDI Camera</a></li>
                                <li><a href="products.php">Turret Camera</a></li>
                                <li><a href="products.php">Bullet Camera</a></li>
                                <li><a href="products.php">Dome Camera</a></li>
                                <li><a href="products.php">WDR and Starlight Camera</a></li>
                                <li><a href="products.php">PTZ Speed Dome</a></li>
                            </ul>
                        </li>
                        <li>
                        	<a href="products.php">DVR System</a>
                            <ul>
                            	<li><a href="products.php">HD-SDI Camera</a></li>
                                <li><a href="products.php">Turret Camera</a></li>
                                <li><a href="products.php">Bullet Camera</a></li>
                                <li><a href="products.php">Dome Camera</a></li>
                                <li><a href="products.php">WDR and Starlight Camera</a></li>
                                <li><a href="products.php">PTZ Speed Dome</a></li>
                                <li><a href="products.php">HD-SDI Camera</a></li>
                                <li><a href="products.php">Turret Camera</a></li>
                                <li><a href="products.php">Bullet Camera</a></li>
                                <li><a href="products.php">Dome Camera</a></li>
                                <li><a href="products.php">WDR and Starlight Camera</a></li>
                                <li><a href="products.php">PTZ Speed Dome</a></li>
                            </ul>
						</li>
                        <li><a href="products.php">IP Solution</a></li>
                        <li><a href="products.php">Access Control</a></li>
                        <li><a href="products.php">Alarm Product</a></li>
                    </ul>
                    <ul class="side-news">
                    	<li>
                        	<a href="#" class="clearfix">
                            	<img src="images/temp_index_news01.jpg" width="60" />
                                <h1>The ISC East 2012 At NewYork</h1>
                            </a>
                        </li>
                        <li>
                        	<a href="#" class="clearfix">
                            	<img src="images/temp_index_news01.jpg" width="60" />
                                <h1>The ISC East 2012 At NewYork</h1>
                            </a>
                        </li>
                        <li>
                        	<a href="#" class="clearfix">
                            	<img src="images/temp_index_news01.jpg" width="60" />
                                <h1>The ISC East 2012 At NewYork</h1>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="right-col">
                	<ul class="product-switch">
                    	<li><a href="#features" class="active">Features</a></li>
                        <li><a href="#specifications">Specifications</a></li>
                        <li><a href="#downloads">Downloads</a></li>
                    </ul>
                    <div id="features" class="product-detail">
                      <ul>
                        <li>  
                          high speed dome camera</li>
                        <li> 650 TVL</li>
                        <li> 1/3&quot; SONY Exview HAD CCD</li>
                        <li> 10X optical zoom</li>
                        <li> f=3.7~37mm</li>
                        <li> Automatic 2 stages IR illumination control </li>
                        <li> OSD function</li>
                        <li> Day &amp; night function (ICR)</li>
                        <li> 256 preset positions</li>
                        <li> 4 pattern scan</li>
                        <li> 8 cruise scan</li>
                        <li> 1 pan scan</li>
                        <li> RS-485 communication; support Pelco-D and Pelco-P protocol</li>
                        <li> DC 12V input </li>
                      </ul>
                    </div>
                  <div id="specifications" class="product-detail">
                    <table border="0" cellspacing="1" cellpadding="5">
                      <tbody>
                        <tr>
                          <td bgcolor="#009933">Model No.</td>
                          <td bgcolor="#009933" colspan="2">LTD2816ND-M</td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4" rowspan="2">System</td>
                          <td bgcolor="#bee8b4">Compression Format</td>
                          <td align="center" bgcolor="#bee8b4">H.264</td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4">OS</td>
                          <td align="center" bgcolor="#bee8b4">Embedded Linux</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0" rowspan="2">Video</td>
                          <td bgcolor="#d6efd0">Input</td>
                          <td align="center" bgcolor="#d6efd0">-</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">Standard Output</td>
                          <td align="center" bgcolor="#d6efd0">-</td>
                        </tr>
                        <tr>
                          <td rowspan="3" bgcolor="#bee8b4">Audio</td>
                          <td bgcolor="#bee8b4">Input</td>
                          <td align="center" bgcolor="#bee8b4">-<br /></td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4">Output</td>
                          <td align="center" bgcolor="#bee8b4">1CH</td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4">Bidirectional Talk</td>
                          <td align="center" bgcolor="#bee8b4">YES</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0" rowspan="5">Recording</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">1080P</td>
                          <td align="center" bgcolor="#d6efd0">120fps</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">720P</td>
                          <td align="center" bgcolor="#d6efd0">240fps</td>
                        </tr>
                        <tr></tr>
                        <tr>
                          <td bgcolor="#d6efd0">Recording Mode</td>
                          <td align="center" bgcolor="#d6efd0">Manual, Sensor, Timer, Motion Detection</td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4" rowspan="2">Playback</td>
                          <td bgcolor="#bee8b4">Max Playback Channel</td>
                          <td align="center" bgcolor="#bee8b4">16CH</td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4">Search Mode</td>
                          <td align="center" bgcolor="#bee8b4">Time, Event, File Management, Image(snapshot)</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0" rowspan="3">Backup</td>
                          <td bgcolor="#d6efd0">USB Disk</td>
                          <td align="center" bgcolor="#d6efd0">1 USB 2.0 port</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">DVD Burner</td>
                          <td align="center" bgcolor="#d6efd0">-</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">Backup Format</td>
                          <td align="center" bgcolor="#d6efd0">DAT or AVI</td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4" rowspan="6">Remote Application</td>
                          <td bgcolor="#bee8b4">Dual Stream</td>
                          <td align="center" bgcolor="#bee8b4">Master stream:1~30fps@4CIF/CIF <br />
                            Network stream: 1~3fps@CIF</td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4">Browser</td>
                          <td align="center" bgcolor="#bee8b4"><p>IE (windows XP//vista/7/8),Safari(Mac OS)</p></td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4">Master Stream in Network</td>
                          <td align="center" bgcolor="#bee8b4">YES</td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4">CMS</td>
                          <td align="center" bgcolor="#bee8b4">YES</td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4">Mobile Phone</td>
                          <td align="center" bgcolor="#bee8b4"><p>BroView for iPhone/Android BroCMS for iPad</p></td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4">User Access</td>
                          <td align="center" bgcolor="#bee8b4">10 users online with professional authority management</td>
                        </tr>
                        <tr>
                          <td rowspan="2" bgcolor="#d6efd0">Alarm</td>
                          <td bgcolor="#d6efd0">Alarm Input</td>
                          <td align="center" bgcolor="#d6efd0">16CH<br /></td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">Alarm Output</td>
                          <td align="center" bgcolor="#d6efd0">4CH</td>
                        </tr>
                        <tr>
                          <td rowspan="3" bgcolor="#bee8b4">Storage</td>
                          <td bgcolor="#bee8b4">HDD</td>
                          <td align="center" bgcolor="#bee8b4">2 SATA</td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4">e-SATA</td>
                          <td align="center" bgcolor="#bee8b4">1<br /></td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4">Max HDD after Deploying DVD</td>
                          <td align="center" bgcolor="#bee8b4">1 SATA + 1 DVD-RW</td>
                        </tr>
                        <tr>
                          <td rowspan="3" bgcolor="#d6efd0">PTZ</td>
                          <td bgcolor="#d6efd0" height="24">PTZ</td>
                          <td align="center" bgcolor="#d6efd0">1*RS485</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">PTZ Protocol</td>
                          <td align="center" bgcolor="#d6efd0">PELCOP,PELCOD,LILIN,MINKING,NEON,STAR,VIDO,DSCP,VISCA,<br />
                            SAMSUNG, RM110,HY</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">PTZ Control</td>
                          <td align="center" bgcolor="#d6efd0">Pan, Tilt, Zoom, Preset, Cruise, Trace</td>
                        </tr>
                        <tr>
                          <td height="40" rowspan="2" bgcolor="#bee8b4">Network</td>
                          <td bgcolor="#bee8b4">Ethernet</td>
                          <td align="center" bgcolor="#bee8b4">10 / 100 Mbps Ethernet (RJ-45)</td>
                        </tr>
                        <tr>
                          <td bgcolor="#bee8b4">Protocol</td>
                          <td align="center" bgcolor="#bee8b4">TCP/IP, DHCP, DDNS, NTP, SMTP</td>
                        </tr>
                        <tr>
                          <td rowspan="7" bgcolor="#d6efd0">Other</td>
                          <td bgcolor="#d6efd0">IR Controller</td>
                          <td align="center" bgcolor="#d6efd0">1</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">External IR Receiver Interface</td>
                          <td align="center" bgcolor="#d6efd0">Yes</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">Power Supply</td>
                          <td align="center" bgcolor="#d6efd0">AC100V/220V</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">Operating Temperature</td>
                          <td align="center" bgcolor="#d6efd0">0°C ~50°C</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">Humidity</td>
                          <td align="center" bgcolor="#d6efd0">10% ~ 90% Humidity</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">Product Weight</td>
                          <td align="center" bgcolor="#d6efd0">-</td>
                        </tr>
                        <tr>
                          <td bgcolor="#d6efd0">Product Dimension</td>
                          <td align="center" bgcolor="#d6efd0">17.5&quot;(L)×16.75&quot;(W)×3.5&quot;(H)</td>
                        </tr>
                      </tbody>
                    </table>                    	
                    </div>
                  <div id="downloads" class="product-detail">
                  	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-normal">
                      <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Size</th>
                        <th>Download</th>
                      </tr>
                      <tr>
                        <td>IP Search Tools</td>
                        <td>Software</td>
                        <td align="center">2013/1/1</td>
                        <td align="center">2.8Mb</td>
                        <td align="center"><a href="#" class="btn btn-warning"><i class="icon-download-alt icon-white"></i> Download</a></td>
                      </tr>
                      <tr>
                        <td>cmip2642</td>
                        <td>Datasheet</td>
                        <td align="center">2013/1/1</td>
                        <td align="center">680Kb</td>
                        <td align="center"><a href="#" class="btn btn-warning"><i class="icon-download-alt icon-white"></i> Download</a></td>
                      </tr>
                    </table>
                  </div>
              </div>
            </div>            	            
        </div>
        
    </div>
    <div class="footer">
    	<div class="container">
    		<div class="copyright">Copyright &copy; 2013 SecuQuest Technology Inc. All Rights Reserved.</div>
        </div>
    </div>
</body>
</html>
