<!doctype html>
<html>
	<head>
        <title>DEV</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        
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
                    maxWidth	: 800,
                    maxHeight	: 600,
                    fitToView	: true,
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
    <div id="wrapper">
  
        <?php
        if (!$_POST) {
        ?>
                <form action="search.php" method="post">
                <table width='100%'>
                <thead>
                    <tr>
                        <th colspan='2' style='text-align: center;'>Zoeken</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <input type="text" name="naam" style="width: 50%;">
                            <input type="submit" value="Zoeken">
                        </td>
                    </tr>
                    
                    </tbody>
                    </form>
        <?php
            }
            else
            {
                $connect = mysqli_connect("localhost","root","","php_dev");
                if (mysqli_connect_errno()) {
                    throw new Exception(mysqli_connect_error(), mysqli_connect_errno());
                }

                if($connect)
                {
                    $naam = $_POST['naam'];
                    $query = mysqli_query($connect, "SELECT * FROM studenten WHERE naam LIKE '%$naam%'; ");  
                    ?>
                    
                <table width='100%'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Naam</th>
                        <th>Voornaam</th>
                        <th>Adres</th>
                        <th>Postnummer</th>
                        <th>Woonplaats</th>
                        <th>Telefoon</th>
                        <th>Email</th>
                        <th>Wijzig</th>
                        <th>Verwijder</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    
                    if (mysqli_num_rows($query) == 0) {
                        ?>
                        <tr>
                            <td colspan='10' style='text-align: center;'>
                                <i class='fa fa-exclamation-triangle' style='color:#cd0000'></i> Geen zoekresultaten gevonden voor naam: <b><?php echo $naam; ?></b><br>
                                <br>
                                Probeer opnieuw: <br>
                                <form action="search.php" method="post">
                                    <input type="text" name="naam" style="width: 50%;">
                                    <input type="submit" value="Zoeken">
                                </form> 
                            </td>
                        </tr>
            

                    <?php
                    }
                    else {
                        while ($row = mysqli_fetch_array($query)) {
                             echo "<tr> <td width='1%'>".$row['id']."</td>
                             <td width='16%'>".$row['naam']."</td>
                             <td width='16%'>".$row['voornaam']. "</td>
                             <td width='16%'>".$row['adres']. "</td>
                             <td width='1%'>".$row['postnummer']. "</td>
                             <td width='16%'>".$row['woonplaats']. "</td>
                             <td width='16%'>".$row['telefoon']. "</td>
                             <td width='16%'>".$row['email']. "</td>
                             <td width='1%'><a href='wijzig.php?id=".$row['id']."&type=student'  class='various fancybox.iframe'><i class='fa fa-pencil-square-o fa-2x'></a></td>
                             <td width='1%'><a href='verwijderen.php?id=".$row['id']."&type=student' id='delete' class='various fancybox.iframe'><i class='fa fa-trash fa-2x'></i></a></td>";
                             echo "</tr>";
                        }
                    }
                ?>
                </tbody>
                </table>
                    
                <?php
                    mysqli_close($connect);
                }

                else
                {
                    die("Kan geen verbinding maken met de database");   
                }
            }
        ?>
         
    </div>
    </body>
    
</html>