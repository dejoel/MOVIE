<?php
include 'tm-inc/vfunc.php';
$title = 'Free Downloads Music and Video'; 
$description ='Wapdam.id Free Downloads Music and Video - Selamat Datang di wapdam.id, disini anda dapat mencari Lagu, Video, Wallpaper, dan Lirik Lagu tanpa Batas. dengan tampilan yang nyaman dan simple, anda dapat menjelajah secara cepat. coba sekarang!';
$keywords ='download mp3, download lagu , gratis, mp3 gratis, 3gp, download full album';
 
include 'tm-inc/head.php';
include 'tm-inc/head-h.php';

echo '<div class="ngiri"><div class="r"><b> Trending Topic This Week </b></div><div class="file"><table class="otable" width="100%"><tbody>';

if(strlen($_GET['page']) >1)
{
 $yesPage = $_GET['page'];
}
else
{
 $yesPage='';
}

// YouTube Grab Top Videos

$grab = ngegrab('https://www.googleapis.com/youtube/v3/videos?key='.$devkey.'&part=snippet,contentDetails,statistics&chart=mostPopular&maxResults=20&regionCode=id');

$json = json_decode($grab);

if($json)
{
foreach ($json->items as $hasil)
{
$link= $hasil->id->videoId;
$id= $hasil->id;
$name= $hasil->snippet->title;
$desc = $hasil->snippet->description;
$chtitle = $hasil->snippet->channelTitle;
$chid = $hasil->snippet->channelId;
$date = dateyt($hasil->snippet->publishedAt);
$time=$dta->contentDetails->duration;
$duration= format_time($time);
$views= $dta->statistics->viewCount;

// Html Page

echo '<tr><td class="vithumb" width="100px"><img src="http://i.ytimg.com/vi/'.$id.'/hqdefault.jpg" title="'.$name.'" width="100px"></a></td> 
<td class="videsc"><a href="/watch?v='.$id.'">'.$name.'</a><br />
<span class="labels"> '.$date.'</span>
</td></tr>';
}
}
else
{
echo 'Result Not Found, please contact arsntx@gmail.com </font> 
<br> &raquo; <a href="http://down3.ucweb.com/ucbrowser/en/v2/?pub=Isha@a7x&prod_id=1&version=2"> Download fast with uc browser </a>';
}

echo '</tbody></table></div></div>';

echo '<div class="nganan"><div class="r"> Top Songs </div><div class="menu">';

$grab = strstr(tmgrab('https://www.apple.com/id/itunes/charts/songs/'),'class="section chart-grid');
$tfkid = explode('</strong>',$grab);
for($i=1; $i<=11; $i++){
$file = cut($tfkid[$i],'l=en">','</a>');
$artis = cut($tfkid[$i],'&amp;l=en">','</a></h4>');
$imgz = cut($tfkid[$i],'src="','"');
$img = explode('">',$file); 
$img = str_replace('width="100" height="100"','width="60" height="60"',$file);
$bajingan = explode('">',$file);
$judul = cut($bajingan[0].'">','alt="','">');
$link=$artis.'-'.$judul;
$link=str_replace(' ', '-', $link);
$link=strtolower($link);
if(!empty($img[0])){
echo '<table width="100%" class="otable"><tbody><tr><td width="60px"> '.$img.'</td><td><a href="/music?q='.$link.'"> '.$artis.' - '.$judul.' </a></td></tr></tbody></table>';
}}

function cut($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];
}return '';}}
echo '<div class="nav"><a href="/music"> See full songs.. </a></div></div>';
 
include 'about.php';
include 'tm-inc/foot.php';

?>