<?php
    // Include the database connection file
    include('../db.php');
    include('DB.class.php');
    $fileData = '';
    if(isset($_FILES['file']['name'][0])) {
        foreach($_FILES['file']['name'] as $keys => $values) {
            $fileName = $_FILES['file']['name'][$keys];
            if(move_uploaded_file($_FILES['file']['tmp_name'][$keys], '../assets/img/uploads/' . $values)) {
                $fileData .= '<img src="../assets/img/uploads/' . $values . '" class="thumbnail" />';
                $query = "INSERT INTO images (file_name, created) VALUES('".$fileName."','".date("Y-m-d H:i:s")."')";
                mysqli_query($con, $query);
            }
        }
    }
    echo $fileData;
?>