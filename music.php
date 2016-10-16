<?php
include'tm-inc/func.php';
if(!empty($_GET['genre'])){
$title='Free Download Music '.queryencode($_GET['genre']).''; 
}
$title='Free Downloads Music '.queryencode($_GET['genre']).''; 
 
if(!empty($_GET['genre'])){
$genrer=str_replace(' ',',',strtolower($_GET['genre']));
$genrer=str_replace('_',',',$genrer);
$genrer=str_replace('-',',',$genrer);
$genre = $_GET['genre'];
}else{
$q=queryencode($_GET['q']);
$artist = array('Demi Lovato','cakra khan','Trio Ubur - Ubur','Michael Heart','Utopia','Shae','Dangdut Koplo','Om Sera','Sagita','soimah','jkt48','iwan fals','T2','slank','goyang morena','syahrini','jupe','tony q rastafara','reggae','laluna','kotak','radja','naff','afgan','ungu','nidji','avril lavigne','gun n roses','tarzan boys','ada band','geisha','agnes monica','dmasiv','dbagindas','simple plan','green day','Inka Christie','nike ardila','doel sumbang','didi kempot','sopsan','bondan','jupe','pallapa','adista band','dadali band','killing me inside','last child');
$no = rand(0,count($artist));
$keyword = $artist[$no];
$title ='Free Download Lagu '.$q.''; 
$description ='Download Lagu '.$q.'.mp3 Gratis Terbaru - Download lagu '.$q.' Gratis terbaru mp3';
$keywords ='download '.$q.' mp3, download lagu , gratis, mp3 gratis, 3gp '.$q.' , download full album '.$q.'';

include'tm-inc/head.php';
include 'tm-inc/head-m.php';
 
$q = $q ? $q : $keyword;
}
if(!empty($_GET['page'])){
$noPage=$_GET['page'];
$page=($noPage-1)*12;
}else{
$noPage='1';
$page='0';
}
if(!empty($_GET['genre'])){
$json=json_decode(ngegrab('http://api.soundcloud.com/tracks.json?genres='.$genre.'&limit=20&offset='.$page.'&client_id='.$mapi.''));
}else{
$json=json_decode(ngegrab('http://api.soundcloud.com/tracks.json?q='.str_replace(' ','-',$q).'&limit=20&offset='.$page.'&client_id='.$mapi.''));
}
echo'<div class="ngiri"><h1 class="biru"><b> Search Results for » '.$q.' '.$genre.'</b></h1><div class="menu"><table width="100%" class="otable"><tbody>';

if (!empty($json[0]->title)){
foreach($json as $list){
$id=$list->id;
$permalink=$list->permalink;
$name=strip_tags($list->title);
$ngaran =str_replace(''.$masbro.'','<font color="red">'.$masbro.'</font>',$name);
$size=format_size(getfilesize(getlinkdl($id)));
$duration=format_time($list->duration/1000);
if($song=$list->artwork_url) {
$thumb = $song;
}
else {
$thumb = '/tm-content/no_thumbnail.png';
}
echo '<tr><td valign="middle" width="78px"><img src="'.$thumb.'" alt="Music - Wapdam.id" title="'.$name.'" width="78px" height="78px" class="thumcircle">
</td><td> <a href="/v/'.$id.'/'.$permalink.'.html" title="'.$name.'"> '.$ngaran.'</a><br />
<span class="label"> '.$duration.' </span>&nbsp;<span class="label"> '.$size.' </span>
</td>
</tr>';}

echo '</tbody></table></div><div class="vagination" align=center>';
if(!empty($_GET['genre'])){
if ($noPage > 1) {echo'<a href="/music/tags/'.$genre.'/'.($noPage-1).'.html">&laquo; Previous</a> - ';}
if (!empty($json[9])) {echo'<a href="/music/tags/'.$genre.'/'.($noPage+1).'.html">Next Page &raquo;</a> ';}
}else{
if ($noPage > 1) {echo'<a href="/music/'.$q.'/page/'.($noPage-1).'.html">&laquo; Previous</a> - ';}
if (!empty($json[9])) {echo'<a href="/music/'.$q.'/page/'.($noPage+1).'.html">Next Page &raquo;</a></br></div>';}
}

echo '</div><div class="nganan"><div class="r"> MUSIK MP3</div><div class="menu"> Lagu - Lagu diatas disajikan untuk pratinjau sebelum anda membeli lagu yang asli, <b>Lagu</b> dapat kamu download di wapdam.id secara gratis dengan catatan situs ini hanya sebagai sarana promosi, jika anda suka lagu ini silahkan beli seacara original di <b> iTunes</b> atau di toko kaset terdekat.</div></div></div></div>';

}else{echo'<div class="menu"><font color="red">Result Not Found, please use another keyword.</font></div>';}

include 'tm-inc/foot.php';
?>