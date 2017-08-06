<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
function mo_slid($num){
    $db = MySql::getInstance();
    $sql = "SELECT * FROM ".DB_PREFIX."blog WHERE type='blog' and top='y' ORDER BY `top` DESC ,`date` DESC LIMIT 0,$num";
    $list = $db->query($sql);
    while($value = $db->fetch_array($list)){
		$logdes = blog_tool_purecontent($value['content'], 178);
        if(pic_thumb($value['content'])){
            $imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($value['content'])."&h=853&w=1280&zc=1";
        }else{
            $imgsrc = TEMPLATE_URL.'img/news/mid-slider/'.rand(1,7).'.jpg';
        }
		echo "<li><div class=\"feat-item img-section\" data-bg-img=\"{$imgsrc}\"><div class=\"latest-overlay\"></div><div class=\"latest-txt\">".mo_sort($value['gid'])."<h3 class=\"latest-title\"><a href=\"".Url::log($value['gid'])."\">{$value['title']}</a></h3><div class=\"big-latest-content\"><p>{$logdes}</p></div><div class=\"lf_admin_pic\"><img src=\"".blog_author_img($value['author'])."\" class=\"img-responsive\" alt=\"{$value['title']}\"></div><span class=\"lf_post_by\"><i class=\"fa fa-user\"></i>".blog_author_name($value['author'])."</span><span class=\"latest-meta\"><span class=\"latest-date\"><i class=\"fa fa-clock-o\"></i> ".gmdate('M d, Y', $value['date'])."</span></span></div></div></li>";
    }
}