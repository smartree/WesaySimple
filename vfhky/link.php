<?php
/*
Template Name: Link
*/
?>
<?php get_header(); ?>
<div id="roll"><div title="回到顶部" id="roll_top"></div><div title="查看评论" id="ct"></div><div title="转到底部" id="fall"></div></div>
<div id="content">
<div class="main">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; 链接</div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<script type="text/javascript">
jQuery(document).ready(function($){
$(".weisaylink a").each(function(e){
	$(this).prepend("<img src=http://www.google.com/s2/favicons?domain="+this.href.replace(/^(http:\/\/[^\/]+).*$/, '$1').replace( 'http://', '' )+" style=float:left;padding:5px;>");
}); 
});
</script>
<div class="left left_page">
<div class="article article_page">
<div class="weisaylink"><ul>
<?php wp_list_bookmarks('orderby=id&category_orderby=id'); ?></ul>
</div>
<div class="clear"></div>
<div class="linkstandard">
<h2 style="color:#FF0000">友链原则：</h2><ul>
<li>一、在您申请本站友情链接之前请先做好本站链接，否则不会通过，谢谢！格式如下：<br/>
链接名称：<font color="#ff0000">黄克业的博客</font><br/>
链接地址：<font color="#ff0000">http://www.huangkeye.com</font><br/>
链接简述：<font color="#ff0000">黄克业的博客 | ——麻辣的视界</font><br/>
链接详述：<font color="#ff0000">黄克业的博客，一个专注于IT互联网技术的博客。主要包括生活、IT互联、WEB开发、CMS系统、C类编程、JAVA编程、杂合七个部分。</font><br/>
本站SEO信息：<a href="http://seo.chinaz.com/?host=www.huangkeye.com&c=1&m=1" target="_blank" title="百度权重"><img src="http://www.huangkeye.com/baidu.gif" /></a>       <a href="http://seo.chinaz.com/?host=www.huangkeye.com&c=1&m=1" target="_blank" title="谷歌PR值"><img src="http://www.huangkeye.com/google.gif" /></a>       <a href="http://seo.chinaz.com/?host=www.huangkeye.com&c=1&m=1" target="_blank" title="搜狗RANK"><img src="http://www.huangkeye.com/sogou.gif" /></a></li>
<br/>
<li>二、谢绝第一次来到本博客就申请友情链接！！！</li>
<br/>
<li>三、原则上，本站目前只链接优秀的社区空间类、设计类、编程类和IT类的网站，极其欢迎原创类站点。</li>
<br/>
<li>四、如果贵站站内广告面积过大的话，一律不予链接！因为本博客纯属公益性的绿色网站！</li>
<br/>
<li>五、如果贵站原创内容＜60%，请不要链接！！！</li>
<br/>
<li>六、对于权重和PR值不做过多考虑，但需要原创并且定期更新。</li>
<br/>
<li>七、最后，如果贵站申请时间超过5天而未予回复的话，麻烦撤掉本博客的链接。</li>
<br/>
</ul>
</div>

</div>
</div>
<div class="articles articles_page">
<?php comments_template(); ?>
</div>

	<?php endwhile; else: ?>
	<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>