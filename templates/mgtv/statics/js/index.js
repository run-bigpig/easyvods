function pageLoad(){

	var pageData = {};
	// 切换标记
	pageData.mark = {'dianshi': 0,'dianying': 0,'zongyi': 0,'dongman': 0};

	// 初始化轮播
	$('.s-slider').mySlider({navAlign:'right',callback: function(index){ $('#headBg').css('background-image',($('#bannerList li.now i').css('background-image'))) }});

	// 换一批
	$('.switch-button').tap(function(){ loadPageData($(this).attr('data-list-type')); })
	var loadNum = 6,markMax = 3;	// 每次切换显示的数量和最大切换次数
	function loadPageData(listType){

		++ pageData.mark[listType];
		if(pageData.mark[listType] > markMax){
			pageData.mark[listType] = 0;
		}
		$('#' + listType + 'List a').hide();
		for(var i = 0;i < loadNum;++ i){
			$('#' + listType + 'List a:eq(' + (pageData.mark[listType] * loadNum + i) + ')').css('display','block');
		}
	}

	pageLoaded = true;
}
if(typeof(pageLoaded) == 'undefined' && typeof(jsApi) != 'undefined'){ pageLoad(); }


// 第一次打开首页时触发一次缓存清理脚本
;$(function(){
	if(!$.cookie('cache_clear')){
		$.cookie('cache_clear','1');
		if(Math.ceil(Math.random() * 100) == 1){	// 每个客户端有百分之一的几率触发一次清理
			$.loadScript('./cache_clear/');
		}
	}
})