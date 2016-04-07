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
	if($_SESSION['isLogin'] == 'true') {
		return resData(true, 'Already Login');
	}

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

	if ($memberType == 1) {
		$sqlmember = "select memberid,checkauth,compid from member where disabled!=1 and compid=0 and account='$account' and password='$password' and checkauth=1";
	}
	elseif ($memberType == 2) {
		$sqlmember = "select memberid,checkauth,compid from member where disabled!=1 and compid='$compid' and account='$account' and password='$password' and checkauth=1";
	}

	$stmtmember = sqlsrv_query($conn, $sqlmember);

	if (sqlsrv_fetch($stmtmember)) {
		return resData(false, 'Validate fail');
	}

	// if ($checkauth != 1) {
	// 	return resData(false, 'Auth validate fail');
	// }

	$_SESSION['memberid'] = sqlsrv_get_field($stmtmember, 0);
	$_SESSION['companyid'] = sqlsrv_get_field($stmtmember, 1);
	$_SESSION['account'] = sqlsrv_get_field($stmtmember, 2);

	return resData(true, 'Login success');

?>
