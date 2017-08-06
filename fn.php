<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
if (PHP_VERSION < '5.0'){
    emMsg('您的php版本过低，请选用支持PHP5的环境配置。');
    exit();
}

if( !file_exists(EMLOG_ROOT."/content/templates/".Option::get('nonce_templet')."/inc/setted.".Option::get('nonce_templet').".inc")){
    emDirect(TEMPLATE_URL.'install.php');
    exit();
}

if(!is_readable(EMLOG_ROOT.'/content/avatars/')){
	emDirect(TEMPLATE_URL.'install.php');
    exit();
}
/**
 * body class include
 */
include View::getView('inc/post-template');
/**
 * 普通函数库加载
 */
include View::getView('inc/functions');

if(em_is_mobile()==false){
	if(!strpos($_SERVER["HTTP_USER_AGENT"],"Chrome")){
		echo '<!doctype html><html lang="en"><head><meta charset="UTF-8"><title>出错啦</title><style>body{color: #999;font-family: \'Microsoft Yahei\';text-align: center;margin: 0;padding: 0;}h1{font-size: 140px;margin: 0 0 20px;padding: 10px 0;background-color: #19B5FE;color: #fff;font-weight: normal;padding-top: 200px;}h2{font-size: 32px;margin: 0 0 10px;font-weight: normal;}h3{font-size: 25px;margin: 0 0 40px;font-weight: normal;}a{font-size: 14px;color: #fff;background-color: #00AAEF;display: inline-block;padding: 10px 20px;border-radius: 2px;text-decoration: none;}a:hover{color: #fff;background-color: #049FDE;}@media (max-width: 600px) {h1{padding-top: 100px;font-size: 120px;}}</style></head><body><h1>Error</h1><h2>出错啦</h2><h3>当前您未使用Google Chrome，请使用Google Chrome来打开此站，谢谢！</h3><a href="'.BLOG_URL.'">返回首页</a></body></html>';
		exit;}
}