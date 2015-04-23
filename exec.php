<!doctype html>
<html>
	<head>
        <title>Formulier</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
	</head>
    
    <body>
        <div id="wrapper" class="basic-grey">
            
        <?php
        $naam = $_POST['naam'];
        $voornaam = $_POST['voornaam'];
        $straat = $_POST['straat'];
        $postcode = $_POST['postcode'];
        $telefoon = $_POST['telefoon'];
        $email = $_POST['email'];
        $arrangement = $_POST['arrangement'];

        $extra= $_POST['extra'];

        if (empty($extra))
        $extra = "Geen suplementen";

        if(!empty($naam) && !empty($voornaam) && !empty($straat) && !empty($postcode) && !empty($email) && !empty($arrangement))
        {

            /* GEGEVENS TONEN */
            echo "<h1>Beste ". $voornaam. ",</h1><br>";
            echo "Wij danken u voor het invullen van ons contact formulier. Hieronder vind je een overzicht van wat je hebt ingevoerd.<br>Naam: " . $naam ."<br>Voornaam: " . $voornaam."<br>Straat: " . $straat."<br>Postcode: " . $postcode."<br>Telefoon: " . $telefoon."<br>Email: " . $email."<br>";

            /* MAIL STUREN */

            $to = "blacksoulkah@gmail.com";
            $message = "Overzicht: \nNaam: " . $naam ."\nVoornaam: " . $voornaam."\nStraat: " . $straat."\nPostcode: " . $postcode."\nWoonplaats: " .$woonplaats."\nTelefoon: " . $telefoon."\nEmail: " . $email;

            $headers = "From:" . $email . "\r\n";
            $headers .= "Reply-To: jornetb61@2schaeferson.be \r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            if (!mail ($to, "Formulier", $message, $headers))
            {
                echo "De mail kon niet verzonden worden";
            }

            
            /* LOG MAKEN */

            $data = $naam . ";" . $voornaam . ";" . $straat . ";" . $postcode . ";" . $telefoon . ";" . $email . ";" $extra;
            if ($file = fopen("formulier.log", "a"))
            {
                fputs($file, $data ."\n");
                fclose($file);
            }

            else echo "Het log bestand kon niet worden geopent";

        }

        else
        {
            echo "Niet alle verplichte velden werden ingevult";
        }
        ?>
        </div>
    </body>
</html>