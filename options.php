<?php
/*
 *    DUX central theme settings
 *
 *    @support tpl_options
 */
!defined('EMLOG_ROOT') && exit('access deined!');
global $CACHE;
$options_cache = $CACHE->readCache('options');
$options = array(
    /* 基本设置 ======================================================================*/
    'compress_html' => array(
        'type' => 'radio',
        'name' => '网站源码压缩',
        'description' => '',
        'values' => array('open' => '压缩','close' => '关闭'),
        'default' => 'close'
    ),
    'logo_src' =>array(
        'type' => 'image',
        'name' => 'Logo',
        'values' => array(TEMPLATE_URL . 'img/logo.png')
    ),
    'theme_skin' => array(
        'type' => 'radio',
        'name' => '主题风格',
        'values' => array(
            'FF5E52' => '<span class="swatch" style="background-color:#FF5E52;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            '2CDB87' => '<span class="swatch" style="background-color:#2CDB87;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            '00D6AC' => '<span class="swatch" style="background-color:#00D6AC;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            '45B6F7' => '<span class="swatch" style="background-color:#45B6F7;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            'EA84FF' => '<span class="swatch" style="background-color:#EA84FF;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            'FDAC5F' => '<span class="swatch" style="background-color:#FDAC5F;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            'FD77B2' => '<span class="swatch" style="background-color:#FD77B2;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            '76BDFF' => '<span class="swatch" style="background-color:#76BDFF;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            'C38CFF' => '<span class="swatch" style="background-color:#C38CFF;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            'FF926F' => '<span class="swatch" style="background-color:#FF926F;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            '8AC78F' => '<span class="swatch" style="background-color:#8AC78F;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            'C7C183' => '<span class="swatch" style="background-color:#C7C183;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            '555555' => '<span class="swatch" style="background-color:#555555;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
        ),
        'default' => '45B6F7',
    ),
    'theme_skin_custom' =>array(
        'type' => 'text',
        'name' => '全站颜色模式设置',
        'description' => '不喜欢上面提供的颜色，你好可以在这里自定义设置，如果不用自定义颜色清空即可（默认不用自定义）<br />颜色代码参考：<br /><a style="color:red" href="http://apps2.bdimg.com/store/static/kvt/0d5af66ae6f8fcfbc5b4ffd8f1d0d6d1.swf" target="_blank">http://apps2.bdimg.com/store/static/kvt/0d5af66ae6f8fcfbc5b4ffd8f1d0d6d1.swf</a><br /><a style="color:red" href="http://www.bootcss.com/p/websafecolors/" target="_blank">http://www.bootcss.com/p/websafecolors/</a>',
        'values' => array(
            '',
        ),
    ),
    'jquery_bom' => array(
        'type' => 'radio',
        'name' => 'jQuery底部加载',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'description' => '可提高页面内容加载速度，但部分依赖jQuery的插件可能失效',
        'default' => 'close',
    ),
    'js_outlink' => array(
        'type' => 'radio',
        'name' => 'JS文件托管（可大幅提速JS加载）',
        'values' => array(
            'no' => '不托管',
            'baidu' => '百度',
            '360' => '360',
            'he' => '框架来源站点（分别引入jquery和bootstrap官方站点JS文件）',
        ),
        'default' => 'no',
    ),
    'site_gray' => array(
        'type' => 'radio',
        'name' => '网站整体变灰',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'description' => '支持IE、Chrome，基本上覆盖了大部分用户，不会降低访问速度',
        'default' => 'close',
    ),
    'layout' => array(
        'type' => 'radio',
        'name' => '网站布局',
        'description' => '2种布局供选择，点击选择你喜欢的布局方式，保存后前端展示会有所改变。',
        'values' => array('1' => '无侧边栏','2' => '有侧边栏'),
        'default' => '2'
    ),
    'home_style' => array(
        'type' => 'radio',
        'name' => '网站首页风格',
        'description' => '',
        'values' => array('blog' => '博客风格','cms' => 'cms风格'),
        'default' => 'blog'
    ),
    'cms_id_style' =>array(
        'type' => 'text',
        'name' => '首页CMS风格分类ID',
        'description' => '多个模块之间用逗号隔开即可！如1*2，1=>分类ID 2=》CMS模块',
        //'values' => array('1*6')
        'values' => array('1*1,2*2,3*3,4*1,4*5,3*6')
    ),
	'target_blank' => array(
        'type' => 'radio',
        'name' => '新窗口打开文章',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'description' => '',
        'default' => 'close',
    ),
    'post_plugin' => array(
        'type' => 'checkbox',
        'name' => '文章小部件开启',
        'values' => array(
            'view' => '阅读量',
            'like' => '点赞',
            'comm' => '列表评论数'
        ),
        'default' => array('view','like','comm'),
    ),
    /* 文章设置 ======================================================================*/
	/*
	内容段落缩进
	*/
	'post_related_s' => array(
        'type' => 'radio',
        'name' => '文章页相关文章',
        'values' => array('open' => '开启','close' => '关闭'),
        'default' => 'open'
    ),
    
    'related_title' =>array(
        'type' => 'text',
        'name' => '文章页相关文章标题',
        'description' => '',
        'values' => array('相关推荐')
    ),
    
    'post_related_n' =>array(
        'type' => 'text',
        'name' => '文章页相关文章显示数量',
        'description' => '',
        'values' => array('8')
    ),
    
    'post_copyright_s' => array(
        'type' => 'radio',
        'name' => '文章页尾版权提示',
        'values' => array('open' => '开启','close' => '关闭'),
        'default' => 'open'
    ),
    
    'post_copyright' =>array(
        'type' => 'text',
        'name' => '文章页尾版权提示前缀',
        'description' => '',
        'values' => array('未经允许不得转载：')
    ),
    'post_likes' => array(
        'type' => 'radio',
        'name' => '文章页点赞功能',
        'values' => array('open' => '开启','close' => '关闭'),
        'default' => 'open'
    ),
    /* 微分类 ======================================================================*/
	'minicat_s' => array(
        'type' => 'radio',
        'name' => '微分类状态',
        'values' => array('open' => '开启','close' => '关闭'),
        'default' => 'open'
    ),
    'minicat' =>array(
        'type' => 'text',
        'name' => '选择分类设置为微分类',
        'description' => '填写一个分类ID，分类下文章将全文输出到微分类列表',
        'values' => array('1')
    ),
    /* 首页焦点图设置 ======================================================================*/
	'focusslide_s' => array(
        'type' => 'radio',
        'name' => '轮换图状态',
        'values' => array('open' => '开启','close' => '关闭'),
        'default' => 'close'
    ),
    'focusslide_num' =>array(
        'type' => 'text',
        'name' => '轮换图展示数量',
        'description' => '',
        'values' => array('1')
    ),
    'focusslide_r_num' =>array(
        'type' => 'text',
        'name' => '轮换图右侧微图展示数量',
        'description' => '',
        'values' => array('1')
    ),
    /* 独立页面 ======================================================================*/
	'read_nums' => array(
		'type' => 'text',
		'name' => '读者墙显示数量',
		'values' => array('1')
	),
	'like_nums' => array(
		'type' => 'text',
		'name' => '点赞排行榜数量',
		'values' => array('1')
	),
    /* 字符设置 ======================================================================*/
    'index_top_title_r' =>array(
        'type' => 'text',
        'name' => '头部链接自定义右侧',
        'description' => '',
        'multi' => true,
        'values' => array("<a href='链接地址'>显示文字</a><a href='链接地址'>显示文字</a><a href='链接地址'>显示文字</a><a href='链接地址'>显示文字</a>")
    ),
    
    'comment_title' =>array(
        'type' => 'text',
        'name' => '评论标题',
        'description' => '',
        'values' => array('评论')
    ),
    
    'comment_text' =>array(
        'type' => 'text',
        'name' => '评论框默认字符',
        'description' => '',
        'values' => array('说点什么吧......')
    ),
    
    'comment_submit_text' =>array(
        'type' => 'text',
        'name' => '评论提交按钮字符',
        'description' => '',
        'values' => array('提交评论')
    ),
    /* 社交设置 ======================================================================*/
	'weibo' =>array(
        'type' => 'text',
        'name' => '新浪微博',
        'description' => '',
        'values' => array('')
    ),
    
    'tqq' =>array(
        'type' => 'text',
        'name' => '腾讯微博',
        'description' => '',
        'values' => array('')
    ),
    
    'qq' =>array(
        'type' => 'text',
        'name' => '腾讯QQ',
        'description' => '',
        'values' => array('')
    ),
    
    'twitter' =>array(
        'type' => 'text',
        'name' => 'Twitter',
        'description' => '',
        'values' => array('')
    ),
    
    'facebook' =>array(
        'type' => 'text',
        'name' => 'Facebook',
        'description' => '',
        'values' => array('')
    ),
    
    'qq_mail' =>array(
        'type' => 'text',
        'name' => 'QQ邮箱',
        'description' => '',
        'values' => array('')
    ),
    
    'feed' =>array(
        'type' => 'text',
        'name' => 'RSS订阅',
        'description' => '',
        'values' => array(BLOG_URL.'rss.php')
    ),
    /* 广告位设置 ======================================================================*/
	/*
	文章页正文结尾文字广告
	首页文章列表上
	首页分页下
	文章页正文上
	文章页正文下
	文章页评论上
	分类页列表上
	标签页列表上
	搜索页列表上
	*/
	/* 自定义代码 ======================================================================*/
    'csscode' => array(
        'type' => 'text',
        'name' => '自定义CSS样式',
        'description' => '位于之前，直接写样式代码，不用添加&lt;style&gt;标签',
        'multi' => true,
        'default' => '',
    ),
    'headcode' => array(
        'type' => 'text',
        'name' => '自定义头部代码',
        'description' => '位于之前，这部分代码是在主要内容显示之前加载，通常是CSS样式、自定义的标签、全站头部JS等需要提前加载的代码',
        'multi' => true,
        'default' => '',
    ),
    'footcode' => array(
        'type' => 'text',
        'name' => '自定义底部代码',
        'description' => '位于</body>之前，这部分代码是在主要内容加载完毕加载，通常是JS代码',
        'multi' => true,
        'default' => '',
    ),
);