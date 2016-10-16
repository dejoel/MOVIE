<?php
include 'tm-inc/vfunc.php';
if($_GET['q'])
{
$q = $_GET['q'];
$cd          = preg_replace("/[^A-Za-z0-9[:space:]]/","$1",$q);
$cd          = str_replace('','', $cd);
$remove = "-";
$masbro = str_replace($remove, " ", ucwords($_GET['q']));
} 
$title ='Video '.$masbro.' 3GP, MP4, FLV, HD Free Download';
$description ='Nonton dan download video '.$masbro.' di wapdam 100% gratis dan mudah, Free download video format MP4, Format 3gp, flv &amp; webm, streaming of Youtube. full Gratis download video, latest video.';
$keywords ='download '.$masbro.' mp3, download lagu , gratis, mp3 gratis, 3gp '.$masbro.', download full album '.$masbro.'';

include 'tm-inc/head.php';
include 'tm-inc/head-v.php';
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
$grab=ngegrab('https://www.googleapis.com/youtube/v3/search?part=snippet&order=relevance&q='.$qu.'&key='.$devkey.'&maxResults=20&pageToken='.$yesPage.'&type=video');
$json = json_decode($grab);
$nextpage=$json->nextPageToken;
$prevpage=$json->prevPageToken;
echo '<div class="r"> Total '.$json->pageInfo->totalResults.' Video &raquo; Untuk <b> '.$masbro.'</b> </div><div class="file"><table class="otable" width="100%"><tbody>';
if($json)
{
foreach ($json->items as $hasil)
{
$id          = $hasil->id->videoId;
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
<br /><span class="labels"> '.$date.'</span>
</td></tr>';
}
echo '</tbody></table></div><div class="vagination" align=center>';
if (strlen($prevpage)>1)
{
if (strlen($_GET['q'])>1)
{
echo '<a href="/query/'.$_GET['q'].'/page/'.$prevpage.'" title="Back To '.$prevpage.'">&laquo; Previous</a> - </a>';
}
}
if (strlen($nextpage)>1)
{
if (strlen($_GET['q'])>1)
{
echo '<a href="/query/'.$_GET['q'].'/page/'.$nextpage.'" title="Go To '.$nextpage.'">Next Page &raquo;</a>';
}
}
echo '</div>';
include 'tm-inc/foot.php';
}
if(!empty($_GET['q']) AND empty($_GET['page'])){$user_query = ''.$_GET['q'].'';
write_to_file($user_query);
}
echo '</div>';
include 'tm-inc/foot.php';
?>