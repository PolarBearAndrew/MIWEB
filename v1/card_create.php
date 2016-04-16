
<?php

require_once 'init.php';
require_once 'validateLogin.php';

date_default_timezone_set('Asia/Taipei');
$date = date('Y-m-d H:i:s');

// echo $date;

$layoutid = $_GET['layout'];

// SELECT * FROM layout LEFT JOIN layout_page ON layout.layoutid = layout_page.layoutid where layout_page.layoutid = '610'

$sqlLayout = "SELECT * FROM layout LEFT JOIN layout_page ON layout.layoutid = layout_page.layoutid where layout_page.layoutid = '$layoutid'";
$stmt = sqlsrv_query($conn, $sqlLayout);

if ($stmt === false) {
	die(print_r(sqlsrv_errors() , true));
}

$layout_array = sqlsrv_fetch_array($stmt);
sqlsrv_free_stmt($stmt);
$subcateid = $layout_array['subcateid'];
$prodid = prodidGet($subcateid, $conn);

// insert into publish values ('3','0','1','47',null,null,'未命名',null,null,'0','0','0','2015-11-29 12:19:59.192',null);

$sql = 'INSERT INTO publish values (? ,? ,? ,? ,?, ? , ?, ?, ?, ?, ?, ?, ?, ?)';
$params = array(
	'2',
	'0',
	'1',
	$prodid,
	null,
	null,
	'未命名',
	null,
	null,
	'0',
	'0',
	'0',
	'2015-11-29 12:19:59.000',
	null
);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
	die(print_r(sqlsrv_errors() , true));
}
else {
	$table = 'publish';
	$publishid = lastidGet($table, $conn);
}

sqlsrv_free_stmt($stmt);
$sql2 = 'INSERT INTO document values (? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,?)';
$params2 = array(
	'3',
	$publishid,
	$subcateid,
	$layout_array['layoutheight'],
	$layout_array['layoutwidth'],
	$layout_array['idCount'],
	$layout_array['dTotalPage'],
	$layout_array['DAddPage'],
	$layout_array['AddPage'],
	'2015-11-29 12:19:59.000',
	'名片',
	null,
	'3',
);
$stmt = sqlsrv_query($conn, $sql2, $params2);

if ($stmt === false) {
	die(print_r(sqlsrv_errors() , true));
}
else {
	$table = 'document';
	$documentid = lastidGet($table, $conn);
}

sqlsrv_free_stmt($stmt);
$sqlDocumentPageInsert = 'INSERT INTO document_page values (?, ?)';
$paramsDocumentPageInsert = array(
	'1',
	$documentid
);
$stmt = sqlsrv_query($conn, $sqlDocumentPageInsert, $paramsDocumentPageInsert);

if ($stmt === false) {
	die(print_r(sqlsrv_errors() , true));
}
else {
	$table = 'document_page';
	$pageid = lastidGet($table, $conn);
}

sqlsrv_free_stmt($stmt);
$sqlLayoutBgimgGet = "SELECT * FROM layout_bgimg where pageid ='{$layout_array['pageid']}'";
$sqlLayoutIllimgGet = "SELECT * FROM layout_illimg where pageid ='{$layout_array['pageid']}'";
$sqlLayoutImageGet = "SELECT * FROM layout_image where pageid ='{$layout_array['pageid']}'";
$sqlLayoutTextGet = "SELECT * FROM layout_text where pageid ='{$layout_array['pageid']}'";
$LayoutBgimgArray = layoutArrayGet($sqlLayoutBgimgGet, $conn);
$LayoutIllimgArray = layoutArrayGet($sqlLayoutIllimgGet, $conn);
$LayoutImageArray = layoutArrayGet($sqlLayoutImageGet, $conn);
$LayoutBgimgRow = layoutRowGet($sqlLayoutBgimgGet, $conn);
$LayoutIllimgRow = layoutRowGet($sqlLayoutIllimgGet, $conn);
$LayoutImageRow = layoutRowGet($sqlLayoutImageGet, $conn);

// layout Text select getting array and row.

$params = array();
$options = array(
	'Scrollable' => SQLSRV_CURSOR_KEYSET
);
$stmt = sqlsrv_query($conn, $sqlLayoutTextGet, $params, $options);
$LayoutTextRow = sqlsrv_num_rows($stmt);

if ($stmt === false) {
	die(print_r(sqlsrv_errors() , true));
}

$i = 0;

while ($array = sqlsrv_fetch_array($stmt)) {
	$LayoutTextrray[$i] = $array;
	$i = $i + 1;
}

sqlsrv_free_stmt($stmt);

// $LayoutTextrray = layoutArrayGet($sqlLayoutTextGet,$conn);

DocutentArrayInsert($LayoutBgimgArray, $LayoutBgimgRow, $LayoutIllimgArray, $LayoutIllimgRow, $LayoutImageArray, $LayoutImageRow, $LayoutTextrray, $LayoutTextRow, $pageid, $conn);
$document_arrya = array(
	'documentid' => $documentid
);
echo $_GET['callback'] . '(' . json_encode($document_arrya) . ')';

function DocutentArrayInsert($LayoutBgimgArray, $LayoutBgimgRow, $LayoutIllimgArray, $LayoutIllimgRow, $LayoutImageArray, $LayoutImageRow, $LayoutTextrray, $LayoutTextRow, $pageid, $conn)
{

	// bgimg

	if ($LayoutBgimgRow != 0) {
		$sqlDocumentBgimgInsert = 'INSERT INTO document_bgimg values (?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$paramsDocumentBgimgInsert = array(
			$pageid,
			$LayoutBgimgArray['objectid'],
			$LayoutBgimgArray['name'],
			$LayoutBgimgArray['objectheight'],
			$LayoutBgimgArray['objectwidth'],
			$LayoutBgimgArray['objectxpos'],
			$LayoutBgimgArray['objectypos'],
			$LayoutBgimgArray['imagepath'],
			$LayoutBgimgArray['zindex'],
		);
		$stmt = sqlsrv_query($conn, $sqlDocumentBgimgInsert, $paramsDocumentBgimgInsert);
		if ($stmt === false) {
			die(print_r(sqlsrv_errors() , true));
		}

		/*else
		{
		echo"bgimg ok" . "</br>";
		}

		sqlsrv_free_stmt( $stmt);
		}
		else
		{
		echo "bgimg is null </br>";*/
	}

	// illimg

	if ($LayoutIllimgRow != 0) {
		$sqlDocumentillimgInsert = 'INSERT INTO document_illimg values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$paramsDocumentillimgInsert = array(
			$pageid,
			$LayoutIllimgArray['objectid'],
			$LayoutIllimgArray['name'],
			$LayoutIllimgArray['objectheight'],
			$LayoutIllimgArray['objectwidth'],
			$LayoutIllimgArray['objectxpos'],
			$LayoutIllimgArray['objectypos'],
			$LayoutIllimgArray['imagepath'],
			$LayoutIllimgArray['zindex'],
			$LayoutIllimgArray['cropper'],
			$LayoutIllimgArray['cutxpos'],
			$LayoutIllimgArray['cutypos'],
			$LayoutIllimgArray['cutheight'],
			$LayoutIllimgArray['cutwidth'],
			$LayoutIllimgArray['objectkey'],
			$LayoutIllimgArray['rotation'],
			$LayoutIllimgArray['objectwarning'],
			$LayoutIllimgArray['picheight'],
			$LayoutIllimgArray['picwidth'],
			$LayoutIllimgArray['reheight'],
			$LayoutIllimgArray['rewidth'],
			$LayoutIllimgArray['diycut'],
			$LayoutIllimgArray['awidth'],
			$LayoutIllimgArray['aheight'],
		);
		$stmt = sqlsrv_query($conn, $sqlDocumentillimgInsert, $paramsDocumentillimgInsert);
		if ($stmt === false) {
			die(print_r(sqlsrv_errors() , true));
		}

		/*else
		{
		echo "illimg ok" . "</br>";
		}

		sqlsrv_free_stmt( $stmt);
		}
		else
		{
		echo "illimg is null . </br>";*/
	}

	// image

	if ($LayoutImageRow != 0) {
		$sqlDocumentImageInsert = 'INSERT INTO document_image values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$paramsDocumentImageInsert = array(
			$pageid,
			$LayoutImageArray['objectid'],
			$LayoutImageArray['name'],
			$LayoutImageArray['objectheight'],
			$LayoutImageArray['objectwidth'],
			$LayoutImageArray['objectxpos'],
			$LayoutImageArray['objectypos'],
			$LayoutImageArray['imagepath'],
			$LayoutImageArray['zindex'],
			$LayoutImageArray['cropper'],
			$LayoutImageArray['cutxpos'],
			$LayoutImageArray['cutypos'],
			$LayoutImageArray['cutheight'],
			$LayoutImageArray['cutwidth'],
			$LayoutImageArray['objectkey'],
			$LayoutImageArray['rotation'],
			$LayoutImageArray['objectwarning'],
			$LayoutImageArray['picheight'],
			$LayoutImageArray['picwidth'],
			$LayoutImageArray['reheight'],
			$LayoutImageArray['rewidth'],
			$LayoutImageArray['diycut'],
			$LayoutImageArray['awidth'],
			$LayoutImageArray['aheight'],
		);
		$stmt = sqlsrv_query($conn, $sqlDocumentImageInsert, $paramsDocumentImageInsert);
		if ($stmt === false) {
			die(print_r(sqlsrv_errors() , true));
		}

		/*else
		{
		echo "image ok" . "</br>";
		}

		sqlsrv_free_stmt( $stmt);
		}
		else
		{
		echo "image is null </br>";*/
	}

	// text

	if ($LayoutTextRow != 0) {
		for ($i = 0; $i < $LayoutTextRow; ++$i) {
			$sqlDocumentTextInsert = 'INSERT INTO document_text values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
			$paramsDocumentTextInsert = array(
				$LayoutTextrray[$i]['objectid'],
				$pageid,
				$LayoutTextrray[$i]['name'],
				$LayoutTextrray[$i]['objectheight'],
				$LayoutTextrray[$i]['objectwidth'],
				$LayoutTextrray[$i]['objectxpos'],
				$LayoutTextrray[$i]['objectypos'],
				$LayoutTextrray[$i]['text'],
				$LayoutTextrray[$i]['charfont'],
				$LayoutTextrray[$i]['charsize'],
				$LayoutTextrray[$i]['charcolor'],
				$LayoutTextrray[$i]['charstrokesize'],
				$LayoutTextrray[$i]['charstrokecolor'],
				$LayoutTextrray[$i]['charalign'],
				$LayoutTextrray[$i]['charbold'],
				$LayoutTextrray[$i]['charitalic'],
				$LayoutTextrray[$i]['objectkey'],
				$LayoutTextrray[$i]['zindex'],
				$LayoutTextrray[$i]['rotation'],
				$LayoutTextrray[$i]['objectwarning'],
			);
			$stmt = sqlsrv_query($conn, $sqlDocumentTextInsert, $paramsDocumentTextInsert);
			if ($stmt === false) {
				die(print_r(sqlsrv_errors() , true));
			}

			/*else{
			echo "text $i ok" . "</br>";
			}

			sqlsrv_free_stmt( $stmt);
			}
			}
			else
			{
			echo "text in null </br>";*/
		}
	}
}

function layoutArrayGet($sql, $conn)
{
	$stmt = sqlsrv_query($conn, $sql);
	if ($stmt === false) {
		die(print_r(sqlsrv_errors() , true));
	}

	$layoutObject_array = sqlsrv_fetch_array($stmt);
	sqlsrv_free_stmt($stmt);
	return $layoutObject_array;
}

function layoutRowGet($sql, $conn)
{
	$params = array();
	$options = array(
		'Scrollable' => SQLSRV_CURSOR_KEYSET
	);
	$stmt = sqlsrv_query($conn, $sql, $params, $options);
	if ($stmt === false) {
		die(print_r(sqlsrv_errors() , true));
	}

	$num_rows = sqlsrv_num_rows($stmt);
	sqlsrv_free_stmt($stmt);
	return $num_rows;
}

function lastidGet($table, $conn)
{
	$sql = "SELECT IDENT_CURRENT('$table') AS 'id'";
	$result = sqlsrv_query($conn, $sql);
	$LastID = sqlsrv_fetch_array($result);
	$LastID = $LastID['id'];
	return $LastID;
}

function prodidGet($subcateid, $conn)
{
	$sqlProdStyleidGet = "SELECT prodid from prod_style WHERE prod_styleid='$subcateid'";
	$result = sqlsrv_query($conn, $sqlProdStyleidGet);
	$obj = sqlsrv_fetch_object($result);
	$prodid = $obj->prodid;
	return $prodid;
}
