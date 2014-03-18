jQuery(document).ready(function(){
jQuery('.article h2 a').click(function(){
    jQuery(this).text('页面载入中……');
    window.location = jQuery(this).attr('href');
    });
});

// 滚屏
jQuery(document).ready(function(){
jQuery('#roll_top').click(function(){jQuery('html,body').animate({scrollTop: '0px'}, 800);}); 
jQuery('#ct').click(function(){jQuery('html,body').animate({scrollTop:jQuery('#comments,#ds-reset').offset().top}, 800);});
jQuery('#fall').click(function(){jQuery('html,body').animate({scrollTop:jQuery('#footer').offset().top}, 800);});
});

//顶部导航下拉菜单
jQuery(document).ready(function(){
jQuery(".topnav ul li").hover(function(){
jQuery(this).children("ul").show();
jQuery(this).addClass("li01");
},function(){
jQuery(this).children("ul").hide();
jQuery(this).removeClass("li01");
});
});

//侧边栏TAB效果
jQuery(document).ready(function(){
jQuery('#tab-title span').click(function(){
	jQuery(this).addClass("selected").siblings().removeClass();
	jQuery("#tab-content > ul").slideUp('1500').eq(jQuery('#tab-title span').index(this)).slideDown('1500');
});
});

//图片渐隐
jQuery(function () {
jQuery('.thumbnail img').hover(
function() {jQuery(this).fadeTo("fast", 0.5);},
function() {jQuery(this).fadeTo("fast", 1);
});
});

//新窗口打开
jQuery(document).ready(function(){
	jQuery("a[rel='external'],a[rel='external nofollow']").click(
	function(){window.open(this.href);return false})
});

//顶部微博等图标渐隐
jQuery(document).ready(function(){
			jQuery('.icon1,.icon2,.icon3,.icon4').wrapInner('<span class="hover"></span>').css('textIndent','0').each(function () {
				jQuery('span.hover').css('opacity', 0).hover(function () {
					jQuery(this).stop().fadeTo(350, 1);
				}, function () {
					jQuery(this).stop().fadeTo(350, 0);
				});
			});
});

//预加载广告
function speed_ads(loader, ad) {
var ad = document.getElementById(ad),
loader = document.getElementById(loader);
if (ad && loader) {
ad.appendChild(loader);
loader.style.display='block';
ad.style.display='block';
}
}
window.onload=function() {
speed_ads('adsense-loader1', 'adsense1');
speed_ads('adsense-loader2', 'adsense2');
speed_ads('adsense-loader3', 'adsense3');
};

/* blog-notice js by vfhky */
jQuery(document).ready(function($){	//Begin jQuery

$(function(){
var _wrap=$('ul.notice');//定义滚动区域
var _interval=6000;//定义滚动间隙时间
var _moving;//需要清除的动画
_wrap.hover(function(){
clearInterval(_moving);//当鼠标在滚动区域中时,停止滚动
},function(){
_moving=setInterval(function(){
var _field=_wrap.find('li:first');//此变量不可放置于函数起始处,li:first取值是变化的
var _h=_field.height();//取得每次滚动高度(多行滚动情况下,此变量不可置于开始处,否则会有间隔时长延时)
_field.animate({marginTop:-_h+'px'},600,function(){//通过取负margin值,隐藏第一行
_field.css('marginTop',0).appendTo(_wrap);//隐藏后,将该行的margin值置零,并插入到最后,实现无缝滚动
})
},_interval)//滚动间隔时间取决于_interval
}).trigger('mouseleave');//函数载入时,模拟执行mouseleave,即自动滚动
});

})	//End Notice jQuery


/* r_comment js by vfhky */
jQuery(document).ready(function($){	//Begin jQuery

$(function(){
var _wrap=$('ul.r_commentjs');//定义滚动区域
var _interval=6000;//定义滚动间隙时间
var _moving;//需要清除的动画
_wrap.hover(function(){
clearInterval(_moving);//当鼠标在滚动区域中时,停止滚动
},function(){
_moving=setInterval(function(){
var _field=_wrap.find('li:first');//此变量不可放置于函数起始处,li:first取值是变化的
var _h=_field.height();//取得每次滚动高度(多行滚动情况下,此变量不可置于开始处,否则会有间隔时长延时)
_field.animate({marginTop:-_h+'px'},600,function(){//通过取负margin值,隐藏第一行
_field.css('marginTop',0).appendTo(_wrap);//隐藏后,将该行的margin值置零,并插入到最后,实现无缝滚动
})
},_interval)//滚动间隔时间取决于_interval
}).trigger('mouseleave');//函数载入时,模拟执行mouseleave,即自动滚动
});

})	//End r_comment jQuery