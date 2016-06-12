<?php
	$target_dir = "../images/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$check = getimagesize($_FILES["file"]["tmp_name"]);
	if($check == false) {
		echo json_encode(array(err => "File is not an image."));
		return false;
	}
	// Check file size
	// if ($_FILES["file"]["size"] > 50000000) {
	// 	echo "Sorry, your file is too large.";
	// 	$uploadOk = 0;
	// }
	// Allow certain file formats
	if(
		$imageFileType != "jpg" &&
		$imageFileType != "png" &&
		$imageFileType != "jpeg" &&
		$imageFileType != "gif"
	) {
		echo json_encode(array(err => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."));
		return false;
	}
	else {
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			echo json_encode(array(path => '/images/'.basename( $_FILES["file"]["name"])));
			return true;
		}
		else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
?>
