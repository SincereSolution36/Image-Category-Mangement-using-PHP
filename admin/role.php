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

    //Code for deletion
    if(isset($_GET['delid']))
    {
        $rid        = intval($_GET['delid']);
        $profilepic = $_GET['ppic'];
        $ppicpath   = "../assets/img/profilepics" . "/" . $profilepic;
        $sql        = mysqli_query($con, "delete from accounts where id=$rid");
        unlink($ppicpath);
        echo "<script>alert('Data deleted');</script>"; 
        echo "<script>window.location.href = 'role.php'</script>";     
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

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <title>Catalog Image Management</title>
    </head>
    <body class="sidebar-mini">
        <?php require('../components/header.php');?>

        <?php require('../components/sidebar.php');?>

        <div class="content-wrapper">
            <div class="container-xl">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-5">
                            <h2 class="text-dark ">User <b>Management</b></h2>
                        </div>
                        <div class="col-sm-7" align="right">
                            <a href="insert.php" class="btn btn-primary d-inline-flex align-items-center"><i class="material-icons mr-1">&#xE147;</i> <span>Add New User</span></a>      
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <div class="table-wrapper">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Profile Pic</th>
                                    <th>Name</th>                       
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Mobile Number</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $ret = mysqli_query($con, "select * from accounts");
                                    $cnt = 1;
                                    $row = mysqli_num_rows($ret);
                                    if($row > 0) {
                                        while ($row = mysqli_fetch_array($ret)) {
                                    ?>
                                    <!--Fetch the Records -->
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><img src="../assets/img/profilepics/<?php echo $row['profilepic']; ?>" width="80" height="80"></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['role']; ?></td>
                                    <td><?php echo $row['mobilenumber']; ?></td>
                                    <td><?php echo $row['creationdate']; ?></td>
                                    <td>
                                        <a href="read.php?viewid=<?php echo htmlentities($row['id']); ?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>

                                        <?php if(($row['role'] == 'editor' && $_SESSION['role'] == 'admin') || $_SESSION['role'] == 'super-admin') { ?>
                                            <a href="edit.php?editid=<?php echo htmlentities($row['id']); ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                            <a href="role.php?delid=<?php echo htmlentities($row['id']); ?>&&ppic=<?php echo $row['profilepic']; ?>" class="delete" title="Delete" data-toggle="tooltip" onclick="return confirm('Do you really want to Delete ?');"><i class="material-icons">&#xE872;</i></a>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <?php 
                                        $cnt = $cnt + 1;
                                    } } else {
                                ?>

                                <tr>
                                    <th style="text-align:center; color:red;" colspan="6">No Record Found</th>
                                </tr>
                                
                                <?php } ?>                 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </body>
</html>