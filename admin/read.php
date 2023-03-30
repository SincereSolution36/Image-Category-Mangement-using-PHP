<?php
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['username']   = 'stranger';
        $_SESSION['role']       = 'guest';
        $_SESSION['profilepic'] = 'super-admin.jpg';
        $_SESSION['userID']     = -1;
    }

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

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <title>Catalog Image Management</title>
    </head>
    <body class="sidebar-mini">
        <?php include('../components/header.php') ?>

        <?php include('../components/sidebar.php') ?>
        
        <div class="content-wrapper">
            <div class="container-xl">
                <div class="table-title">
                    <div class="row d-block d-lg-flex">
                        <div class="col-lg-5">
                            <h2 class="text-dark mb-2 mb-lg-0">User <b>Details</b></h2>
                        </div>
                        
                        <?php
                            $vid = $_GET['viewid'];
                            $ret = mysqli_query($con, "select * from accounts where id=$vid");
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($ret)) {
                        ?>

                        <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'super-admin') { ?>
                            <div class="col-lg-7 text-lg-right">
                                <a href="role.php" class="btn btn-primary d-inline-flex align-items-center mr-2 mb-2"><span>View Registered Users</span></a>

                                <?php if(($row['role'] == 'editor' && $_SESSION['role'] == 'admin') || $_SESSION['role'] == 'super-admin') { ?>
                                    <a href="edit.php?editid=<?php echo htmlentities ($row['id']);?>" class="btn btn-primary mb-2"><span>Edit User Details</span></a>           
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <div class="table-wrapper">

                        <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                            <tbody>
                                <tr>
                                    <th width="200">Profile Pic</th>
                                    <td><img src="../assets/img/profilepics/<?php  echo $row['profilepic'];?>" width="80" height="80"></td>
                                    <th width="200">Creation Date</th>
                                    <td><?php  echo $row['creationdate'];?></td>
                                </tr>

                                <tr>
                                    <th>Username</th>
                                    <td><?php  echo $row['username'];?></td>
                                    <th>Email</th>
                                    <td><?php  echo $row['email'];?></td>
                                </tr>

                                <tr>
                                    <th>Mobile Number</th>
                                    <td><?php  echo $row['mobilenumber'];?></td>
                                </tr>

                                <?php 
                                    $cnt = $cnt + 1;
                                }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>     
        </div>
    </body>
</html>