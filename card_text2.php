<?php
   require_once ('config.php');

    $did = $_GET['document'];
    if($did == 1)
    {
      $pid = 1;
      $documentarray = array ('TEXT'=>DocumentidTextGet($pid,$conn),'BGIMG'=>DocumentidBgimgGet($pid,$conn));
      echo json_encode($documentarray);
    }
    else
    {
     echo "error"; 
    }


    function MemberidGet($acc,$conn)
    {
      if ($acc != fales)
      {
        $sqlMemGet="SELECT memberid FROM member WHERE account='$acc'";
        $result = sqlsrv_query($conn, $sqlMemGet);
          while( $obj = sqlsrv_fetch_object( $result))
          {
            $memberid[] = $obj->memberid;
          }
        $mid= $memberid[0];
        return $mid;
       //$obj = sqlsrv_fetch_object( $result);
      }
      else
      {
        return null;
      }
    }

    function DocumentidGet($mid,$conn)
    {
      if ($mid != fales)
      {
        $sqlDocGet="SELECT documentid FROM document WHERE memberid='$mid'";
        $result = sqlsrv_query($conn, $sqlDocGet);
        //echo "result - " . $result;
          while( $obj = sqlsrv_fetch_object( $result))
          {
            $documentid[] = $obj->documentid;
          }
        $did= $documentid[0];
        return $did;
       //$obj = sqlsrv_fetch_object( $result);
      }
      else
      {
        return null;
      }
    }

    function DocumentidPgaeGet($did,$conn)
    {
      if ($did != fales)
      {
        $sqlPageGet="SELECT pageid FROM document_page WHERE documentid='$did'";
        $result = sqlsrv_query($conn, $sqlPageGet);
        //echo "result - " . $result;
          while( $obj = sqlsrv_fetch_object( $result))
          {
            $pageid[] = $obj->pageid;
          }
        $pid= $pageid[0];
        return $pid;
       //$obj = sqlsrv_fetch_object( $result);
      }
      else
      {
        return null;
      }
    }

    function DocumentidTextGet($pid,$conn)
    {
      if ($pid !== fales)
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
        //$textarray = array ('TEXT'=>$textbox);
        //echo json_encode($textarray);
        return $textbox;
            //echo $text['textid']."<br/>";
            //echo $text['pageid']."<br/>";
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


    function DocumentidBgimgGet($pid,$conn)
    {
      if ($pid !== fales)
      {
        $sqlBgimgGet="SELECT * FROM document_bgimg WHERE pageid='$pid'";
        $result = sqlsrv_query($conn, $sqlBgimgGet);
        //echo "result - " . $result;
        

        $i=0;
        while($obj = sqlsrv_fetch_object( $result)){
          $bgimg= array(bgimgid => $obj->bgimgid, 
                          objectid =>$obj->objectid, 
                          pageid =>$obj->pageid, 
                          name => $obj->name,
                          objectheight => $obj->objectheight,
                          objectwidth => $obj->objectwidth,
                          objectxpos => $obj->objectxpos,
                          objectypos => $obj->objectypos,
                          imagepath => $obj->imagepath,
                          zindex => $obj->zindex);

          $bgimgbox[$i] = $bgimg;
          $i=$i+1;
        };
        //$imgarray= array ('BGIMG'=>$bgimgbox);
        //echo json_encode($imgarray);
        return $bgimgbox;

      }
      else
      {
        return null;
      }
    }


?>