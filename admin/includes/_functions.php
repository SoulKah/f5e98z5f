<?php
include_once '_connect.php';

/*// RING RING, DATABASE CONNECTION?!
function dbconnect()
{   
    global $connect;
    $connect = mysqli_connect($GLOBALS['connection']['hostname'],$GLOBALS['connection']['username'],$GLOBALS['connection']['password'],$GLOBALS['connection']['database']);
    
    if (mysqli_connect_errno()) {
        throw new Exception(mysqli_connect_error(), mysqli_connect_errno());
    }
}*/

// WAGENS TONEN (ADMIN SIDE)
function toon_autos($mysqli)
{
    $stmt = $mysqli->prepare('SELECT * FROM autos WHERE verkocht = 0');
    $stmt->execute();
    $query = $stmt->get_result();
  
    while ($row = $query->fetch_assoc()) {
        
        $id = $row['token'];

        $stmt = $mysqli->prepare('SELECT count(*) AS total FROM images WHERE car_id = ?');
        $stmt->bind_param('s', $id);
    
        $stmt->execute();

        $query2 = $stmt->get_result();
        $data = $query2->fetch_assoc();
        
        echo "<td width='10%'>".$row['merk']."</td>
        <td width='10%'>".$row['model']. "</td>
        <td width='10%'>".$row['jaar']. "</td>
        <td width='10%'>".$row['cilinder']. "</td>
        <td width='10%'>".$row['pk']. "</td>
        <td width='10%'>".$row['vermogen']. "</td>
        <td width='10%'>".$row['kleur']. "</td>
        <td width='10%'>".$row['deuren']. "</td>
        <td width='10%'>".$row['versnellingen']. "</td>
        <td width='5%'>".$data['total']."</td>
        <td width='3%'><a href='wijzig.php?id=".$row['token']."&type=auto&saved=false'  class='various fancybox.iframe'><i class='fa fa-pencil-square-o fa-2x'></i></a></td>
        <td width='2%'><a href='verwijderen.php?id=".$row['token']."&type=auto' class='delete'><i class='fa fa-trash fa-2x'></i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

// VERKOCHTE WAGENS TONEN (ADMIN SIDE)
function toon_verkochte_autos($mysqli)
{
    $stmt = $mysqli->prepare('SELECT * FROM autos WHERE verkocht = 1');
    $stmt->execute();
    $query = $stmt->get_result();
  
    while ($row = $query->fetch_assoc()) {
        $id = $row['token'];

        $stmt = $mysqli->prepare('SELECT count(*) AS total FROM images WHERE car_id = ?');
        $stmt->bind_param('s', $id);
    
        $stmt->execute();

        $query = $stmt->get_result();
        $data = $query->fetch_assoc();
        
        echo "<td width='10%'>".$row['merk']."</td>
        <td width='10%'>".$row['model']. "</td>
        <td width='10%'>".$row['jaar']. "</td>
        <td width='10%'>".$row['cilinder']. "</td>
        <td width='10%'>".$row['pk']. "</td>
        <td width='10%'>".$row['vermogen']. "</td>
        <td width='10%'>".$row['kleur']. "</td>
        <td width='10%'>".$row['deuren']. "</td>
        <td width='10%'>".$row['versnellingen']. "</td>
        <td width='5%'>".$data['total']."</td>
        <td width='3%'><a href='wijzig.php?id=".$row['token']."&type=auto&saved=false' class='various fancybox.iframe'><i class='fa fa-pencil-square-o fa-2x'></i></a></td>
        <td width='2%'><a href='verwijderen.php?id=".$row['token']."&type=auto' class='delete'><i class='fa fa-trash fa-2x'></i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_close($mysqli);
}

// WAGENS TONEN (CLIENT SIDE)
function toon_auto_main($mysqli)
{
    $stmt = $mysqli->prepare('SELECT * FROM autos ORDER BY id DESC;');
    $stmt->execute();
    
    $query = $stmt->get_result();
    
    if (mysqli_num_rows($query) == 0) {
            echo "<span style='width: 100%; text-align: center; font-size: 14px;'>Er zijn momenteen geen wagens beschikbaar</span>";
    }
  
    while ($row = $query->fetch_assoc()) {
        $id = $row['token'];
        $verkocht = $row['verkocht'];
        
        $stmt2 = $mysqli->prepare('SELECT * FROM images WHERE car_id = ? LIMIT 1');
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
                <div class="stock-box-text">&euro; <?php echo $row['prijs'] ?></div>
                <div class="stock-box-plus"><a href="viewcar.php?id=<?php echo $row['token'] ?>"><div class="service-box-plus-btn"></div></a></div>
            </div>
<?php   }
    }
    mysqli_close($mysqli);
}

// WAGEN INFO
function auto_bekijken($mysqli)
{
    $id = $_GET['id'];
                
    if($mysqli && !empty($id))
    {
        $stmt = $mysqli->prepare('SELECT * FROM autos WHERE token = ?');
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
                    <label>Merk: </label><?php echo $data['merk'] ?></br>
                    <label>Model: </label><?php echo $data['model'] ?></br>
                    <label>Brandstof: </label><?php echo $data['brandstof'] ?></br>
                    <label>Bouwjaar: </label><?php echo $data['jaar'] ?></br>
                    <label>Cilinder inhoud: </label><?php echo $data['cilinder'] ?> CC</br>
                    <label>Aantal PK: </label><?php echo $data['pk'] ?></br>
                    <label>Vermogen: </label><?php echo $data['vermogen'] ?> Kw</br>
                    <label>Kleur: </label><?php echo $data['kleur'] ?></br>
                    <label>Aantal kilometers: </label><?php echo $data['km'] ?></br>
                    <label>Garantie: </label>12 maanden</br>
                    <label>Prijs: </label>&euro; <?php echo number_format($data['prijs']) ?></br>
                </div>

                <div id='autoinfo-title'>Opties</div>
                <div id='autoinfo-content'>
                    <?php echo $data['opties'] ?>
                </div>
            <?php
            }
        }
    }
}

// WAGEN FOTOS
function auto_get_pics($mysqli)
{
    $id = $_GET['id'];
                
    if($mysqli && !empty($id))
    {
        $stmt = $mysqli->prepare('SELECT `original_image`, `thumbnail_image` FROM images WHERE car_id = ?');
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
    mysqli_close($mysqli);
}

// WAGEN TOEVOEGEN
function auto_toevoegen($mysqli)
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
                    
    if($mysqli && !empty($merk))
    {
        $query = mysqli_query($mysqli, "INSERT INTO autos (merk, model, jaar, cilinder, pk, vermogen, kleur, deuren, versnellingen, brandstof, prijs, km, opties, token) VALUES ('$merk', '$model', '$jaar', '$cilinder', '$pk', '$vermogen', '$kleur', '$deuren', '$versnellingen', '$brandstof', '$prijs', '$km', '$opties', '$token');");
        
        mysqli_close($mysqli);
        header("Location: ../admin/img-up/index.php?token=".$token."");
        exit();
    }  
}
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id(true);    // regenerated the session, delete the old one. 
    
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
}

function login($email, $password, $mysqli) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
        FROM gebruikers
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
 
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }
}

function checkbrute($user_id, $mysqli) {
    // Get timestamp of current time 
    $now = time();
 
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
 
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}

function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM gebruikers 
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}

function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}



?>