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
	<?php if(_g('minicat_s')=='open'):?>
	<div class="featured_slider<?php if(_g('focusslide_s')=='close'){ echo " posts_sidebar_no ";}; ?>">
		<?php echo mo_sort_name(_g('minicat')); ?>
		<div class="featured_posts_slider">
			<div id="featured_post">
				<?php
					_moloader('mo-featured_post');
					featured_post(_g('minicat'));
				?>
			</div>
		</div>
	</div>
	<?php endif;?>
	<div class="posts_sidebar<?php if(_g('focusslide_s')=='close' && _g('minicat_s')=='close'){echo " posts_sidebar_no";}?> clearfix">
		<div class="posts_areaa col-md-<?php if(_g('layout')=='1'){echo "12";}else{echo "8";}?>">
			<div class="row">
				<?php
					_moloader('mo-home-cms');
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