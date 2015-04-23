<?php
include 'config/config.php';

// RING RING, DATABASE CONNECTION?!
function dbconnect()
{   
    global $connect;
    $connect = mysqli_connect($GLOBALS['connection']['hostname'],$GLOBALS['connection']['username'],$GLOBALS['connection']['password'],$GLOBALS['connection']['database']);
    
    if (mysqli_connect_errno()) {
        throw new Exception(mysqli_connect_error(), mysqli_connect_errno());
    }
}

// STUDENTEN TONEN
function toon_autos()
{
    global $connect;
    $query = mysqli_query($connect, "SELECT * FROM autos;");    
  
    while ($row = mysqli_fetch_array($query)) {
        $id = $row['id'];
        $result = mysqli_query($connect, "SELECT count(*) AS total FROM images WHERE car_id = $id");
        $data = mysqli_fetch_assoc($result);
        
        echo "<td width='16%'>".$row['merk']."</td>
        <td width='16%'>".$row['model']. "</td>
        <td width='16%'>".$row['jaar']. "</td>
        <td width='1%'>".$row['cilinder']. "</td>
        <td width='16%'>".$row['pk']. "</td>
        <td width='16%'>".$row['vermogen']. "</td>
        <td width='16%'>".$row['kleur']. "</td>
        <td width='16%'>".$row['deuren']. "</td>
        <td width='16%'>".$row['versnellingen']. "</td>
        <td width='16%'>".$data['total']."</td>
        <td width='1%'><a href='wijzig.php?id=".$row['id']."&type=student&saved=false'  class='various fancybox.iframe'><i class='fa fa-pencil-square-o fa-2x'></a></td>
        <td width='1%'><a href='verwijderen.php?id=".$row['id']."&type=student' id='delete' class='various fancybox.iframe' onclick='ConfirmDelete()'><i class='fa fa-trash fa-2x'></i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

function toon_auto_main()
{
    global $connect;
    $query = mysqli_query($connect, "SELECT * FROM autos;");    
  
    while ($row = mysqli_fetch_array($query)) {
        $id = $row['id'];
        $result = mysqli_query($connect, "SELECT * FROM images WHERE car_id = $id LIMIT 1");
        $data = mysqli_fetch_assoc($result);
        ?>
            <div id="stock-box">
                <div class="stock-box-title"><?php echo $row['merk'] . " " . $row['model']?></div>
                <div class="stock-box-img"><img src="admin/img-up/images/<?php echo $data['thumbnail_image']?>" width="205" height="" /></div>
                <div class="stock-box-text">&euro; <?php echo $row['prijs'] ?>.0</div>
                <div class="stock-box-plus"><a href="onderhoud.html"><div class="service-box-plus-btn"></div></a></div>
            </div>
<?php
        /*
        echo "<td width='16%'><img src='admin/img-up/images/".$data['thumbnail_image']."' width='' height=''/></td>
        <td width='16%'>".$row['merk']." ".$row['model']."</td>
        <td width='16%'>".$row['prijs']. "</td>
        <td width='16%'>".$row['jaar']. "</td>
        <td width='1%'>".$row['cilinder']. "</td>
        <td width='16%'>".$row['kleur']. "</td>";

        echo "</tr>";*/
    }
}

// STUDENT TOEVOEGEN
function auto_toevoegen()
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
    
    global $connect;
                
    if($connect && !empty($merk))
    {
        $query = mysqli_query($connect, "INSERT INTO autos (merk, model, jaar, cilinder, pk, vermogen, kleur, deuren, versnellingen) VALUES ('$merk', '$model', '$jaar', '$cilinder', '$pk', '$vermogen', '$kleur', '$deuren', '$versnellingen');");
        echo "<div class='saved'>Wagen toegevoegd!</div>";
    }
}

?>