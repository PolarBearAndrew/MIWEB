<?php
    require_once ('config.php');

    $pid = $_GET['product'];
    if($pid !==fales )
    {

      productidGet($pid,$conn);
    }
    else
    {
     echo "error"; 
    }
    function productidGet($pid,$conn)
    {
      if ($pid !== fales)
      {
        $sqlproducetidGet="SELECT * FROM product WHERE prod_cateid='$pid'";
        $result = sqlsrv_query($conn, $sqlproducetidGet);
        //echo "result - " . $result;
      
        $i=0;
        while($obj = sqlsrv_fetch_object( $result)){
          $prodarr= array(prodid => $obj->prodid, 
                          prod_name =>$obj->prod_name, 
                          prod_sname =>$obj->prod_sname, 
                          prod_cateid => $obj->prod_cateid,
                          prod_desc => $obj->prod_desc,
                          height => $obj->height,
                          width => $obj->width,
                          dTotalPage => $obj->dTotalPage,
                          DAddPage => $obj->DAddPage,
                          AddPage => $obj->AddPage,
                          prod_price => $obj->prod_price,
                          EditType => $obj->EditType,
                          ImagePath => $obj->ImagePath,
                          enabled => $obj->enabled,
                          newid => $obj->newid,
                          newdate => $obj->newdate,
                          editid => $obj->editid,
                          editdate => $obj->editdate);

          $prodidbox[$i] = $prodarr;
          //echo $prodidbox[$i]['prodid'];
          $i=$i+1;
        };
        $productarray = array ('PROCDUCT'=>$prodidbox);
        //echo json_encode($productarray);
        echo $_GET['callback']."(".json_encode($productarray).")";

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
      else
      {
        return null;
      }
    }
?>