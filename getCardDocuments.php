<?php
require_once('config.php');

$documentId = $_GET['document'];
//$pid=40;
//$pidarray=PageidGet($documentId,$conn);
//$pid=$pidarray['0'];

//Get document Pageid
$sqlPageidGet = "SELECT pageid FROM document_page WHERE documentid='$documentId'";
$params = array();
$options = array(
    "Scrollable" => SQLSRV_CURSOR_KEYSET
);
$stmt = sqlsrv_query($conn, $sqlPageidGet, $params, $options);

$pageidRow = sqlsrv_num_rows($stmt);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$i = 0;

while ($pageidarr = sqlsrv_fetch_array($stmt)) {
  $pageidarrary[$i] = $pageidarr;
  $i = $i + 1;
}
sqlsrv_free_stmt($stmt);

if ($documentId !== fales) {

    for ($i = 0; $i < $pageidRow; $i++) {

        $page[$i] = array(
            'text' => DocumentidTextGet($pageidarrary[$i]['pageid'], $conn),
            'bgimg' => DocumentidBgimgGet($pageidarrary[$i]['pageid'], $conn),
            'image' => DocumentidimageGet($pageidarrary[$i]['pageid'], $conn),
            'illimage' => DocumentidIllimgGet($pageidarrary[$i]['pageid'], $conn),
            'bgimgLayout' => DocumentLayoutBgimgGet($pageidarrary[$i]['pageid'], $conn)
        );

    }
    $documentarray = array(
        'page' => $page
    );
    //echo json_encode($documentarray);
    // echo $_GET['callback'] . "(" . json_encode($documentarray) . ")";
		echo str_replace('@data', json_encode($documentarray), '{ data : @data }');
    //echo $documentarray['page'][0]['text'][0]['textid'];
}
else {
    echo "error";
}


function MemberidGet($acc, $conn) {
    if ($acc != fales) {
        $sqlMemGet = "SELECT memberid FROM member WHERE account='$acc'";
        $result    = sqlsrv_query($conn, $sqlMemGet);
        while ($obj = sqlsrv_fetch_object($result)) {
            $memberid[] = $obj->memberid;
        }
        $mid = $memberid[0];
        return $mid;
        //$obj = sqlsrv_fetch_object( $result);
    } else {
        return null;
    }
}

function PageidGet($documentId, $conn) {
    //echo $documentId;
    if ($documentId !== fales) {
        $sqlPageidGet = "SELECT pageid FROM document_page WHERE documentid='$documentId'";
        $params       = array();
        $options      = array(
            "Scrollable" => SQLSRV_CURSOR_KEYSET
        );
        $stmt         = sqlsrv_query($conn, $sqlPageidGet, $params, $options);

        $pageidRow = sqlsrv_num_rows($stmt);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $pageidarray = sqlsrv_fetch_array($stmt);

        sqlsrv_free_stmt($stmt);
        return $pageidarray;

    }

}


function DocumentidGet($mid, $conn) {
    if ($mid != fales) {
        $sqlDocGet = "SELECT documentid FROM document WHERE memberid='$mid'";
        $result    = sqlsrv_query($conn, $sqlDocGet);
        //echo "result - " . $result;
        while ($obj = sqlsrv_fetch_object($result)) {
            $documentid[] = $obj->documentid;
        }
        $documentId = $documentid[0];
        return $documentId;
        //$obj = sqlsrv_fetch_object( $result);
    } else {
        return null;
    }
}

function DocumentidPgaeGet($documentId, $conn) {
    if ($documentId != fales) {
        $sqlPageGet = "SELECT pageid FROM document_page WHERE documentid='$documentId'";
        $result     = sqlsrv_query($conn, $sqlPageGet);
        //echo "result - " . $result;
        while ($obj = sqlsrv_fetch_object($result)) {
            $pageid[] = $obj->pageid;
        }
        $pid = $pageid[0];
        return $pid;
        //$obj = sqlsrv_fetch_object( $result);
    } else {
        return null;
    }
}

function DocumentidTextGet($pid, $conn) {
    if ($pid !== fales) {
        $sqlTextGet = "SELECT * FROM document_text WHERE pageid='$pid'";
        $result     = sqlsrv_query($conn, $sqlTextGet);
        //echo "result - " . $result;


        $i = 0;
        while ($obj = sqlsrv_fetch_object($result)) {
            $text = array(
                textid => $obj->textid,
                objectid => $obj->objectid,
                pageid => $obj->pageid,
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
                objectwarning => $obj->objectwarning
            );

            $textbox[$i] = $text;
            $i           = $i + 1;
        }
        ;
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
    } else {
        return null;
    }
}


function DocumentidBgimgGet($pid, $conn) {
    if ($pid !== fales) {
        $sqlBgimgGet = "SELECT * FROM document_bgimg WHERE pageid='$pid'";
        $result      = sqlsrv_query($conn, $sqlBgimgGet);
        //echo "result - " . $result;


        $i = 0;
        while ($obj = sqlsrv_fetch_object($result)) {
            $bgimg = array(
                bgimgid => $obj->bgimgid,
                pageid => $obj->pageid,
                objectid => $obj->objectid,
                name => $obj->name,
                objectheight => $obj->objectheight,
                objectwidth => $obj->objectwidth,
                objectxpos => $obj->objectxpos,
                objectypos => $obj->objectypos,
                imagepath => $obj->imagepath,
                zindex => $obj->zindex
            );

            $bgimgbox[$i] = $bgimg;
            $i            = $i + 1;
        }
        ;
        //$imgarray= array ('BGIMG'=>$bgimgbox);
        //echo json_encode($imgarray);
        return $bgimgbox;

    } else {
        return null;
    }
}

function DocumentidimageGet($pid, $conn) {
    if ($pid !== fales) {
        $sqlImageGet = "SELECT * FROM document_image WHERE pageid='$pid'";
        $result      = sqlsrv_query($conn, $sqlImageGet);
        //echo "result - " . $result;


        $i = 0;
        while ($obj = sqlsrv_fetch_object($result)) {
            $image = array(
                imageid => $obj->imageid,
                pageid => $obj->pageid,
                objectid => $obj->objectid,
                name => $obj->name,
                objectheight => $obj->objectheight,
                objectwidth => $obj->objectwidth,
                objectxpos => $obj->objectxpos,
                objectypos => $obj->objectypos,
                imagepath => $obj->imagepath,
                zindex => $obj->zindex,
                cropper => $obj->cropper,
                cutxpos => $obj->cutxpos,
                cutypos => $obj->cutypos,
                cutheight => $obj->cutheight,
                cutwidth => $obj->cutwidth,
                objectkey => $obj->objectkey,
                rotation => $obj->rotation,
                objetctwarning => $obj->objetctwarning,
                picheight => $obj->picheight,
                picwidth => $obj->picwidth,
                reheight => $obj->reheight,
                rewidth => $obj->rewidth,
                diycut => $obj->diycut,
                awidht => $obj->awidht,
                aheight => $obj->aheight
            );

            $imagebox[$i] = $image;
            $i            = $i + 1;
        }
        ;
        //$imgarray= array ('BGIMG'=>$bgimgbox);
        //echo json_encode($imgarray);

        return $imagebox;

    } else {
        return null;
    }
}


function DocumentidIllimgGet($pid, $conn) {
    if ($pid !== fales) {
        $sqlIllimgGet = "SELECT * FROM document_illimg WHERE pageid='$pid'";
        $result       = sqlsrv_query($conn, $sqlIllimgGet);
        //echo "result - " . $result;


        $i = 0;
        while ($obj = sqlsrv_fetch_object($result)) {
            $illimg = array(
                illimgid => $obj->illimgid,
                pageid => $obj->pageid,
                objectid => $obj->objectid,
                name => $obj->name,
                objectheight => $obj->objectheight,
                objectwidth => $obj->objectwidth,
                objectxpos => $obj->objectxpos,
                objectypos => $obj->objectypos,
                imagepath => $obj->imagepath,
                zindex => $obj->zindex,
                cropper => $obj->cropper,
                cutxpos => $obj->cutxpos,
                cutypos => $obj->cutypos,
                cutheight => $obj->cutheight,
                cutwidth => $obj->cutwidth,
                objectkey => $obj->objectkey,
                rotation => $obj->rotation,
                objetctwarning => $obj->objetctwarning,
                picheight => $obj->picheight,
                picwidth => $obj->picwidth,
                reheight => $obj->reheight,
                rewidth => $obj->rewidth,
                diycut => $obj->diycut,
                awidht => $obj->awidht,
                aheight => $obj->aheight
            );

            $illimgbox[$i] = $illimg;
            $i             = $i + 1;
        }
        ;
        //$imgarray= array ('BGIMG'=>$bgimgbox);
        //echo json_encode($imgarray);
        return $illimgbox;

    } else {
        return null;
    }
}


function DocumentLayoutBgimgGet($pid, $conn) {
    if ($pid !== fales) {
        $sqlLayoutBgimgGet = "SELECT * FROM layout_bgimg Where objectheight = '476' and objectwidth = '782' and imagepath LIKE 'LBackground/Business_card/%'";
        $result            = sqlsrv_query($conn, $sqlLayoutBgimgGet);
        //echo "result - " . $result;


        $i = 0;
        while ($obj = sqlsrv_fetch_object($result)) {
            $bgimg = array(
                bgimgid => $obj->bgimgid,
                pageid => $obj->pageid,
                objectid => $obj->objectid,
                name => $obj->name,
                objectheight => $obj->objectheight,
                objectwidth => $obj->objectwidth,
                objectxpos => $obj->objectxpos,
                objectypos => $obj->objectypos,
                imagepath => $obj->imagepath,
                zindex => $obj->zindex
            );


            $bgimgbox[$i] = $bgimg;
            $i            = $i + 1;
        }
        ;
        //$imgarray= array ('BGIMG'=>$bgimgbox);
        //echo json_encode($imgarray);
        return $bgimgbox;

    } else {
        return null;
    }
}

?>
