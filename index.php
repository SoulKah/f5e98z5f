<!doctype html>
<html>
	<head>
        <title>Formulier</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" ></script>
        
        <!-- Add Awesomefont -->
        <link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
	</head>

	<body>
    <div class="inschrijven">
        
    <?php
    include 'functions.php';
    include 'config/config.php';

    if (!$_POST)
    {
    ?>
        <h1>Stap 1: Vul jou persoonlijke gevens in.</h1>
        <form action="index.php" method="post"><br>
    		<label>Naam:</label> <input type="text" name="naam" required><br>
    		<label>Voornaam:</label> <input type="text" name="voornaam" required><br>
    		<label>Adres:</label> <input type="text" name="adres" required><br>
    		<label>Postnummer:</label> <input type="text" name="postnummer" value="9000" min="1" max="9999" required><br>
            <label>Woonplaats:</label> <input type="text" name="woonplaats" required><br>
    		<label>Telefoon:</label> <input type="tel" name="telefoon" value="09" required><br>
            <label>Email:</label> <input type="email" name="email" required><br>
            <br>
		    <input type="submit" name="verzenden" value="Volgende Stap >" class="button"/>
		</form>
    <?php
    }
    else
    { 
        dbconnect();
        registreren();
        mysqli_close($connect);
    }

 ?>
    </div>   
	</body>
    
<!-- "Error" div laten faden na 2.5 sec ;] -->
<script>
$(document).ready(function(){
    $('.email').animate({marginTop: '50px'});
    setTimeout(function(){
        $('.error').fadeOut(1000);
    },2000);
    
    setTimeout(function(){
        $('.email').animate({marginTop: '0'}, 1000);
    },2500);
});
</script>
    
</html>