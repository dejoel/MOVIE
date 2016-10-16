<?php
include 'tm-inc/func.php';
$id=$_GET['id'] ;
$grab=json_decode(ngegrab('http://api.soundcloud.com/tracks/'.$id.'.json?client_id='.$mapi.''));
$dl=''.getlinkdl($id).'';
$name=$grab->title;
header("Content-Type:audio/mpeg");
header("Content-length:".getfilesize(getlinkdl($id)));
header('Content-Disposition:attachment; filename="'.$name.' ( wapdam.id ).mp3"');
readfile("$dl") ;
header("Content -Transfer-Encoding:binary");
?>