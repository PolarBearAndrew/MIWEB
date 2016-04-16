
<?php
require_once ('config.php');

$name = $_GET['name'];
$page = $_GET['page'];
$pageStart = ($page - 1) * 20 + 1;
$pageShow = $pageStart + 20 - 1;

// $name = Business_card_H_F;

if ($name !== fales && $page !== false) {
	productLayoutGet($name, $conn, $pageStart, $pageShow);
}
else {
	echo "error";
}

function productLayoutGet($name, $conn, $pageStart, $pageShow)
{
	if ($name !== fales) {
		$sqlProdidGet = "SELECT prodid FROM product WHERE prod_sname = '$name'";
		$result = sqlsrv_query($conn, $sqlProdidGet);

		// echo "result - " . $result;

		$obj = sqlsrv_fetch_object($result);
		$prodid = $obj->prodid;
		if ($prodid !== flase) {
			$sqlProdStyleidGet = "SELECT prod_styleid FROM prod_style WHERE prodid = '$prodid'";
			$result2 = sqlsrv_query($conn, $sqlProdStyleidGet);

			// echo "result - " . $result;

			$obj2 = sqlsrv_fetch_object($result2);
			$prodStyleid = $obj2->prod_styleid;

			// echo $prodStyleid;

			if ($prodStyleid !== fales) {

				// $sqlLayoutGet="SELECT * FROM layout WHERE subcateid = '$prodStyleid'";
				// $sqlLayoutGet="SELECT * FROM layout LEFT JOIN layout_page ON layout.layoutid = layout_page.layoutid WHERE subcateid = '$prodStyleid'";

				$sqlLayoutGet = "SELECT * FROM ( SELECT ROW_NUMBER() over (order by layoutid) rownum,* from layout where subcateid = '$prodStyleid') as layout LEFT JOIN layout_page ON layout.layoutid = layout_page.layoutid  WHERE  subcateid = '$prodStyleid' and rownum between '$pageStart' and '$pageShow'";
				$result3 = sqlsrv_query($conn, $sqlLayoutGet);

				// echo "result - " . $result3;

				$i = 0;
				while ($obj3 = sqlsrv_fetch_object($result3)) {
					$layoutarr = array(
						layoutid => $obj3->layoutid,
						subcateid => $obj3->subcateid,
						layoutheight => $obj3->layoutheight,
						layoutwidth => $obj3->layoutwidth,
						idCount => $obj3->idCount,
						dTotalPage => $obj3->dTotalPage,
						DAddPage => $obj3->DAddPage,
						AddPage => $obj3->AddPage,
						layoutname => $obj3->layoutname,
						vpercent => $obj3->vpercent,
						sort => $obj3->sort,
						enabled => $obj3->enabled,
						newid => $obj3->newid,
						newdate => $obj3->newdate,
						editid => $obj3->editid,
						editdate => $obj3->editdate,
						pageid => $obj3->pageid,
						pageno => $obj3->pageno
					);
					$layoutbox[$i] = $layoutarr;

					// echo $layoutarr[$i]['layoutid']."<br/>";

					$i = $i + 1;
				};
				$layoutarray = array(
					'Layout' => $layoutbox
				);

				echo json_encode($prodStyleidarray);

				// echo $_GET['callback'] . "(" . json_encode($layoutarray) . ")";
			}
		}
	}
	else {
		return null;
	}
}

?>
