<?php get_header(); ?>
<div id="roll"><div title="回到顶部" id="roll_top"></div><div title="转到底部" id="fall"></div></div>
<div id="content">
<div class="main">
<div id="mapsite">当前位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; 搜索结果</div>
<!--搜索结果开始--><p><br/></p>
<font color="#FF0000" face="微软雅黑" size="4px">搜索<font color="#0000FF" face="微软雅黑">“<?php the_search_query(); ?>”</font>的结果</font>
<div id="cse" style="width: 100%;"><form action="http://www.baidu.com/baidu" target="_blank">
<table bgcolor="#C78DCC" style="font-size:10pt;margin: 30px auto;">
<tr height="60">
<td>
<input name="word" style="width: 405px;height: 32px;font: 16px/22px arial;background: white;outline: none;-webkit-appearance: none;background: url(<?php bloginfo('template_directory'); ?>/images/bdsearch.png) no-repeat -304px 0;"  onfocus="if (this.value != '') {this.value = '';}" onblur="if (this.value == '') {this.value = ' Google努力搜索中，若5秒内未显示结果，请换百度';}" value=" Google努力搜索中，若5秒内未显示结果，请换百度">
<span style="width: 96px;height: 33px;display: inline-block;background: url(<?php bloginfo('template_directory'); ?>/images/bdsearch.png) no-repeat -202px 0;z-index: 0;vertical-align: top;">
<input type="submit" value="百度试试" style="width: 95px;height: 32px;padding-top: 2px;font-size: 14px;background: #DDD url(<?php bloginfo('template_directory'); ?>/images/bdsearch.png);cursor: pointer;">
</span>
<input name=tn type=hidden value="bds">
<input name=cl type=hidden value="3">
<input name=ct type=hidden value="2097152">
<input name=si type=hidden value="www.huangkeye.cn">
</td></tr></table>
</form></div>
<font color="#FF0000" face="微软雅黑" size="4px">搜索<font color="#0000FF" face="微软雅黑">“<?php the_search_query(); ?>”</font>的结果</font><p><br/></p>
</div>
<!--搜索结果结束-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
<script src="http://www.google.com.hk/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
  google.load('search', '1', {language : 'zh-CN', style : google.loader.themes.BUBBLEGUM});
  google.setOnLoadCallback(function() {
    var customSearchOptions = {};
    var orderByOptions = {};
    orderByOptions['keys'] = [{label: '相关性', key: ''},{label: '日期', key: 'date'}];
    customSearchOptions['enableOrderBy'] = true;
    customSearchOptions['orderByOptions'] = orderByOptions;
    var imageSearchOptions = {};
    imageSearchOptions['layout'] = google.search.ImageSearch.LAYOUT_POPUP;
    customSearchOptions['enableImageSearch'] = true;
    customSearchOptions['imageSearchOptions'] = imageSearchOptions;  var customSearchControl = new google.search.CustomSearchControl(
      '009679826070314366499:8kwbjps0rz0', customSearchOptions);
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    var options = new google.search.DrawOptions();
    options.setAutoComplete(true);
    options.enableSearchResultsOnly(); 
    customSearchControl.draw('cse', options);
    function parseParamsFromUrl() {
      var params = {};
      var parts = window.location.search.substr(1).split('\x26');
      for (var i = 0; i < parts.length; i++) {
        var keyValuePair = parts[i].split('=');
        var key = decodeURIComponent(keyValuePair[0]);
        params[key] = keyValuePair[1] ?
            decodeURIComponent(keyValuePair[1].replace(/\+/g, ' ')) :
            keyValuePair[1];
      }
      return params;
    }

    var urlParams = parseParamsFromUrl();
    var queryParamName = "s";
    if (urlParams[queryParamName]) {
      customSearchControl.execute(urlParams[queryParamName]);
    }
  }, true);
</script>

<style type="text/css">
  .gsc-control-cse {
    font-family: Arial, sans-serif;
    border-color: #C78DCC;
    background-color: #fafafa;
  }
  .gsc-control-cse .gsc-table-result {
    font-family: Arial, sans-serif;
  }
  .gsc-tabHeader{   font-size:20px;}
  .gsc-tabHeader.gsc-tabhInactive {

    border-color: #DECAFF;
    background-color: #DECAFF;
  }
  .gsc-tabHeader.gsc-tabhActive {
    border-color: #C78DCC;
    background-color: #C78DCC;
  }
  .gsc-tabsArea {
    border-color: #C78DCC;
  }
  .gsc-webResult.gsc-result,
  .gsc-results .gsc-imageResult {
    border-color: #C78DCC;
    background-color: #F9F5FF;
		margin:0px 0px 15px 0px ;
  }
  .gsc-webResult.gsc-result:hover,
  .gsc-imageResult:hover {
    border-color: #DECAFF;
    background-color: #FFFFFF;
  }
  .gsc-webResult.gsc-result.gsc-promotion:hover {
    border-color: #DECAFF;
    background-color: #FFFFFF;
  }
  .gs-webResult.gs-result a.gs-title:link,
  .gs-webResult.gs-result a.gs-title:link b,
  .gs-imageResult a.gs-title:link,
  .gs-imageResult a.gs-title:link b {
    color: #0066CC;
  }
  .gs-webResult.gs-result a.gs-title:visited,
  .gs-webResult.gs-result a.gs-title:visited b,
  .gs-imageResult a.gs-title:visited,
  .gs-imageResult a.gs-title:visited b {
    color: #0066CC;
  }
  .gs-webResult.gs-result a.gs-title:hover,
  .gs-webResult.gs-result a.gs-title:hover b,
  .gs-imageResult a.gs-title:hover,
  .gs-imageResult a.gs-title:hover b {
    color: #0066CC;
  }
  .gs-webResult.gs-result a.gs-title:active,
  .gs-webResult.gs-result a.gs-title:active b,
  .gs-imageResult a.gs-title:active,
  .gs-imageResult a.gs-title:active b {
    color: #0066CC;
  }
  .gsc-cursor-page {
    color: #0066CC;
  }
  a.gsc-trailing-more-results:link {
    color: #0066CC;
  }
  .gs-webResult .gs-snippet,
  .gs-imageResult .gs-snippet,
  .gs-fileFormatType {
    color: #000000;
  }
  .gs-webResult div.gs-visibleUrl,
  .gs-imageResult div.gs-visibleUrl {
    color: #009933;
  }
  .gs-webResult div.gs-visibleUrl-short {
    color: #009933;
  }
  .gs-webResult div.gs-visibleUrl-short {
    display: none;
  }
  .gs-webResult div.gs-visibleUrl-long {
    display: block;
  }
  .gs-promotion div.gs-visibleUrl-short {
    display: none;
  }
  .gs-promotion div.gs-visibleUrl-long {
    display: block;
  }
  .gsc-cursor-box {
    border-color: #F9F5FF;
  }
  .gsc-results .gsc-cursor-box .gsc-cursor-page {
    border-color: #DECAFF;
    background-color: #F9F5FF;
    color: #0066CC;
  }
  .gsc-results .gsc-cursor-box .gsc-cursor-current-page {
    border-color: #C78DCC;
    background-color: #C78DCC;
    color: #0066CC;
  }
  .gsc-webResult.gsc-result.gsc-promotion {
    border-color: #DECAFF;
    background-color: #F0E9FF;
  }
  .gsc-completion-title {
    color: #0066CC;
  }
  .gsc-completion-snippet {
    color: #000000;
  }
  .gs-promotion a.gs-title:link,
  .gs-promotion a.gs-title:link *,
  .gs-promotion .gs-snippet a:link {
    color: #0066CC;
  }
  .gs-promotion a.gs-title:visited,
  .gs-promotion a.gs-title:visited *,
  .gs-promotion .gs-snippet a:visited {
    color: #0066CC;
  }
  .gs-promotion a.gs-title:hover,
  .gs-promotion a.gs-title:hover *,
  .gs-promotion .gs-snippet a:hover {
    color: #0066CC;
  }
  .gs-promotion a.gs-title:active,
  .gs-promotion a.gs-title:active *,
  .gs-promotion .gs-snippet a:active {
    color: #0066CC;
  }
  .gs-promotion .gs-snippet,
  .gs-promotion .gs-title .gs-promotion-title-right,
  .gs-promotion .gs-title .gs-promotion-title-right *  {
    color: #000000;
  }
  .gs-promotion .gs-visibleUrl,
  .gs-promotion .gs-visibleUrl-short {
    color: #CC7A9F;
  }</style>