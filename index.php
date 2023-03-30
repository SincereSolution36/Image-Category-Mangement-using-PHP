<?php
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['username']   = 'stranger';
        $_SESSION['role']       = 'guest';
        $_SESSION['profilepic'] = 'super-admin.jpg';
        $_SESSION['userID']     = -1;
    }
    // Include and initialize DB class
    require_once './media/DB.class.php';
    $db        = new DB();
    // Fetch the images data
    $condition = array('where' => array('status' => 1));
    $images    = $db -> getRows('images', $condition);
    
    include('db.php');
    if(isset($_GET['s'])) {
        $sql = "SELECT id, file_name, category, sku, tag FROM images WHERE file_name LIKE '%" . $_GET['s'] . "%' LIMIT 20";
    } else {
        $sql = "SELECT id, file_name, category, sku, tag FROM images";
    }

    $resultset = mysqli_query($con, $sql) or die("database error:" . mysqli_error($con));
    $imgData = array();
    while( $rows = mysqli_fetch_assoc($resultset) ) {	
        $imgData [] = array(
            "id"        => $rows['id'],
            "file_name" => $rows['file_name'],
        );
    }

    if(isset($_POST['imgSearchSubmit'])){
        $redirectURL = 'index.php?s=' . $_POST['imgsearch'];
        // // Redirect the user
        header("Location: ".$redirectURL);
    }
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="./assets/css/main.css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        <script>
            $("[data-fancybox]").fancybox();
        </script>

        <title>Catalog Image Management</title>
    </head>
    <body class="sidebar-mini">
        <?php include('./components/header.php') ?>

        <?php include('./components/sidebar.php') ?>

        <div class="content-wrapper">
            <div class="gallery">
                <div class="container">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-7 d-xl-flex align-items-center">
                                <h2 class="text-dark mr-4"><b>Search</b></h2>
                                <form method="post" action="" enctype="multipart/form-data" class="d-flex align-items-center mb-2 mb-sm-0">
                                    <input class="form-control w-auto d-inline-block" name="imgsearch" type="text" placeholder="Search Images...." value="<?php isset($_GET['s']) ? $_GET['s'] : '' ?>">
                                    <input type="submit" name="imgSearchSubmit" class="btn btn-primary" value="Search" style="height: 40px">
                                </form>
                            </div>

                            <?php if($_SESSION['role'] != 'guest') { ?>
                                <div class="col-sm-5 d-flex align-items-center justify-content-sm-end" >
                                    <a href="./media/manage.php" class="btn btn-primary d-inline-flex align-items-center" style="height: 40px;"><span>Manage</span></a>      
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <?php
                            if(!empty($imgData)){
                                foreach($imgData as $row) {
                                    $uploadDir = './assets/img/uploads/';
                                    $imageURL = $uploadDir . $row["file_name"];
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="<?php echo $imageURL; ?>" data-fancybox="gallery" data-caption="<?php echo $row["file_name"]; ?>" >
                                <img src="<?php echo $imageURL; ?>" alt="" />
                                <p><?php echo $row["file_name"]; ?></p>
                            </a>
                        </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>