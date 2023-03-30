<?php
	include('../db.php');

    $error= 0;
    $deleteSKU = mysqli_query($con, "DELETE FROM sku WHERE parent_id = '" . $_GET["rowID"] . "'") or $error= 1;
    $deleteCat = mysqli_query($con, "DELETE FROM categories WHERE id = '" . $_GET["rowID"] . "'") or $error= 1;

    if(!$error) {
        $msg = "Category was deleted successfully";
        return $msg;
    } else {
        $msg= "Error: " . $query . "<br>" . mysqli_error($con);
    }
?>