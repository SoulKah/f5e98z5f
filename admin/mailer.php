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
    <div id="popup-wrapper">
  
        <?php
            $connect=mysqli_connect("localhost","root","","php_dev");
            if (mysqli_connect_errno()) {
                throw new Exception(mysqli_connect_error(), mysqli_connect_errno());
            }
            if($connect)
            {
                $query=mysqli_query($connect, "SELECT `email`, `naam`, `voornaam` FROM studenten ORDER BY naam;");    
            ?>
                <form action="sent.php" method="post">
                <table width='100%'>
                <thead>
                    <tr>
                        <th colspan="2" style='text-align: center;'>Verstuur een mail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ontvanger</td>
                        <td><select name='email' style="width: 100%;">
                <?php
                    while ($row = mysqli_fetch_array($query)) {
                         echo "<option value='".$row['email']."'>".$row['voornaam']." ".$row['naam']." [ ".$row['email']." ]</option>\n";
                    }
                ?>

                    </select></td></tr>
                    <tr>
                        <td>Onderwerp</td>
                        <td><input type="text" name="onderwerp" style="width: 100%;"></td>
                    </tr>
                    
                    <tr>
                        <td>Bericht</td>
                        <td><textarea name="bericht" style="width: 100%;" rows="8"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Verstuur"></td>
                    </tr>
                    </tbody>
                    </form>
            <?php
                mysqli_close($connect);
            }

            else
            {
                die("Kan geen verbinding maken met de database");   
            }
        ?>
         
    </div>
    </body>
    
</html>