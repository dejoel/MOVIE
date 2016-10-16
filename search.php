<?php
if(!empty($_GET['q'])){

if($_GET['type']=='music'){
$b = str_replace(" ","+",$_GET['q']);
$b = strtolower($b);
$url='/music?q='.$b.'';
}else
if($_GET['type']=='video'){
$mx = str_replace(" ","+",$_GET['q']);
$mx = strtolower($mx);
$url='/video?q='.$mx.'';
}else{
$url='/'; }}
header('location:'.$url.'');
?>