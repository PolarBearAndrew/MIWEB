
<?php

require_once ('config.php');

if (isset($_POST['myData'])) {
	$json = $_POST['myData'];
	var_dump(json_decode($json, true));
}
else {
	echo "Noooooooob";
}

/*
if(isset($_POST['myData'])) {
$json = $_POST['myData'];

// var_dump(json_decode($json, true));

echo $_GET['callback']."(".json_encode(json_decode($json, true)).")";
} else {
$json = "jsonp not find.";
echo $_GET['callback']."(".json_encode($json).")";
}

*/

// $code = "ok";
// echo $_GET['callback']."(".json_encode($code).")";
// $docid = json_decode($_POST["documentid"]);
// echo printf($GLOBALS['HTTP_RAW_PPOST_DATA']);
// $code = "ok";
// echo $_GET['callback']."(".json_encode($code).")";
// $code = "ok";
// echo $_GET['callback']."(".json_encode($GLOBALS['HTTP_RAW_POST_DATA']).")";
// echo $_GET['callback']."(".json_encode($_POST['callback']).")";
// if(isset($_POST['myData']))
// {
//	$code = "ok";
// echo $_GET['callback']."(".json_encode($code).")";
// }
// else
// {
// $code = "fail";
// echo $_GET['callback']."(".json_encode($code).")";
// }

?>
