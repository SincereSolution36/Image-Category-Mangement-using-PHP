<?php
    session_start();
    if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['username']   = 'stranger';
        $_SESSION['role']       = 'guest';
        $_SESSION['profilepic'] = 'super-admin.jpg';
        $_SESSION['userID']     = -1;
    }
    
  	include('tag-script.php');
?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,600"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/main.css"/>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <title>Catalog Image Management</title>
    </head>
    <body class="sidebar-mini">
        <?php require('../components/header.php');?>

        <?php require('../components/sidebar.php');?>

		<div class="content-wrapper category-admin d-flex align-items-center">
			<div class="container-xl">
				<div class="page-content">
					<div class="row">
						<div class="col-lg-6">
							<div class="form">
                                <div class="form-title mb-4">
                                    <h3 class="text-dark">Create Tag</h3>
                                </div>
    
                                <form method="post" action="">
                                    <label class="text-dark">Tag Name</label>
                                    <input type="text" placeholder="Enter Full Name" class="form-control mb-3" name="tag_name" required>
                                    <button type="submit" name="addtag" class="btn btn-primary btn-lg btn-block">Add Tag</button>
                                </form>
							</div>

							<p style="color:red">
								<?php if(!empty($msg)){ echo $msg; }?>
							</p>
						</div>
	
						<div class="col-lg-6">
                            <div class="form-title mb-4">
                                <h3 class="text-dark">Registered Tag List</h3>
                            </div>

                            <div>
                                <?php
                                    foreach ($tagData as $tag) {
                                ?>
                                    <div class="text-white py-1 px-2 d-inline-block bg-primary category-btn position-relative" id="<?php echo $tag['id'] ?>"><?php echo $tag['tag_name']; ?><span class="material-icons">&#xe5c9;</span></div>
                                <?php } ?>

                                <script>
                                    $('.category-btn').click(function(){
                                        var rowID= $(this).attr('id');
                                        $.get( "tag-del.php?rowID=" + rowID, function( error ) {
                                            if(error == 0){
                                                $('.category-btn#' + rowID).remove();
                                            }
                                            else{
                                                alert('MySQL error!');
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>