
<?php

	$keys = array_keys($_POST);

	$Query = 'SELECT @fields FROM ' . $_POST['table'];

	// filter
	$tmp = Array();
	for ($i = 0; $i < count($keys); $i++) {
		if(
			$keys[$i] != 'table' &&
			$keys[$i] != 'where'
		) {
			array_push($tmp, $keys[$i]);
		}
	}
	$keys = $tmp;

	// replace fields
	$fields = '';
	for ($i = 0; $i < count($keys); $i++) {
		if($i != 0) {
			$fields = $fields . ', ';
		}
		$fields = $fields . $keys[$i];
	}
	$Query = str_replace("@fields", $fields, $Query);

	// replace where
	if($_POST['where']) {
		$where = ' WHERE ';
		$whereFields = array_keys($_POST['where']);
		for ($i = 0; $i < count($whereFields); $i++) {
			if($i != 0) {
				$where = $where . ' AND ';
			}
			$key = $whereFields[$i];
			$where = $where . $key . ' = ' . $_POST['where'][$key];
		}
		$Query = $Query . $where;
	}

	echo $Query;

?>
