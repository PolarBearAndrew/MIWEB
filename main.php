<?php
    require_once ('config.php');

	//$acc = $_GET['acc'];
    $acc="juya@huaging.com.tw";
    $sql = "SELECT count(memberid) as count FROM member WHERE account='" . $acc . "' and password='rubytest'";
    $result = sqlsrv_query($conn, $sql);
    //echo "result" . $result;
    if($result != fales)
    {
      while( $obj = sqlsrv_fetch_object( $result)) {
      //echo $obj->acc_id . '<br/>';
      echo $obj->count . '<br/>';
	     if($obj->count == 1) echo 'login success !!';
      }
    }

/*
    $sql2 = "SELECT count(memberid) as count FROM member WHERE account='admin' and password='admin'";
    $result2 = sqlsrv_query($conn, $sql2);
    echo "result2" . $result2;
    if($result2 != fales)
    {
      while( $obj2 = sqlsrv_fetch_array( $result2)) {
        echo $obj2['memberid']. '<br/>';
      }
    }

	echo 'success';
*/  
  $mid = MemberidGet($acc,$conn);
  echo "mid =" .$mid;
  $did = DocumentidGet($mid,$conn);
  echo "did =" .$did;
  $pid = DocumentidPgaeGet($did,$conn);
  echo "pid =" .$pid;
  echo "<br/>" ;
  //DocumentidTextGet($pid,$conn);
  //DocumentidBgimgGet($pid,$conn);
    $documentarray = array ('TEXT'=>DocumentidTextGet($pid,$conn),'BGIMG'=>DocumentidBgimgGet($pid,$conn));
echo $documentarray['TEXT']['name'];
    echo json_encode($documentarray);


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
        echo "pid =".$pid;

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


?>
