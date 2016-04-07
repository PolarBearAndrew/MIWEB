<?php
    require_once ('config.php');

    $did = $_GET['document'];
    if($did == 1)
    {
      $pid = 1;
      DocumentidTextGet($pid,$conn);
    }
    else
    {
     echo "error"; 
    }
    function DocumentidTextGet($pid,$conn)
    {
      if ($pid != fales)
      {
        $sqlTextGet="SELECT * FROM document_text WHERE pageid='$pid'";
        $result = sqlsrv_query($conn, $sqlTextGet);
        //echo "result - " . $result;
      
        $i=0;
        while($obj = sqlsrv_fetch_object( $result)){
          $text= array(textid => $obj->textid, 
                          objectid =>$obj->objectid, 
                          pageid =>$obj->pageid, 
                          name => $obj->name,
                          objectheight => $obj->objectheight,
                          objectwidth => $obj->objectwidth,
                          objectxpos => $obj->objectxpos,
                          objectypos => $obj->objectypos,
                          text => $obj->text,
                          charfont => $obj->charfont,
                          charsize => $obj->charsize,
                          charcolor => $obj->charcolor,
                          charstrokesize => $obj->charstrokesize,
                          charstrokecolor => $obj->charstrokecolor,
                          charalign => $obj->charalign,
                          charbold => $obj->charbold,
                          charitalic => $obj->charitalic,
                          objectkey => $obj->objectkey,
                          zindex => $obj->zindex,
                          rotation => $obj->rotation,
                          objectwarning => $obj->objectwarning);

          $textbox[$i] = $text;
          $i=$i+1;
        };
        $textarray = array ('TEXT'=>$textbox);
        //echo json_encode($textarray);
        echo $_GET['callback']."(".json_encode($textarray).")";

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