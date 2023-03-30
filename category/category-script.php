<?php
	include('../db.php');

	if(isset($_POST['addcat'])){
		$msg = create_category($con);     
	}

	if(isset($_POST['addskucat'])){
		$msg = create_sku($con);     
	}

	function create_category($con) {
		$category_name = legal_input($_POST['category_name']);
		$query1        = mysqli_query($con, "SELECT * FROM categories WHERE category_name = '$category_name'");
		$row           = mysqli_num_rows($query1);
		if($row > 0) {
			$msg  = "Same Category already exist.";
			return $msg; 
		}

		$query         = $con  -> prepare("INSERT INTO categories (category_name) VALUES (?)");
		$query         -> bind_param('s', $category_name);
		$exec          = $query -> execute();
		if($exec) {
			$msg = " Category was created successfully";
			return $msg;
		} else {
			$msg= "Error: " . $query . "<br>" . mysqli_error($con);
		}
	}

	function create_sku($con){
		$sku_name  = legal_input($_POST['sku_name']);
		$parent_id = legal_input($_POST['parent_id']);

		$query1    = mysqli_query($con, "SELECT * FROM sku WHERE sku_name = '$sku_name'");
		$row       = mysqli_num_rows($query1);

		if($row > 0) {
			$flag = false;
			while ($row = mysqli_fetch_array($query1)) {
				if($row['parent_id'] == $parent_id) {
					$msg  = "Same SKU already exist.";
					$flag = true;
				}
			}
			if($flag) return $msg;
		}

		$query     = $con -> prepare("INSERT INTO sku (parent_id, sku_name) VALUES (?,?)");
		$query     -> bind_param('is', $parent_id, $sku_name);
		$exec      = $query -> execute();

		if($exec){
			$msg = "SKU was created sucessfully.";
			return $msg;
		} else {
			$msg = "Error: " . $query . "<br>" . mysqli_error($con);
		}
	}

	// fetch query
	$catData = fetch_categories($con);

	function fetch_categories($con) { 
		$parent_id = 0;
		$query     = $con -> prepare('SELECT * FROM categories WHERE parent_id = ?');
		$query     -> bind_param('i', $parent_id); 
		$query     -> execute();
		$exec      = $query -> get_result();

		$catData   = [];
		if($exec -> num_rows > 0){
			while($row = $exec -> fetch_assoc()) {
				$catData[] = [
					'id'            => $row['id'],
					'parent_id'     => $row['parent_id'],
					'category_name' => $row['category_name'],
					'sku'           => fetch_sku($con, $row['id'])
				];  
			}
			return $catData;	
		} else{
			return $catData=[];
		}
	}

	// fetch query

	function fetch_sku($con, $parent_id)	{
		$query = $con -> prepare('SELECT * FROM sku WHERE parent_id = ?');
		$query -> bind_param('i', $parent_id); 
		$query -> execute();
		$exec  = $query->get_result();

		$skuData = [];
		if($exec -> num_rows > 0) {
			while($row = $exec -> fetch_assoc())
			{
				$skuData[] = [
					'id'        => $row['id'],
					'parent_id' => $row['parent_id'],
					'sku_name'  => $row['sku_name'],
				];  
			}
			return $skuData;	
		} else {
			return $skuData=[];
		}
	}

	// convert illegal input to legal input
	function legal_input($value) {
		$value = trim($value);
		$value = stripslashes($value);
		$value = htmlspecialchars($value);
		return $value;
	}
?>