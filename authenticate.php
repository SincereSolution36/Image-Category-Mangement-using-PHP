<?php
    session_start();

    include('db.php');
    
    if ( !isset($_POST['username'], $_POST['password']) ) {
        // Could not get the data that should have been sent.
        exit('Please fill both the username and password fields!');
    }

    $username = stripslashes($_REQUEST['username']);    // removes backslashes
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    
    // Check user is exist in the database
    $query1 = "SELECT * FROM `super-admin` WHERE username='$username'
                AND password='$password'";
    $query2 = "SELECT * FROM `accounts` WHERE username='$username'
                AND password='$password'";
    $result1 = mysqli_query($con, $query1) or die(mysql_error());
    $result2 = mysqli_query($con, $query2) or die(mysql_error());
    
    $rows1 = mysqli_num_rows($result1);
    $rows2 = mysqli_num_rows($result2);

    if (!$rows1 && !$rows2) {
        echo "<div class='form'>
        <h3>Incorrect Username/password.</h3><br/>
        <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
        </div>";
    } else {
        $_SESSION['username']   = $username;
        $ret                    = $rows1 == 1 ? $result1 -> fetch_assoc() : $result2 -> fetch_assoc();
        $_SESSION['role']       = $ret['role'];
        $_SESSION['loggedIn']   = true;
        $_SESSION['profilepic'] = $ret['profilepic'];
        $_SESSION['userID']     = $ret['id'];
        // Redirect to user dashboard page
        header("Location: index.php");
    }
?>