<html>
<head>
<title>Toevoegen</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="popup-wrapper">
    
<?php

include '../functions.php';
include '../config/config.php';

$type = $_GET['type'];

    if (!$_POST && $type == "auto")
    { 
    ?>
        <form action="toevoegen.php?type=auto" method="post">
        <table width='100%'>
        <thead>
            <th colspan='2'>Wagen toevoegen</th>
        </thead>
        <tr>
            <td>Merk</td>
            <td><input type="text" name="merk"/></td>
        </tr>
        <tr>
            <td>Model</td>
            <td><input type="text" name="model"/></td>
        </tr>
        <tr>
            <td>Jaar</td>
            <td><input type="text" name="jaar"/></td>
        </tr>
        <tr>
            <td>Cilinder</td>
            <td><input type="text" name="cilinder"/></td>
        </tr>
        <tr>
            <td>PK</td>
            <td><input type="text" name="pk"/></td>
        </tr>
        <tr>
            <td>Vermogen</td>
            <td><input type="text" name="vermogen"/></td>
        </tr>
        <tr>
            <td>Kleur</td>
            <td><input type="text" name="kleur"/></td>
        </tr>
        <tr>
            <td>Aantal Deuren</td>
            <td><input type="text" name="deuren"/></td>
        </tr>
        <tr>
            <td>Versnellingen</td>
            <td><input type="text" name="versnellingen"/></td>
        </tr>
        <tr>
            <td colspan='2'><input type="submit" name="toevoegen" value="Wagen toevoegen"/></td>
        </tr>
        </table>
        </form>
        
        <?php
        }

        else if ($_POST && $type == "auto")
        { 
            dbconnect();
            auto_toevoegen();
            mysqli_close($connect);
        }

    ?>
</div>
</body>
</html>