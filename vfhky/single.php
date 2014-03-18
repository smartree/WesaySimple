<?php get_header(); ?>
<div id="roll"><div title="回到顶部" id="roll_top"></div><div title="查看评论" id="ct"></div><div title="转到底部" id="fall"></div></div>
<div id="content">
<div class="main">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php the_category(', ') ?> &gt; 正文</div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="left">
<h2><?php the_title(); ?></h2>
<div class="post_date"><span class="date_m"><?php echo date('M',get_the_time('U'));?></span><span class="date_d"><?php the_time('d') ?></span><span class="date_y"><?php the_time('Y') ?></span></div>
<div class="article">
<div class="article_info">作者：<?php the_author() ?> &nbsp; 发布：<?php the_time('Y-m-d H:i') ?> &nbsp; 分类：<?php the_category(', ') ?> &nbsp; <?php if(function_exists('the_views')) { echo '阅读：'; the_views(); } ?> &nbsp; <?php comments_popup_link ('抢沙发','1条评论','%条评论'); ?> &nbsp; <?php edit_post_link('编辑', ' [ ', ' ] '); ?></div><div class="clear"></div>
        <div class="context">
        <?php if (get_option('swt_adb') == 'Display') { ?><div style="float:right;border:1px #ccc solid;padding:2px;overflow:hidden;margin:12px 0 1px 2px;"><?php echo stripslashes(get_option('swt_adbcode')); ?></div><?php { echo ''; } ?><?php } else { } ?><?php the_content('Read more...'); ?><?php wp_link_pages(); ?></div>
        <?php if (get_option('swt_adc') == 'Display') { ?><p style="text-align:center;"><?php echo stripslashes(get_option('swt_adccode')); ?></p><?php { echo ''; } ?><?php } else { } ?>
<div class="ws_alido_postMainWrap" title="Alipay-Donate"><!--支付宝-->		
	<div class="ws_alido_postChildWrap">
		<p class="ws_alido_postDesc" title="感谢您的支持！Thanks for Support！">感谢您对一名草根站长的支持，黄克业的博客始终坚持面向大众、面向草根和绿色安全的原则。如果您觉得文章还不错的话，可以通过点击右边的支付宝按钮对博客进行资助。</p>
		<div class="ws_alido_postPaySec">
			<div class="ws_alido_tip">感谢您的支持</div>
			<div class="ws_alido_tip">Thanks for Your Support</div>
			<div class="ws_alido_postPay"><a href="http://me.alipay.com/vfhky" title="支付宝赞助博客" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/alipay.png" /></a></div>
        </div>
    </div>
</div>
</div>
</div>
<div class="articles">
<div class="author_pic">
	<img src="<?php $mail = get_the_author_email();
	$a = get_bloginfo('wpurl') . '/avatar/' . md5(strtolower($mail)) . '.jpg'; echo $a; ?>" alt="<?php the_author_description();?>" title="<?php the_author_description();?>" width="40" height="40" >
</div>
<div class="author_text">
			<span class="spostinfo">
				固定链接: <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_permalink() ?> | <?php bloginfo('name');?></a><br/>
				载请注明: <a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> | <?php bloginfo('name');?></a><br/>
				<?php the_tags('关键标签: ', ', ', ''); ?>
			</span>
</div>
</div>

<div class="articles">
<?php previous_post_link('【上一篇】%link') ?><br/><?php next_post_link('【下一篇】%link') ?>
</div>
<div class="articles">
<?php comments_template(); ?>
</div>

	<?php endwhile; else: ?>
	<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>