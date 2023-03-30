<?php
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['username']   = 'stranger';
        $_SESSION['role']       = 'guest';
        $_SESSION['profilepic'] = 'super-admin.jpg';
        $_SESSION['userID']     = -1;
    }

    require_once 'DB.class.php';
    $db = new DB();

    if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['username']   = 'stranger';
        $_SESSION['role']       = 'guest';
        $_SESSION['profilepic'] = 'super-admin.jpg';
        $_SESSION['userID']     = -1;
    }

    $postData = $imgData = array();
    $selectedCat = -1;

    // Get session data
    $sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';

    // Get status message from session
    if(!empty($sessData['status']['msg'])){
        $statusMsg = $sessData['status']['msg'];
        $statusMsgType = $sessData['status']['type'];
        unset($_SESSION['sessData']['status']);
    }

    // Get posted data from session
    if(!empty($sessData['postData'])){
        $postData = $sessData['postData'];
        unset($_SESSION['sessData']['postData']);
    }

    // Get image data
    if(!empty($_GET['id'])){        
        $conditions['where'] = array(
            'id' => $_GET['id'],
        );
        $conditions['return_type'] = 'single';
        $imgData = $db->getRows('images', $conditions);
    }

    // Get category data
    $catData = $db->getRows('categories');

    // Get sku data
    $skuData = $db->getRows('sku');

    // Get tag data
    $tagData = $db->getRows('tag');

    // Pre-filled data
    $imgData = !empty($postData)?$postData:$imgData;

    // Define action
    $actionLabel = !empty($_GET['id'])?'Edit':'Add';
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

        <!-- Display status message -->
        <?php if(!empty($statusMsg)){ ?>
        <div class="col-xs-12">
            <div class="alert alert-<?php echo $statusMsgType; ?>"><?php echo $statusMsg; ?></div>
        </div>
        <?php } ?>

        <div class="content-wrapper image-manage">
            <div class="container-xl">
                <div class="row">
                    <div class="col-sm-4">
                        <?php if(!empty($imgData['file_name'])){ ?>
                            <img src="../assets/img/uploads/<?php echo $imgData['file_name']; ?>" class="mb-4">
                            <h3 class="text-dark"><?php echo $imgData['file_name'] ?></h3>
                        <?php } ?>
                    </div>
                    
                    <div class="col-sm-8 align-self-center">
                        <form method="post" action="postAction.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="file" name="image">
                            </div>
                            
                            <label class="text-dark">Select SKU</label>
                            <select name="imgsku" class="form-control mb-3 select-sku">
                            <?php
                                foreach ($skuData as $sku) {
                                    ?>
                                <option value="<?php echo $sku['sku_name']; ?>"> <?php echo $sku['sku_name']; ?></option>
                                <?php } ?>
                            </select>

                            <label class="text-dark">Select Tag</label>
                            <select name="imgtag" class="form-control mb-3 select-tag">
                                <?php
                                    foreach ($tagData as $tag) {
                                ?>
                                    <option value="<?php echo $tag['tag_name']; ?>" class="select-tag-item" id="<?php echo $tag['id']; ?>"> <?php echo $tag['tag_name']; ?></option>
                                <?php } ?>
                            </select>

                            <a href="manage.php" class="btn btn-secondary">Back</a>
                            <input type="hidden" name="id" value="<?php echo !empty($imgData['id'])?$imgData['id']:''; ?>">
                            <input type="submit" name="imgSubmit" class="btn btn-success" value="SUBMIT">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>