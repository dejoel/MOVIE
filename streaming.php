<?php
include 'tm-inc/vfunc.php';
$yf=ngegrab('https://www.googleapis.com/youtube/v3/videos?key='.$devkey.'&part=snippet,contentDetails,statistics,topicDetails&id='.$_GET['v'].'');
$yf=json_decode($yf);
if($yf)
{
foreach ($yf->items as $item)
{
$name=$item->snippet->title;
$des = $item->snippet->description;
$date = dateyt($item->snippet->publishedAt);
$channelId = $item->snippet->channelId;
$chtitle = $item->snippet->channelTitle;
$ctd=$item->contentDetails;
$duration=format_time($ctd->duration);
$hd = $ctd->definition;
$st= $item->statistics;
$views = $st->viewCount;
$likes = $st->likeCount;
$dislikes = $st->dislikeCount;
$favoriteCount = $st->favoriteCount;
$commentCount = $st->commentCount;
$source_id = $_GET['v'];
$server_1 = file_get_contents('http://srv.tfkmedia.net/developers/yt/code_muviza.php?videoid='.$source_id.'&type=Download');
{$title='Download Video '.$name.' ('.$duration.')';}
$tag=$name;
$tag=str_replace(" ",",", $tag);
$dtag=$des;
include 'tm-inc/head.php';
include 'tm-inc/head-v.php';
echo '<div class="ngiri"><div class="ngiri"><div class="title_a"><b>Streaming Video '.$name.' </b></div>
<div class="menu">
<center><iframe width="196"height="147" src="http://www.youtube.com/embed/'.$_GET['v'].'?feature=player_detailpage?rel=0&autoplay=1"frameborder="0"allowfullscreen></iframe>
</br><b>Click on this image to play video.</b> <center></div></div>';
}
}
include 'tm-inc/foot.php';
?>