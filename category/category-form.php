<?php
	session_start();
	if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['username']   = 'stranger';
        $_SESSION['role']       = 'guest';
        $_SESSION['profilepic'] = 'super-admin.jpg';
        $_SESSION['userID']     = -1;
    }

  	include('category-script.php');
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
						<div class="<?php echo $_GET['add']??'' ? 'col-lg-6' : 'col-lg-12' ?>">
							<div class="form">
								<?php
									$add = $_GET['add']??'';
									switch ($add) {
										case 'add-category':	
								?>
											<div class="form-title mb-4">
												<h3 class="text-dark">Create Category</h3>
											</div>
				
											<form method="post" action="">
												<label class="text-dark">Category Name</label>
												<input type="text" placeholder="Enter Full Name" class="form-control mb-3" name="category_name" required>
												<button type="submit" name="addcat" class="btn btn-primary btn-lg btn-block">Add category</button>
											</form>
									<?php
										break;
										case 'add-sku':	
									?>
											<div class="form-title mb-4">
												<h3 class="text-dark">Create SKU</h3>
											</div>
				
											<form method="post" action="">
												<label class="text-dark">Category Name</label>
				
												<select name="parent_id" class="form-control mb-3">	
												<?php
													foreach ($catData as $cat) {
												?>
													<option value="<?php echo $cat['id']; ?>"> <?php echo $cat['category_name']; ?></option>
												<?php } ?>
												</select>
				
												<label class="text-dark">SKU Name</label>
				
												<input type="text" placeholder="Enter Full Name" class="form-control mb-3" name="sku_name" required>
												
												<button type="submit" name="addskucat" class="btn btn-primary btn-lg btn-block" <?php if (!count($catData)) { ?> disabled <?php } ?>>Add SKU</button>
											</form>
									<?php
										break;
										default:
									?>
											<div class="form-title mb-4">
												<h3 class="text-dark">Registered <label class="text-danger">Categories</label> and <label class="text-primary">SKUs</label></h3>
											</div>
											
											<div>
												<?php
													foreach ($catData as $cat) {
												?>
													<div class="text-white py-1 px-2 d-inline-block bg-danger category-btn position-relative" id="<?php echo $cat['id'] ?>"><?php echo $cat['category_name']; ?><span class="material-icons">&#xe5c9;</span></div>

													<div class="pl-3">
														<?php
															foreach ($cat['sku'] as $sku) {
														?>
															<div class="text-white py-1 px-2 d-inline-block bg-primary sku-btn position-relative" id="<?php echo $sku['id']?>" ><?php echo $sku['sku_name']; ?><span class="material-icons">&#xe5c9;</span></div>
														<?php } ?>

														<script>
															$('.sku-btn .material-icons').click(function(){
																var rowID = $(this).parent().attr('id');
																$.get( "sku-del.php?rowID=" + rowID, function( error ) {
																	if(error == 0){
																		$('.sku-btn#' + rowID).remove();
																	}
																	else{
																		alert('MySQL error!');
																	}
																});
															});
														</script>
													</div>
												<?php } ?>

												<script>
													$('.category-btn .material-icons').click(function(){
														var rowID = $(this).parent().attr('id');
														$.get( "category-del.php?rowID=" + rowID, function( error ) {
															if(error == 0){
																$('.category-btn#' + rowID + '+ div.pl-3').remove();
																$('.category-btn#' + rowID).remove();
															}
															else{
																alert('MySQL error!');
															}
														});
													});
												</script>
											</div>
									<?php
										break;
									}
								?>
							</div>

							<p style="color:red">
								<?php if(!empty($msg)){ echo $msg; }?>
							</p>
						</div>

						<?php if($_GET['add']??'') { ?>
							<div class="col-lg-6">
								<?php
									$add = $_GET['add']??'';
									switch ($add) {
										case 'add-category':	
								?>
											<div class="form-title mb-4">
												<h3 class="text-dark">Category List</h3>
											</div>
				
											<div>
												<?php
													foreach ($catData as $cat) {
												?>
													<div class="text-white py-1 px-2 d-inline-block bg-primary category-btn position-relative" id="<?php echo $cat['id'] ?>"><?php echo $cat['category_name']; ?><span class="material-icons">&#xe5c9;</span></div>
												<?php } ?>

												<script>
													$('.category-btn .material-icons').click(function(){
														var rowID = $(this).parent().attr('id');
														$.get( "category-del.php?rowID=" + rowID, function( error ) {
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
										<?php
											break;
										case 'add-sku':	
										?>
											<div class="form-title mb-4">
												<h3 class="text-dark">SKU List</h3>
											</div>
											
											<ul>
												<?php
													foreach ($catData as $cat) {
												?>
													<li class="text-dark mb-2"><?php echo $cat['category_name']; ?></li>

													<div class="pl-3">
														<?php
															foreach ($cat['sku'] as $sku) {
														?>
															<div class="text-white py-1 px-2 d-inline-block bg-primary sku-btn position-relative" id="<?php echo $sku['id']?>" ><?php echo $sku['sku_name']; ?><span class="material-icons">&#xe5c9;</span></div>
														<?php } ?>

														<script>
															$('.sku-btn .material-icons').click(function(){
																var rowID = $(this).parent().attr('id');
																$.get( "sku-del.php?rowID=" + rowID, function( error ) {
																	if(error == 0) {
																		$('.sku-btn#' + rowID).remove();
																	} else{
																		alert('MySQL error!');
																	}
																});
															});
														</script>
													</div>
												<?php } ?>
											</ul>
										<?php
											break;
										default:
											break;
										}
								?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>