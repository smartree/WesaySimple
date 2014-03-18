<h3>最新评论</h3>
<div class="r_comment">
<ul class="r_commentjs">
<?php
global $wpdb;
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date, comment_approved, comment_type,comment_author_url,comment_author_email, SUBSTRING(comment_content,1,240) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND user_id='0' ORDER BY comment_date DESC LIMIT 8";
$comments = $wpdb->get_results($sql);
$output = $pre_HTML;
$i=1;
foreach ($comments as $comment) {
$author = mb_strimwidth($comment->comment_author,0,8);
$comment->com_excerpt = mb_strimwidth(strip_tags($comment->com_excerpt),0,68);
$date = '<span style="color:#999;">('.date("Y-m-d H:i",strtotime($comment->comment_date)).')</span>';
$a= get_bloginfo('wpurl') .'/avatar/'.md5(strtolower($comment->comment_author_email)).'.jpg';
$output .= "\n<li><img src='". $a ."' width='32' height='32' alt='".$comment->comment_author."' title='".$comment->comment_author."' class='avatar'/>".$author."   ".$date."&nbsp;&nbsp;#".$i."<br /><a href='" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "' title='《" .$comment->post_title . "》'>" .strip_tags($comment->com_excerpt)."</a><div style='width:100%;border-top:1px dashed #cccccc;'></div></li>";
$i+=1;}
$output .= $post_HTML;
$output = convert_smilies($output);
echo $output;
?> 
</ul>
</div>