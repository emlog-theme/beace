<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
		<div id="footer" class="footer container-fulid">
			<div class="copyright">
				<div class="hmztop"></div>
				<div class="container">
					<p>&copy; 2016 <a href="<?php echo BLOG_URL; ?>">Beace主题演示</a> &nbsp;· &nbsp;本站主题由 <a href="http://emthemanet.com" target="_blank">EmThemanet</a> 提供 &nbsp;· &nbsp;由 <a href="http://www.emlog.net" target="_blank">Emlog</a> 驱动 &nbsp;· &nbsp; <a href="<?php echo BLOG_URL; ?>sitemap.xml">网站地图</a><a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<script>window.jsui={www: '<?php echo BLOG_URL; ?>',uri: '<?php echo TEMPLATE_URL; ?>'};</script>
<?php
	load_script();
	echo $footer_info;
	doAction('index_footer');
?>
</body>
</html>
<?php
if(_g('compress_html')=='open'){
	$html=ob_get_contents();
	ob_get_clean();
	echo em_compress_html_main($html);
}
?>