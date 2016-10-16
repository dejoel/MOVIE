<?php
include 'tm-inc/vfunc.php';

$q = $_GET['q'];
$cd          = preg_replace("/[^A-Za-z0-9[:space:]]/","$1",$q);
$cd          = str_replace('','', $cd);
$remove = "-";
$masbro = str_replace($remove, " ", ucwords($_GET['q']));

$title ='Free Download Video '.$masbro.'';
$description ='Wapdam Video Search Engine - Cari dan download video yang kamu suka di wapdam.id dan bagikan ke temanmu.';
$keywords ='download official-video mp3, download lagu , gratis, mp3 gratis, 3gp official-video , download full album official-video';
$tgl = gmdate("d M Y", time()+3600*7);

include 'tm-inc/head.php';
include 'tm-inc/head-v.php';
 
if($_GET['q'])
{
$q = $_GET['q'];
} 
else 
{
$a = array(''.$tgl.'');
$b = count($a)-1;
$q = $a[rand(0,$b)];
}
$qu=$q;
$qu=str_replace(" ","+", $qu);
$qu=str_replace("-","+", $qu);
$qu=str_replace("_","+", $qu);
if(strlen($_GET['page']) >1)
{
$yesPage=$_GET['page'];
}
else
{
$yesPage='';
}
$grab = ngegrab('https://www.googleapis.com/youtube/v3/search?part=snippet&order=relevance&q='.$qu.'&key='.$devkey.'&maxResults=20&pageToken='.$yesPage.'&type=video');
$json = json_decode($grab);
$nextpage=$json->nextPageToken;
$prevpage=$json->prevPageToken;
echo '<div class="r"><b> '.ucwords($q).' </b> LIST '.$json->pageInfo->totalResults.' Videos</div><div class="file"><table class="otable" width="100%"><tbody>';
if($json)
{
foreach ($json->items as $hasil)
{
$id          = $hasil->id->videoId;
$v          = $hasil->id->videoId;
$name        = $hasil->snippet->title;
$ngaran =str_replace(''.$masbro.'','<font color="red">'.$masbro.'</font>',$name);
$ln          = preg_replace("/[^A-Za-z0-9[:space:]]/","$1",$name);
$ln          = str_replace(' ','-',$ln);
$ud          = strtolower("$ln");
$description = $hasil->snippet->description;
$channel     = $hasil->snippet->channelTitle;
$channelid   = $hasil->snippet->channelId;
$date     = dateyt($hasil->snippet->publishedAt);
$hasil       = ngegrab('https://www.googleapis.com/youtube/v3/videos?key='.$devkey.'&part=contentDetails,statistics&id='.$id.'');
$dt          = json_decode($hasil);
foreach ($dt->items as $dta)
{
$time        = $dta->contentDetails->duration;
$duration    = format_time($time);
$views       = $dta->statistics->viewCount;
$likes       = $dta->statistics->likeCount;	
}
echo '<tr><td class="vithumb" width="100px"><img src="http://i.ytimg.com/vi/'.$id.'/hqdefault.jpg" alt="Thumbnail" class="thumbnail" title="'.$name.'" width="78px" height="78px">
</td><td> <a href="/watch?v='.$id.'">'.$ngaran.'</a><br />
<span class="label"> '.$duration.' </span>
<br /><span class="labels">'.$date.'</span>
</td></tr>';
}
echo '</tbody></table></div><div class="vagination" align=center>';
if (strlen($prevpage)>1)
{
echo '<a href="/query/'.$q.'/page/'.$prevpage.'">&laquo; Previous</a> - ';}
if (strlen($nextpage)>1)
{
echo '<a href="/query/'.$q.'/page/'.$nextpage.'">Next Page &raquo;</a>';
}

echo '</div>';

}else{echo'<div class="menu"><font color="red">Result Not Found, please use another keyword.</font></div>';}
include 'tm-inc/foot.php';
?>