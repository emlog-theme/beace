<?php
/**
 * Template name: 读者墙
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
function reader($readernum){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['name'];
	$DB = MySql :: getInstance();
	$sql = "SELECT count(*) AS comment_nums,poster,mail,url FROM ".DB_PREFIX."comment where date >0 and poster !='". $name ."' and  poster !='匿名' and hide ='n' group by poster order by comment_nums DESC limit 0,$readernum";
	$result = $DB->query( $sql );
	$x=1;
	while($row = $DB->fetch_array($result))
		if($x<=1){
			{
				$img = "<a class=\"item-top item-".$x."\" target=\"_blank\" href=". $row[ 'url' ] ."><h4>【金牌读者】<small>评论：". $row[ 'comment_nums' ] ."</small></h4><img alt='' src=".cache_gravatar( $row[ 'mail' ]) ." class=\"avatar avatar-32 photo\" height=\"36\" width=\"36\" /><strong>". $row[ 'poster' ] ."</strong>". $row[ 'url' ] ."</a>";
				if($row['url']){
					$tmp = "<a class=\"item-top item-".$x."\" target=\"_blank\" href=". $row[ 'url' ] ."><h4>【金牌读者】<small>评论：". $row[ 'comment_nums' ] ."</small></h4><img alt='' src=".cache_gravatar( $row[ 'mail' ]) ." class=\"avatar avatar-32 photo\" height=\"36\" width=\"36\" /><strong>". $row[ 'poster' ] ."</strong>". $row[ 'url' ] ."</a>";
				}else{
					$tmp = $img;
				}
				$output .= $tmp;
				$x++;
			}
		}elseif($x<=2){
			$img = "<a class=\"item-top item-2\" target=\"_blank\" href=". $row[ 'url' ] ."><h4>【银牌读者】<small>评论：". $row[ 'comment_nums' ] ."</small></h4><img alt='' src=".cache_gravatar( $row[ 'mail' ]) ." class=\"avatar avatar-32 photo\" height=\"36\" width=\"36\" /><strong>". $row[ 'poster' ] ."</strong>". $row[ 'url' ] ."</a>";
			if($row['url']){
				$tmp = "<a class=\"item-top item-2\" target=\"_blank\" href=". $row[ 'url' ] ."><h4>【银牌读者】<small>评论：". $row[ 'comment_nums' ] ."</small></h4><img alt='' src=".cache_gravatar( $row[ 'mail' ]) ." class=\"avatar avatar-32 photo\" height=\"36\" width=\"36\" /><strong>". $row[ 'poster' ] ."</strong>". $row[ 'url' ] ."</a>";
			}else{
				$tmp = $img;
			}
			$output .= $tmp;
			$x++;
		}elseif($x<=3){
			$img = "<a class=\"item-top item-3\" target=\"_blank\" href=". $row[ 'url' ] ."><h4>【铜牌读者】<small>评论：". $row[ 'comment_nums' ] ."</small></h4><img alt='' src=".cache_gravatar( $row[ 'mail' ]) ." class=\"avatar avatar-32 photo\" height=\"36\" width=\"36\" /><strong>". $row[ 'poster' ] ."</strong>". $row[ 'url' ] ."</a>";
			if($row[ 'url']){
				$tmp = "<a class=\"item-top item-3\" target=\"_blank\" href=". $row[ 'url' ] ."><h4>【铜牌读者】<small>评论：". $row[ 'comment_nums' ] ."</small></h4><img alt='' src=".cache_gravatar( $row[ 'mail' ]) ." class=\"avatar avatar-32 photo\" height=\"36\" width=\"36\" /><strong>". $row[ 'poster' ] ."</strong>". $row[ 'url' ] ."</a>";
			}else{
				$tmp = $img;
			}
			$output .= $tmp;
			$x++;
		}elseif($x>=4){
			$img = "";
			if($row['url']){
				$tmp = "<a target=\"_blank\" href=\"". $row[ 'url' ] ."\" title=\"【第".$x."名】 评论：". $row[ 'comment_nums' ] ."\"><img alt='' src=".cache_gravatar( $row[ 'mail' ]) ." class=\"avatar avatar-32 photo\" height=\"36\" width=\"36\" />". $row[ 'poster' ] ."</a>";
			}else{
				$tmp = $img;
			}
			$output .= $tmp;
			$x++;
		}
		$output = '<div class="readers">'. $output .'</div>';
		echo $output ;
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
									echo reader(_g('read_nums'));
								?>
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