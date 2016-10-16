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
$server_1 = file_get_contents('http://api.indovideo.co/wapdam.php?videoid='.$source_id.'&type=Download');
$server_2 = file_get_contents('http://srv.tfkmedia.net/developers/yt/codes_1.php?videoid='.$source_id.'&type=Download'); 
{
$title='Video '.$name.' - Download 3GP - MP4 - FLV ('.$duration.')';
$description =''.$name.' - '.substr($des,0,600).'';
$keywords ='download mp3, '.$name.', gratis, mp3 gratis, download video, video gratis, video '.$name.', 3gp '.$name.', download full album';
}
$tag=$name;
$tag=str_replace(" ",",", $tag);
$dtag=$des;
include 'tm-inc/head.php';
include 'tm-inc/head-v.php';
echo '<div class="ngiri"><div class="ngiri"><div class="title_a"><b>'.$name.' </b>
<br>Source: www.youtube.com/watch?v='.$_GET['v'].'</div>
<div class="menu">
<table width="100%"><tbody><tr><td align="center"><img src="/tm-content/view.png" width="18px"> <br>'.$views.'</td><td align="center"><img src="/tm-content/like.png" width="18px"><br> '.$likes.' </td><td align="center"><img src="/tm-content/upload.png" width="18px"><br><b>'.$date.'</b></td> <td align="center"><img src="/tm-content/duration.png" width="18px"><br>'.$duration.' </td>
</tr></tbody></table><br>
 
<center>
<a href="http://facebook.com/sharer.php?u=http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" rel="nofollow" target="_blank"><img alt="share" src="http://server.indonesiaz.com/files/fb.png" height="23" /></a>

<a href="http://twitter.com/intent/tweet?url=http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" rel="nofollow" target="_blank"><img alt="tweet" src="http://server.indonesiaz.com/files/twit.png" height="23" /></a>

<a href="https://plus.google.com/share?url=http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" rel="nofollow" target="_blank"><img alt="G+" src="http://server.indonesiaz.com/files/plus.png" height=23"" /></a><br></br>

<a href="/streaming?v='.$_GET['v'].'"><img width="90%" src="http://i.ytimg.com/vi/'.$_GET['v'].'/mqdefault.jpg" alt="'.$name.'"><div class="server1"> Watch Video </div></a></center>
<div class="info"> All material is copyright to their respectful owners and no copyright infringement is intended. this video uploaded by <b> '.$chtitle.'</b> .
</div> '.$des.'</div>
<div class="r"><table><tbody><tr><td><img src="/tm-content/video-call-24.png"></td><td> Download Video </td></tr></tbody></table></div>
<div class="menu">
'.$server_1.'
<div class="advinfo"> If download link not display please refresh the page. </div>
</div></div>';
}
}
include 'related.php';
include 'tm-inc/foot.php';
?>