<?php
include_once 'includes/_connect.php';
include_once 'includes/_functions.php';
 
session_start();
if (login_check($mysqli) == true) :
?>
<html>
<head>
<title>Wijzig</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css">

<!-- Add Awesomefont -->
<link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
    
<!-- Load CKEditor -->
<script src="ckeditor/ckeditor.js"></script>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
<script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
        $("a.delete").click(function(e){
            if(!confirm('Weet je zeker dat je deze foto wil verwijderen?')){
                e.preventDefault();
                return false;
            }
            return true;
        });
    });
</script>
</head>
    
<body>

<div id="popup-wrapper">
<?php

    $type = $_GET['type']; 

    if($mysqli && $type == "auto")
    {   
        if (!$_POST)
        {
            $wijzig_id = $_GET['id']; 
            $query = mysqli_query($mysqli, "SELECT * FROM autos WHERE token = '$wijzig_id'");
            if (!$query) {
                    die('Invalid query: ' . mysql_error());
            }
            
            // Tonen dat er opgeslagen werd :)
            if ($_GET['saved'] == 'true')
                echo "<div class='saved'><i class='fa fa-check'></i> Deze wagen werd succesvol opgeslagen!</div>";
            
            else if ($_GET['saved'] == '2')
                echo "<div class='saved'><i class='fa fa-check'></i> De foto werd verwijderd!</div>";
            
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
                    </tr>
                    <tr>
                        <td>Kleur</td>
                        <td><input type='text' name='kleur' value='<?php echo $row['kleur']?>'></td>
                   </tr>
                
                    <tr>
                        <td>Deuren</td>
                        <td><input type='text' name='deuren' value='<?php echo $row['deuren']?>'></td>
                   </tr>
                
                    <tr>
                        <td>Versnellingen</td>
                        <td><input type='text' name='versnellingen' value='<?php echo $row['versnellingen']?>'></td>
                   </tr>
                
                    <tr>
                        <td>Brandstof</td>
                        <td><input type='text' name='brandstof' value='<?php echo $row['brandstof']?>'></td>
                   </tr>
                
                    <tr>
                        <td>Prijs</td>
                        <td><input type='text' name='prijs' value='<?php echo $row['prijs']?>'></td>
                   </tr>
                
                    <tr>
                        <td>Opties</td>
                        <td>
                            <textarea name="editor1" id="editor1" rows="10" cols="80">
                                <?php echo $row['opties']?>
                            </textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'editor1' );
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <input type='hidden' name='id' value='<?php echo $row['token']?>'>
                        <td colspan='2'>
                            <input type='submit' name='wijzigen' value='Opslaan'/>
                            <input type="checkbox" name="verkocht" value="1"/> Markeer als verkocht
                        </td>
                    </tr>
                </table>
                </form>
    
                <h1>Foto's van deze wagen:</h1>
                <div class="thumbnail-box clearfix" id="images">
    
                    <?php
                
                    $stmt = $mysqli->prepare('SELECT * FROM images WHERE car_id = ?');
                    $stmt->bind_param('s', $wijzig_id);

                    $stmt->execute();

                    $query = $stmt->get_result();
                
                    if (mysqli_num_rows($query) == 0) {
                        echo "<tr><td colspan='2'><i class='fa fa-exclamation-triangle' style='color:#cd0000'></i> Deze wagen heeft nog geen foto's</td></tr>";
                    }

                    else {
                        while ($row = $query->fetch_assoc()) {

                            echo "<div class='thumbnail'><a href='verwijderen.php?type=img&id=".$row['id']."' class='delete'><img src='img-up/images/".$row['thumbnail_image']."' width='' height='' class='portrait car-thumb'/></a></div>";
                        }
                    }
                    ?>
                </div>
                <a href="img-up/index.php?token=<?php echo $wijzig_id ?>" class="btn">Foto's  toevoegen</a>
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
            $deuren = $_POST['deuren'];
            $versnellingen = $_POST['versnellingen'];
            $brandstof = $_POST['brandstof'];
            $opties = $_POST['editor1'];
            $id = $_POST['id'];
            $verkocht = $_POST['verkocht'];
            
            $query = mysqli_query($mysqli, "UPDATE autos SET merk = '$merk', model = '$model', jaar = '$jaar', cilinder = '$cilinder', pk = '$pk', vermogen = '$vermogen', kleur = '$kleur', opties = '$opties', verkocht = '$verkocht' WHERE id='$id'");
            
            if (!$query) {
                die('Invalid query: ' . mysql_error());
            }
            header("Location: wijzig.php?id=". $id ."&type=auto&saved=true");
        }
    }

    
    if (!$mysqli)
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

<?php else :
    header("Location: ../admin");
endif; ?>