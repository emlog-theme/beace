<?php
/**
 * Template name: 文章存档
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if( $tpl_side == 'y' ){include View::getView('page/pagemenu');}
function displayRecord(){
    global $CACHE; 
    $record_cache = $CACHE->readCache('record');
    $output = '';
    foreach($record_cache as $value){
        $output .= '<div class="item"><h3>'.$value['record'].'</h3>'.displayRecordItem($value['date']).'</div>';
    }
    $output = '<article class="archives">'.$output.'</article>';
    return $output;
}
function displayRecordItem($record){
    if (preg_match("/^([\d]{4})([\d]{2})$/", $record, $match)) {
        $days = getMonthDayNum($match[2], $match[1]);
        $record_stime = emStrtotime($record . '01');
        $record_etime = $record_stime + 3600 * 24 * $days;
    } else {
        $record_stime = emStrtotime($record);
        $record_etime = $record_stime + 3600 * 24;
    }
    $sql = "and date>=$record_stime and date<$record_etime order by date desc";
    $result = archiver_db($sql);
    return $result;
}
function archiver_db($condition = ''){
    $DB = MySql::getInstance();
    $sql = "SELECT gid, title,comnum, date, views FROM " . DB_PREFIX . "blog WHERE type='blog' and hide='n' $condition";
    $result = $DB->query($sql);
    $output = '';
    while ($row = $DB->fetch_array($result)) {
        $log_url = Url::log($row['gid']);
        $output .= '<li><time>'.date('d日',$row['date']).'</time><a href="'.$log_url.'">'.$row['title'].' </a><span class="muted">评论('.$row['comnum'].')</span></li>';
    }
    $output = empty($output) ? '<li>暂无文章</li>' : $output;
    $output = '<ul class="archives-list">'.$output.'</ul>';
    return $output;
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
									echo displayRecord();
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