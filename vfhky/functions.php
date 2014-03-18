<?php
add_image_size('thumbnail', 140, 100, true);
add_image_size('large',600,500);
add_image_size('medium',300,260);
?>
<?php
include("includes/theme_options.php");
if (function_exists('register_sidebar'))
{
    register_sidebar(array(
		'name'			=> '小工具1',
        'before_widget'	=> '',
        'after_widget'	=> '',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3>',
    	'after_widget' => '',
    ));
}
{
    register_sidebar(array(
		'name'			=> '小工具2',
        'before_widget'	=> '',
        'after_widget'	=> '',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3>',
    	'after_widget' => '',
    ));
}
{
    register_sidebar(array(
		'name'			=> '小工具3',
        'before_widget'	=> '',
        'after_widget'	=> '',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3>',
    	'after_widget' => '',
    ));
}

if ( function_exists('register_nav_menus') ) {
    register_nav_menus(array(
        'primary' => '导航菜单'
    ));
}

//blog notice by vfhky 1
function get_notice(){
	$page_ID=178; //用来作为公告栏的页面或者文章id
    $num=3; //显示公告的条数
	$announcement = '';//设置变量值为空
	$comments = get_comments("number=$num&post_id=$page_ID&user_id=1$comment_parent=0");//获取评论（包括内容、链接等等）
	if ( !empty($comments) ) {
        $i = 1;
		foreach ($comments as $comment) {
		$comment_result = mb_strimwidth(strip_tags($comment->comment_content),0,200,"....");
		$comm_link = get_comment_link($comment->comment_ID);//获取评论链接
		$announcement .= '<li><a rel="nofollow" href='.$comm_link.' title="同步微博" style="color:#f90;">@黄克业的博客+'.$i.'</a>'. convert_smilies($comment_result) . '<span style="color:#999;">(' . get_comment_date('Y-m-d H:i',$comment->comment_ID) . ')</span><div style="width:100%;border-top:1px dashed #cccccc;"></div></li>';	
		$i += 1;}
	}
	if ( empty($announcement) ) $announcement = '<li>欢迎光临黄克业的博客！</li>';
	echo $announcement;
	}

//recall comment expression by vfhky 2
add_filter('smilies_src','custom_smilies_src',1,10);
 function custom_smilies_src ($img_src, $img, $siteurl){
     return get_bloginfo('template_directory').'/images/smilies/'.$img;
 }
// 获得热评文章
function simple_get_most_viewed($posts_num=8, $days=90){
    global $wpdb;
    $sql = "SELECT ID , post_title , comment_count
            FROM $wpdb->posts
           WHERE post_type = 'post'  AND ($wpdb->posts.`post_status` = 'publish' OR $wpdb->posts.`post_status` = 'inherit')
           ORDER BY comment_count DESC LIMIT 0 , $posts_num ";
    $posts = $wpdb->get_results($sql);
    $output = "";
    foreach ($posts as $post){
        $output .= "\n<li><a href= \"".get_permalink($post->ID)."\" rel=\"bookmark\" title=\"".$post->post_title." (".$post->comment_count."条评论)\" >". $post->post_title."</a></li>";
    }
    echo $output;
}

//分页
function pagination($query_string){
global $posts_per_page, $paged;
$my_query = new WP_Query($query_string ."&posts_per_page=-1");
$total_posts = $my_query->post_count;
if(empty($paged))$paged = 1;
$prev = $paged - 1;							
$next = $paged + 1;	
$range = 5; // 修改数字,可以显示更多的分页链接
$showitems = ($range * 2)+1;
$pages = ceil($total_posts/$posts_per_page);
if(1 != $pages){
	echo "<div class='pagination'>";
	echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<a href='".get_pagenum_link(1)."' class='fir_las'>最前</a>":"";
	echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."' class='page_previous'>« 上一页</a>":"";		
	for ($i=1; $i <= $pages; $i++){
	if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
	echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>"; 
	}
	}
	echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."' class='page_next'>下一页 »</a>" :"";
	echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."' class='fir_las'>最后</a>":"";
	echo "</div>\n";
	}
}

//日志归档
	class hacklog_archives
{
	function GetPosts() 
	{
		global  $wpdb;
		if ( $posts = wp_cache_get( 'posts', 'ihacklog-clean-archives' ) )
			return $posts;
		$query="SELECT DISTINCT ID,post_date,post_date_gmt,comment_count,comment_status,post_password FROM $wpdb->posts WHERE post_type='post' AND post_status = 'publish' AND comment_status = 'open'";
		$rawposts =$wpdb->get_results( $query, OBJECT );
		foreach( $rawposts as $key => $post ) {
			$posts[ mysql2date( 'Y.m', $post->post_date ) ][] = $post;
			$rawposts[$key] = null; 
		}
		$rawposts = null;
		wp_cache_set( 'posts', $posts, 'ihacklog-clean-archives' );;
		return $posts;
	}
	function PostList( $atts = array() ) 
	{
		global $wp_locale;
		global $hacklog_clean_archives_config;
		$atts = shortcode_atts(array(
			'usejs'        => $hacklog_clean_archives_config['usejs'],
			'monthorder'   => $hacklog_clean_archives_config['monthorder'],
			'postorder'    => $hacklog_clean_archives_config['postorder'],
			'postcount'    => '1',
			'commentcount' => '1',
		), $atts);
		$atts=array_merge(array('usejs'=>1,'monthorder'   =>'new','postorder'    =>'new'),$atts);
		$posts = $this->GetPosts();
		( 'new' == $atts['monthorder'] ) ? krsort( $posts ) : ksort( $posts );
		foreach( $posts as $key => $month ) {
			$sorter = array();
			foreach ( $month as $post )
				$sorter[] = $post->post_date_gmt;
			$sortorder = ( 'new' == $atts['postorder'] ) ? SORT_DESC : SORT_ASC;
			array_multisort( $sorter, $sortorder, $month );
			$posts[$key] = $month;
			unset($month);
		}
		$html = '<div class="car-container';
		if ( 1 == $atts['usejs'] ) $html .= ' car-collapse';
		$html .= '">'. "\n";
		if ( 1 == $atts['usejs'] ) $html .= '<a href="#" class="car-toggler">展开所有月份'."</a>\n\n";
		$html .= '<ul class="car-list">' . "\n";
		$firstmonth = TRUE;
		foreach( $posts as $yearmonth => $posts ) {
			list( $year, $month ) = explode( '.', $yearmonth );
			$firstpost = TRUE;
			foreach( $posts as $post ) {
				if ( TRUE == $firstpost ) {
                    $spchar = $firstmonth ? '<span class="car-toggle-icon car-minus">-</span>' : '<span class="car-toggle-icon car-plus">+</span>';
					$html .= '	<li><span class="car-yearmonth" style="cursor:pointer;">'.$spchar.' ' . sprintf( __('%1$s %2$d'), $wp_locale->get_month($month), $year );
					if ( '0' != $atts['postcount'] ) 
					{
						$html .= ' <span title="文章数量">(共' . count($posts) . '篇文章)</span>';
					}
                    if ($firstmonth == FALSE) {
					$html .= "</span>\n		<ul class='car-monthlisting' style='display:none;'>\n";
                    } else {
                    $html .= "</span>\n		<ul class='car-monthlisting'>\n";
                    }
					$firstpost = FALSE;
                     $firstmonth = FALSE;
				}
				$html .= '			<li>' .  mysql2date( 'd', $post->post_date ) . '日: <a target="_blank" href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a>';
				if ( '0' != $atts['commentcount'] && ( 0 != $post->comment_count || 'closed' != $post->comment_status ) && empty($post->post_password) )
					$html .= ' <span title="评论数量">(' . $post->comment_count . '条评论)</span>';
				$html .= "</li>\n";
			}
			$html .= "		</ul>\n	</li>\n";
		}
		$html .= "</ul>\n</div>\n";
		return $html;
	}
	function PostCount() 
	{
		$num_posts = wp_count_posts( 'post' );
		return number_format_i18n( $num_posts->publish );
	}
}
if(!empty($post->post_content))
{
	$all_config=explode(';',$post->post_content);
	foreach($all_config as $item)
	{
		$temp=explode('=',$item);
		$hacklog_clean_archives_config[trim($temp[0])]=htmlspecialchars(strip_tags(trim($temp[1])));
	}
}
else
{
	$hacklog_clean_archives_config=array('usejs'=>1,'monthorder'   =>'new','postorder'    =>'new');	
}
$hacklog_archives=new hacklog_archives();

//密码保护提示
function password_hint( $c ){
global $post, $user_ID, $user_identity;
if ( empty($post->post_password) )
return $c;
if ( isset($_COOKIE['wp-postpass_'.COOKIEHASH]) && stripslashes($_COOKIE['wp-postpass_'.COOKIEHASH]) == $post->post_password )
return $c;
if($hint = get_post_meta($post->ID, 'password_hint', true)){
$url = get_option('siteurl').'/wp-pass.php';
if($hint)
$hint = '密码提示：'.$hint;
else
$hint = "请输入您的密码";
if($user_ID)
$hint .= sprintf('欢迎进入，您的密码是：', $user_identity, $post->post_password);
$out = <<<END
<form method="post" action="$url">
<p>这篇文章是受保护的文章，请输入密码继续阅读：</p>
<div>
<label>$hint<br/>
<input type="password" name="post_password"/></label>
<input type="submit" value="输入密码" name="Submit"/>
</div>
</form>
END;
return $out;
}else{
return $c;
}
}
add_filter('the_content', 'password_hint');

//支持外链缩略图
if ( function_exists('add_theme_support') )
 add_theme_support('post-thumbnails');
 function catch_first_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  if(empty($first_img)){
		$random = mt_rand(1, 20);
		echo get_bloginfo ( 'stylesheet_directory' );
		echo '/images/random/tb'.$random.'.jpg';
  }
  return $first_img;
 }

//自定义头像
add_filter( 'avatar_defaults', 'fb_addgravatar' );
function fb_addgravatar( $avatar_defaults ) {
$myavatar = get_bloginfo('template_directory') . '/images/gravatar.png';
  $avatar_defaults[$myavatar] = '自定义头像';
  return $avatar_defaults;
}

//gravatar cache by vfhky 3
function vfhky_avatar( $email, $size = '40', $default , $alt) {
  // $alt = (false === $alt) ? '' : esc_attr( $alt );
  $alt = ('' == $alt) ? '' :  $alt ;//用于设置当鼠标移到头像上显示提示文字
  $f = md5( strtolower( $email ) );//根据email的值来生成一个md5变量值，作为本地.jpg头像的名字
  $a = get_bloginfo('wpurl') . '/avatar/' . $f. '.jpg';//需要在根目录下面新建一个avatar文件夹
  $e = ABSPATH .'avatar/'. $f. '.jpg';//缓存的头像的绝对路径
  $default_random_abs = ABSPATH .'wp-content/themes/vfhky/avatardefault/';//在avatar文件夹下新建一个default文件夹，用于保存博客预先自定义的头像
  $default_random = array('default1.jpg', 'default2.jpg','default3.jpg','default4.jpg','default5.jpg','default6.jpg','default7.jpg','default8.jpg','default9.jpg','default10.jpg'); //在default文件夹下添加18个自己喜欢的头像，作为没有gravatar头像的人使用
  $default_random_num = array_rand($default_random, 1);  //随机从上面18张头像中选出一张
  $t = 432000; //单位s，设置更新时间为5天
  if ( empty($default) ) $default = $default_random_abs.$default_random[$default_random_num];//设置默认头像
  if ( (time() - filemtime($e)) > $t ){ //不是第一次留言留言且留言时间超过5天就更新头像
    $r = get_option('avatar_rating');
    //$g = sprintf( "http://%d.gravatar.com", ( hexdec( $f{0} ) % 2 ) ). '/avatar/'. $f// wp 3.0 的服务器
    $g = 'http://www.gravatar.com/avatar/'. $f; // 旧服务器 (哪个快就开哪个)
    copy($g, $e); //将$g代表的网络图片复制到$e代表的本地服务器中
    if (filesize($e) == 2637 ){copy($default_random_abs.$default_random[$default_random_num], $a);}
 //如果该E-mail未在gravatar官网设置头像，则把官网默认的头像$e改成default中的随机一张图片
    else {$a = esc_attr($g);}
  }
  //如果是第一次留言并且没有官网头像，则直接用default中的随机一张图片替代
   if (!is_file($e) || filesize($e) == 2637  ) 
   {copy($default_random_abs.$default_random[$default_random_num], $e);}
  echo "<img title='{$alt}' alt='{$alt}' src='{$a}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
}

 //math-checker by vfhky 5
 function spam_provent_math(){
    $a=rand(5,15);
    $b=rand(5,15);
    echo "<input type='text' name='sum' id='sum'  size='22' tabindex='3' value='动手又动脑，哦也 ！' onfocus='if (this.value != \"\") {this.value = \"\";}' onblur='if (this.value == \"\") {this.value = \"动手又动脑，哦也 ！\";}' > = $a + $b （<font color='#0088DD'>防止机器人评论</font>）"
        ."<input type='hidden' name='a' value='$a'>"
        ."<input type='hidden' name='b' value='$b'>";
}
function spam_provent_pre($spam_result){
    $sum=$_POST['sum'];
    switch($sum){
        case $_POST['a']+$_POST['b']:break;
        case null:wp_die('亲，算个结果撒');break;
        default:wp_die('算错啦⊙﹏⊙b汗');
    }
    return $spam_result;
}
if (( !isset($user_ID) || (0 == $user_ID) ) && ( $comment_data['comment_type'] == '' ) ){
    add_filter('preprocess_comment','spam_provent_pre');
}

//obtain the visit level by vfhky 7
function get_author_class($authoremail,$user_id){ 
    global $wpdb; 
    $adminEmail = get_option('admin_email'); 
    $allcounts  =  count($wpdb->get_results( 
    "SELECT comment_ID as allallcounts FROM  $wpdb->comments WHERE comment_author_email = '$authoremail' and  comment_approved='1' ")); 
    //if($authoremail ==$adminEmail && $user_id!=0) return; 
    //因为我的管理员没有设计特殊样式，所以直接返回，可以制作图标自己定制的哦 
    if($user_id!=0 || $allcounts>=30) 
        echo '<a class="vip" target="_blank" href="'. get_bloginfo('wpurl').'/guestbook/" title="认证用户"></a>';
    if($allcounts>=0 && $allcounts<5) 
        echo '<a class="vip1" target="_blank" href="'. get_bloginfo('wpurl').'/guestbook/" title="评论少尉 LV.1"></a>'; 
    else if($allcounts>=5 && $allcounts<15) 
        echo '<a class="vip2" target="_blank" href="'. get_bloginfo('wpurl').'/guestbook/" title="评论上尉 LV.2"></a>'; 
    else if($allcounts>=15 && $allcounts<30) 
        echo '<a class="vip3" target="_blank" href="'. get_bloginfo('wpurl').'/guestbook/" title="评论少校 LV.3"></a>';     
    else if($allcounts>=30 && $allcounts<45) 
        echo '<a class="vip4" target="_blank" href="'. get_bloginfo('wpurl').'/guestbook/" title="评论上校 LV.4"></a>';     
    else if($allcounts>=45 &&$allcounts<60) 
        echo '<a class="vip5" target="_blank" href="'. get_bloginfo('wpurl').'/guestbook/" title="评论少将 LV.5"></a>';     
    else if($allcounts>=60 && $author_coun<80) 
        echo '<a class="vip6" target="_blank" href="'. get_bloginfo('wpurl').'/guestbook" title="评论中将 LV.6"></a>';     
    else if($allcounts>=80) 
        echo '<a class="vip7" target="_blank" href="'. get_bloginfo('wpurl').'/guestbook/" title="评论上将 LV.7"></a>';     
}

// 评论回复
function weisay_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
global $commentcount,$wpdb, $post;
     if(!$commentcount) { //初始化楼层计数器
          $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
          $cnt = count($comments);//获取主评论总数量
          $page = get_query_var('cpage');//获取当前评论列表页码
          $cpp=get_option('comments_per_page');//获取每页评论显示数量
         if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
             $commentcount = $cnt + 1;//如果评论只有1页或者是最后一页，初始值为主评论总数
         } else {
             $commentcount = $cpp * $page + 1;
         }
     }
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
   <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
      <?php $add_below = 'div-comment'; ?>
		<div class="comment-author vcard"><div class="level">
			<?php
			    vfhky_avatar($comment->comment_author_email, $size = '40','',$comment->comment_author);
				get_author_class($comment->comment_author_email,$comment->user_id);
			?></div>
			<div class="floor"><?php 
					$adminEmaill=get_option('admin_email');
					if($comment->comment_author_email == $adminEmaill){echo "<div align='right'><img src='".get_bloginfo('template_directory')."/images/admin.gif' title='博主专用章' alt='博主专用章' width='60' height='41'></div>";} 
 if(!$parent_id = $comment->comment_parent){
   switch ($commentcount){
     case 2 :echo "<font size='5px'>沙发</font>";--$commentcount;break;
     case 3 :echo "<font size='5px'>板凳</font>";--$commentcount;break;
     case 4 :echo "<font size='5px'>地板</font>";--$commentcount;break;
     default:printf('<font size="5px">%1$s</font><font size="3px">楼</font>', --$commentcount);
   }
 }
 ?>
         </div><strong><?php comment_author_link() ?></strong><?php useragent_output_custom(); ?>&nbsp;<font class="country-flag"><?php echo convertip(get_comment_author_ip()); ?></font></div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<span style="color:#C00; font-style:inherit">您的评论正在等待审核中...</span>
			<br />			
		<?php endif; ?>
        <div class="vfhky_quote"><?php comment_text() ?></div>
		<div class="clear"></div><span class="datetime"><?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span> <span class="reply"><?php edit_comment_link('[编辑]','&nbsp;&nbsp;',''); ?></span>&nbsp;&nbsp;<a class="quote" href="#comment-<?php comment_ID() ?>">[引用]</a>&nbsp;&nbsp;<span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => '[回复]', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
  </div>
<?php
}
function weisay_end_comment() {
		echo '</li>';
}

//登陆显示头像
function weisay_get_avatar($email, $size = 48){
return get_avatar($email, $size);
}
//彩色标签云
function colorCloud($text) {
    $text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
    return $text;
}
function colorCloudCallback($matches) {
    $text = $matches[1];
    for($a=0;$a<6;$a++){    //采用#ffffff方法
       $color.=dechex(rand(0,15));//累加随机的数据--dechex()将十进制改为十六进制
    }
    $pattern = '/style=(\'|\")(.*)(\'|\")/i';
    $text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
    return "<a $text>";
    unset($color);//卸载color
}
add_filter('wp_tag_cloud', 'colorCloud', 1);

//自动生成版权时间
function comicpress_copyright() {
    global $wpdb;
    $copyright_dates = $wpdb->get_results("
    SELECT
    YEAR(min(post_date_gmt)) AS firstdate,
    YEAR(max(post_date_gmt)) AS lastdate
    FROM
    $wpdb->posts
    WHERE
    post_status = 'publish'
    ");
    $output = '';
    if($copyright_dates) {
    $copyright = "&copy; " . $copyright_dates[0]->firstdate;
    if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
    $copyright .= '-' . $copyright_dates[0]->lastdate;
    }
    $output = $copyright;
    }
    return $output;
    }


 //obtain the commenter's IP address by vfhky 8
function convertip($ip) {
    //IP数据文件路径
    $dat_path = TEMPLATEPATH.'/qqwry.dat';
    //检查IP地址
    //if(!preg_match("/^d{1,3}.d{1,3}.d{1,3}.d{1,3}$/", $ip)) {
    //    return 'IP Address Error';
    //}
    //打开IP数据文件
    if(!$fd = @fopen($dat_path, 'rb')){
        return 'IP date file not exists or access denied';
    }
    //分解IP进行运算，得出整形数
    $ip = explode('.', $ip);
    $ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];
    //获取IP数据索引开始和结束位置
    $DataBegin = fread($fd, 4);
    $DataEnd = fread($fd, 4);
    $ipbegin = implode('', unpack('L', $DataBegin));
    if($ipbegin < 0) $ipbegin += pow(2, 32);
    $ipend = implode('', unpack('L', $DataEnd));
    if($ipend < 0) $ipend += pow(2, 32);
    $ipAllNum = ($ipend - $ipbegin) / 7 + 1;
    $BeginNum = 0;
    $EndNum = $ipAllNum;
    //使用二分查找法从索引记录中搜索匹配的IP记录
    while($ip1num>$ipNum || $ip2num<$ipNum) {
        $Middle= intval(($EndNum + $BeginNum) / 2);
        //偏移指针到索引位置读取4个字节
        fseek($fd, $ipbegin + 7 * $Middle);
        $ipData1 = fread($fd, 4);
        if(strlen($ipData1) < 4) {
            fclose($fd);
            return 'System Error';
        }
        //提取出来的数据转换成长整形，如果数据是负数则加上2的32次幂
        $ip1num = implode('', unpack('L', $ipData1));
        if($ip1num < 0) $ip1num += pow(2, 32);
        //提取的长整型数大于我们IP地址则修改结束位置进行下一次循环
        if($ip1num > $ipNum) {
            $EndNum = $Middle;
            continue;
        }
        //取完上一个索引后取下一个索引
        $DataSeek = fread($fd, 3);
        if(strlen($DataSeek) < 3) {
            fclose($fd);
            return 'System Error';
        }
        $DataSeek = implode('', unpack('L', $DataSeek.chr(0)));
        fseek($fd, $DataSeek);
        $ipData2 = fread($fd, 4);
        if(strlen($ipData2) < 4) {
            fclose($fd);
            return 'System Error';
        }
        $ip2num = implode('', unpack('L', $ipData2));
        if($ip2num < 0) $ip2num += pow(2, 32);
        //没找到提示未知
        if($ip2num < $ipNum) {
            if($Middle == $BeginNum) {
                fclose($fd);
                return 'Unknown';
            }
            $BeginNum = $Middle;
        }
    }
    $ipFlag = fread($fd, 1);
    if($ipFlag == chr(1)) {
        $ipSeek = fread($fd, 3);
        if(strlen($ipSeek) < 3) {
            fclose($fd);
            return 'System Error';
        }
        $ipSeek = implode('', unpack('L', $ipSeek.chr(0)));
        fseek($fd, $ipSeek);
        $ipFlag = fread($fd, 1);
    }
    if($ipFlag == chr(2)) {
        $AddrSeek = fread($fd, 3);
        if(strlen($AddrSeek) < 3) {
            fclose($fd);
            return 'System Error';
        }
        $ipFlag = fread($fd, 1);
        if($ipFlag == chr(2)) {
            $AddrSeek2 = fread($fd, 3);
            if(strlen($AddrSeek2) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
            fseek($fd, $AddrSeek2);
        } else {
            fseek($fd, -1, SEEK_CUR);
        }
        while(($char = fread($fd, 1)) != chr(0))
            $ipAddr2 .= $char;
        $AddrSeek = implode('', unpack('L', $AddrSeek.chr(0)));
        fseek($fd, $AddrSeek);
        while(($char = fread($fd, 1)) != chr(0))
            $ipAddr1 .= $char;
    } else {
        fseek($fd, -1, SEEK_CUR);
        while(($char = fread($fd, 1)) != chr(0))
            $ipAddr1 .= $char;
        $ipFlag = fread($fd, 1);
        if($ipFlag == chr(2)) {
            $AddrSeek2 = fread($fd, 3);
            if(strlen($AddrSeek2) < 3) {
                fclose($fd);
                return 'System Error';
            }
            $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
            fseek($fd, $AddrSeek2);
        } else {
            fseek($fd, -1, SEEK_CUR);
        }
        while(($char = fread($fd, 1)) != chr(0)){
            $ipAddr2 .= $char;
        }
    }
    fclose($fd);
    //最后做相应的替换操作后返回结果
    if(preg_match('/http/i', $ipAddr2)) {
        $ipAddr2 = '';
    }
    $ipaddr = "$ipAddr1 $ipAddr2";
    $ipaddr = preg_replace('/CZ88.Net/is', '', $ipaddr);
    $ipaddr = preg_replace('/^s*/is', '', $ipaddr);
    $ipaddr = preg_replace('/s*$/is', '', $ipaddr);
    if(preg_match('/http/i', $ipaddr) || $ipaddr == '') {
        $ipaddr = 'Unknown';
    }
	$ipaddr = iconv('gbk', 'utf-8//IGNORE', $ipaddr); //转换编码，如果网页的gbk可以删除此行
    return $ipaddr;
}	

// prevent others acting as the blog owner by vfhky 6
function  users_checking($incoming_comment) {
global $user_ID;
$isSpam = 0;
if ( strtolower(trim($incoming_comment['comment_author'])) == 'vfhky' ) $isSpam = 1;
if ( strtolower(trim($incoming_comment['comment_author_email'])) == 'vfhky@qq.com') $isSpam = 1;
if (!$isSpam || intval($user_ID) > 0) { return $incoming_comment; } else { wp_die('请勿冒充博主发表评论!'); }
}
add_filter( 'preprocess_comment', 'users_checking' );

//reply mail-notice by vfhky
 function vfhky_mail_notify($comment_id) {
     $comment = get_comment($comment_id);//根据id取得评论的所有信息
     $content=$comment->comment_content;//取得评论的内容
     //对评论内容进行匹配
     $match_count=preg_match_all('/<a href="#comment-([0-9]+)?" rel="nofollow">/si',$content,$matchs);
     if($match_count>0){//如果匹配到了
         foreach($matchs[1] as $parent_id){//对每个子匹配都进行邮件发送操作
             vfhky_send_email($parent_id,$comment);//调用自定义的邮件发送函数
         }
     }elseif($comment->comment_parent!='0'){//如果没匹配到，有人故意删了@回复，则通过查找父级评论id来确定邮件发送对象to
         $parent_id=$comment->comment_parent;
         vfhky_send_email($parent_id,$comment);
     }else return;
 }
 add_action('comment_post', 'vfhky_mail_notify');
function vfhky_send_email($parent_id,$comment){//reply mail-notice by vfhky
     $adminEmail = get_option('admin_email'); //取得博主的邮箱
     $parent_comment=get_comment($parent_id);//取得被回复者的所有信息
     $author_email=trim($comment->comment_author_email);//取得评论者的邮箱
     $to = trim($parent_comment->comment_author_email);//取得被回复者的邮箱
     $spam_confirmed = $comment->comment_approved;
     if ($spam_confirmed != 'spam') {
         $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // 
         $subject = '尊敬的 ' . trim(get_comment($parent_id)->comment_author) . '，您在 [' . get_option("blogname") . '] 中的评论有了新的回复';
$message = '<b>尊敬的：' . trim(get_comment($parent_id)->comment_author) . ' </b><br/>
<HR style="FILTER: alpha(opacity=100,finishopacity=0,style=1)" width="100%" color=#987cb9 SIZE=3>
<font style="margin:0px 0px 0px 25px;">您之前在 [' . get_option("blogname") . '] 中的一篇文章《' . get_the_title($comment->comment_post_ID) . '》上发表了如下评论：</font>
<p style="background-color:#EEE;border: 1px solid #DDD; padding: 20px;margin: 6px 0px  20px 25px;">'
. nl2br(trim(get_comment($parent_id)->comment_content)). '
</p>
<b>回复人：' . trim($comment->comment_author) . ' </b><br/>
<HR style="FILTER: alpha(opacity=100,finishopacity=0,style=1)" width="100%" color=#987cb9 SIZE=3>
<font style="margin:0px 0px 0px 25px;">给您的回复如下：</font><p style="background-color:#EEE;border: 1px solid #DDD; padding: 20px;margin: 6px 0px  20px 25px;">'
. nl2br(trim($comment->comment_content)) .
' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="text-decoration:none;"  href="' . htmlspecialchars(get_comment_link($parent_id,array("type" => "all"))) . '" target="_blank">' .'[查看回复详情]</a></p>
<b>获取博客最新资讯：</b><br/>
<HR style="FILTER: alpha(opacity=100,finishopacity=0,style=1)" width="100%" color=#987cb9 SIZE=3>
<p style="background-color:#EEE;border: 1px solid #DDD; padding: 20px;margin: 15px 0px  15px 25px;">
新浪微博：<a style="text-decoration:none;"  href="'.stripslashes(get_option('swt_tsinaurl')).'" target="_blank">'.stripslashes(get_option('swt_tsinaurl')).'</a><br/>
腾讯微博：<a style="text-decoration:none;"  href="'.stripslashes(get_option('swt_tqqurl')).'" target="_blank">'.stripslashes(get_option('swt_tqqurl')).'</a><br/>
QQ邮箱订阅：<a style="text-decoration:none;"  href="http://mail.qq.com/cgi-bin/feed?u='.get_option("siteurl").'/feed" target="_blank">http://mail.qq.com/cgi-bin/feed?u='.get_option("siteurl").'/feed</a><br/>
Google+：<a style="text-decoration:none;"  href="https://plus.google.com/101192347122765496150?rel=author" target="_blank">vfhky</a><br/>
</p>

<div align="center">感谢您对 <a href="'.get_option("siteurl").'" target="_blank">黄克业的博客</a> 的支持！<br/>任何疑问，敬请访问 <a href="'.get_option("siteurl").'/contact" target="_blank">'.get_option(siteurl).'/contact</a><br/>
Copyright &copy;2012-2013 All Rights Reserved</div>';
		 $message = convert_smilies($message);
     $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
     $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
     wp_mail( $to, $subject, $message, $headers );
     }
 }

//self-define the login platform by vfhky 4
add_filter('login_headerurl', create_function(false,"return get_bloginfo( 'siteurl' );"));
add_filter('login_headertitle', create_function(false,"return get_bloginfo( 'sitename' );"));
add_action('login_head', 'my_custom_login_logo');
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('template_directory').'/images/wordpress-logo.png) !important; }
    </style>';

}

//全部设置结束
?>