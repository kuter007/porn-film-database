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
