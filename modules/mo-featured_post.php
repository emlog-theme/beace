<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
function featured_post($id){
    $db = MySql::getInstance();
    $sql = "SELECT * FROM ".DB_PREFIX."blog WHERE sortid='{$id}' AND type='blog' AND hide='n' order by date DESC limit 0,10";
    $list = $db->query($sql);
    while($value = $db->fetch_array($list)){
        if(pic_thumb($value['content'])){
            $imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($value['content'])."&h=180&w=270&zc=1";
        }else{
            $imgsrc = TEMPLATE_URL.'img/news/featured-slider/'.rand(1,10).'.jpg';
        }
        echo "<div class=\"item\"><div class=\"img_post\"><a href=\"".Url::log($value['gid'])."\"><img src=\"{$imgsrc}\" alt=\"{$value['title']}\"></a></div><div class=\"featured_title_post\"><div class=\"caption_inner\"><a href=\"".Url::log($value['gid'])."\"><h4 class=\"title_post\">".subString(strip_tags($value['title']),0,16)."</h4></a><div class=\"post_date\"><em><a href=\"".Url::record(gmdate('Ym',$value['date']))."\"> ".gmdate('M d, Y', $value['date'])."</a></em></div>".mo_sort($value['gid'])."</div></div></div>";
    }
}