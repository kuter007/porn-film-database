<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sensual Movie Doc</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.6.1.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Sensual Movie Doc</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="#home">Home</a></li>
                            <li class="active"><a href="#">Filmlist</a></li>
                            <li><a href="#contact">Go Pro</a></li>
                            <li><a href="#login">Log-In</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
		<div class="hero-unit">
        <?php
        include 'access.php';
        //Select DB
        mysql_select_db($database);
       
        if (!$connection){
            die('Could not connect: ' . mysql_error());
        }else{      
        	$sql = "SELECT * FROM Film";
			$db_erg = mysql_query($sql);
			if(!$db_erg) {
				echo 'Tabelle nicht gefunden';
			}else {
				echo '<table border="1">';
					while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
					{
					  echo "<tr>";
					  echo "<td>Fortlaufende Nr.</td>";
					  echo "<td>Filmname</td>";
					  echo "<td>Altersfreigabe</td>";
					  echo "<td>Kurzbeschreibung</td>";
					  echo "</tr>";
					  echo "<tr>";
					  echo "<td>". $zeile['id'] . "</td>";
					  echo "<td>". $zeile['name'] . "</td>";
					  echo "<td>". $zeile['fsk'] . "</td>";
					  echo "<td>". $zeile['beschreibung'] . "</td>";
					  echo "</tr>";
					}
					echo "</table>";
			}
        }
        ?>
        </div>
        <div class="row">&nbsp;</div>
    </body>
</html>