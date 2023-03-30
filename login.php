<?php
    if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['username']   = 'stranger';
        $_SESSION['role']       = 'guest';
        $_SESSION['profilepic'] = 'super-admin.jpg';
        $_SESSION['userID']     = -1;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Login</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="./assets/css/main.css"/>
    </head>
    <body style="background-color: #7db1ff;" class="text-center">
        <div class="login">
			<h1>Login</h1>
			<form action="authenticate.php" method="post">
				<label for="username">
                    <span class="material-icons">&#xe7fd;</span>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
                    <span class="material-icons">&#xe73c;</span>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login" action="authenticate.php">
			</form>
            <a href="index.php" class="return">Return to Homepage</a>
		</div>
    </body>
</html>
