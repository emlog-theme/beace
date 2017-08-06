<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
//widget：个人资料
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];
	if(ISLOGIN){
		echo "<div class=\"widget  widget_about_me\">
			<div class=\"about_me\">
				<div class=\"my_pic\"><img src=\"".blog_author_img(1)."\" alt=\"{$user_cache[1]['des']}\"></div>
				<div class=\"my_name\"><h4>{$name}</h4></div>
				<div class=\"my_words\"><p>{$user_cache[1]['des']}</p></div>
				<div class=\"social_icon\">
					<span><a href=\""._g('weibo')."\"><i class=\"fa fa-weibo\"></i></a></span>
					<span><a href=\""._g('tqq')."\"><i class=\"fa fa-tencent-weibo\"></i></a></span>
					<span><a href=\""._g('qq_mail')."\"><i class=\"fa fa-envelope-o\"></i></a></span>
					<span><a href=\""._g('qq')."\"><i class=\"fa fa-qq\"></i></a></span>
					<span><a href=\""._g('twitter')."\"><i class=\"fa fa-twitter\"></i></a></span>
					<span><a href=\""._g('facebook')."\"><i class=\"fa fa-facebook\"></i></a></span>
				</div>
			</div>
		</div>";
	}else{
		echo "<div class=\"widget widget_login\"><h4 class=\"widget_title\">Login</h4><div class=\"widget_login\"><form name=\"f\" method=\"post\" action=\"".BLOG_URL."admin/index.php?action=login\"><input type=\"text\" id=\"user\" name=\"user\" value=\"Username\"><div class=\"widget_login_password\"><input type=\"password\" name=\"pw\" id=\"pw\" value=\"Password\"></div><input type=\"submit\" value=\"Login\" class=\"button\"></form></div></div>";
	}
}
//widget：日历
function widget_calendar($title){
	echo "<div class=\"widget widget_calendar\"><h4 class=\"widget_title\">{$title}</h4><div id=\"calendar_wrap\">".calendar()."</div></div>";
}
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');
	shuffle($tag_cache);
	$tag_cache = array_slice($tag_cache,0,45);
	echo "<div class=\"widget widget_tag_cloud\"><h4 class=\"widget_title\">{$title}</h4><div class=\"tagcloud\">";
	foreach($tag_cache as $value){
		echo "<a href=\"".Url::tag($value['tagurl'])."\" title=\"{$value['usenum']} 篇文章\">{$value['tagname']}</a>";
	}
	echo "</div></div>";
}
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort');
	echo "<div class=\"widget widget_categories\"><h4 class=\"widget_title\">{$title}</h4><ul class=\"categories\">";
	foreach($sort_cache as $value){
		if ($value['pid'] != 0) continue;
		echo "<li><a href=\"".Url::sort($value['sid'])."\">{$value['sortname']} <span>({$value['lognum']})</span></a><i class=\"fa fa-angle-double-right\"></i></li>";
		if (!empty($value['children'])){
			$children = $value['children'];
			foreach ($children as $key){
				$value = $sort_cache[$key];
				echo "<li><a href=\"".Url::sort($value['sid'])."\">{$value['sortname']} <span>({$value['lognum']})</span></a><i class=\"fa fa-angle-double-right\"></i></li>";
			}
		}
	}
	echo "</ul></div>";
}
//widget：最新微语
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	echo "<div class=\"widget widget_twitter\"><h4 class=\"widget_title\">{$title}</h4><ul class=\"tweet_list\">";
	foreach($newtws_cache as $value){
		echo "<li><span class=\"tweet_text\">{$value['t']}</span></li>";
	}
	echo "</ul></div>";
}
//widget：最新评论
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	echo "<div class=\"widget widget_recent_comments\"><h4 class=\"widget_title\">{$title}</h4><ul class=\"recent_post\">";
	foreach($com_cache as $value){
		$url = Url::comment($value['gid'], $value['page'], $value['cid']);
		echo "<li>
			<figure class=\"widget_post_thumbnail\">
				<a href=\"{$url}\"><img class=\"img-circle\" src=\"".cache_gravatar($value['mail'])."\" height=\"60\" width=\"60\" alt=\"\"></a>
			</figure>
			<div class=\"widget_post_info\">
				<strong class=\"comment-author\"><a href=\"{$url}\"><i class=\"fa fa-user\"></i> {$value['name']}</a></strong>
				<span class=\"comment-c\"><a href=\"{$url}\">".subString(strip_tags($value['content']),0,160)."</a></span>
			</div>
			</li>";
	}
	echo "</ul></div>";
}
//widget：最新文章
function widget_newlog($title){
	$index_newlognum = Option::get('index_newlognum');
	$db = MySql::getInstance();
	$sql = $db->query ("SELECT * FROM ".DB_PREFIX."blog WHERE hide='n' AND type='blog' AND top='n' order by date DESC limit 0,$index_newlognum");
	echo "<div class=\"widget widget_recent_post\"><h4 class=\"widget_title\">{$title}</h4><ul class=\"recent_post\">";
	while($row = $db->fetch_array($sql)){
		if(pic_thumb($row['content'])){
			$imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($row['content'])."&h=80&w=80&zc=1";
		}else{
			$imgsrc = TEMPLATE_URL.'img/news/world/'.rand(1,11).'.jpg';
		}
		$comment = ($row['comnum'] != 0) ? '评论('.$row['comnum'].')' : '暂无评论';
		echo "<li>
			<figure class=\"widget_post_thumbnail\">
				<a href=\"".Url::log($row['gid'])."\"><img src=\"{$imgsrc}\" alt=\"{$row['title']}\"></a>
			</figure>
			<div class=\"widget_post_info\">
				<h5><a href=\"".Url::log($row['gid'])."\">".subString(strip_tags($row['title']),0,20)."</a></h5>
				<div class=\"post_meta\">
					<span><a href=\"".Url::log($row['gid'])."#comments\"><i class=\"fa fa-comments-o\"></i> {$comment}</a></span>
					<span class=\"date_meta\"><a href=\"".Url::log($row['gid'])."#comments\"><i class=\"fa fa-calendar\"></i> ".gmdate('M d, Y', $row['date'])."</a></span>
				</div>
			</div>
		</li>";
	}
	echo "</ul></div>";
}
//widget：热门文章
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$db = MySql::getInstance();
	$sql = $db->query ("SELECT * FROM ".DB_PREFIX."blog WHERE hide='n' and checked='y' and type='blog' ORDER BY views DESC, comnum DESC LIMIT 0, $index_hotlognum");
	echo "<div class=\"widget widget_recent_post\"><h4 class=\"widget_title\">{$title}</h4><ul class=\"recent_post\">";
	while($row = $db->fetch_array($sql)){
		if(pic_thumb($row['content'])){
			$imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($row['content'])."&h=80&w=80&zc=1";
		}else{
			$imgsrc = TEMPLATE_URL.'img/news/world/'.rand(1,11).'.jpg';
		}
		$comment = ($row['comnum'] != 0) ? '评论('.$row['comnum'].')' : '暂无评论';
		echo "<li>
			<figure class=\"widget_post_thumbnail\">
				<a href=\"".Url::log($row['gid'])."\"><img src=\"{$imgsrc}\" alt=\"{$row['title']}\"></a>
			</figure>
			<div class=\"widget_post_info\">
				<h5><a href=\"".Url::log($row['gid'])."\">".subString(strip_tags($row['title']),0,20)."</a></h5>
				<div class=\"post_meta\">
					<span><a href=\"".Url::log($row['gid'])."#comments\"><i class=\"fa fa-comments-o\"></i> {$comment}</a></span>
					<span class=\"date_meta\"><a href=\"".Url::log($row['gid'])."#comments\"><i class=\"fa fa-calendar\"></i> ".gmdate('M d, Y', $row['date'])."</a></span>
				</div>
			</div>
		</li>";
	}
	echo "</ul></div>";
}
//widget：随机文章
function widget_random_log($title){
	global $CACHE;
	$index_randlognum = Option::get('index_randlognum');
	$sta_cache = $CACHE->readCache('sta');
	$lognum = $sta_cache['lognum'];
	$start = $lognum > $index_randlognum ? mt_rand(0, $lognum - $index_randlognum): 0;
	$db = MySql::getInstance();
	$sql = $db->query ("SELECT * FROM ".DB_PREFIX."blog WHERE hide='n' and checked='y' and type='blog' LIMIT $start, $index_randlognum");
	echo "<div class=\"widget widget_recent_post\"><h4 class=\"widget_title\">{$title}</h4><ul class=\"recent_post\">";
	while($row = $db->fetch_array($sql)){
		if(pic_thumb($row['content'])){
			$imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($row['content'])."&h=80&w=80&zc=1";
		}else{
			$imgsrc = TEMPLATE_URL.'img/news/world/'.rand(1,11).'.jpg';
		}
		$comment = ($row['comnum'] != 0) ? '评论('.$row['comnum'].')' : '暂无评论';
		echo "<li>
			<figure class=\"widget_post_thumbnail\">
				<a href=\"".Url::log($row['gid'])."\"><img src=\"{$imgsrc}\" alt=\"{$row['title']}\"></a>
			</figure>
			<div class=\"widget_post_info\">
				<h5><a href=\"".Url::log($row['gid'])."\">".subString(strip_tags($row['title']),0,20)."</a></h5>
				<div class=\"post_meta\">
					<span><a href=\"".Url::log($row['gid'])."#comments\"><i class=\"fa fa-comments-o\"></i> {$comment}</a></span>
					<span class=\"date_meta\"><a href=\"".Url::log($row['gid'])."#comments\"><i class=\"fa fa-calendar\"></i> ".gmdate('M d, Y', $row['date'])."</a></span>
				</div>
			</div>
		</li>";
	}
	echo "</ul></div>";
}
//widget：搜索
function widget_search($title){
	echo "<div class=\"widget widget_search\">
		<h4 class=\"widget_title\">{$title}</h4>
		<form name=\"keyform\" method=\"get\" action=\"".BLOG_URL."index.php\">
			<input type=\"search\" name=\"keyword\" value=\"Search here ...\" onfocus=\"if(this.value==this.defaultValue)this.value='';\" onblur=\"if(this.value=='')this.value=this.defaultValue;\">
			<input class=\"button\" type=\"submit\" value=\"Search Now\">
		</form>
	</div>";
}
//widget：归档
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	echo "<div class=\"widget widget_categories\"><h4 class=\"widget_title\">{$title}</h4><ul class=\"categories\">";
	foreach($record_cache as $value){
		echo "<li><a href=\"".Url::record($value['date'])."\">{$value['record']} <span>({$value['lognum']})</span></a><i class=\"fa fa-angle-double-right\"></i></li>";
	}
	echo "</ul></div>";
}
//widget：自定义组件
function widget_custom_text($title, $content){
	echo "<div class=\"widget widget_advertisement\">";
	if(!empty($title)){
		echo "<h4 class=\"widget_title\">{$title}</h4>";
	}
	echo $content."</div>";
}
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	echo "<div class=\"widget widget_links\" ><h4 class=\"widget_title\">{$title}</h4><ul>";
	foreach($link_cache as $value){
		echo "<li><i class=\"fa fa-link fa-fw\"></i><a href=\"{$value['url']}\" title=\"{$value['des']}\" target=\"_blank\">{$value['link']}</a></li>";
	}
	echo "</ul></div>";
}
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	foreach($navi_cache as $value){
		if ($value['pid'] != 0) {
			continue;
		}
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
		$value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
		$current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : '';
		if(!empty($value['children']) || !empty($value['childnavi'])){
			$children = " current-menu-item";
		}
		echo "<li class=\"{$current_tab}{$children}\"><a href=\"{$value['url']}\" {$newtab}>{$value['naviname']}</a>";
		if(!empty($value['children'])){
			echo "<ul class=\"dl-submenu\">";
			foreach($value['children'] as $row){
				echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
			}
			echo "</ul>";
		}
		if(!empty($value['childnavi'])){
			echo "<ul class=\"dl-submenu\">";
			foreach($value['childnavi'] as $row){
				$newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
				echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
			}
			echo "</ul>";
		}
		echo "</li>";
	}
}
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<img src=\"".TEMPLATE_URL."/images/top.png\" title=\"首页置顶文章\" /> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<img src=\"".TEMPLATE_URL."/images/sortop.png\" title=\"分类置顶文章\" /> " : '';
    }
}
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
	echo $editflg;
}
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	if(!empty($log_cache_sort[$blogid])){
		echo "<span class=\"lf_cat_post\"><i class=\"fa fa-folder-open\"></i><a href=\"".Url::sort($log_cache_sort[$blogid]['id'])."\">{$log_cache_sort[$blogid]['name']}</a></span>";
	}
}
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '<div class="lf_tags">';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "<span><a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname']."</a></span>&nbsp;&nbsp;\n";
		}
		$tag .= '</div>';
		echo $tag;
	}
}
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	&laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>
		|
	<?php endif;?>
	<?php if($nextLog):?>
		 <a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>&raquo;
	<?php endif;?>
<?php
}
//blog：评论列表
function blog_comments($comments){
    extract($comments);
?>
<a name="comments"></a>
<div id="loading-comments"><span><i class="fa fa-spinner fa-spin"></i> 加载中...</span></div>
<ol class="commentlist clearfix">
<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
?>
<li class="comment">
	<div class="comment-body clearfix" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<div class="avatar">
			<img class="img-circle" alt="" src="<?php echo cache_gravatar($comment['mail']); ?>">
		</div>
		<div class="comment-text">
			<div class="author clearfix">
				<div class="comment-meta">
					<span><?php echo $comment['poster']; ?></span>
					<em><?php echo $comment['date']; ?></em>
				</div>
				<a class="comment-reply button" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a>
			</div>
			<div class="text">
				<p><?php echo $comment['content']; ?></p>
			</div>
		</div>
	</div>
	
<ul class="children"><?php blog_comments_children($comments, $comment['children']); ?></ul>
</li>
	<?php endforeach; ?>
</ol>
<div class="pagenav" id="pagenavi"><?php echo $commentPageUrl;?></div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<li class="comment">
		<div class="comment-body clearfix" id="comment-<?php echo $comment['cid']; ?>">
			<a name="<?php echo $comment['cid']; ?>"></a>
			<div class="avatar">
				<img class="img-circle" alt="" src="<?php echo cache_gravatar($comment['mail']); ?>">
			</div>
			<div class="comment-text">
				<div class="author clearfix">
					<div class="comment-meta">
						<span><?php echo $comment['poster']; ?></span>
						<em><?php echo $comment['date']; ?></em>
					</div>
					<a class="comment-reply button" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a>
				</div>
				<div class="text">
					<p><?php echo $comment['content']; ?></p>
				</div>
			</div>
		</div>
	</li>
	<?php blog_comments_children($comments, $comment['children']); ?>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
<div id="comment-place">
	<div id="comment-post">
		<div class="reply-title">
			<h4 class="post_title"><?php echo _g('comment_title'); ?><a name="respond"></a><span class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></span></h4>
		</div>
		<div class="comment-form">
			<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
				<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
				<?php if(ROLE == ROLE_VISITOR): ?>
				<div class="form-input">
					<i class="fa fa-user"></i>
					<input type="text" name="comname" maxlength="49" value="<?php echo $ckname; ?>" size="22" tabindex="1">
				</div>
				<div class="form-input">
					<i class="fa fa-envelope"></i>
					<input type="text" name="commail"  maxlength="128"  value="<?php echo $ckmail; ?>" size="22" tabindex="2">
				</div>
				<div class="form-input">
					<i class="fa fa-home"></i>
					<input type="text" name="comurl" maxlength="128"  value="<?php echo $ckurl; ?>" size="22" tabindex="3">
				</div>
				<?php endif; ?>
				<div class="form-input"><?php echo $verifyCode; ?></div>
				<div class="form-input">
					<i class="fa fa-comment"></i>
					<textarea placeholder="<?php echo _g('comment_text'); ?>" name="comment" id="comment"></textarea>
				</div>
				<input type="submit" class="button" value="<?php echo _g('comment_submit_text'); ?>">
				<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
			</form>
		</div>
	</div>
</div>
	<?php endif; ?>
<?php }?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
?>
