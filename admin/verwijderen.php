<?php
include_once 'includes/_connect.php';
include_once 'includes/_functions.php';

session_start();

if (login_check($mysqli) == true)
{

    $type = $_GET['type']; 

    if($mysqli && $type == "auto")
    {
        $delete_id = $_GET['id']; 

        $stmt = $mysqli->prepare('DELETE FROM autos WHERE token = ?');
        $stmt->bind_param('s', $delete_id);
        $stmt->execute();

        $stmt = $mysqli->prepare('SELECT * FROM images WHERE car_id= ?');
        $stmt->bind_param('s', $delete_id);
        $stmt->execute();
        $query = $stmt->get_result();

        while ($row = $query->fetch_assoc()) {

            $original = "img-up/images/".$row['original_image']."";
            $thumbnail = "img-up/images/".$row['thumbnail_image']."";
            // See if it exists before attempting deletion on it
            if (file_exists($original) && file_exists($thumbnail)) {
                unlink($original); // Delete original img
                unlink($thumbnail); // Delete thumbnail img
            } 
            // See if it exists again to be sure it was removed
            if (file_exists($original) && file_exists($thumbnail)) {
                echo "Problem deleting " . $original. "<br>";
                echo "Problem deleting " . $thumbnail. "<br>";
            }
        }

        $stmt = $mysqli->prepare('DELETE FROM images WHERE car_id = ?');
        $stmt->bind_param('s', $delete_id);
        $stmt->execute();

        mysqli_close($mysqli);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    if ($mysqli && $type == "img")
    {
        $delete_id = $_GET['id']; 
        $del = mysqli_query($mysqli, "DELETE FROM images WHERE id = $delete_id");
        if ($del)
        {
            mysqli_close($mysqli);
            header('Location: ' . $_SERVER['HTTP_REFERER']. '#images');
            exit();
        }
        else
            echo "Failed";
    }
}

else 
    header("Location: ../admin");
?>