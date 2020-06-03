<?php

if(!isset($_GET['c4T1ty4Rt4641tY6ge2v41Ib462G54wu6750n651oM0I6851i0ve6Y15'])) exit;

$file_id = 'arquivo';

if(!$_FILES[$file_id]['name']) die('1');

$file_title = $_FILES[$file_id]['name'];

$exp = explode('.',$file_title);
if(count($exp) < 2)
    die('2');
$ext = strtolower(end($exp));

$uniqer = substr(md5(uniqid(rand(),1)),0,5);
$file_name = $uniqer . '_' . substr(sha1($file_title),0,6).".".$ext;
$uploadfile = $file_name;

$result = '';

if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)){
    die('3');
} else {
    if(!$_FILES[$file_id]['size']) { //Check if the file is made
        @unlink($uploadfile);//Delete the Empty file
        die('4');
    } else {
        chmod($uploadfile,0777);//Make it universally writable.
    }
}


$retorno = array(
	'erro'=>false,
	'arquivo'=>'/static/gabrieluploads/'.$file_name,
);

echo json_encode($retorno);
exit;
?>