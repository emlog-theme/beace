<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
//$cmsid=explode(",",'1*1,2*4,3*5');
$cmsid=explode(",",_g('cms_id_style'));
$printr = "";
foreach ($cmsid as $k => $id){
	$cms_style = explode("*",$id);
	$db = MySql::getInstance();
	if($cms_style[1]==1){
		$cms_sql_1 = "SELECT * FROM ".DB_PREFIX."blog WHERE sortid='{$cms_style[0]}' AND type='blog' AND hide='n' order by date DESC limit 0,1";
		$cmsone_f = $db->fetch_array($db->query($cms_sql_1));
		$cmsone_f_logdes = blog_tool_purecontent($cmsone_f['content'], 75);
        if(pic_thumb($cmsone_f['content'])){
            $cmsone_f_t_imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($cmsone_f['content'])."&h=230&w=345&zc=1";
        }else{
            $cmsone_f_t_imgsrc = TEMPLATE_URL.'img/news/posts-block/'.rand(1,8).'.jpg';
        }
		echo "<div class=\"block_posts block_1\">".mo_sort_name($cms_style[0])."<div class=\"block_inner row\"><div class=\"big_post col-lg-6 col-md-6 col-sm-6 col-xs-6\"><div class=\"block_img_post\"><img src=\"{$cmsone_f_t_imgsrc}\" alt=\"{$cmsone_f['title']}\"></div><div class=\"inner_big_post\"><div class=\"title_post\"><a href=\"".Url::log($cmsone_f['gid'])."\"><h4>{$cmsone_f['title']}</h4></a></div><div class=\"big_post_content\"><p>{$cmsone_f_logdes}</p></div><div class=\"post_date\"><em><a href=\"".Url::record(gmdate('Ym',$cmsone_f['date']))."\">".gmdate('M d, Y', $cmsone_f['date'])."</a></em></div></div></div><div class=\"small_list_post col-lg-6 col-md-6 col-sm-6 col-xs-6\"><ul>";
		$cms_sql_2 = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$cms_style[0]}' AND type='blog' AND hide='n' order by date DESC limit 1,4");
		while($cmsone_f_t = $db->fetch_array($cms_sql_2)){
			if(pic_thumb($cmsone_f_t['content'])){
				$cmsone_f_t2_imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($cmsone_f_t['content'])."&h=68&w=100&zc=1";
			}else{
				$cmsone_f_t2_imgsrc = TEMPLATE_URL.'img/news/featured-slider/'.rand(1,7).'.jpg';
			}
			echo "<li class=\"small_post clearfix\"><div class=\"img_small_post\"><img src=\"{$cmsone_f_t2_imgsrc}\" alt=\"{$cmsone_f_t['title']}\"></div><div class=\"small_post_content\"><div class=\"title_small_post\"><a href=\"".Url::log($cmsone_f_t['gid'])."\"><h5> ".subString(strip_tags($cmsone_f_t['title']),0,12)."</h5></a></div><div class=\"post_date\"><em><a href=\"".Url::record(gmdate('Ym',$cmsone_f_t['date']))."\">".gmdate('M d, Y', $cmsone_f_t['date'])."</a></em></div></div></li>";
		}
		echo  "</ul></div></div></div>";
	}
	
	if($cms_style[1]>1 && $cms_style[1]<=2){
		echo "<div class=\"ads_in_block\"><a href=\"#\"><img src=\"".TEMPLATE_URL."img/ads_1.gif\" alt=\"ads\" style=\"width: 100%;\"></a></div>";
	}
	
	if($cms_style[1]==2){
		echo "<div class=\"block_posts block_2\">".mo_sort_name($cms_style[0])."<div class=\"block_inner row\"><div class=\"small_list_post col-lg-6 col-md-6 col-sm-6 col-xs-6\"><ul>";
		
		$cms_sql_3 = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$cms_style[0]}' AND type='blog' AND hide='n' order by date DESC limit 0,4");
		while($cmsone_f_t2 = $db->fetch_array($cms_sql_3)){
			if(pic_thumb($cmsone_f_t2['content'])){
				$cmsone_f_t3_imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($cmsone_f_t2['content'])."&h=68&w=100&zc=1";
			}else{
				$cmsone_f_t3_imgsrc = TEMPLATE_URL.'img/news/sport/'.rand(1,8).'.jpg';
			}
			echo "<li class=\"small_post clearfix\"><div class=\"img_small_post\"><img src=\"{$cmsone_f_t3_imgsrc}\" alt=\"{$cmsone_f_t2['title']}\"></div><div class=\"small_post_content\"><div class=\"title_small_post\"><a href=\"".Url::log($cmsone_f_t2['gid'])."\"><h5> ".subString(strip_tags($cmsone_f_t2['title']),0,12)."</h5></a></div><div class=\"post_date\"><em><a href=\"".Url::record(gmdate('Ym',$cmsone_f_t2['date']))."\">".gmdate('M d, Y', $cmsone_f_t2['date'])."</a></em></div></div></li>";
		}
		echo "</ul></div><div class=\"small_list_post col-lg-6 col-md-6 col-sm-6 col-xs-6\"><ul>";
		$cms_sql_4 = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$cms_style[0]}' AND type='blog' AND hide='n' order by date DESC limit 4,4");
		while($cmsone_f_t3 = $db->fetch_array($cms_sql_4)){
			if(pic_thumb($cmsone_f_t3['content'])){
				$cmsone_f_t4_imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($cmsone_f_t3['content'])."&h=68&w=100&zc=1";
			}else{
				$cmsone_f_t4_imgsrc = TEMPLATE_URL.'img/news/sport/'.rand(1,8).'.jpg';
			}
			echo "<li class=\"small_post clearfix\"><div class=\"img_small_post\"><img src=\"{$cmsone_f_t4_imgsrc}\" alt=\"{$cmsone_f_t3['title']}\"></div><div class=\"small_post_content\"><div class=\"title_small_post\"><a href=\"".Url::log($cmsone_f_t3['gid'])."\"><h5> ".subString(strip_tags($cmsone_f_t3['title']),0,12)."</h5></a></div><div class=\"post_date\"><em><a href=\"".Url::record(gmdate('Ym',$cmsone_f_t3['date']))."\">".gmdate('M d, Y', $cmsone_f_t3['date'])."</a></em></div></div></li>";
		}
		echo "</ul></div></div></div>";
	}
	
	if($cms_style[1]==3){
		echo "<div class=\"block_posts block_3\">".mo_sort_name($cms_style[0])."<div class=\"block_inner\"><div class=\"featured_cat_slider\"><div id=\"featured_cat_post\">";
		$cms_sql_5 = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$cms_style[0]}' AND type='blog' AND hide='n' order by date DESC limit 0,7");
		while($cmsone_f_t4 = $db->fetch_array($cms_sql_5)){
			if(pic_thumb($cmsone_f_t4['content'])){
				$cmsone_f_t5_imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($cmsone_f_t4['content'])."&h=160&w=240&zc=1";
			}else{
				$cmsone_f_t5_imgsrc = TEMPLATE_URL.'img/news/design/'.rand(1,7).'.jpg';
			}
			echo "<div class=\"item\"><div class=\"img_post\"><a href=\"".Url::log($cmsone_f_t4['gid'])."\"><img src=\"{$cmsone_f_t5_imgsrc}\" alt=\"{$cmsone_f_t4['title']}\" style=\"\"></a></div><div class=\"featured_title_post\"><div class=\"caption_inner\"><a href=\"".Url::log($cmsone_f_t4['gid'])."\"><h4 class=\"title_post\">".subString(strip_tags($cmsone_f_t4['title']),0,12)."</h4></a><div class=\"post_date\"><em><a href=\"".Url::record(gmdate('Ym',$cmsone_f_t4['date']))."\">".gmdate('M d, Y', $cmsone_f_t4['date'])."</a></em></div>".mo_sort($cmsone_f_t4['gid'])."</div></div></div>";
		}
		echo "</div></div></div></div>";
	}
	
	if($cms_style[1]==4){
		echo "<div class=\"block_posts block_4\">".mo_sort_name($cms_style[0])."<div class=\"block_inner row\"><div class=\"big_post col-lg-6 col-md-6 col-sm-6 col-xs-6\">";
		$cms_sql_6 = "SELECT * FROM ".DB_PREFIX."blog WHERE sortid='{$cms_style[0]}' AND type='blog' AND hide='n' order by date DESC limit 0,1";
		$cmsone_f_t5 = $db->fetch_array($db->query($cms_sql_6));
		$cmsone_f_t5_logdes = blog_tool_purecontent($cmsone_f_t5['content'], 75);
		if(pic_thumb($cmsone_f_t5['content'])){
			$cmsone_f_t6_imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($cmsone_f_t5['content'])."&h=230&w=345&zc=1";
		}else{
			$cmsone_f_t6_imgsrc = TEMPLATE_URL.'img/news/world/'.rand(1,11).'.jpg';
		}
		echo "<div class=\"block_img_post\"><img src=\"{$cmsone_f_t6_imgsrc}\" alt=\"{$cmsone_f_t5['title']}\"></div><div class=\"inner_big_post\"><div class=\"title_post\"><a href=\"".Url::log($cmsone_f_t5['gid'])."\"><h4>".subString(strip_tags($cmsone_f_t5['title']),0,12)."</h4></a></div><div class=\"big_post_content\"><p>{$cmsone_f_t5_logdes}</p></div><div class=\"post_date\"><em><a href=\"".Url::record(gmdate('Ym',$cmsone_f_t5['date']))."\">".gmdate('M d, Y', $cmsone_f_t5['date'])."</a></em></div></div><div class=\"small_list_post\"><ul>";
		$cms_sql_7 = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$cms_style[0]}' AND type='blog' AND hide='n' order by date DESC limit 1,4");
		while($cmsone_f_t6 = $db->fetch_array($cms_sql_7)){
			if(pic_thumb($cmsone_f_t6['content'])){
				$cmsone_f_t7_imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($cmsone_f_t6['content'])."&h=68&w=100&zc=1";
			}else{
				$cmsone_f_t7_imgsrc = TEMPLATE_URL.'img/news/world/'.rand(1,11).'.jpg';
			}
			echo "<li class=\"small_post clearfix\"><div class=\"img_small_post\"><img src=\"{$cmsone_f_t7_imgsrc}\" alt=\"{$cmsone_f_t6['title']}\"></div><div class=\"small_post_content\"><div class=\"title_small_post\"><a href=\"".Url::log($cmsone_f_t6['gid'])."\"><h5>".subString(strip_tags($cmsone_f_t6['title']),0,12)."</h5></a></div><div class=\"post_date\"><em><a href=\"".Url::record(gmdate('Ym',$cmsone_f_t6['date']))."\">".gmdate('M d, Y', $cmsone_f_t6['date'])."</a></em></div></div></li>";
		}
		echo "</ul></div></div><div class=\"big_post col-lg-6 col-md-6 col-sm-6 col-xs-6\">";
		$cms_sql_8 = "SELECT * FROM ".DB_PREFIX."blog WHERE sortid='{$cms_style[0]}' AND type='blog' AND hide='n' order by date DESC limit 5,5";
		$cmsone_f_t7 = $db->fetch_array($db->query($cms_sql_8));
		$cmsone_f_t7_logdes = blog_tool_purecontent($cmsone_f_t7['content'], 75);
		if(pic_thumb($cmsone_f_t7['content'])){
			$cmsone_f_t8_imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($cmsone_f_t7['content'])."&h=230&w=345&zc=1";
		}else{
			$cmsone_f_t8_imgsrc = TEMPLATE_URL.'img/news/world/'.rand(1,11).'.jpg';
		}
		echo "<div class=\"block_img_post\"><img src=\"{$cmsone_f_t8_imgsrc}\" alt=\"{$cmsone_f_t7['title']}\"></div><div class=\"inner_big_post\"><div class=\"title_post\"><a href=\"".Url::log($cmsone_f_t7['gid'])."\"><h4>".subString(strip_tags($cmsone_f_t7['title']),0,12)."</h4></a></div><div class=\"big_post_content\"><p>{$cmsone_f_t7_logdes}</p></div><div class=\"post_date\"><em><a href=\"".Url::record(gmdate('Ym',$cmsone_f_t7['date']))."\">".gmdate('M d, Y', $cmsone_f_t7['date'])."</a></em></div></div><div class=\"small_list_post\"><ul>";
		$cms_sql_9 = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$cms_style[0]}' AND type='blog' AND hide='n' order by date DESC limit 6,9");
		while($cmsone_f_t8 = $db->fetch_array($cms_sql_9)){
			if(pic_thumb($cmsone_f_t8['content'])){
				$cmsone_f_t9_imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($cmsone_f_t8['content'])."&h=68&w=100&zc=1";
			}else{
				$cmsone_f_t9_imgsrc = TEMPLATE_URL.'img/news/world/'.rand(1,11).'.jpg';
			}
			echo "<li class=\"small_post clearfix\"><div class=\"img_small_post\"><img src=\"{$cmsone_f_t9_imgsrc}\" alt=\"{$cmsone_f_t8['title']}\"></div><div class=\"small_post_content\"><div class=\"title_small_post\"><a href=\"".Url::log($cmsone_f_t8['gid'])."\"><h5>".subString(strip_tags($cmsone_f_t8['title']),0,12)."</h5></a></div><div class=\"post_date\"><em><a href=\"".Url::record(gmdate('Ym',$cmsone_f_t8['date']))."\">".gmdate('M d, Y', $cmsone_f_t8['date'])."</a></em></div></div></li>";
		}
		echo "</ul></div></div></div></div>";
	}
	if($cms_style[1]>4 && $cms_style[1]<=5){
		echo "<div class=\"ads_in_block\"><a href=\"#\"><img src=\"".TEMPLATE_URL."img/ads_1.gif\" alt=\"ads\" style=\"width: 100%;\"></a></div>";
	}
	
	if($cms_style[1]==5){
		echo "<div class=\"block_posts block_5\">".mo_sort_name($cms_style[0])."<div class=\"block_inner\">";
		$cms_sql_10 = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$cms_style[0]}' AND type='blog' AND hide='n' order by date DESC limit 0,6");
		while($cmsone_f_t9 = $db->fetch_array($cms_sql_10)){
			if(pic_thumb($cmsone_f_t9['content'])){
				$cmsone_f_t10_imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($cmsone_f_t9['content'])."&h=158&w=236&zc=1";
			}else{
				$cmsone_f_t10_imgsrc = TEMPLATE_URL.'img/news/life/'.rand(1,6).'.jpg';
			}
			echo "<article class=\"a-post-box\"><figure class=\"latest-img\"><img src=\"{$cmsone_f_t10_imgsrc}\" alt=\"{$cmsone_f_t9['title']}\" class=\"latest-cover\"></figure><div class=\"latest-overlay\"></div><div class=\"latest-txt\"><h5 class=\"latest-title\"><a href=\"".Url::log($cmsone_f_t9['gid'])."\">".subString(strip_tags($cmsone_f_t9['title']),0,12)."</a></h5></div></article>";
		}
		echo "</div></div>";
	}
	
	if($cms_style[1]==6){
		echo "<div class=\"block_posts block_6\">".mo_sort_name($cms_style[0])."<div class=\"block_inner\">";
		$cms_sql_11 = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$cms_style[0]}' AND type='blog' AND hide='n' order by date DESC limit 0,3");
		while($cmsone_f_t10 = $db->fetch_array($cms_sql_11)){
			$cmsone_f_t10_logdes = blog_tool_purecontent($cmsone_f_t10['content'], 75);
			if(pic_thumb($cmsone_f_t10['content'])){
				$cmsone_f_t11_imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($cmsone_f_t10['content'])."&h=200&w=300&zc=1";
			}else{
				$cmsone_f_t11_imgsrc = TEMPLATE_URL.'img/news/lastest/'.rand(1,3).'.jpg';
			}
			echo "<article class=\"block_lf_post\"><div class=\"standard_post\"><div class=\"list_thum\"><div class=\"lf_thumb_post\">".cms_tag($cmsone_f_t10['gid'])."<img src=\"{$cmsone_f_t11_imgsrc}\" class=\"img-responsive\" alt=\"{$cmsone_f_t10['title']}\" ></div></div><div class=\"list_content\"><div class=\"block_lf_top_post\"><div class=\"block_title_and_meta\"><h4 class=\"lf_title\"><a href=\"".Url::log($cmsone_f_t10['gid'])."\">".subString(strip_tags($cmsone_f_t10['title']),0,12)."</a></h4><div class=\"lf_meta_post\"><span class=\"lf_date_post\"><i class=\"fa fa-calendar\"></i><a href=\"".Url::record(gmdate('Ym',$cmsone_f_t10['date']))."\">".gmdate('M d, Y', $cmsone_f_t10['date'])."</a></span><span class=\"lf_date_post\"><i class=\"fa fa-comments\"></i><a href=\"".Url::log($cmsone_f_t10['gid'])."#comments\">{$cmsone_f_t10['comnum']} Comments</a></span></div></div></div><div class=\"block_lf_main_post_content\"><div class=\"lf_content\"><p>{$cmsone_f_t10_logdes}</p></div><div class=\"lf_bottom_post\"><div class=\"lf_read_more\"><a href=\"".Url::log($cmsone_f_t10['gid'])."\">查看文章</a></div></div></div></div></div></article>";
		}
		echo "</div></div>";
	}
}