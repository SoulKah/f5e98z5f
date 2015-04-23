<?php
$connect=mysqli_connect("localhost","root","","autodealer");
if (mysqli_connect_errno()) {
    throw new Exception(mysqli_connect_error(), mysqli_connect_errno());
}

$type = $_GET['type']; 

if($connect && $type == "auto")
{
    $delete_id = $_GET['id']; 
    mysqli_query($connect, "DELETE FROM autos WHERE id='$delete_id'");
    mysqli_query($connect, "DELETE FROM images WHERE car_id='$delete_id'");
    echo "Wagen: verwijderd!";
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