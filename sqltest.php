<?php

  require_once ('config.php');


$sqlLayoutTextGet = "SELECT * FROM layout_text where pageid ='2660'";

//$stmt = sqlsrv_query( $conn, $sqlLayoutTextGet ,array( "Scrollable" => SQLSRV_CURSOR_KEYSET ) );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sqlLayoutTextGet  , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count.";
else
   echo $row_count;
$i = 0;

while($array = sqlsrv_fetch_array($stmt)){
$Text_array[$i] = $array;
$i=$i+1;
}
echo $Text_array;

sqlsrv_free_stmt( $stmt);

?>