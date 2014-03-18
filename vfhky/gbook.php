<?php
/*
Template Name: Guestbook
*/
?>
<?php get_header(); ?>
<div id="roll"><div title="回到顶部" id="roll_top"></div><div title="查看评论" id="ct"></div><div title="转到底部" id="fall"></div></div>
<div id="content">
<div class="main">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; 留言</div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="left left_page">
<div class="article article_page">
<h2>留言TOP 28</h2>
<div class="v_comment"><ul>
<?php
$counts = $wpdb->get_results("SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE user_id='0' AND comment_author_email != '' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 28");
foreach ($counts as $count) {
$a = get_bloginfo('wpurl') . '/avatar/' . md5(strtolower($count->comment_author_email)) . '.jpg';
$c_url = $count->comment_author_url;
$mostactive .= '<li class="mostactive">' . '<a href="'. $c_url . '" title="' . $count->comment_author . '（共留下 '. $count->cnt . ' 个脚印）" target="_blank" rel="external nofollow"><img src="' . $a . '" alt="' . $count->comment_author . '（共留下 '. $count->cnt . ' 个脚印）" class="avatar" width="40px" height="40px"/></a></li>';
}
echo $mostactive;
?></ul>
</div>
<div class="clear"></div><p><br/></p>
<h1 style="text-align:center"><font color="#ff0000">—Started 评论授衔仪式 at 2012.12.11 08:00—</font></h1>

<p>为了活跃博客的气氛，增进博友之间的交流，黄克业的博客从2012.12.11 08:00开始对博客所有评论者进行授衔仪式！！！</p>
<h2>授衔规则</h2>

<p><span title="评论少尉 LV.1" class="vip1"></span>  &nbsp; 级别：评论少尉；&nbsp; 要求：评论条数>1；</p>

<p><span title="评论上尉 LV.2" class="vip2"></span>  &nbsp; 级别：评论上尉；&nbsp; 要求：评论条数>5；</p>

<p><span title="评论少校 LV.3" class="vip3"></span>  &nbsp; 级别：评论少校；&nbsp; 要求：评论条数>15；</p>

<p><span title="评论上校 LV.4" class="vip4"></span>  &nbsp; 级别：评论上校；&nbsp; 要求：评论条数>30；</p>

<p><span title="评论少将 LV.5" class="vip5"></span>  &nbsp; 级别：评论少将；&nbsp; 要求：评论条数>45；</p>

<p><span title="评论中将 LV.6" class="vip6"></span>  &nbsp; 级别：评论中将；&nbsp; 要求：评论条数>60；</p>

<p><span title="评论大将 LV.7" class="vip7"></span>  &nbsp; 级别：评论大将；&nbsp; 要求：评论条数>80；<p>

<p>&nbsp; &nbsp;&nbsp; <span title="认证用户" class="vip"></span>&nbsp; &nbsp; &nbsp; 级别：认证用户；&nbsp; 要求：博客认证用户或者至少为上校级别的用户持有。</p>

<h2>附录说明</h2>

<p class="articles_all"><hr style="border:1px dashed #0000fff"/>追求完美，追求卓越，坚持写好博客中的每一篇文章！但这并不代表没有缺点，所以当你发现博客中存在任何失误的地方，请不要吝啬指出来。<br/>

如果你在博客中遇到了任何疑问或者需要更多的互动交流，可以通过以下方式和我取得联系：<br/><br/>

<font color="#ff0000">1.</font> E-mail：vfhky@qq.com ，QQ：546836353。<br/><br/>

<font color="#ff0000">2.</font> QQ群：①24385396  ②202828505 进群请注明一下“黄克业的博客”以便成功审核。<br/><br/>

<font color="#ff0000">3.</font> 最直接的方式：通过本博客留言，系统会自动通过发邮件方式通知我。<br/><br/>

<strong><font color="#ff0000">4. 如何下载本站中的共享资源：</font></strong><br/>

<strong>@115网盘：</strong><a href="http://115.com/folder/fb8w6zvd6#黄克业的博客资源共享区" title="黄克业的博客资源共享区" target="_blank">黄克业的博客资源共享区</a>。大家也可以加入黄克业的博客在115的圈子，1圈号106474，2圈号113684；<br/>

<strong>@百度云盘：</strong><a href="http://pan.baidu.com/share/link?shareid=78704&uk=1879910561" title="黄克业的博客资源共享区" target="_blank">黄克业的博客资源共享区</a>；&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>@谷歌托管代码：</strong><a href="https://code.google.com/p/huangkeye-blog/downloads/list" title="黄克业的博客资源共享区" target="_blank">黄克业的博客资源共享区</a>。<br/><br/>

<font color="#ff0000" size="4px"><strong>5.VIP付费技术服务：</strong>黄克业的博客承接各类型网站、系统的开发与建设，并提供已有网站或系统软件所存在的问题的技术解决方案。</font>
</div></div>

<div class="articles articles_page">
<?php comments_template(); ?>
</div>

	<?php endwhile; else: ?>
	<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>