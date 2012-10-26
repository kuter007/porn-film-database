<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $server = "space-sponsor.de";
        $username = "aytac";
        $password = "admin";
        $database = "filmverleih";
        $connection = mysql_connect($server, $username, $password);
        //input fields 
        //$id = md5(uniqid(rand (10,10000), true));
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $strasse = $_POST['strasse'];
        $hausnummer = $_POST['hausnummer'];
        $plz = $_POST['plz'];
        $stadt = $_POST['stadt'];
        $gdatum = $_POST['gatum'];
        $email = $_POST['email'];
        $senden = $_POST['senden'];
        //Db Select
        mysql_select_db($database);
        //Query to insert into Table
        
        $insertTableAnschrift = "INSERT INTO Anschrift (strasse,hausnummer,plz,stadt,vorname,nachname) VALUES('$strasse','$hausnummer','$plz','$stadt','$vorname','$nachname')";
        //is exist email do not save
        $ifExistEmail = "SELECT  email FROM Kunde WHERE email = '$email'";
        $count = mysql_query($ifExistEmail) or die (mysql_error());
        $result = mysql_fetch_array($count);
        if (!$connection){
            die('Could not connect: ' . mysql_error());
        }        
            if ($senden != ""){
                if($result['email'] == $email){
                    echo '<b style="color:red">Die E-Mail Adresse ist bereits vorhanden Kunde mit der email ist bereits vorhanden</b>';
                }else{
                
                $anschriftId = mysql_fetch_array(mysql_query($insertTableAnschrift) or die (mysql_error()));
                $insertTableKunde = "INSERT INTO Kunde (anschriftId,geburtsdatum,email) VALUES('$anschriftId','$gdatum','$email')";
                mysql_query($insertTableKunde) or die (mysql_error());    
                
                
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
                    strasse
                </td>
                <td>
                    <input type="text" name="strasse" />
                </td>
            </tr>
            <tr>
                <td>
                    hausnummer
                </td>
                <td>
                    <input type="text" name="hausnummer" />
                </td>
            </tr>
            <tr>
                <td>
                    postleitzahl
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
                    email
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
    </body>
</html>
