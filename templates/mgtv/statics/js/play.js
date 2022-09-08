$(function(){
    $('.laiyuan').click(function (){
        let that = this
        let playtype = $(this).attr("playtype")
        $.each($('.laiyuan'),function (){
            $(this).removeClass("current")
        })
        $(this).addClass("current")
        $.each($('.episodes-list'),function (){
               if ($(this).attr("playtype")==playtype){
                   $(this).show();
               }else {
                   $(this).hide();
               }
        })
    })
})