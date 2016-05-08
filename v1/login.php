<?php

	// const
	$METHOD = 'POST';

	// init
	require_once ('init.php');

	function resData($login, $msg) {
		$data = array(
			'login' => $login,
			'message' => $msg,
		);
		echo json_encode($data);
	}

	if($_SERVER['REQUEST_METHOD'] != $METHOD) {
		return;
	}

	// already login
	// if($_SESSION['isLogin'] == 'true') {
	// 	return resData(true, 'Already Login');
	// }

	// validate params
	if (
		!isset($_POST['account']) &&
		!isset($_POST['password'])
	) {
		return resData(false, 'Params validate fail');
	}

	// validate users
	$account = $_POST['account'];
	$password = $_POST['password'];

	$Query = "select memberid,compid, account from member where account='$account' and password='$password'";

	$params = array();
	$options = array(
		"Scrollable" => SQLSRV_CURSOR_KEYSET
	);
	$result = sqlsrv_query($conn, $Query, $params, $options);


	if (!sqlsrv_fetch($result)) {
		return resData(false, 'Validate fail');
	}


	$_SESSION['memberid'] = sqlsrv_get_field($result, 0);
	$_SESSION['companyid'] = sqlsrv_get_field($result, 1);
	$_SESSION['account'] = sqlsrv_get_field($result, 2);

	return resData(true, 'Login success');

?>
