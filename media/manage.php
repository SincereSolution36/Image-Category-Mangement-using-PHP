<?php
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['username']   = 'stranger';
        $_SESSION['role']       = 'guest';
        $_SESSION['profilepic'] = 'super-admin.jpg';
        $_SESSION['userID']     = -1;
    }
    
    // Include and initialize DB class
    require_once 'DB.class.php';
    $db = new DB();

    // Fetch the users data
    $images = $db->getRows('images');

    // Get session data
    $sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';

    // Get status message from session
    if(!empty($sessData['status']['msg'])){
        $statusMsg     = $sessData['status']['msg'];
        $statusMsgType = $sessData['status']['type'];
        unset($_SESSION['sessData']['status']);
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
        <link rel="stylesheet" href="../assets/css/main.css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <title>Catalog Image Management</title>
    </head>
    <body class="sidebar-mini">
        <?php include('../components/header.php') ?>

        <?php include('../components/sidebar.php') ?>

        <div class="content-wrapper image-manage">
            <div class="container-xl">
                <!-- Display status message -->
                <?php if(!empty($statusMsg)){ ?>
                <div class="col-xs-12">
                    <div class="alert alert-<?php echo $statusMsgType; ?>"><?php echo $statusMsg; ?></div>
                </div>
                <?php } ?>
        
                <!-- List the images -->
                <table class="table table-striped table-bordered mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th width="5%"></th>
                            <th width="10%">Image</th>
                            <th width="18%">Title</th>
                            <th width="12%">Category</th>
                            <th width="12%">SKU</th>
                            <th width="12%">Tag</th>
                            <th width="10%">Created</th>
                            <th width="5%">Status</th>
                            <th width="16%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($images)){
                            foreach($images as $row){
                                $statusLink    = ($row['status'] == 1) ? 'postAction.php?action_type=block&id=' . $row['id'] : 'postAction.php?action_type=unblock&id=' . $row['id'];
                                $statusTooltip = ($row['status'] == 1) ? 'Click to Inactive' : 'Click to Active';
                        ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><img src="<?php echo '../assets/img/uploads/'.$row['file_name']; ?>" alt="" /></td>
                            <td><?php echo $row['file_name']; ?></td>
                            <td><?php echo $row['category'] == 'NULL' ? 'Not Set' : $row['category']; ?></td>
                            <td><?php echo $row['sku'] == 'NULL' ? 'Not Set' : $row['sku']; ?></td>
                            <td><?php echo $row['tag'] == 'NULL' ? 'Not Set' : $row['tag']; ?></td>
                            <td><?php echo $row['created']; ?></td>
                            <td><a href="<?php echo $statusLink; ?>" title="<?php echo $statusTooltip; ?>"><span class="badge <?php echo ($row['status'] == 1)?'badge-success':'badge-danger'; ?>"><?php echo ($row['status'] == 1)?'Active':'Inactive'; ?></span></a></td>
                            <td>
                                <a href="addEdit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning mb-2">Edit</a>
                                <a href="postAction.php?action_type=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger mb-2" onclick="return confirm('Are you sure to delete data?')?true:false;">Delete</a>
                            </td>
                        </tr>
                        <?php } } else { ?>
                            <tr><td colspan="6">No image(s) found...</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>