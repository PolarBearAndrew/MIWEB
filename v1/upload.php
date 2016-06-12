<?php
	$target_dir = "./";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	$check = getimagesize($_FILES["file"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	}
	else {
		echo "File is not an image.";
		$uploadOk = 0;
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
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	}
	else {
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
		}
		else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
?>
