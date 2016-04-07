<?php
require_once 'config.php';

// $code = "ok";
// echo $_GET['callback']."(".json_encode($code).")";
// $docid = json_decode($_POST["documentid"]);

/* print_r($GLOBALS['HTTP_RAW_PPOST_DATA']);
$code = "ok";
echo $_GET['callback']."(".json_encode($code).")";
}

*/

if (isset($_POST['save_object_tmp'])) {
	$code = 'ok';

	// echo $_GET['callback']."(".json_encode($code).")";

	echo json_encode($code);
}
else {
	$json = 'test';
	echo json_encode($json);
}

?>
