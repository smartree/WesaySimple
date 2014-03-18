<div id="sidebar">
<div class="notice">
<ul class="notice"><?php get_notice(); ?></ul>
</div>
<div class="widget">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('小工具1') ) : ?>
	<?php endif; ?>
</div>
<div class="clear"></div>
<?php if (get_option('swt_ada') == 'Display') { ?>
<div class="widget"><h3>大家赞助</h3><?php echo stripslashes(get_option('swt_adacode')); ?></div><?php { echo ''; } ?><?php } else { } ?><div class="clear"></div>

<div class="widget"><div id="tab-title"><?php include('includes/r_tab.php'); ?></div></div>
<div class="clear"></div>
<div class="widget"><div class="top_comment">
	<?php include(TEMPLATEPATH . '/includes/top_comment.php'); ?></div>
</div>
<div class="clear"></div>
<div class="widget"><?php include('includes/r_comment.php'); ?></div>

<div class="widget"><?php include('includes/r_tags.php'); ?></div>

<div class="widget"><?php include('includes/r_statistics.php'); ?></div>
<div class="clear"></div>
<?php if ( is_home() ) { ?>
<div class="widget">
<h3>友链展示</h3>
<div class="v-links"><ul><?php wp_list_bookmarks('orderby=link_id&categorize=0&category='.get_option('swt_links').'&title_li='); ?><li><a href="http://www.huangkeye.com/links" title="友情链接 | 黄克业的博客" target="_blank">申请/更多</a></li></ul></div></div>
<div class="clear"></div>
<?php } ?>
<div class="clear"></div>

</div>
</div>