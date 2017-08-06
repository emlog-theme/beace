<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="main_content container">
	<div class="posts_sidebar clearfix">
		<div class="inner_single col-md-<?php if(_g('layout')=='1'){echo "12";}else{echo "8";}?>">
			<div class="row">
				<div class="post_header">
					<h1><?php echo $log_title; ?></h1>
				</div>
				<article class="lf_post">
					<div class="post_wrapper">
						<div class="lf_main_post_content">
							<div class="lf_content">
								<?php echo $log_content; ?>
								<?php doAction('log_related', $logData); ?>
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
		<?php if(_g('layout')=='2'):?>
		<div class="sidebar col-md-4">
			<div class="row">
				<?php include View::getView('side');?>
			</div>
		</div>
		<?php endif;?>
	</div>
</div>
<?php include View::getView('footer');?>