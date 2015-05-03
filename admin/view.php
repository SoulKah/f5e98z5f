<?php
include_once 'includes/_connect.php';
include_once 'includes/_functions.php';
 
session_start();

if (login_check($mysqli) == true) :
?>

<!doctype html>
<html>
	<head>
        <title>Admin Control Panel</title>
        <?php include_once "includes/_scripts.php"; ?>
        <script language="JavaScript" type="text/javascript">
            $(document).ready(function(){
                $("a.delete").click(function(e){
                    if(!confirm('Weet je zeker dat je deze wagen wil verwijderen?')){
                        e.preventDefault();
                        return false;
                    }
                    return true;
                });
            });
        </script>
	</head>
    
    <body>
    <div id="wrapper">
        <div id="left">
            <div id="left-wrap">
                <h1>ACP</h1>
                <h3>Welkom, <?php echo htmlentities($_SESSION['username']); ?>!</h3>
                <nav>
                    <ul>
                        <li class="current"><a href="view.php">Overzicht <i class="fa fa-list"></i></a></li>
                        <li><a href="add.php?type=auto">Wagen toevoegen <i class="fa fa-car"></i></a></li>
                        <li><a href="includes/logout.php">Uitloggen <i class="fa fa-sign-out"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div id="right">
            <div id="right-wrap">


            <?php

                if($mysqli)
                {
                ?>
                <a href="#" id="toggleNav"><i class="fa fa-chevron-right arrow fa-3x"></i><span class='toggle'>Toon navigatie</span></a>
                    <h1>Wagens in stock</h1><br>
                    <table width='100%'>
                    <thead>
                        <tr>
                            <th>Merk</th>
                            <th>Model</th>
                            <th>Jaar</th>
                            <th>Cilinder</th>
                            <th>PK</th>
                            <th>Vermogen (kW)</th>
                            <th>Kleur</th>
                            <th>Deuren</th>
                            <th>Versnellingen</th>
                            <th>Foto's</th>
                            <th>Wijzig</th>
                            <th>Verwijder</th>
                        </tr>
                    </thead>
                    <?php
                    toon_autos($mysqli);
                    ?>
                        
                    <h1>Verkochte wagens</h1><br>
                    <table width='100%'>
                    <thead>
                        <tr>
                            <th>Merk</th>
                            <th>Model</th>
                            <th>Jaar</th>
                            <th>Cilinder</th>
                            <th>PK</th>
                            <th>Vermogen (kW)</th>
                            <th>Kleur</th>
                            <th>Deuren</th>
                            <th>Versnellingen</th>
                            <th>Foto's</th>
                            <th>Wijzig</th>
                            <th>Verwijder</th>
                        </tr>
                    </thead>
                    <?php
                    toon_verkochte_autos($mysqli);
                }

                else
                {
                    die("Kan geen verbinding maken met de database");   
                }
            ?>
            </div>
        </div>   
    </div>
            
    <!-- Add Nav Slide -->
    <script type="text/javascript" src="../admin/js/nav.js"></script>
            
    </body>
    
</html>
        
<?php else :
    header("Location: ../admin");
    die();
endif; ?>