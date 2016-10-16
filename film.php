<?php 
include 'tm-inc/fnc.php';
 
$title='Film Populer Downloads';

include 'tm-inc/head.php';
include 'tm-inc/head-h.php';

echo '<div class="ngiri"><div class="r"> Film Populer </div><div class="menu" align="center">';

$grab = strstr(tfkmedia('http://www.apple.com/id/itunes/charts/movies/'),'class="section movies chart-grid');
$tfkid = explode('</strong>',$grab);
for($i=1; $i<=30; $i++){
$file = cut($tfkid[$i],'l=en">','</a>');
$cat = cut($tfkid[$i],'&amp;l=en">','</a></h4>');
$img = explode('">',$file);
$name = cut($img[0].'">','alt="','">');
$link_2=$cat.'-'.$name; 
$link=$name;
$link=str_replace(' ', '-', $link);
$link=strtolower($link);
if(!empty($img[0])){
echo '<a href="/video/'.$link.'.html"><div class="topartist">'.$img[0].'"><br>
<p> '.$name.' </p></div></a>';
}}

function cut($content,$start,$end){
if($content && $start && $end) {
$r = explode($start, $content);
if (isset($r[1])){
$r = explode($end, $r[1]);
return $r[0];
}return '';}}
echo '</div></div>';

include 'about.php';
include 'tm-inc/foot.php'; ?>