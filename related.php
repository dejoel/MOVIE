<?php
echo '<div class="nganan"><div class="r"><table><tbody><tr><td width="24"><img src="/tm-content/plus-2-32.png" width="20"></td><td> Video Terkait </td></tr></tbody></table></div>
<div class="menu"><table class="otable"><tbody>';
$grab=ngegrab('https://www.googleapis.com/youtube/v3/search?part=snippet&order=relevance&q='.$qu.'&key='.$devkey.'&part=snippet&maxResults=11&relatedToVideoId='.$_GET['v'].'&type=video');
$json = json_decode($grab);
if($json)
{
foreach($json->items as $hasil) 
{
$id          = $hasil->id->videoId;
$name        = $hasil->snippet->title;
$ln          = preg_replace("/[^A-Za-z0-9[:space:]]/","$1",$name);
$ln          = str_replace(' ','-',$ln);
$ud          = strtolower("$ln");
$description = $hasil->snippet->description;
$channel     = $hasil->snippet->channelTitle;
$channelid   = $hasil->snippet->channelId;
$date     = dateyt($hasil->snippet->publishedAt);
$hasil       = ngegrab('https://www.googleapis.com/youtube/v3/videos?key='.$key.'&part=contentDetails,statistics&id='.$id.'');
$dt          = json_decode($hasil);
foreach ($dt->items as $dta)
{
$time        = $dta->contentDetails->duration;
$duration    = format_time($time);
$views       = $dta->statistics->viewCount;
$likes       = $dta->statistics->likeCount;	
}
echo '<tr><td><img src="http://i.ytimg.com/vi/'.$id.'/hqdefault.jpg" alt="Thumbnail" class="thumbnail" title="'.$name.'" width="78px" height="78px">
</td><td> <a href="/watch?v='.$id.'">'.$name.'</a><br />
<span class="label"> '.$duration.' </span>
<br />
<span class="labels"> '.$date.'</span>
</td></tr>';
}
}
echo '</tbody></table></div></div></div></div></div></div>';
?>