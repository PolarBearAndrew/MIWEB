
<?php

	require_once ('config.php');
	// require_once ('validateLogin.php');

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

	// echo $Query;

	$params = array();
	$options = array(
		"Scrollable" => SQLSRV_CURSOR_KEYSET
	);
	$result = sqlsrv_query($conn, $Query, $params, $options);

	if ($result === false) {
		die(print_r(sqlsrv_errors() , true));
	}
	else {
		$data = Array();
		while ($row = sqlsrv_fetch_array($result)) {
			array_push($data, $row);
		}
		$data = array(
			'data' => $data
		);

		echo json_encode($data);
		echo $data;
	}
?>
