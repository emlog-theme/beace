<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<div class="focusbanner" style="background-image:url(<?php echo TEMPLATE_URL; ?>img/bg.jpg)">
    <div class="container">
		<h1 class="title">微语</h1>
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
								<ol class="teamnewslist">
									<?php
										foreach($tws as $val):
											$author = $user_cache[$val['author']]['name'];
											$avatar = empty($user_cache[$val['author']]['avatar']) ? 
											BLOG_URL . 'admin/views/images/avatar.jpg' : 
											BLOG_URL . $user_cache[$val['author']]['avatar'];
											$tid = (int)$val['id'];
											$img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
									?>
									<li><strong><?php echo $val['date'];?></strong><?php echo $val['t'].$img;?></li>
									<?php endforeach;?>
								</ol>
							</div>
							<div class="pagination pagination-multi"><?php echo static_page($twnum, Option::get('index_twnum'),$page,BLOG_URL.'t/?page='); ?></div>
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