<?php 
include'tm-inc/fnc.php';
$title='Top Songs on iTunes';
$description ='Top Songs and Music Videos Chart';
$keywords ='download mp3, download lagu , gratis, mp3 gratis, 3gp, download full album';
 
include 'tm-inc/head.php';
include 'tm-inc/head-c.php'; 
echo '<div class="r"> Top Chart</div><div class="menu">';

$grab = strstr(tfkmedia('https://www.apple.com/id/itunes/charts/songs/'),'class="section chart-grid');
$tfkid = explode('</strong>',$grab);
for($i=1; $i<=20; $i++){
$file = cut($tfkid[$i],'l=en">','</a>');
$artis = cut($tfkid[$i],'&amp;l=en">','</a></h4>');
$img = explode('">',$file);
$judul = cut($img[0].'">','alt="','">');
$link=$artis.'-'.$judul;
$link=str_replace(' ', '-', $link);
$link=strtolower($link);
if(!empty($img[0])){
echo '<table class="otable" width="100%"><tbody><tr valign="top"><td class="vithumb" width="100px">'.$img[0].'" width="78px" height="78px" class="thumcircle">
</td><td>  '.$artis.' - '.$judul.'<br>
<a href="/music/'.$link.'.html"><span class="label">Music</span></a> - <a href="/video/'.$link.'.html"><span class="labels">Video</span></a>
</td>
</tr></table>';
}}

function cut($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];
}return '';}}
echo '<div class="nav"><a href="/music"> See full chart.. </a></div></div>';

include 'tm-inc/foot.php';

?>