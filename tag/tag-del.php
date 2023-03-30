<?php
	include('../db.php');

    $error= 0;
    $deleteCat = mysqli_query($con, "DELETE FROM tag WHERE id = '" . $_GET["rowID"] . "'") or $error= 1;

    if(!$error) {
        $msg = "Tag was deleted successfully";
        return $msg;
    } else {
        $msg= "Error: " . $query . "<br>" . mysqli_error($con);
    }
?>