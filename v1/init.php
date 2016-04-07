
<?php

// ----------------------
//  db connection
// ----------------------
$serverName = "localhost";
$connectionInfo = array(
	"Database" => "miweb",
	"UID" => "mobilesa",
	"PWD" => "mobile2015",
	"CharacterSet" => "UTF-8"
);
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
	die(print_r(sqlsrv_errors() , true));
}

// ----------------------
//  session
// ----------------------

session_start();
if($_SESSION['isLogin'] != 'true') {
	$_SESSION['isLogin'] = 'false';
}

?>
