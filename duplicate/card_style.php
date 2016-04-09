
<?php
require_once ('config.php');

$styleid = $_GET['style'];

// $styleid = 49;

if ($styleid !== fales) {
	productStyleidGet($styleid, $conn);
}
else {
	echo "error";
}

function productStyleidGet($styleid, $conn)
{
	if ($styleid !== fales) {
		$sqlprodStyleidGet = "SELECT * FROM prod_style WHERE prodid='$styleid'";
		$result = sqlsrv_query($conn, $sqlprodStyleidGet);

		// echo "result - " . $result;

		$i = 0;
		while ($obj = sqlsrv_fetch_object($result)) {
			$prodStylearr = array(
				prod_styleid => $obj->prod_styleid,
				prodid => $obj->prodid,
				style_name => $obj->style_name,
				styleheight => $obj->styleheight,
				stylewidth => $obj->stylewidth,
				dTotalPage => $obj->dTotalPage,
				DAddPage => $obj->DAddPage,
				enabled => $obj->enabled,
				sort => $obj->sort,
				vpercent => $obj->vpercent,
				newid => $obj->newid,
				newdate => $obj->newdate,
				editid => $obj->editid,
				editdate => $obj->editdate
			);
			$prodStyleidarr[$i] = $prodStylearr;

			// echo $prodStyleidarr[$i]['prod_styleid'];

			$i = $i + 1;
		};
		$prodStyleidarray = array(
			'prod_style' => $prodStyleidarr
		);

		// echo json_encode($prodStyleidarray);

		echo $_GET['callback'] . "(" . json_encode($prodStyleidarray) . ")";
		/*textid
		objectid
		pageid
		name
		objectheight
		objectwidth
		objectxpos
		objectypos
		text
		charfont
		charsize
		charcolor
		charstrokesize
		charstrokecolor
		charalign
		charbold
		charitalic
		objectkey
		zindex
		rotation
		objectwarning*/
	}
	else {
		return null;
	}
}

?>
