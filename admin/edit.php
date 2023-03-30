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
		$eid=$_GET['editid'];
		//Getting Post Values
		$username = $_POST['username'];
		$password = $_POST['password'];
		$role     = $_POST['role'];
		$contno   = $_POST['contactno'];
		$email    = $_POST['email'];

		// If the data is not empty
		if($eid) {
			if(!empty($username) || !empty($role) || !empty($contno) || !empty($email) ) {
				if(!empty($username)) {
					$query = mysqli_query($con, "update accounts set username='$username' where id='$eid'");
				}

				if(!empty($password)) {
					$query = mysqli_query($con, "update accounts set password='$password' where id='$eid'");
				}

				if(!empty($role)) {
					$query = mysqli_query($con, "update accounts set role='$role' where id='$eid'");
				}

				if(!empty($contno)) {
					$query = mysqli_query($con, "update accounts set mobilenumber='$contno' where id='$eid'");
				}

				if(!empty($email)) {
					$query = mysqli_query($con, "update accounts set email='$email' where id='$eid'");
				}

				if ($query) {
					echo "<script>alert('You have successfully update the data');</script>";
					echo "<script type='text/javascript'> document.location ='role.php'; </script>";
				} else {
					echo "<script>alert('Something Went Wrong. Please try again');</script>";
				}
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
				<form  method="POST">
					<div class="d-flex align-items-center justify-content-between">
						<span>
							<h2 class="mb-0 text-dark">Update</h2>
							<p class="hint-text">Update user info.</p>
						</span>
						<a href="role.php" class="btn btn-primary d-inline-flex align-items-center"><span>View Registered Users</span></a>
					</div>
					
					<?php
						$eid = $_GET['editid'];
						$ret = mysqli_query($con, "select * from accounts where id = '$eid'");
						while ($row = mysqli_fetch_array($ret)) {
					?>					
	
					<div class="form-group">
						<img src="../assets/img/profilepics/<?php  echo $row['profilepic'];?>" width="120" height="120" class="mr-2" />
						<a href="change-image.php?userid=<?php echo $row['id'];?>">Change Image</a>
					</div>
	
					<div class="form-group">
						<input type="text" class="form-control" name="username" placeholder="Username">
					</div>

					<div class="form-group">
						<input type="password" class="form-control" name="password" placeholder="Password">
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
						<input type="text" class="form-control" name="contactno" placeholder="Mobile Number" maxlength="10" pattern="[0-9]+">
					</div>

					<div class="form-group">
						<input type="email" class="form-control" name="email" placeholder="Email Address">
					</div>

					<?php 
					}?>

					<div class="form-group">
						<button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Update</button>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>