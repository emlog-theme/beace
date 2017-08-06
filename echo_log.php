<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="main_content container">
	<div class="posts_sidebar clearfix">
		<div class="inner_single col-md-<?php if(_g('layout')=='1'){echo "12";}else{echo "8";}?>">
			<div class="row">
				<article class="lf_post">
					<div class="post_wrapper">
						<div class="lf_top_post">
							<div class="lf_title_and_meta">
								<div class="lf_title">
									<h3><a href="<?php echo URL::log($logid); ?>"><?php echo $log_title; ?></a></h3>
								</div>
								<div class="lf_meta_post">
									<span class="lf_post_by"><i class="fa fa-user"></i><?php blog_author($author); ?></span>
									<?php blog_sort($logid); ?>
									<span class="lf_date_post"><i class="fa fa-calendar"></i><a href="<?php echo Url::record(gmdate('Ym',$value['date'])); ?>"><?php echo get_time($date); ?></a></span>
									<span class="lf_date_post"><i class="fa fa-eye"></i><?php echo $views; ?></span>
									<span class="lf_date_post"><i class="fa fa-comments"></i><?php if($comnum<=0):?>暂无评论<?php else:?><?php echo $comnum;?><?php endif;?></span>
								</div>
							</div>
						</div>
						<div class="lf_main_post_content">
							<div class="lf_content">
								<?php echo $log_content; ?>
								<?php doAction('log_related', $logData); ?>
							</div>
							<div class="lf_bottom_post">
								<?php blog_tag($logid); ?>
								<div class="shareBox  clearfix">
									<?php if(_g('post_likes')=='open'){echo likes($logid,1);} ?>
									<a href="javascript:;" class="sharebtn showShare"><i class="fa fa-mail-forward"></i>分享</a>
									<div class="action-share bdsharebuttonbox">
										<a class="share-links bds_tsina fa fa-weibo" data-cmd="tsina"></a>
										<a class="share-links bds_weixin fa fa-wechat" data-cmd="weixin"></a>
										<a class="share-links bds_tqq fa fa-tencent-weibo" data-cmd="tqq"></a>
										<a class="share-links bds_tqf fa fa-qq" data-cmd="tqf"></a>
										<a class="share-links bds_mail fa fa-envelope-o" data-cmd="mail"></a>
										<a class="share-links bds_copy fa fa-link" data-cmd="copy"></a>
										<a class="share-links bds_more" data-cmd="more"><i class="fa fa-mail-forward"></i></a> (<a class="bds_count" data-cmd="count"></a>)
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php if(_g('post_related_s')=='open'):?>
					<div class="single_related_posts">
						<div class="post_title">
							<h4><?php echo _g('related_title'); ?></h4>
						</div>
						<ul id="post_related_block" class="post_block">
							<?php related_logs($logData,_g('post_related_n'));?>
						</ul>
					</div>
					<?php
						endif;
						if($allow_remark == 'y'){
							if($comnum>=1){
								echo "<div class=\"conmments_block\"><div class=\"post_title\"><h4>全部评论：{$comnum}</h4></div>";
								blog_comments($comments);
								echo "</div>";
							}
							blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark);
						}
					?>
				</article>
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