<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SecuQuest</title>
        <link href="css/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" type="text/css" />
        <link href="css/core/core.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" language="javascript" src="script/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" language="javascript" src="script/jquery.backgroundpos.min.js"></script>
        <script type="text/javascript" language="javascript" src="script/jquery-ui-1.10.0.custom.min.js"></script>
        <script type="text/javascript" language="javascript" src="script/jquery.cycle.all.js"></script>
        <script type="text/javascript" language="javascript" src="css/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" language="javascript" src="script/global.js"></script>
        <script type="text/javascript" language="javascript" src="script/index.js"></script>
    </head>
    <body>
        <div class="header">
            <div class="fire f1">
                <div class="bar">
                    <ul class="guide">
                        <li><a href="./" title="Home">Home</a></li>
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
                        <li class="logo"><a href="./" title="SecuQuest">&nbsp;</a></li>
                        <li><a href="bcatalog.php" <?php echo CAT == 1 ? 'class="active"' : ''; ?> title="Products">Products</a></li>
                        <li><a href="support.php" <?php echo CAT == 2 ? 'class="active"' : ''; ?> title="Support">Support</a></li>
                        <li><a href="contact.php" <?php echo CAT == 3 ? 'class="active"' : ''; ?> title="Contact">Contact</a></li>
                        <li><a href="about.php" <?php echo CAT == 4 ? 'class="active"' : ''; ?> title="About Us">About Us</a></li>
                    </ul>
                </div>
            </div>
        </div>