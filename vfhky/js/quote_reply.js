/* @quoter js by vfhky */
jQuery(document).ready(function($){	//Begin jQuery
$("a.quote").click(function(){
if($("#comment").length > 0){
var author = $(this).prevAll().find("strong:first").text();//获取当前引用的姓名
var content = $(this).parents("li").find(".vfhky_quote").html();//获取当前引用的内容
content = content.replace(/<\/?.+?>/g,"");//js去除html代码标记
var cmt_link = $(this).attr("href");
var output = $("#comment").val() + " <div class=\"quotescontents\">";
//注意下面这个div是控制引用内容的样式，你可以通过在主题style.css文件中自定义
output += "<strong>引用<a href=\"" + cmt_link + "\">"+ author+"<\/a>" +'原文：'+"<\/strong>"+content+"</div>";
$("#comment").val(output);
$("#comment").focus();
return false;
} else {
alert("评论已经关闭，无法引用。");
return false;
}
});
})	//End jQuery


/* @replyer js by vfhky */
jQuery(document).ready(function($){	//Begin jQuery
	$('.reply').click(function() {
	var atid = '"#' + $(this).parent().attr("id") + '"';//获取当前评论的链接地址
	var atname = $(this).prevAll().find("strong:first").text();//获取当前评论的姓名
	$("#comment").focus().attr("value","<a href=" + atid + ">@" + atname + "</a> ");
});
	$('.cancel-comment-reply a').click(function() {	//点击取消回复评论清空评论框的内容
	$("#comment").attr("value",'');
});
})	//End jQuery