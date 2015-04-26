<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!doctype html>
<html>
	<head>
        <title>DEV</title>
        <link href="../css/admin.css" rel="stylesheet" type="text/css">
        
        <!-- Add Awesomefont -->
        <link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
        
        <!-- Add jQuery library -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

        <!-- Add fancyBox -->
        <link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

        <!-- Optionally add helpers - button, thumbnail and/or media -->
        <link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

        <link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $(".fancybox").fancybox();
            });
            
            $(document).ready(function() {
                $(".various").fancybox({

                    fitToView	: false,
                    width		: '70%',
                    height		: '70%',
                    autoSize	: false,
                    closeClick	: false,
                    openEffect	: 'fade',
                    closeEffect	: 'fade',
                    afterClose  : function() { document.location.reload(true) }
                });
            });
            
        </script>
        
	</head>
    
    <body>
    <?php if (login_check($mysqli) == true) : ?>
    <div id="wrapper">
        <div id="left">
            <div id="left-wrap">
                <h1>ACP</h1>
                <h3>Welcome, <?php echo htmlentities($_SESSION['username']); ?>!</h3>
                <nav>
                    <ul>
                        <li class="current"><a href="view.php">Overzicht <i class="fa fa-list"></i></a></li>
                        <li><a href="add.php?type=auto">Wagen toevoegen <i class="fa fa-user-plus"></i></a></li>
                        <li><a href="includes/logout.php">Uitloggen <i class="fa fa-sign-out"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div id="right">
            <div id="right-wrap">


            <?php
                include '../functions.php';
                include '../config/config.php';
                dbconnect();

                if($connect)
                {
                ?>
                <a href="#" id="toggleNav"><i class="fa fa-chevron-left arrow fa-3x"></i></a>
                    <h1>Wagens in stock</h1><br>
                    <table width='100%'>
                    <thead>
                        <tr>
                            <th>Merk</th>
                            <th>Model</th>
                            <th>Jaar</th>
                            <th>Cilinder</th>
                            <th>PK</th>
                            <th>Vermogen (Kw)</th>
                            <th>Kleur</th>
                            <th>Deuren</th>
                            <th>Versnellingen</th>
                            <th>Foto's</th>
                            <th>Wijzig</th>
                            <th>Verwijder</th>
                        </tr>
                    </thead>
                    <?php
                    toon_autos();
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
                            <th>Vermogen (Kw)</th>
                            <th>Kleur</th>
                            <th>Deuren</th>
                            <th>Versnellingen</th>
                            <th>Foto's</th>
                            <th>Wijzig</th>
                            <th>Verwijder</th>
                        </tr>
                    </thead>
                    <?php
                    toon_verkochte_autos();

                    mysqli_close($connect);
                }

                else
                {
                    die("Kan geen verbinding maken met de database");   
                }
            ?>
            </div>
        </div>   
    </div>
    <?php else :
        header("Location: ../admin");
    endif; ?>
    </body>
    
</html>
        
                <!-- Add Nav Slide -->
        <script src="../admin/js/nav.js"></script>