<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
function post_box($nums){
    $db = MySql::getInstance();
    $time = time();
    $sql = "SELECT * FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - 30*24*60*60 ORDER BY `views` DESC LIMIT 0,$nums";
    $list = $db->query($sql);
    while($value = $db->fetch_array($list)){
        if(pic_thumb($value['content'])){
            $imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($value['content'])."&h=300&w=360&zc=1";
        }else{
            $imgsrc = TEMPLATE_URL.'img/new/lastest/'.rand(1,3).'.png';
        }
		echo "<article class=\"a-post-box\"><figure class=\"latest-img\"><img src=\"{$imgsrc}\" alt=\"{$value['title']}\" class=\"latest-cover\"></figure><div class=\"latest-overlay\"></div><div class=\"latest-txt\"><h4 class=\"latest-title\"><a data-dummy=\"dfsdfsdfdsf\" href=\"".Url::log($value['gid'])."\" rel=\"bookmark\" title=\"{$value['title']}\">".subString(strip_tags($value['title']),0,12)."</a></h4>".mo_sort($value['gid'])."<span class=\"latest-meta\"><span class=\"latest-date\"><i class=\"fa fa-clock-o\"></i>".gmdate('M-d-Y', $value['date'])."</span></span></div></article>";
		
    }
}