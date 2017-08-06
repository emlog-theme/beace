<?php
/**
 * Template name: 读者墙
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
function Show_likes($likenum){
    $db = MySql :: getInstance();
    $sql = "SELECT * FROM ".DB_PREFIX."blog where type='blog' and hide ='n' and checked='y' and praise!='0' order by praise desc limit 0,$likenum";
    $result = $db->query( $sql );
    while($row = $db->fetch_array($result)){
		if(pic_thumb($row['content'])){
            $imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($row['content'])."&h=180&w=240&zc=1";
        }else{
            $imgsrc = TEMPLATE_URL.'img/news/featured-slider/'.rand(1,10).".jpg";
        }
        echo "<li><a href=\"".Url::log($row['gid'])."\"><img src=\"{$imgsrc}\" class=\"thumb\"/><h2>{$row['title']}</h2></a><a href=\"javascript:;\" class=\"post-like\" data-pid=\"{$row['gid']}\" evt=\"likes\"><i class=\"fa fa-thumbs-up\"></i> 赞 (<span>".likes_getNum($row['gid'])."</span>)</a></li>";
	}
}
?>
<div class="focusbanner" style="background-image:url(<?php echo TEMPLATE_URL; ?>img/bg.jpg)">
    <div class="container">
		<h1 class="title"><?php echo $log_title; ?></h1>
	</div>
</div>
<div class="main_content container">
	<div class="posts_sidebar clearfix">
		<div class="inner_single col-md-12">
			<div class="row">
				<article class="lf_post">
					<div class="post_wrapper">
						<div class="lf_main_post_content">
							<div class="lf_content">
								<?php
									echo $log_content;
								?>
								<ul class="likepage"><?php echo Show_likes(_g('like_nums')); ?></ul>
							</div>
						</div>
					</div>
				</article>
				<?php
					if($allow_remark == 'y'){
						if($comnum>=1){
							echo "<div class=\"conmments_block\"><div class=\"post_title\"><h4>全部评论：{$comnum}</h4></div>";
							blog_comments($comments);
							echo "</div>";
						}
						blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark);
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php include View::getView('footer');?>