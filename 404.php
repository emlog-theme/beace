<?php 
/**
 * 自定义404页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>出错啦</title>
<style>
body{color: #999;font-family: 'Microsoft Yahei';text-align: center;margin: 0;padding: 0;}
h1{font-size: 140px;margin: 0 0 20px;padding: 10px 0;background-color: #19B5FE;color: #fff;font-weight: normal;padding-top: 200px;}
h2{font-size: 32px;margin: 0 0 10px;font-weight: normal;}
h3{font-size: 25px;margin: 0 0 40px;font-weight: normal;}
a{font-size: 14px;color: #fff;background-color: #00AAEF;display: inline-block;padding: 10px 20px;border-radius: 2px;text-decoration: none;}
a:hover{color: #fff;background-color: #049FDE;}
@media (max-width: 600px) {
	h1{padding-top: 100px;font-size: 120px;}
}
</style>
</head>
<body>
<h1>404</h1>
<h2>出错啦</h2>
<h3>你找的内容不存在！</h3>
<a href="<?php echo BLOG_URL; ?>">返回首页</a>
</body>
</html>