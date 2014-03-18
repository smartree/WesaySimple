<h3><span>读者推荐</span><span class="selected">热评文章</span><span>随机文章</span></h3>
	<div id="tab-content">
		<ul class="hide">
		  <?php if (function_exists('get_most_viewed')): ?>
          <?php get_most_viewed(); ?>
          <?php endif; ?>
		</ul>
		<ul><?php simple_get_most_viewed(); ?></ul>
		<ul class="hide">
		<?php $myposts = get_posts('numberposts=8&orderby=rand');foreach($myposts as $post) :?>
		   <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php mb_strimwidth(the_title(),0,36); ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>