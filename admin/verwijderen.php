<?php
$connect = mysqli_connect("localhost","root","","autodealer");
if (mysqli_connect_errno()) {
    throw new Exception(mysqli_connect_error(), mysqli_connect_errno());
}

$type = $_GET['type']; 

if($connect && $type == "auto")
{
    $delete_id = $_GET['id']; 

    $stmt = $connect->prepare('DELETE FROM autos WHERE token = ?');
    $stmt->bind_param('s', $delete_id);
    $stmt->execute();

    $stmt = $connect->prepare('SELECT * FROM images WHERE car_id= ?');
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
        else {
            echo "Deleted: " .$original. "<br>";
            echo "Deleted: " .$thumbnail. "<br>";
        }
    }
    
    $stmt = $connect->prepare('DELETE FROM images WHERE car_id = ?');
    $stmt->bind_param('s', $delete_id);
    $stmt->execute();

    echo "Deleted: Wagen";
    mysqli_close($connect);
}

if ($connect && $type == "foto")
{
    $delete_id = $_GET['id']; 
    $del = mysqli_query($connect, "DELETE FROM images WHERE id = $delete_id");
    if ($del)
    {
        echo "Foto: verwijderd!";
    }
    else
        echo "Failed";
    mysqli_close($connect);
}
?>