
<?php
$serverName = "localhost"; //serverName\instanceName
$connectionInfo = array(
	"Database" => "miweb",
	"UID" => "miwebsa",
	"PWD" => "SQLmiweb",
	"CharacterSet" => "UTF-8"
);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
	die(print_r(sqlsrv_errors() , true));
}

$host = $_SERVER['HTTP_HOST'];
$uri = trim(dirname($_SERVER['PHP_SELF']) , '/\\');
$sqlcomp = "Select compid,memberType from company where domain='$uri'";
$stmtcomp = sqlsrv_query($conn, $sqlcomp);

if (sqlsrv_fetch($stmtcomp)) {
	$compid = sqlsrv_get_field($stmtcomp, 0);
	$memberType = sqlsrv_get_field($stmtcomp, 1);
}

if (isset($_POST['account']) && isset($_POST['password'])) {

	// if the user has just tried to log in

	$account = $_POST['account'];
	$password = $_POST['password'];
	if (preg_match("/@/", $account)) {
		if ($memberType == 1) {
			$sqlmember = "select memberid,checkauth,compid from member where disabled!=1 and compid=0 and account='$account' and password='$password'";
		}
		elseif ($memberType == 2) {
			$sqlmember = "select memberid,checkauth,compid from member where disabled!=1 and compid='$compid' and account='$account' and password='$password'";
		}

		$stmtmember = sqlsrv_query($conn, $sqlmember);
		if (sqlsrv_fetch($stmtmember)) {
			$memberid = sqlsrv_get_field($stmtmember, 0);
			$checkauth = sqlsrv_get_field($stmtmember, 1);
			$companyid = sqlsrv_get_field($stmtmember, 2);
			if ($checkauth == "True") {
				$_SESSION['memberid'] = $memberid;
				$_SESSION['companyid'] = $companyid; //����member.compid
				$_SESSION['account'] = $account;
			}
			else {
				$errorMessage = "�b�����{�ҡI";
			}
		}
		else {
			$errorMessage = "�b���αK�X���J���~�I";
		}
	}
	else {
		$errorMessage = "�b���αK�X���J���~�I";
	}
}
else {
	$errorMessage = "�п��J�b���M�K�X�I";
}

?>
