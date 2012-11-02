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
                            <li><a href="#list">Filmlist</a></li>
                            <li class="active"><a href="#">Go Pro</a></li>
                            <li><a href="#login">Log-In</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
		<div class="hero-unit">
        <?php
        include 'access.php';
         
        //Save input field Values in Variable
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $strasse = $_POST['strasse'];
        $hausnummer = $_POST['hausnummer'];
        $plz = $_POST['plz'];
        $stadt = $_POST['stadt'];
        $gdatum = $_POST['gdatum'];
        $email = $_POST['email'];
        $senden = $_POST['senden'];
       
        //Select DB
        mysql_select_db($database);
       
        if (!$connection){
            die('Could not connect: ' . mysql_error());
        }else{      
       
            if ($senden != ""){
                //is exist email OR vorname do not save
                $ifExistEmail = "SELECT email FROM Kunde WHERE email = '$email'";
                $emailQuery = mysql_query($ifExistEmail) or die (mysql_error());    
                $emailResult = mysql_fetch_array($emailQuery);                
                $ifExistVorname = "SELECT vorname FROM Anschrift WHERE vorname = '$vorname'";
                $vornameQuery = mysql_query($ifExistVorname) or die (mysql_error());
                $vornameResult = mysql_fetch_array($vornameQuery);
               
                if($emailResult['email'] == $email OR $vornameResult['vorname'] == $vorname){
                    echo '<b style="color:red">Die E-Mail Adresse oder Benutzername ist bereits vorhanden Kunde mit der email ist bereits vorhanden</b>';
                }else{
                    //Query to insert into  Anschrift
                    $insertTableAnschrift = "INSERT INTO Anschrift (strasse,hausnummer,plz,stadt,vorname,nachname) VALUES('$strasse','$hausnummer','$plz','$stadt','$vorname','$nachname')";
                    mysql_query($insertTableAnschrift) or die (mysql_error());
                    //Get last inserted ID to write in Kunde.anschriftId                
                    $anschriftId = mysql_insert_id();
                    //Query to insert into Kunde
                    $insertTableKunde = "INSERT INTO Kunde (anschriftId,geburtsdatum,email) VALUES('$anschriftId','$gdatum','$email')";
                    $successReg = mysql_query($insertTableKunde) or die (mysql_error());    
               
                if($successReg){
                    echo 'Speichern Erfolgreich';                    
                    }
                }
            }
        }
        ?>
        <form method="POST" >
        <table>
            <tr>
                <td colspan="2">Kunden Daten einpflegen
                </td>
            </tr>
            <tr>
                <td>
                    Vorname
                </td>
                <td>
                    <input type="text" name="vorname" />
                </td>
            </tr>
            <tr>
                <td>
                    Nachname
                </td>
                <td>
                    <input type="text" name="nachname" />
                </td>
            </tr>
            <tr>
                <td>
                    Stra&szlig;e
                </td>
                <td>
                    <input type="text" name="strasse" />
                </td>
            </tr>
            <tr>
                <td>
                    Hausnummer
                </td>
                <td>
                    <input type="text" name="hausnummer" />
                </td>
            </tr>
            <tr>
                <td>
                    Postleitzahl
                </td>
                <td>
                    <input type="text" name="plz" />
                </td>
            </tr>
            <tr>
                <td>
                    Stadt
                </td>
                <td>
                    <input type="text" name="stadt" />
                </td>
            </tr>
            <tr>
                <td>
                    Geburtsdatum
                </td>
                <td>
                    <input type="date" name="gdatum" />
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <input type="text" name="email" />
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="senden" value="senden" /></td>
            </tr>
        </table>
        </form>
        </div>
        <div class="row">&nbsp;</div>
    </body>
</html>
