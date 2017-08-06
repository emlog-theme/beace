<?php
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<div class="main_content container">
	<?php if(_g('focusslide_s')=='open'):?>
	<div class="mian_slider clearfix">
		<div class="big_silder col-md-8">
			<div class="row">
				<ul id="big-slid-post" class="a-post-box">
					<?php
						_moloader('mo-slid');
						mo_slid(_g('focusslide_num'))
					?>
				</ul>
			</div>
		</div>
		<div class="post_box col-md-4">
			<div class="row">
				<?php
					_moloader('mo-post-box');
					post_box(_g('focusslide_r_num'));
				?>
			</div>
		</div>
	</div>
	<?php endif;?>
	<div class="posts_sidebar <?php if(_g('focusslide_s')=='close'){ echo "posts_sidebar_no ";}; ?>list_layout clearfix">
		<div class="posts_areaa col-md-<?php if(_g('layout')=='1'){echo "12";}else{echo "8";}?>">
			<div class="row">
				<div class="grid_layout">
					<?php
						foreach($logs as $value):
							$logdes = blog_tool_purecontent($value['content'], 80);
							if(pic_thumb($value['content'])){
								$imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($value['content'])."&h=200&w=300&zc=1";
							}else{
								$imgsrc = TEMPLATE_URL.'img/news/featured-slider/'.rand(1,10).'.jpg';
							}
					?>
					<article class="lf_post">
						<div class="standard_post">
							<div class="list_thum">
								<div class="lf_thumb_post">
									<?php echo cms_tag($value['gid']); ?>
									<img src="<?php echo $imgsrc; ?>" class="img-responsive" alt="<?php echo $value['log_title']; ?>-<?php echo $blogname; ?>">
								</div>
							</div>
							<div class="list_content">
								<div class="lf_top_post">
									<div class="lf_title_and_meta">
										<div class="lf_title">
											<a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>-<?php echo $blogname; ?>"><h4 class="lf_title"><?php echo $value['log_title']; ?></h4></a>
										</div>
										<div class="lf_meta_post">
											<?php blog_sort($value['logid']); ?> 
											<span class="lf_date_post"><i class="fa fa-calendar"></i><a href="<?php echo Url::record(gmdate('Ym',$value['date'])); ?>"><?php echo get_time($value['date']); ?></a></span>
											<?php echo in_array('view',_g('post_plugin')) ? '<span class="lf_date_post"><i class="fa fa-eye"></i>阅读('.$value['views'].')</span>' : '' ; ?>
											<?php echo in_array('comm',_g('post_plugin')) ? '<span class="lf_date_post"><i class="fa fa-comments"></i>评论('.$value['comnum'].')</span>' : '' ; ?>
											<?php echo in_array('like',_g('post_plugin')) ? likes($value['logid'],2) : '' ; ?>
										</div>
									</div>
								</div>
								<div class="lf_main_post_content">
									<div class="lf_content">
										<p><?php echo $logdes;?></p>
									</div>
									<div class="lf_bottom_post">
										<div class="lf_read_more"><a href="<?php echo $value['log_url']; ?>">查看更多</a></div>
									</div>
								</div>
							</div>
						</div>
					</article>
					<?php endforeach;?>
					<nav class="pagination_post"><?php echo static_page_next($lognum,$index_lognum,$page,$pageurl); ?></nav>
				</div>
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