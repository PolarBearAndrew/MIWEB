<?php

	if($_SESSION['isLogin'] != 'true') {
		$data = array(
			'code' => 304,
			'message' => '需要登入才能進行對應的操作',
		);
		echo json_encode($data);
		return false;
	}

 ?>
