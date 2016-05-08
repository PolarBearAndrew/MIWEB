
<?php

	$keys = array_keys($_POST);

	$Query = 'SELECT * FROM ' . $_POST['table'];

	// filter
	$tmp = Array();
	for ($i = 0; $i < count($keys); $i++) {
		if($keys[$i] != 'table') {
			array_push($tmp, $keys[$i]);
		}
	}

	// echo print_r($tmp);

?>
