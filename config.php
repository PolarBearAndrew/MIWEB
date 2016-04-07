
<?php
$serverName = "localhost"; //serverName\instanceName
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

// @ $con = odbtp_connect('localhost', 'sa', 'sa', 'miweb') or die;
// $db = new mysqli('localhost','root','huagingmysql','miweb');
// if (mysqli_connect_errno())
// {
//    echo 'Error: Could not connect to database. Please try again later.';
//    exit;
// }

?>
