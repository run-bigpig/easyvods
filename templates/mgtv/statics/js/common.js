$(function(){
	// 搜索
	$('#searchDo').tap(function(){
		let kw = $('#search').val()
		if(!kw){ $('#search').myBubble('h5','请输入想看的影视名称',1000);return false; }

	})
	// 回车搜索
	$('#search').keydown(function(e){
		if(e.keyCode == 13){
			$('#searchDo').trigger('tap');
			return false;
		}
	});
	// 回到顶部
	$(window).scroll(function(e){
		if($(window).scrollTop() > $(window).height()){
			$('#scrollToTop').css('display','block');
		}else{
			$('#scrollToTop').css('display','none');
		}
		// 触底自动加载
		if($('#loadMore').length){
			if($(window).scrollTop() + $(window).height() > $('#loadMore').offset().top - 200){
				$('#loadMore').trigger('tap');
			}
		}
	})
	$('#scrollToTop').tap(function(){ $('html,body').animate({scrollTop: 0},300); })
})

// 模板解析函数
function parseTemplate(template,data){

	if(data.id){
		if(location.href.indexOf('/list/') < 0){	// 判断当前是否在list目录
			data.href = './play.html?vid=' + encodeURIComponent(data.id);
		}else{
			data.href = '../play.html?vid=' + encodeURIComponent(data.id);
		}
	}
	if(data.from){
		data.href = data.from[0];
		data.site = data.from[2];
	}
	for(var i in data){
		template = template.replace('{{' + i + '}}',data[i]).replace('{{' + i + '}}',data[i]).replace('{{' + i + '}}',data[i]);
	}
	return template;
}

// 初始化js
var jsApi,jsApiUrl,jsUrl,pageLoaded;
function jsApiConfig(api){

	if(typeof api === 'object'){
		jsApi = api;
		if(typeof pageLoad == 'function'){
			pageLoad();
		}
	}else{
		alert('接口配置错误');
	}
}
	// 载入配置文件
$(function(){

	if(location.href.indexOf('/list/') > -1){
		jsUrl = '../../data/?random=index&callback=?';
		jsApiUrl = '/templates/mgtv/statics/js/config.js?_=' + $.now();
	}else if(location.href.indexOf('/play/') > -1){
		jsUrl = '../data/?random=index&callback=?';
		jsApiUrl = '/templates/mgtv/statics/js/config.js?_=' + $.now();
	}else{
		jsUrl = './data/?random=index&callback=?';
		jsApiUrl = '/templates/mgtv/statics/js/config.js?_=' + $.now();
	}
	$.loadScript(jsApiUrl);
});