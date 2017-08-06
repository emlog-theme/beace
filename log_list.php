<?php
/**
 * 站点列表模板加载
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if(blog_tool_ishome()){
	if(_g('home_style')=='cms'){
		include View::getView('modules/mo-log-list-1');
	}else{
		include View::getView('modules/mo-log-list-2');
	}
}else{
	include View::getView('modules/mo-log-list-3');
}