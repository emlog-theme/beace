<?php 
/**
 * 局部函数库
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
error_reporting(0);
//index 分页函数
function static_page($count,$perlogs,$page,$url,$anchor=''){
    $pnums = @ceil($count / $perlogs);
    $page = @min($pnums,$page);
    $prepg=$page-1;//上一页
    $nextpg=($page==$pnums ? 0 : $page+1); //下一页
    $urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
    //开始分页导航内容
    $re = "<ul>";
    if($pnums<=1){
        return false;//如果只有一页则跳出
    }
    if($prepg){
        $re .="<li class=\"prev-page\"><a href=\"$url$prepg$anchor\">上一页</a></li>";
    }else{
        $re .="<li class=\"prev-page\"></li>";
    }
    for($i = $page-2;$i <= $page+2 && $i <= $pnums; $i++){
        if($i > 0){
            if($i == $page){
                $re .= "<li class=\"active\"><span>$i</span></li>";
            }elseif($i == 1){
                $re .= "<li><a href=\"$urlHome$anchor\">$i</a></li>";
            }else{
                $re .= "<li><a href=\"$url$i$anchor\">$i</a></li>";
            }
        }
    }
    if($nextpg){
        $re .="<li class=\"next-page\"><a href=\"$url$nextpg$anchor\">下一页</a></li>";
    }
    $re .="<li><span>共 $pnums 页</span></li>";
    $re .="</ul>";
    return $re;
}
function static_page_next($count,$perlogs,$page,$url,$anchor=''){
    $pnums = @ceil($count / $perlogs);
    $page = @min($pnums,$page);
    $prepg=$page-1;//上一页
    $nextpg=($page==$pnums ? 0 : $page+1); //下一页
    $urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
    //开始分页导航内容
    $re = "<ul class=\"pager\">";
    if($pnums<=1){
        return false;//如果只有一页则跳出
    }
    /*if($page!=1){
        $re .=" <a href=\"$urlHome$anchor\">首页</a> ";
    }*/
    if($prepg){
        $re .="<li class=\"prev-page\"><a href=\"$url$prepg$anchor\">上一页</a></li>";
    }else{
        $re .="<li class=\"prev-page\"></li>";
    }
    if($nextpg){
        $re .="<li class=\"next-page\"><a href=\"$url$nextpg$anchor\">下一页</a></li>";
    }
    $re .="</ul>";
    return $re;
}
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
    if($imgsrc):
        return $imgsrc;
    endif;
}

function blog_tool_purecontent($content, $strlen = null){
        $content = str_replace('继续阅读&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString($content, 0, $strlen);
        }
        return $content;
}

function _cssloader($arr) {
	foreach ($arr as $key => $item) {
		$href = $item;
		if (strstr($href, '//') === false) {
			$href = TEMPLATE_URL .$item.'.css';
		}
		echo "<link rel='stylesheet' id='css-{$key}' href='{$href}' />\n";
	}
}

function _jsloader($arr) {
	foreach ($arr as $item) {
		echo "<script type='text/javascript' src='".$item."'></script>\n";
	}
}
//读取系统缓存信息
function option($name){
    global $CACHE;
    $options_cache = $CACHE->readCache('options');
    return $options_cache[$name];
}
//读取用户缓存信息
function user($uid,$type){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    return $user_cache[$uid][$type];
}
//输出文章作者除链接
function blog_author_name($uid){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    return $user_cache[$uid]['name'];
}
//输出缓存作者头像链接
function blog_author_img($uid){
	global $CACHE;
    $user_cache = $CACHE->readCache('user');
	return cache_gravatar($user_cache[$uid]['mail']);
}
//收费获取文章分类
function index_sort_name($blogid){
	global $CACHE; 
    $log_cache_sort = $CACHE->readCache('logsort');
	if(!empty($log_cache_sort[$blogid])){
		echo "<div class=\"ribbon-box\">{$log_cache_sort[$blogid]['name']}</div>";
	}
}
//文件加载
function _moloader($name = '') {
	return include View::getView('modules/'.$name);
}
//Gravatar头像缓存
function cache_gravatar($email, $s = 44, $d = 'identicon', $r = 'g'){
    $f = md5($email);
    $a = BLOG_URL.'content/avatars/'.$f.'.jpg';
    $e = EMLOG_ROOT.'/content/avatars/'.$f.'.jpg';
    $t = 1296000;
    if(empty($email)){
        $a = TEMPLATE_URL.'img/avatar-default.png';
    }
    if(!is_file($e) || (time() - filemtime($e)) > $t ){
        $g = sprintf("http://secure.gravatar.com",(hexdec($f{0})%2)).'/avatar/'.$f;copy($g,$e); $a=$g;
    }
    if(filesize($e) < 500){
        copy($d,$e);
    }
    return $a;
}
//检测是否为手机
function em_is_mobile() {
    static $is_mobile;

    if ( isset($is_mobile) )
        return $is_mobile;

    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        $is_mobile = false;
    } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
            $is_mobile = true;
    } else {
        $is_mobile = false;
    }

    return $is_mobile;
}
//根据时间G来判断
function get_time_type($t){
    if($t<=3){
        $ts = '拂晓';
    }elseif($t<=6){
        $ts = '黎明';
    }elseif($t<=9){
        $ts = '清晨';
    }elseif($t<=12){
        $ts = '早上';
    }elseif($t<=15){
        $ts = '中午';
    }elseif($t<=18){
        $ts = '下午';
    }elseif($t<=21){
        $ts = '傍晚';
    }elseif($t<=00){
        $ts = '深夜/午夜';
    }
    return $ts;
}
//评论时间格式获取 含时间段
function get_time_com($ptime){
    //$ptime = strtotime($time);
    $etime = time() - $ptime;
    if ($etime < 1) {
        return '刚刚';
    }
    $interval = array(
        12 * 30 * 24 * 60 * 60 => '年前 (' . date('Y-m-d', $ptime) . ')',
        30 * 24 * 60 * 60 => '个月前 (' . date('m-d', $ptime) . ')',
        7 * 24 * 60 * 60 => '周前 (' . date('m-d', $ptime) . ')',
        24 * 60 * 60 => '天前 (' . date('m-d', $ptime) . ')',
        60 * 60 => '小时前 <time class="new">'.get_time_type(date('G', $ptime)).'</time>',
        60 => '分钟前 <time class="new">'.get_time_type(date('G', $ptime)).'</time>',
        1 => '秒前 <time class="new">'.get_time_type(date('G', $ptime)).'</time>',
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}
//评论时间格式获取 无时间段
function get_time($ptime){
    //$ptime = strtotime($time);
    $etime = time() - $ptime;
    if ($etime < 1) {
        return '刚刚';
    }
    $interval = array(
        12 * 30 * 24 * 60 * 60 => '年前',
        30 * 24 * 60 * 60 => '个月前',
        7 * 24 * 60 * 60 => '周前',
        24 * 60 * 60 => '天前',
        60 * 60 => '小时前',
        60 => '分钟前',
        1 => '秒前',
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}
//主题header加载部分
function Index_head(){
	
	echo "<link rel=\"EditURI\" type=\"application/rsd+xml\" title=\"RSD\" href=\"".BLOG_URL."xmlrpc.php?rsd\" />\n<link rel=\"wlwmanifest\" type=\"application/wlwmanifest+xml\" href=\"".BLOG_URL."wlwmanifest.xml\" />\n<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\"  href=\"".BLOG_URL."rss.php\" />\n";
	
	_cssloader(array(
		'main'=>'style',
		'bootstrap'=>'css/bootstrap',
		'bootstrap-theme'=>'css/bootstrap-theme',
		'font-awesome'=>'css/font-awesome.min'
	));
	$jss = array(
        'no' => array(
            'jquery' => TEMPLATE_URL.'js/jquery.js',
            'bootstrap' => TEMPLATE_URL . 'js/bootstrap.js'
        ),
        'baidu' => array(
            'jquery' => 'http://apps.bdimg.com/libs/jquery/2.1.3/jquery.min.js',
            'bootstrap' => 'http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js'
        ),
        '360' => array(
            'jquery' => 'http://libs.useso.com/js/jquery/2.0.0/jquery.min.js',
            'bootstrap' => 'http://libs.useso.com/js/bootstrap/3.2.0/js/bootstrap.min.js'
        ),
        'he' => array(
            'jquery' => '//code.jquery.com/jquery-2.0.0.min.js',
            'bootstrap' => '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'
        )
    );
	
	if( _g('jquery_bom') == 'close' ){
		_jsloader(array(
			'jquery'=> _g('js_outlink') ? $jss[_g('js_outlink')]['jquery'] : TEMPLATE_URL.'js/jquery.js'
		));
	}
	
	if( _g('headcode') ) echo "<!--ADD_CODE_HEADER_START-->\n"._g('headcode')."\n<!--ADD_CODE_HEADER_END-->\n";
	
	$styles = '';

    if( _g('site_gray') == 'open' ){
        $styles .= "html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}";
    }

    if( _g('theme_skin_custom') ){
        $skin_option = _g('theme_skin_custom');
        $skc = $skin_option;
    }else{
        $skin_option = _g('theme_skin');
        $skc = '#'.$skin_option;
    }
    
	if( $skin_option && $skin_option !== '45B6F7' ){
		$styles .= "a:hover, .top_bar a:hover, #primary_nav_wrap ul a:hover,#primary_nav_wrap ul li.current a,.feat-item .post-header span a, .a-post-box .latest-title a:hover,.breaking_news .breaking_news_slider a span, .block_posts .small_post_content a:hover, .featured_cat_slider a:hover,.lf_top_post .lf_title_and_meta h3:hover, .lf_meta_post a:hover, .inner_sidebar .widget a:hover, .inner_footer .widget a:hover,.widget_calendar a,.dl-menuwrapper li a:hover{color: {$skc};}#primary_nav_wrap ul a:hover,.dl-menuwrapper li a:hover{border-bottom: 2px solid {$skc};}.social_icon span a:hover, .navbar-toggle, .a-post-box .latest-cat a, .breaking_news .bn_title, .caption_inner .latest-cat a, .view_button,.slider_button a, .lf_bottom_post .lf_icon_shere .lf_share span a:hover, .lf_bottom_post .lf_icon_shere .share_toggle:hover, .lf_read_more a,.lf_thumb_post .lf_cat_post a, .lf_post .lf_thumb_post i, .lf_tags span a:hover,.comment-reply.button, .comment-edit-link, .comment-reply-link, .widget .tagcloud a:hover,.widget_search .button, button, input[type=\"submit\"], input[type=\"reset\"], input[type=\"button\"], .hmztop:hover, .back-to-home a:hover, .widget_title:after,.likepage .post-like.actived,.pagenav span, .pagenav a:hover{background-color: {$skc};}.breaking_news .bn_title span{border-left-color: {$skc};border-color: transparent transparent transparent {$skc};}";
    }

    $styles .= _g('csscode');

    if( $styles ) echo '<style>'.$styles."</style>\n";
}
//import javascript
function load_script(){
    
    $jss = array(
        'no' => array(
            'jquery' => TEMPLATE_URL.'js/jquery.js',
            'bootstrap' => TEMPLATE_URL . 'js/bootstrap.js'
        ),
        'baidu' => array(
            'jquery' => 'http://apps.bdimg.com/libs/jquery/2.1.3/jquery.min.js',
            'bootstrap' => 'http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js'
        ),
        '360' => array(
            'jquery' => 'http://libs.useso.com/js/jquery/2.0.0/jquery.min.js',
            'bootstrap' => 'http://libs.useso.com/js/bootstrap/3.2.0/js/bootstrap.min.js'
        ),
        'he' => array(
            'jquery' => '//code.jquery.com/jquery-2.0.0.min.js',
            'bootstrap' => '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'
        )
    );
    $jquery = _g('js_outlink') ? $jss[_g('js_outlink')]['jquery'] : TEMPLATE_URL.'js/jquery.js';
    $bootstrap = _g('js_outlink') ? $jss[_g('js_outlink')]['bootstrap'] : TEMPLATE_URL . 'js/bootstrap.js';
	
    if( _g('jquery_bom') == 'open' ){
		_jsloader(array('jquery'=> $jquery));
    }
	_jsloader(array(
		'bootstrap'=> $bootstrap,
		'plugins'=> TEMPLATE_URL.'js/plugins.js',
		'custom'=> TEMPLATE_URL.'js/custom.js'
	));
    if( _g('footcode') ) echo "<!--ADD_CODE_FOOTER_START-->\n"._g('footcode')."\n<!--ADD_CODE_FOOTER_END-->\n";
}
//网站源码压缩函数
function em_compress_html_main($buffer){
    $initial=strlen($buffer);
    $buffer=explode("<!--em-compress-html-->", $buffer);
    $count=count ($buffer);
    for ($i = 0; $i <= $count; $i++){
        if (stristr($buffer[$i], '<!--em-compress-html no compression-->')){
            $buffer[$i]=(str_replace("<!--em-compress-html no compression-->", " ", $buffer[$i]));
        }else{
            $buffer[$i]=(str_replace("\t", " ", $buffer[$i]));
            $buffer[$i]=(str_replace("\n\n", "\n", $buffer[$i]));
            $buffer[$i]=(str_replace("\n", "", $buffer[$i]));
            $buffer[$i]=(str_replace("\r", "", $buffer[$i]));
            while (stristr($buffer[$i], '  '))
            {
            $buffer[$i]=(str_replace("  ", " ", $buffer[$i]));
            }
        }
        $buffer_out.=$buffer[$i];
    }
    $final=strlen($buffer_out);
    $savings=($initial-$final)/$initial*100;
    $savings=round($savings, 2);
    $buffer_out.="\n<!--压缩前的大小: $initial bytes; 压缩后的大小: $final bytes; 节约：$savings% -->";
    return $buffer_out;
}
//内容页面禁止PRE压缩
function unCompress($content){
    if(preg_match_all('/(crayon-|<\/pre>)/i', $content, $matches)) {
        $content = '<!--em-compress-html--><!--em-compress-html no compression-->'.$content;
        $content.= '<!--em-compress-html no compression--><!--em-compress-html-->';
    }
    return $content;
}
//module获取分类
function mo_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	if(!empty($log_cache_sort[$blogid])){
		return "<span class=\"latest-cat\"><a href=\"".Url::sort($log_cache_sort[$blogid]['id'])."\">{$log_cache_sort[$blogid]['name']}</a></span>";
	}
}
//CMS分类名称获取
function mo_sort_name($sortid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('sort');
	if(!empty($log_cache_sort[$sortid])){
		return "<div class=\"featured_title\"><h4>{$log_cache_sort[$sortid]['sortname']}</h4><a href=\"".Url::sort($log_cache_sort[$sortid]['sid'])."\" class=\"view_button\">更多</a></div>";
	}
}
//CMS标签
function cms_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '<div class="cat_list_post"><span class="lf_cat_post">';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "	<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		$tag .= '</span></div>';
		return $tag;
	}
}
//模板点赞功能
function likes($logid,$type='2'){
	if($type=='1'){
		$l = '<a href="javascript:;" class="sharebtn like" data-pid="'.$logid .'" evt="likes" ><i class="fa fa-thumbs-o-up"></i>赞 (<span>'.(isset($log['praise']) ? $log['praise'] : likes_getNum($logid)).'</span>)</a>';
	}elseif($type=='2'){
		$l = '<span class="lf_date_post"><a data-pid="'. $logid .'" evt="likes" ><i class="fa fa-thumbs-o-up"></i>赞 (<span>'.(isset($log['praise']) ? $log['praise'] : likes_getNum($logid)).'</span>)</a></span>';
	}
	return $l;
}
function likes_getNum($logid){
	static $arr = array();
	$DB = Database::getInstance();
	if(isset($arr[$logid])) return $arr[$logid];
	$sql = "SELECT praise FROM " . DB_PREFIX . "blog WHERE gid=$logid";
	$res = $DB->query($sql);
	$row = $DB->fetch_array($res);
	$arr[$logid] = intval($row['praise']);
	return $arr[$logid];
}
//侧边栏日历获取
 function calendar() {
	$DB = Database::getInstance();
	$timezone = Option::get('timezone');
	$timestamp = time() + $timezone * 3600;
	
	$query = $DB->query("SELECT date FROM ".DB_PREFIX."blog WHERE hide='n' and checked='y' and type='blog'");
	while ($date = $DB->fetch_array($query)) {
		$logdate[] = gmdate("Ymd", $date['date'] + $timezone * 3600);
	}
	$n_year  = gmdate("Y", $timestamp);
	$n_year2 = gmdate("Y", $timestamp);
	$n_month = gmdate("m", $timestamp);
	$n_day   = gmdate("d", $timestamp);
	$time    = gmdate("Ymd", $timestamp);
	$year_month = gmdate("Ym", $timestamp);
	
	if (isset($_GET['record'])) {
		$n_year = substr(intval($_GET['record']),0,4);
		$n_year2 = substr(intval($_GET['record']),0,4);
		$n_month = substr(intval($_GET['record']),4,2);
		$year_month = substr(intval($_GET['record']),0,6);
	}
	
	$m  = $n_month - 1;
	$mj = $n_month + 1;
	$m  = ($m < 10) ? '0' . $m : $m;
	$mj = ($mj < 10) ? '0' . $mj : $mj;
	$year_up = $n_year;
	$year_down = $n_year;
	if ($mj > 12) {
		$mj = '01';
		$year_up = $n_year + 1;
	}
	if ( $m < 1) {
		$m = '12';
		$year_down = $n_year - 1;
	}
	$url = DYNAMIC_BLOGURL.'?action=cal&record=' . ($n_year - 1) . $n_month;
	$url2 = DYNAMIC_BLOGURL.'?action=cal&record=' . ($n_year + 1) . $n_month;
	$url3 = DYNAMIC_BLOGURL.'?action=cal&record=' . $year_down . $m;
	$url4 = DYNAMIC_BLOGURL.'?action=cal&record=' . $year_up . $mj;

	$calendar ="<table id=\"calendar\"><caption>{$n_year2}年{$n_month}月</caption><thead><tr><th scope=\"col\" title=\"星期一\">一</th><th scope=\"col\" title=\"星期二\">二</th><th scope=\"col\" title=\"星期三\">三</th><th scope=\"col\" title=\"星期四\">四</th><th scope=\"col\" title=\"星期五\">五</th><th scope=\"col\" title=\"星期六\">六</th><th scope=\"col\" title=\"星期日\">日</th></tr></thead><tbody>";
		
	$week = @gmdate("w",gmmktime(0,0,0,$n_month,1,$n_year));
	$lastday = @gmdate("t",gmmktime(0,0,0,$n_month,1,$n_year));
	$lastweek = @gmdate("w",gmmktime(0,0,0,$n_month,$lastday,$n_year));
	if ($week == 0) {
		$week = 7;
	}
	$j = 1;
	$w = 7;
	$isend = false;
	for ($i = 1;$i <= 6;$i++) {
		if ($isend || ($i == 6 && $lastweek==0)) {
			break;
		}
		$calendar .= '<tr>';
		for ($j ; $j <= $w; $j++) {
			if ($j < $week) {
				$calendar.= '<td>&nbsp;</td>';
			} elseif ( $j <= 7 ) {
				$r = $j - $week + 1;
				$n_time = $n_year . $n_month . '0' . $r;
				if (@in_array($n_time,$logdate) && $n_time == $time) {
					$calendar .= '<td id="today">'. $r .'</td>';
				} elseif (@in_array($n_time,$logdate)) {
					$calendar .= '<td>'. $r .'</td>';
				} elseif ($n_time == $time) {
					$calendar .= '<td id="today">'. $r .'</td>';
				} else {
					$calendar.= '<td>'. $r .'</td>';
				}
			} else {
				$t = $j - ($week - 1);
				if ($t > $lastday) {
					$isend = true;
					$calendar .= '<td>&nbsp;</td>';
				} else {
					$t < 10 ? $n_time = $n_year . $n_month . '0' . $t : $n_time = $n_year . $n_month . $t;
					if (@in_array($n_time,$logdate) && $n_time == $time) {
						$calendar .= '<td id="today">'. $t .'</td>';
					} elseif(@in_array($n_time,$logdate)) {
						$calendar .= '<td>'. $t .'</td>';
					} elseif($n_time == $time) {
						$calendar .= '<td id="today">'. $t .'</td>';
					} else {
						$calendar .= '<td>'.$t.'</td>';
					}
				}
			}
		}
		$calendar .= '</tr>';
		$w += 7;
	}
	$calendar .= '</tbody></table>';
	return $calendar;
}
//文章详情页下相关文章
function related_logs($logData = array(),$log_num){
    if(is_file($configfile)){
        require $configfile;
    }else{
        $related_log_type = 'sort';//相关日志类型，sort为分类，tag为标签；
        $related_log_sort = 'views_desc';//排列方式，views_desc 为点击数（降序）comnum_desc 为评论数（降序） rand 为随机 views_asc 为点击数（升序）comnum_asc 为评论数（升序）
        $related_log_num = $log_num; //显示文章数
        $related_inrss = 'y'; //是否显示在rss订阅中，y为是，其它值为否
    }
    global $value;
    $DB = MySql::getInstance();
    $CACHE = Cache::getInstance();
    extract($logData);
    if($value){
        $logid = $value['id'];
        $sortid = $value['sortid'];
        global $abstract;
    }
    $sql = "SELECT gid,title,content,date FROM ".DB_PREFIX."blog WHERE hide='n' AND type='blog'";
    if($related_log_type == 'tag'){
        $log_cache_tags = $CACHE->readCache('logtags');
        $Tag_Model = new Tag_Model();
        $related_log_id_str = '0';
        foreach($log_cache_tags[$logid] as $key => $val){
            $related_log_id_str .= ','.$Tag_Model->getTagByName($val['tagname']);
        }
        $sql .= " AND gid!=$logid AND gid IN ($related_log_id_str)";
    }else{
        $sql .= " AND gid!=$logid AND sortid=$sortid";
    }
    switch($related_log_sort){
        case 'views_desc':{
            $sql .= " ORDER BY views DESC";break;
        }
        case 'views_asc':{
            $sql .= " ORDER BY views ASC";
            break;
        }
        case 'comnum_desc':{
            $sql .= " ORDER BY comnum DESC";
            break;
        }
        case 'comnum_asc':{
            $sql .= " ORDER BY comnum ASC";
            break;
        }
        case 'rand':{
            $sql .= " ORDER BY rand()";
        break;
        }
    }
    $sql .= " LIMIT 0,$related_log_num";
    $related_logs = array();
    $query = $DB->query($sql);
    while($row = $DB->fetch_array($query)){
        $row['gid'] = intval($row['gid']);
        $row['title'] = htmlspecialchars($row['title']);
        $related_logs[] = $row;
    }
    $out = '';
	if(!empty($related_logs)){
		foreach($related_logs as $val){
			if(pic_thumb($value['content'])){
				$imgsrc = TEMPLATE_URL."timthumb.php?src=".pic_thumb($value['content'])."&h=175&w=234&zc=1";
			}else{
				$imgsrc = TEMPLATE_URL."timthumb.php?src=".TEMPLATE_URL.'img/news/featured-slider/'.rand(1,10).'.jpg&h=175&w=234&zc=1';
			}
			$out .= "<li class=\"item\"><div class=\"img_box\"><a href=\"".Url::log($val['gid'])."\"><img src=\"{$imgsrc}\" alt=\"{$val['title']}\"></a></div><h5><a href=\"".Url::log($val['gid'])."\">{$val['title']}</a></h5><span class=\"date\">".gmdate('M d, Y', $val['date'])."</span></li>";
		}
	}
    if(!empty($value['content'])){
        if($related_inrss == 'y'){
            $abstract .= $out;
        }
    }else{
        echo $out;
    }
}