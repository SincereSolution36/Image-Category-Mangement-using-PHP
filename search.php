<?php
	include('db.php');
	
	// fetch query
	$imgData = fetch_image($con);
	
	function fetch_image($con) { 
		$sql = "SELECT id, file_name, category, sku, tag FROM images WHERE file_name LIKE '%" . $_POST['query'] . "%' LIMIT 20";
		$resultset = mysqli_query($con, $sql) or die("database error:" . mysqli_error($con));
		$array = array();
		while( $rows = mysqli_fetch_assoc($resultset) ) {	
			$array [] = array(
				"id"        => $rows['id'],
				"file_name" => $rows['file_name'],
			);
		}

		return $array;
	}

	echo json_encode($imgData);
?>