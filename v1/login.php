<?php

	// init
	require_once ('init.php');


	// already login
	if($_SESSION['isLogin'] != 'true') {
		return echo json_encode({ login : true });
	}

	// validate params
	if (
		!isset($_POST['account']) &&
		!isset($_POST['password'])
	) {
		return echo json_encode({ login : false });
	}

	// validate users
	$account = $_POST['account'];
	$password = $_POST['password'];

	if ($memberType == 1) {
		$sqlmember = "select memberid,checkauth,compid from member where disabled!=1 and compid=0 and account='$account' and password='$password'";
	}
	elseif ($memberType == 2) {
		$sqlmember = "select memberid,checkauth,compid from member where disabled!=1 and compid='$compid' and account='$account' and password='$password'";
	}

	$stmtmember = sqlsrv_query($conn, $sqlmember);

	if (sqlsrv_fetch($stmtmember)) {
		return echo json_encode({ login : false });
	}

	$memberid = sqlsrv_get_field($stmtmember, 0);
	$checkauth = sqlsrv_get_field($stmtmember, 1);
	$companyid = sqlsrv_get_field($stmtmember, 2);

	if ($checkauth != "True") {
		return echo json_encode({ login : false });
	}

	$_SESSION['memberid'] = $memberid;
	$_SESSION['companyid'] = $companyid;
	$_SESSION['account'] = $account;

	return echo json_encode({ login : true });


?>
