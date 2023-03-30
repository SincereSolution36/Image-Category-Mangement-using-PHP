<?php
	include('../db.php');

	if(isset($_POST['addtag'])){
		$msg = create_tag($con);     
	}
	function create_tag($con) {
		$tag_name = legal_input($_POST['tag_name']);
		$query1        = mysqli_query($con, "SELECT * FROM tag WHERE tag_name = '$tag_name'");
		$row           = mysqli_num_rows($query1);
		if($row > 0) {
			$msg  = "Same Tag already exist.";
			return $msg; 
		}

		$query         = $con  -> prepare("INSERT INTO tag (tag_name) VALUES (?)");
		$query         -> bind_param('s', $tag_name);
		$exec          = $query -> execute();
		if($exec) {
			$msg = "Tag was created successfully";
			return $msg;
		} else {
			$msg= "Error: " . $query . "<br>" . mysqli_error($con);
		}
	}

	// fetch query
	$tagData = fetch_tag($con);

	function fetch_tag($con) {
		$query = $con -> prepare('SELECT * FROM tag');
		$query -> execute();
		$exec  = $query -> get_result();

		$tagData   = [];
		if($exec -> num_rows > 0){
			while($row = $exec -> fetch_assoc()) {
				$tagData[] = [
					'id'       => $row['id'],
					'tag_name' => $row['tag_name']
				];  
			}
			return $tagData;	
		} else{
			return $tagData=[];
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