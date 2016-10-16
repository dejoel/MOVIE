<?php
include'tm-inc/func.php';
$comment =  'Wapdam Search Music dan Video';
$default_artist = 'Wapdam.id';
$default_album = 'Wapdam Collections';
$default_year = date("Y");
$id=$_GET['id'];
$situs='http://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'].'';
$url=''.$_SERVER['REQUEST_URI'].'';
$grab=json_decode(ngegrab('http://api.soundcloud.com/tracks/'.$id.'.json?client_id='.$mapi.''));
$duration=format_time($grab->duration/1000);
$useride=$grab->user_id;
$datauser=json_decode(ngegrab('http://api.soundcloud.com/users/'.$useride.'.json?client_id='.$mapi.''));
$userpermalink=$datauser->permalink_url;
$usernama=$datauser->username;
$useravatar=$datauser->avatar_url;
if(!empty($grab->genre)){
$genre=$grab->genre;
}else{
$genre='Wapdam Collections';
}
if(!empty($grab->artwork_url)){
$thumb=$grab->artwork_url;
}else{
$thumb='/tm-content/no_thumbnail.png';
}
if(!empty($grab->label_name)){
$label=$grab->label_name;
}else{
$label='-';
}
if(!empty($grab->release_year)){
$release=$grab->release_year;
}else{
$release='-';
}
$playcount=$grab->playback_count;
$downcount=$grab->download_count;
$like=$grab->favoritings_count;
$name=$grab->title;
$remove = "'";
$tfkmedia = str_replace($remove, "", ucwords($name));
$deskripsi=$grab->description;
$size=format_size(getfilesize(getlinkdl($id)));
if(!empty($name) && !empty($_GET['id']) && !empty($_GET['permalink'])){
$title='Download Lagu '.$name.' Mp3 Gratis';
$description =' Download Lagu '.$name.'.mp3 Gratis - '.$name.' ('.$size.') '.$duration.' free for download';
$keywords ='download  mp3, download lagu '.$name.', gratis, mp3 gratis, 3gp  '.$name.' download full album';

include'tm-inc/head.php';
include 'tm-inc/head-m.php';

echo '<div class="ngiri"><h1 class="title_a" align="justify"><b>'.$name.'</b>
<br>Source: www.soundcloud.com</h1>
<div class="file"><table class="otable"><tbody><tr><td width="110" height="110"><img src="'.$thumb.'" alt="Cover Lagu - '.$name.'" width="100" height="100"></td><td> Download Lagu '.$name.' secara gratis langsung dari perangkat anda.
<br>Dengan Catatan: Lagu '.$name.' hanya sebagai sebuah review saja. untuk mendapatkan lagu ini secara Legal, belilah CD originalnya dan gunakanlah i- Ring / RBT / NSPnya atau anda juga bisa membelinya juga di iTunes. </td></tr>
</tbody></table>
<table class="otable" style="width:100%"><tbody>
<tr valign="top"> <td width="30%">Judul</td><td> : </td><td>'.$tfkmedia.'</td></tr>
<tr valign="top"> <td width="30%">Durasi</td><td> : </td><td>'.$duration.'</td></tr>
<tr valign="top"> <td width="30%">Ukuran</td><td> : </td><td>'.$size.'</td></tr>
<tr valign="top"> <td width="30%">BitRate</td><td> : </td><td>128kpbs</td></tr>
<tr valign="top"> <td width="30%">Genre</td><td> : </td><td><span style="color: #c66;text-shadow:1px 1px 1px white; font-weight: bold;">   '.$genre.'</span></a></td></tr>
<tr valign="top"> <td width="30%">Diputar</td><td> : </td><td>'.$playcount.' kali</td></tr>
</tbody></table>';
echo '<div class="file"><a href="/unduhmp3/'.$id.'.mp3" title="'.$name.'" target="_blank" rel="nofollow"> 
<div class="dbutton" align="center"><img src="/tm-content/dwnld.png" style="vertical-align:middle;width:18px;" name="mp3"><b> Download Now ( '.$size.' ) </b></div></a></div>
<div class="advinfo"> Terimah kasih karena sudah mengunduh musik <i> "'.$tfkmedia.'.mp3" </i></div>';
echo'</div></div></center>';
$relartist = explode(' ',trim($name));
$relartist = explode(' ',trim($name));
$relartist = str_replace('-','', $relartist);
$jsonr=json_decode(ngegrab('http://api.soundcloud.com/tracks.json?q='.$relartist[0].'&limit=12&offset=0&client_id='.$mapi.''));

if (!empty($jsonr[0]->title)){
echo'<div class="nganan"><div class="title2"> Related Song </div><div class="menu"><ol type="1"> 
';foreach($jsonr as $list){$idr=$list->id;$permalinkr=$list->permalink;$namer=$list->title;

echo'<li><a href="/v/'.$idr.'/'.$permalinkr.'.html"> '.$namer.'.mp3</a></li>';
}
}
}else{
$title='Not Found';
include'head.php';
echo'<div class="file">Maaf, data tidak ditemukan, silahkan cari yang lain</div>';
}
echo'</div></div>';
include'tm-inc/foot.php';
?>
 