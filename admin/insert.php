<?php
	session_start();
    if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['username']   = 'stranger';
        $_SESSION['role']       = 'guest';
        $_SESSION['profilepic'] = 'super-admin.jpg';
        $_SESSION['userID']     = -1;
    }

	//Databse Connection file
	include('../db.php');

	if(isset($_POST['submit']))
	{
		//getting the post values
		$username = $_POST['username'];
		$password = $_POST['password'];
		$role     = $_POST['role'];
		$contno   = $_POST['contactno'];
		$email    = $_POST['email'];
		$ppic     = $_FILES["profilepic"]["name"];
		// get the image extension
		$extension = substr($ppic, strlen($ppic) - 4, strlen($ppic));
		// allowed extensions
		$allowed_extensions = array(".jpg", "jpeg" , ".png", ".gif", "jfif");
		// Validation for allowed extensions .in_array() function searches an array for a specific value.
		if(!in_array($extension, $allowed_extensions)) {
			echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif / jfif format allowed');</script>";
		} else {
			$imgfile    = ' ';
			//rename the image file
			$imgnewfile = md5($imgfile).time().$extension;
			// Code for move image into directory
			move_uploaded_file($_FILES["profilepic"]["tmp_name"], "../assets/img/profilepics/" . $imgnewfile);
			// Query for data insertion
			$query      = mysqli_query($con, "insert into accounts(username, password, role, mobilenumber, email, profilepic) value('$username', '$password', '$role', '$contno', '$email', '$imgnewfile' )");
			if ($query) {
				echo "<script>alert('You have successfully inserted the data');</script>";
				echo "<script type='text/javascript'> document.location ='role.php'; </script>";
			} else{
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
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

        <title>Catalog Image Management</title>
    </head>
    <body class="sidebar-mini">
        <?php include('../components/header.php') ?>

        <?php include('../components/sidebar.php') ?>

		<div class="signup-form">
			<div class="container-xl">
				<form method="POST" enctype="multipart/form-data" >
					<div class="d-flex align-items-center justify-content-between">
						<h2 class="mb-0 text-dark">Fill User Info</h2>
						<a href="role.php" class="btn btn-primary d-inline-flex align-items-center"><span>View Registered Users</span></a>
					</div>
					<p class="hint-text">Fill below form.</p>
					<div class="form-group">
						<input type="text" class="form-control" name="username" placeholder="Username" required="true">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="password" placeholder="Password" required="true">
					</div>
					<div class="form-group">
						<select name="role" class="form-control" id="role">
							<option value="">--- Choose a Role ---</option>
							<option value="editor">Editor</option>
							
							<?php if($_SESSION['role'] == 'super-admin') { ?>
								<option value="admin">Admin</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="contactno" placeholder="Enter your Mobile Number" required="true" maxlength="10" pattern="[0-9]+">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" name="email" placeholder="Enter your Email" required="true">
					</div>
					
					<div class="form-group">
						<input type="file" name="profilepic">
						<span style="color:red; font-size:12px;">Only jpg / jpeg / png / gif / jfif format allowed.</span>
					</div>      
					
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>