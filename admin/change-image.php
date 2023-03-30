<?php
	session_start();
    if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['username']   = 'stranger';
        $_SESSION['role']       = 'guest';
        $_SESSION['profilepic'] = 'super-admin.jpg';
        $_SESSION['userID']     = -1;
    }
	
	//Database Connection
	include('../db.php');

	if(isset($_POST['submit']))
	{
		$uid                = $_GET['userid'];
		//getting the post values
		$ppic               = $_FILES["profilepic"]["name"];
		$oldppic            = $_POST['oldpic'];
		$oldprofilepic      = "../assets/img/profilepics/" . $oldppic;
		// get the image extension
		$extension          = substr($ppic, strlen($ppic) - 4, strlen($ppic));
		// allowed extensions
		$allowed_extensions = array(".jpg", "jpeg", ".png", ".gif", "jfif");
		// Validation for allowed extensions .in_array() function searches an array for a specific value.
		if(!in_array($extension, $allowed_extensions)) {
			echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif / jfif format allowed');</script>";
		} else {
			//rename the image file
			$imgfile    = ' ';
			$imgnewfile = md5($imgfile).time().$extension;
			// Code for move image into directory
			move_uploaded_file($_FILES["profilepic"]["tmp_name"], "../assets/img/profilepics/" . $imgnewfile);
			// Query for data insertion
			$query      = mysqli_query($con, "update accounts set profilepic = '$imgnewfile' where id = '$uid' ");
			if ($query) {
				//Old pic
				unlink($oldprofilepic);
				echo "<script>alert('Profile pic updated successfully');</script>";
				echo "<script type='text/javascript'> document.location ='role.php'; </script>";
			} else {
				echo "<script>alert('Something Went Wrong. Please try again');</script>";
			}
		}
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
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <title>Catalog Image Management</title>
    </head>
    <body class="sidebar-mini">
        <?php include('../components/header.php') ?>

        <?php include('../components/sidebar.php') ?>

		<div class="signup-form">
			<div class="container-xl">
				<form  method="POST" enctype="multipart/form-data">
					<?php
						$eid = $_GET['userid'];
						$ret = mysqli_query($con, "select * from accounts where ID = '$eid'");
						while ($row=mysqli_fetch_array($ret)) {
					?>
					<div class="d-flex flex-wrap">
						<h2 class="mb-0 mr-5 text-dark">Update</h2>
						<p class="hint-text">Update your profile pic.</p>
					</div>
					
					<input type="hidden" name="oldpic" value="<?php  echo $row['profilepic'];?>">

					<div class="form-group">
						<img src="../assets/img/profilepics/<?php  echo $row['profilepic'];?>" width="120" height="120">
					</div>
	
					<div class="form-group">
						<input type="file" name="profilepic"  required="true">
						<span style="color:red; font-size:12px;">Only jpg / jpeg / png / gif / jfif format allowed.</span>
					</div>
	
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Update</button>
					</div>
					
					<?php
					}?>
				</form>
			</div>
		</div>
	</body>
</html>