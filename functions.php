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

// WAGENS TONEN (ADMIN SIDE)
function toon_autos()
{
    global $connect;
    
    $stmt = $connect->prepare('SELECT * FROM autos WHERE verkocht = 0');
    $stmt->execute();
    $query = $stmt->get_result();
  
    while ($row = $query->fetch_assoc()) {
        
        $id = $row['token'];

        $stmt = $connect->prepare('SELECT count(*) AS total FROM images WHERE car_id = ?');
        $stmt->bind_param('s', $id);
    
        $stmt->execute();

        $query2 = $stmt->get_result();
        $data = $query2->fetch_assoc();
        
        echo "<td width='5%'>".$row['merk']."</td>
        <td width='5%'>".$row['model']. "</td>
        <td width='5%'>".$row['jaar']. "</td>
        <td width='5%'>".$row['cilinder']. "</td>
        <td width='5%'>".$row['pk']. "</td>
        <td width='5%'>".$row['vermogen']. "</td>
        <td width='5%'>".$row['kleur']. "</td>
        <td width='5%'>".$row['deuren']. "</td>
        <td width='5%'>".$row['versnellingen']. "</td>
        <td width='5%'>".$data['total']."</td>
        <td width='1%'><a href='wijzig.php?id=".$row['token']."&type=auto&saved=false'  class='various fancybox.iframe'><i class='fa fa-pencil-square-o fa-2x'></a></td>
        <td width='1%'><a href='verwijderen.php?id=".$row['id']."&type=auto' id='delete' class='various fancybox.iframe' onclick='ConfirmDelete()'><i class='fa fa-trash fa-2x'></i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

// VERKOCHTE WAGENS TONEN (ADMIN SIDE)
function toon_verkochte_autos()
{
    global $connect;
    
    $stmt = $connect->prepare('SELECT * FROM autos WHERE verkocht = 1');
    $stmt->execute();
    $query = $stmt->get_result();
  
    while ($row = $query->fetch_assoc()) {
        $id = $row['token'];

        $stmt = $connect->prepare('SELECT count(*) AS total FROM images WHERE car_id = ?');
        $stmt->bind_param('s', "$id");
    
        $stmt->execute();

        $query = $stmt->get_result();
        $data = $query->fetch_assoc();
        
        echo "<td width='5%'>".$row['merk']."</td>
        <td width='5%'>".$row['model']. "</td>
        <td width='5%'>".$row['jaar']. "</td>
        <td width='5%'>".$row['cilinder']. "</td>
        <td width='5%'>".$row['pk']. "</td>
        <td width='5%'>".$row['vermogen']. "</td>
        <td width='5%'>".$row['kleur']. "</td>
        <td width='5%'>".$row['deuren']. "</td>
        <td width='5%'>".$row['versnellingen']. "</td>
        <td width='5%'>".$data['total']."</td>
        <td width='1%'><a href='wijzig.php?id=".$row['id']."&type=auto&saved=false'  class='various fancybox.iframe'><i class='fa fa-pencil-square-o fa-2x'></a></td>
        <td width='1%'><a href='verwijderen.php?id=".$row['id']."&type=auto' id='delete' class='various fancybox.iframe' onclick='ConfirmDelete()'><i class='fa fa-trash fa-2x'></i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

// WAGENS TONEN (CLIENT SIDE)
function toon_auto_main()
{
    global $connect;
    
    $stmt = $connect->prepare('SELECT * FROM autos ORDER BY id DESC;');
    $stmt->execute();

    $query = $stmt->get_result();
    
  
    while ($row = $query->fetch_assoc()) {
        $id = $row['token'];
        $verkocht = $row['verkocht'];
        
        $stmt2 = $connect->prepare('SELECT * FROM images WHERE car_id = ? LIMIT 1');
        $stmt2->bind_param('s', $id);
        $stmt2->execute();

        $query2 = $stmt2->get_result();
        while ($data = $query2->fetch_assoc()) {
        
        ?>
            <div id="stock-box">
                <div class="stock-box-title"><?php echo $row['merk'] . " " . $row['model']?></div>
        <?php        
        if (mysqli_num_rows($query2) == 0) {
            echo "<div class='thumbnail'><img src='img/noimg.png' class='thumbnail'/></div>";
        }
        else {
            if ($verkocht == '1')
                $class = 'sold';
            else 
                $class = '';
        ?>
                <div class="thumbnail <?php echo $class ?>"><a href="admin/img-up/images/<?php echo $data['original_image']?>" class="fancybox"><img src="admin/img-up/images/<?php echo $data['thumbnail_image']?>" class="portrait" alt="Image" /></a></div>
        <?php } ?>
                <div class="stock-box-text">&euro; <?php echo $row['prijs'] ?>.0</div>
                <div class="stock-box-plus"><a href="viewcar.php?id=<?php echo $row['token'] ?>"><div class="service-box-plus-btn"></div></a></div>
            </div>
<?php   }
    }
}

// WAGEN INFO
function auto_bekijken()
{
    $id = $_GET['id'];
    
    global $connect;
                
    if($connect && !empty($id))
    {
        $stmt = $connect->prepare('SELECT * FROM autos WHERE token = ?');
        $stmt->bind_param('s', $id);

        $stmt->execute();

        $result = $stmt->get_result();
        
        if (mysqli_num_rows($result) == 0) {
            echo "<div id='autoinfo-title'>Technische Informatie</div>";
            echo "<div id='autoinfo-content'>Geen wagen gevonden</div>";
        }
        else {
            while ($data = $result->fetch_assoc()) {
            echo "<div id='autoinfo-title'>Technische Informatie</div>";
            ?>
                <div id='autoinfo-content'>
                    Merk: <?php echo $data['merk'] ?></br>
                    Model: <?php echo $data['model'] ?></br>
                    Brandstof: <?php echo $data['brandstof'] ?></br>
                    Bouwjaar: <?php echo $data['jaar'] ?></br>
                    Cilinder inhoud: <?php echo $data['cilinder'] ?> CC</br>
                    Aantal PK: <?php echo $data['pk'] ?></br>
                    Vermogen: <?php echo $data['vermogen'] ?></br>
                    Kleur: <?php echo $data['kleur'] ?></br>
                    Aantal kilometers: <?php echo $data['km'] ?></br>
                </div>

                <div id='autoinfo-title'>Opties</div>
                <div id='autoinfo-content'>
                    <?php echo $data['opties'] ?></br>
                </div>
            <?php
            }
        }
    }
}

// WAGEN FOTOS
function auto_get_pics()
{
    $id = $_GET['id'];
    
    global $connect;
                
    if($connect && !empty($id))
    {
        $stmt = $connect->prepare('SELECT * FROM images WHERE car_id = ?');
        $stmt->bind_param('s', $id);

        $stmt->execute();

        $result = $stmt->get_result();
        
        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='2'><i class='fa fa-exclamation-triangle' style='color:#cd0000'></i> Deze wagen heeft nog geen foto's</td></tr>";
        }

        else {
            while ($row = $result->fetch_assoc()) {

                echo "<div class='thumbnail'><a class='fancybox' href='admin/img-up/images/".$row['original_image']."' data-fancybox-group='carimages'><img src='admin/img-up/images/".$row['thumbnail_image']."' width='' height='' class='portrait car-thumb'/></a></div>\n";
            }
        }
    }
}

// WAGEN TOEVOEGEN
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
    $brandstof = $_POST['brandstof'];
    $prijs = $_POST['prijs'];
    $km = $_POST['km'];
    $opties = $_POST['opties'];
    $token = uniqid(mt_rand(), false);
    
    global $connect;
                
    if($connect && !empty($merk))
    {
        $query = mysqli_query($connect, "INSERT INTO autos (merk, model, jaar, cilinder, pk, vermogen, kleur, deuren, versnellingen, brandstof, prijs, km, opties, token) VALUES ('$merk', '$model', '$jaar', '$cilinder', '$pk', '$vermogen', '$kleur', '$deuren', '$versnellingen', '$brandstof', '$prijs', '$km', '$opties', '$token');");
        
        header("Location: ../admin/img-up/index.php?token=$token");
        
    }
    
}

?>