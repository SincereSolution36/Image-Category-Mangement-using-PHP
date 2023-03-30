<?php
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['username']   = 'stranger';
        $_SESSION['role']       = 'guest';
        $_SESSION['profilepic'] = 'super-admin.jpg';
        $_SESSION['userID']     = -1;
    }

    //database conection file
    include('../db.php');
?>

<!doctype html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,600"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="../assets/css/main.css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <title>Catalog Image Management</title>
    </head>
    <body class="sidebar-mini">
        <?php include('../components/header.php') ?>

        <?php include('../components/sidebar.php') ?>

        <div class="content-wrapper">
            <div class="container">
                <div id="drop_file_area" class="text-dark">
                    Drag and Drop Files Here
                </div>

                <div id="uploaded_file" class="overflow-hidden">
                    <?php
                        $ret = mysqli_query($con, "select * from images");
                        $row = mysqli_num_rows($ret);
                        if($row > 0) {
                            while ($row = mysqli_fetch_array($ret)) {
                    ?>
                        <img src="../assets/img/uploads/<?php echo $row['file_name'] ?>" class="thumbnail" />
                    <?php }} ?>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $("html").on("dragover", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                });

                $("html").on("drop", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                });

                $('#drop_file_area').on('dragover', function () {
                    $(this).addClass('drag_over');
                    return false;
                });

                $('#drop_file_area').on('dragleave', function () {
                    $(this).removeClass('drag_over');
                    return false;
                });

                $('#drop_file_area').on('drop', function (e) {
                    e.preventDefault();
                    $(this).removeClass('drag_over');
                    var formData = new FormData();
                    var files = e.originalEvent.dataTransfer.files;

                    for (var i = 0; i < files.length; i++) {
                        formData.append('file[]', files[i]);
                    }

                    uploadFormData(formData);
                });

                function uploadFormData(form_data) {
                    $.ajax({
                        url: "file_upload.php",
                        method: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            $('#uploaded_file').append(data);
                        }
                    });
                }
            });
        </script>
    </body>
</html>