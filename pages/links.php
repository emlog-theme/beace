<?php
/**
 * Template name: 友情链接
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
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
								<?php echo $log_content; ?>
								<ul class="plinks linkcat">
									<ul class='xoxo blogroll'>
										<?php
											global $CACHE; 
											$link_cache = $CACHE->readCache('link');
											foreach($link_cache as $value):
										?>
										<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
										<?php endforeach; ?>
									</ul>
								</ul>
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