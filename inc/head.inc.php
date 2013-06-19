<!DOCTYPE html>
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
        <script>
		$(document).ready(function(e) {
            //網址判斷				
				$("a:not(.lang)").each(function(index, element) {
					
					var regex = new RegExp(/\?/);
					var url = $(element).prop("href");
					if(regex.test(url)){
						regex = new RegExp(/\?LANG=/);
						if(!regex.test(url)){
							$(element).prop("href",url+"&LANG=<?php echo LANG; ?>");
						}
					}else{
						$(element).prop("href",url+"?LANG=<?php echo LANG; ?>");
					}
				});
        });
		</script>
		<?php if($_SERVER['PHP_SELF']=="/index.php"){?>        
        <script type="text/javascript" language="javascript" src="http://player.youku.com/jsapi"></script>
        <script type="text/javascript" language="javascript" src="script/index.<?php echo LANG; ?>.js"></script>        
        <?php } ?>
    </head>
    <body>
        <div class="header">
            <div class="fire f1">
                <div class="bar">
                    <ul class="guide">
                        <li><a href="index.php" title="Home">Home</a></li>
                        <li>
                            <div class="btn-group">
                                <a class="btn dropdown-toggle btn-small btn-inverse lang" data-toggle="dropdown"><?php echo $_lang['title'][LANG]; ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php?LANG=en" <?php echo(LANG == 'en') ? 'class="active"' : ''; ?>>English</a></li>
                                    <li><a href="index.php?LANG=cn" <?php echo(LANG == 'cn') ? 'class="active"' : ''; ?>>簡体中文</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="menu">        	
                    <ul class="nav">        	
                        <li class="logo"><a href="index.php" title="SecuQuest">&nbsp;</a></li>
                        <li><a href="bcatalog.php" <?php echo CAT == 1 ? 'class="active"' : ''; ?> title="Products"><?php echo $_LANG['btn']['Products'][LANG]; ?></a></li>
                        <li><a href="support.php" <?php echo CAT == 2 ? 'class="active"' : ''; ?> title="Support"><?php echo $_LANG['btn']['Support'][LANG]; ?></a></li>
                        <li><a href="contact.php" <?php echo CAT == 3 ? 'class="active"' : ''; ?> title="Contact"><?php echo $_LANG['btn']['Contact'][LANG]; ?></a></li>
                        <li><a href="about.php" <?php echo CAT == 4 ? 'class="active"' : ''; ?> title="About Us"><?php echo $_LANG['btn']['About Us'][LANG]; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>