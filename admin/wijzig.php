<?php require_once 'img-up/config.php';?>
<html>
<head>
<title>Wijzig</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">

<!-- Add Awesomefont -->
<link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
    
<body>
<div id="popup-wrapper">
<?php
    $connect=mysqli_connect("localhost","root","","autodealer");
    if (mysqli_connect_errno()) {
        throw new Exception(mysqli_connect_error(), mysqli_connect_errno());
    }

    $type = $_GET['type']; 

    if($connect && $type == "auto")
    {   
        if (!$_POST)
        {
            $wijzig_id = $_GET['id']; 
            $query = mysqli_query($connect, "SELECT * FROM autos WHERE id = $wijzig_id");
            if (!$query) {
                    die('Invalid query: ' . mysql_error());
            }
            
            // Tonen dat er opgeslagen werd :)
            if ($_GET['saved'] == 'true')
                echo "<div class='saved'><i class='fa fa-check'></i> Student succesvol opgeslagen!</div>";
            
            ?>
            <form action="wijzig.php?type=auto" method='POST'>
            <table width='100%'>
                <thead>
                    <tr>
                        <th colspan="2" style="text-align: center;">Wijzig wagen</th>
                    </tr>
                </thead>
            <?php
            
            if (mysqli_num_rows($query) == 0) {
                echo "<tr><td colspan='2'><i class='fa fa-exclamation-triangle' style='color:#cd0000'></i> Student niet gevonden!</td></tr>";
            }
            
            else {

                $row = mysqli_fetch_array($query)
                ?>
                    <tr>
                        <td>Merk</td>
                        <td><input type='text' name='merk' value='<?php echo $row['merk']?>'></td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td><input type='text' name='model' value='<?php echo $row['model']?>'></td>
                    </tr>
                    <tr>
                        <td>Jaar</td>
                        <td><input type='text' name='jaar' value='<?php echo $row['jaar']?>'></td>
                    </tr>
                    <tr>
                        <td>Cilinder</td>
                        <td><input type='text' name='cilinder' value='<?php echo $row['cilinder']?>'></td>
                    </tr>
                    <tr>
                        <td>PK</td>
                        <td><input type='text' name='pk' value='<?php echo $row['pk']?>'></td>
                    </tr>
                    <tr>
                        <td>Vermogen</td>
                        <td><input type='text' name='vermogen' value='<?php echo $row['vermogen']?>'></td>
                    <tr>
                        <td>Kleur</td>
                        <td><input type='text' name='kleur' value='<?php echo $row['kleur']?>'></td>
                   </tr>
                    <tr>
                        <input type='hidden' name='id' value='<?php echo $row['id']?>'>
                        <td colspan='2'><input type='submit' name='wijzigen' value='Opslaan'/></td>
                    </tr>
                </table>
                </form>
                    <?php
                    $query = mysqli_query($connect, "SELECT * FROM images WHERE car_id = $wijzig_id");
                    if (mysqli_num_rows($query) == 0) {
                        echo "<tr><td colspan='2'><i class='fa fa-exclamation-triangle' style='color:#cd0000'></i> Deze wagen heeft nog geen foto's</td></tr>";
                    }

                    else {
                        while ($row = mysqli_fetch_array($query)) {

                            echo "<a href='verwijderen.php?type=foto&id=".$row['id']."'><img src='img-up/images/".$row['thumbnail_image']."' width='' height='' class='car-thumb'/></a>";
                        }
                    }
                    ?>
                </div>
    
                <div class="container">
                    <div class="form-container">
                        <form enctype="multipart/form-data" name='imageform' role="form" id="imageform" method="post" action="img-up/ajax.php?id=<?php echo $wijzig_id ?>">
                            <div class="form-group">
                                <p>Foto's uploaden </p>
                                <input class='file' multiple="multiple" type="file" class="form-control" name="images[]" id="images" placeholder="Please choose your image">
                                <span class="help-block"></span>
                            </div>
                            <div id="loader" style="display: none;">
                                Laden...
                            </div>
                            <input type="submit" value="Upload" name="image_upload" id="image_upload" class="btn"/>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                    <div id="uploaded_images" class="uploaded-images">
                        <div id="error_div">
                        </div>
                        <div id="success_div">
                        </div>
                    </div>
                </div>
                <input type="hidden" id='base_path' value="<?php echo BASE_PATH; ?>">
                <script src="img-up/js/jquery.min.js"></script>
                <script type="text/javascript" src="img-up/js/jquery.form.min.js"></script>
                <script src="img-up/js/script.js"></script>
                <?php
            
            }
        }
        
        else 
        { 
            $merk = $_POST['merk'];
            $model = $_POST['model'];
            $jaar = $_POST['jaar'];
            $cilinder = $_POST['cilinder'];
            $pk = $_POST['pk'];
            $vermogen = $_POST['vermogen'];
            $kleur = $_POST['kleur'];
            $id = $_POST['id'];

            $query = mysqli_query($connect, "UPDATE autos SET merk = '$merk', model = '$model', jaar = '$jaar', cilinder = '$cilinder', pk = '$pk', vermogen = '$vermogen', kleur = '$kleur' WHERE id='$id'");
            
            if (!$query) {
                die('Invalid query: ' . mysql_error());
            }
            
            // Pagina herladen na wijziging
            header("Refresh:0; url=wijzig.php?id=$id&type=auto&saved=true");
        }
    }

    
    // OK, THANKS, BYE! :]
    mysqli_close($connect);

    if (!$connect)
    {
        die ("Kan geen verbinding maken met de database");   
    }

?>
</div>


<!-- "Saved" div laten faden na 2 sec ;] -->
<script>
$(document).ready(function(){
    setTimeout(function(){
        $('.saved').fadeOut(1000,function(){
        });
    },2000);
});
</script>

                
</body>
</html>