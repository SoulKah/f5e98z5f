<html>
<head>
<title>Wijzig</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="inschrijven">
    <h1>Stap 3: Betaling</h1>
    
    
        
<?php
$connect=mysqli_connect("localhost","root","","php_dev");
if (mysqli_connect_errno()) {
    throw new Exception(mysqli_connect_error(), mysqli_connect_errno());
}

                
if($connect)
{

    $cursus = $_POST['cursus'];
    $student = $_POST['student'];
    
    foreach ($cursus as $id) {
        $query=mysqli_query($connect, "INSERT INTO inschrijvingen (cursus_id, student_id) VALUES ('$id', '$student')");
    }

    $query = mysqli_query($connect, "SELECT cursusnaam, prijs FROM inschrijvingen AS inschrijvingen JOIN studenten AS studenten ON studenten.id = inschrijvingen.student_id JOIN cursussen AS cursussen ON cursussen.id = inschrijvingen.cursus_id WHERE studenten.id = $student");
    
    echo "<table width='100%'><thead><th>Naam</th><th>Prijs</th></thead>";
        
    while ($row = mysqli_fetch_array($query))
    {
        echo "<tr><td>".$row['cursusnaam']."</td><td>".$row['prijs']." euro</td></tr>";
    }
    echo "</table>";
    $query = mysqli_query($connect, "SELECT SUM(prijs), naam FROM inschrijvingen AS inschrijvingen JOIN studenten AS studenten ON studenten.id = inschrijvingen.student_id JOIN cursussen AS cursussen ON cursussen.id = inschrijvingen.cursus_id WHERE studenten.id = $student");
    
    $totaal = mysqli_fetch_array($query);
    $prijs = $totaal['SUM(prijs)'];
    $totaalbtw = 21 * ($prijs/100);
    $btwloos = $prijs - (21 * ($prijs/100));

    
    echo "<br>Subtotaal: ". $prijs ." euro</br>";
    echo "<br>Btw: ". $totaalbtw ." euro</br>";
    echo "<br>Totaal: ". $btwloos ." euro</br>";
    echo '<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="amount" value="'.$totaal['SUM(prijs)'].'">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="custom" value="'.$row["naam"].'">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="item_name" value="Donation">
    <input type="hidden" name="item_number" value="00011113478">
    <input type="hidden" name="business" value="jorne.schaefer@telenet.be">
    <input type="hidden" name="return" value="jorne.schaefer@telenet.be">
    <input type="hidden" name="cancel_return" value="jorne.schaefer@telenet.be">
    <input type="submit" value="Betaal" class="button">
    </form>';
    mysqli_close($connect);
}
?>
</div>
</body>
</html>