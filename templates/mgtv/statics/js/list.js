function pageLoad(){

	// 初始化导航
	$('#conditionBox .s-slide-menu').mySlideMenu();
	$('#conditionBox .s-slide-menu').each(function(){
		if($(this).find('.now').length && $(this).find('.now').index() != 0){
			$(this).trigger('to',$(this).find('.now').index());
		}
	})

	$('#headBg').css('background-image',($('#listList a:eq(0) i').css('background-image')));

	pageLoaded = true;
}
if(typeof(pageLoaded) == 'undefined' && typeof(jsApi) != 'undefined'){ pageLoad(); }