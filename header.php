<?php
/*
Template Name:Beace
Description:Beace是一款清新和响应模板博客主题
Version:1.2
Author:lonewolf
Author Url:http://www.emthemanet.com
Sidebar Amount:1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('fn');
require_once View::getView('module');
if(blog_tool_ishome()){
    $site_title = $blogname.'-'.$bloginfo;
}elseif(!empty($tws)){
    $site_title = '微语 - '.$blogname;
}else{
    $site_title = $site_title;
}
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]>
<!--> <!--<![endif]-->
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<link rel="Shortcut Icon" href="<?php echo BLOG_URL; ?>favicon.ico" type="image/x-icon" />
<?php Index_head(); ?>
<?php doAction('index_head'); ?>
</head>
<?php
//首页body属性判断
if(ROLE == 'admin' || ROLE == 'writer'){
	$role = ' logged-in';
}
if($allow_remark == 'y'){
	$comment = ' comment-open';
}
if($pono==true){
	$pono = ' posts_sidebar_no';
}
if(blog_tool_ishome()){
	echo '<body class="home blog'.$role.'">';
}elseif($keyword){
	echo '<body class="search search-results'.$role.'">';
}elseif($tag){
	echo '<body class="archive tag tag-emlog tag-'.$id.$role.'">';
}elseif($params[1]=='page'){
	echo '<body class="home blog paged paged-'.htmlspecialchars(urldecode($params[2])).$role.'">';
}elseif($sortName){
	echo '<body class="archive category '.$see.' category-'.$sortid.$role.'">';
}elseif($params[1]=='author'){
	echo '<body class="archive page-author author author-'.$author.'">';
}elseif($template=='pages/tags'){
	echo '<body class="page-tags'.$role.$comment.'">';
}elseif($template=='pages/archivers'){
	echo '<body class="page-archivers'.$role.$comment.'">';
}elseif($template=='pages/links'){
	echo '<body class="page-links'.$role.$comment.'">';
}elseif($template=='pages/reader'){
	echo '<body class="page-reader'.$role.$comment.'">';
}elseif($template=='pages/likes'){
	echo '<body class="page-likes'.$role.$comment.'">';
}elseif($logs || $logid || $tws){
	echo '<body class="single single-post postid-'.$logid.' single-format-standard'.$role.$comment.'">';
}else{
	echo '<body>';
}
?>

<div class="all_content <?php //echo $nav_class; ?> container-fluid">
    <div class="row">
        <div class="header">
            <!--
			<div class="top_bar">
                <div class="min_top_bar">
                    <div class="container">
                        <div class="top_nav">
                            <ul>
                                <li><a href="#">关于我们</a></li>
                                <li><a href="#">在线留言</a></li>
                                <li><a href="#">文章归档</a></li>
                            </ul>
                        </div>
                        <div id="top_search_ico">
                            <div class="top_search">
                                <form method="get">
                                    <input type="text" placeholder="搜索关键字...">
                                </form>
                                <i class="fa fa-search search-desktop"></i>
                            </div>
                            <div id="top_search_toggle">
                                <div id="search_toggle_top">
                                    <form method="get">
                                        <input type="text" placeholder="搜索关键字...">
                                    </form>
                                </div>
                                <i class="fa fa-search search-desktop"></i>
                            </div>
                        </div>
						<div class="social_icon">
							<span><a href="<?php echo _g('weibo'); ?>"><i class="fa fa-weibo"></i></a></span>
							<span><a href="<?php echo _g('tqq'); ?>"><i class="fa fa-tencent-weibo"></i></a></span>
							<span><a href="<?php echo _g('qq_mail'); ?>"><i class="fa fa-envelope-o"></i></a></span>
							<span><a href="<?php echo _g('qq'); ?>"><i class="fa fa-qq"></i></a></span>
							<span><a href="<?php echo _g('twitter'); ?>"><i class="fa fa-twitter"></i></a></span>
							<span><a href="<?php echo _g('facebook'); ?>"><i class="fa fa-facebook"></i></a></span>
						</div>
                    </div>
                </div>
            </div>
			-->
            <div class="main_header">
				<div class="container">
					<div class="logo logo_blog_layout">
						<a href="<?php echo BLOG_URL; ?>"><img src="<?php echo TEMPLATE_URL; ?>img/logo.png" alt="Logo"></a>
					</div>
					<div class="nav_bar">
						<nav id="primary_nav_wrap"><ul><?php blog_navi();?></ul></nav>
					</div>
					<div class="lf_responsive">
						<div id="dl-menu" class="dl-menuwrapper">
							<button class="dl-trigger">Open Menu</button>
							<ul class="dl-menu"><?php blog_navi();?></ul>
						</div>
					</div>
				</div>
			</div>
        </div>
		<?php doAction('index_loglist_top'); ?>