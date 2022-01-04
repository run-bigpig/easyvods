/*!
 */
var stui = {
    browser: {
        url: document.URL,
        domain: document.domain,
        title: document.title,
        language: (navigator.browserLanguage || navigator.language).toLowerCase(),
        canvas: function () {
            return !!document.createElement("canvas").getContext
        }(),
        useragent: function () {
            var a = navigator.userAgent;
            return {
                mobile: !!a.match(/AppleWebKit.*Mobile.*/),
                ios: !!a.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/),
                android: -1 < a.indexOf("Android") || -1 < a.indexOf("Linux"),
                iPhone: -1 < a.indexOf("iPhone") || -1 < a.indexOf("Mac"),
                iPad: -1 < a.indexOf("iPad"),
                trident: -1 < a.indexOf("Trident"),
                presto: -1 < a.indexOf("Presto"),
                webKit: -1 < a.indexOf("AppleWebKit"),
                gecko: -1 < a.indexOf("Gecko") && -1 == a.indexOf("KHTML"),
                weixin: -1 < a.indexOf("MicroMessenger")
            }
        }()
    },
    mobile: {
        popup: function () {
            $popblock = $(".popup");
            $(".open-popup").click(function () {
                $popblock.addClass("popup-visible");
                $("body").append('<div class="mask"></div>');
                $(".close-popup").click(function () {
                    $popblock.removeClass("popup-visible");
                    $(".mask").remove();
                    $("body").removeClass("modal-open")
                });
                $(".mask").click(function () {
                    $popblock.removeClass("popup-visible");
                    $(this).remove();
                    $("body").removeClass("modal-open")
                })
            })
        },
        slide: function () {
            $.getScript("/templates/kubo/statics/js/flickity.pkgd.min.js", function () {
                $(".type-slide").each(function (a) {
                    $index = $(this).find('.active').index() * 1;
                    if ($index > 3) {
                        $index = $index - 3;
                    } else {
                        $index = 0;
                    }
                    $(this).flickity({
                        cellAlign: 'left',
                        freeScroll: true,
                        contain: true,
                        prevNextButtons: false,
                        pageDots: false,
                        initialIndex: $index
                    });
                })
            })
        },
        share: function () {
            $(".open-share").click(function () {
                stui.browser.useragent.weixin ? $("body").append('<div class="mobile-share share-weixin"></div>') : $("body").append('<div class="mobile-share share-other"></div>');
                $(".mobile-share").click(function () {
                    $(".mobile-share").remove();
                    $("body").removeClass("modal-open")
                })
            })
        }
    },
    flickity: {
        carousel: function () {

            $.getScript("/templates/kubo/statics/js/flickity.pkgd.min.js", function () {
                $('.carousel_default').flickity({
                    cellAlign: 'left',
                    contain: true,
                    wrapAround: true,
                    autoPlay: true,
                    prevNextButtons: false
                });
                $('.carousel_wide').flickity({
                    cellAlign: 'center',
                    contain: true,
                    wrapAround: true,
                    autoPlay: true,
                });
                $('.carousel_center').flickity({
                    cellAlign: 'center',
                    contain: true,
                    wrapAround: true,
                    autoPlay: true,
                    prevNextButtons: false
                });
                $('.carousel_right').flickity({
                    cellAlign: 'left',
                    wrapAround: true,
                    contain: true,
                    pageDots: false
                });
            })
        }
    },
    images: {
        lazyload: function () {
            $.getScript("/templates/kubo/statics/js/jquery.lazyload.js", function () {
                $(".lazyload").lazyload({
                    effect: "fadeIn",
                    threshold: 200,
                    failurelimit: 15,
                    skip_invisible: !1
                })
            })
        },
    },
    common: {
        bootstrap: function () {
            $.getScript("/templates/kubo/statics/js/bootstrap.min.js", function () {
                $('a[data-toggle="tab"]').on("shown.bs.tab", function (a) {
                    var b = $(a.target).text();
                    $(a.relatedTarget).text();
                    $("span.active-tab").html(b)
                })
            })
        },
        headroom: function () {
            $.getScript("/templates/kubo/statics/js/headroom.min.js", function () {
                $("#header-top", function () {
                    (new Headroom(document.querySelector("#header-top"), {
                        tolerance: 5,
                        offset: 205,
                        classes: {
                            initial: "top-fixed",
                            pinned: "top-fixed-up",
                            unpinned: "top-fixed-down"
                        }
                    })).init()
                });
            })
        },
        autocomplete: function(){
            $('#wd').keyup(function(){
                var keywords = $(this).val();
                if (keywords=='') { $('#word').hide(); return };
                $.ajax({
                    url: 'https://video.360kan.com/suggest.php?cb=&fmt=jsonp&ac=richsug&kw=' + keywords,
                    dataType: 'jsonp',
                    jsonp: 'cb',

                    beforeSend:function(){
                        $('#word').append('<div class="autocomplete-suggestion">正在加载。。。</div>');
                    },
                    success:function(data){
                        $('#word').empty().show();
                        var data07 = eval(data);
                        var item = data07.data.suglist;
                        if (data07.data.suglist[0].word=='')
                        {
                            $('#word').append('<div class="autocomplete-suggestion">未找到与 "' + keywords + '"相关的结果</div>');
                        }

                        for(var i=0;i<item.length;i++){
                            arrvalue=item[i]['word'];
                            $('#word').append('<div class="autocomplete-suggestion">'+item[i]['word'] +'</div>');

                        }
                    },
                    error:function(){
                        $('#word').empty().show();
                        $('#word').append('<div class="autocomplete-suggestion">查找"' + keywords + '"失败</div>');
                    }
                })
            })

            $(document).on('click','.autocomplete-suggestion',function(){
                var word = $(this).text();
                $('#wd').val(word);
                $('#word').hide();
                $('#submit').trigger('click');
            })

            var clear = function(){ $('#word').hide();}
            $("input").blur(function(){
                setTimeout(clear,500);
            })
        },
        collapse: function () {
            $(".detail").on("click", ".detail-more", function () {
                $detailContent = $(".detail-content");
                $detailSketch = $(".detail-sketch");
                "none" == $detailContent.css("display") ? ($(this).html('\u6536\u8d77 <i class="icon iconfont icon-less"></i>'), $detailContent.show(), $detailSketch.hide()) : ($(this).html('\u8be6\u60c5 <i class="icon iconfont icon-moreunfold"></i>'), $detailContent.hide(), $detailSketch.show())
            })
        },
        scrolltop: function () {
            var a = $(window);
            $scrollTopLink = $("a.backtop");
            a.scroll(function () {
                500 < $(this).scrollTop() ? $scrollTopLink.css("display", "block") : $scrollTopLink.css("display", "none")
            });
            $scrollTopLink.on("click", function () {
                $("html, body").animate({
                    scrollTop: 0
                }, 400);
                return !1
            })
        }
    }
};

function hspanel() {
    $('.stui-pannel_hd').click(function () {
        $('.sw').each(function () {
            $(this).addClass('hidepanel')
        });
        $(this).next().removeClass('hidepanel');
    })
}

function vhspanel() {
    var jiekou = $('#ys').attr('data-interface');
    var url = $('.vplay:eq(0)').attr('data-href');
    $('.vplay:eq(0)').addClass('bs')
    $('.sw').each(function () {
        $(this).addClass('hidepanel')
    });
    $('.vplay:eq(0)').parent().parent().parent().removeClass('hidepanel');
    $('#video').attr('src',jiekou+url);
    return false;
}

function bofang(obj) {
    var href = $(obj).attr('data-href');
    var text = $(obj).text();
    $.each($('.vplay'), function () {
        $(this).removeClass('bs');
    });
    $(obj).addClass('bs');
    var jiekou = $('#ys').attr('data-interface');
    if (href != '' || href != null) {
       $('#video').attr('src', jiekou + href);
    }
}
function xldata(obj) {
    var url = $(obj).attr('data-interface');
    $.each($('.interfacebtn'), function () {
        $(this).attr('id',"");
    });
    $(obj).attr('id',"ys");
    var src = $('.bs').attr('data-href');
    $('#video').attr('src', url + src);
}

$(document).ready(function () {
    if (stui.browser.useragent.mobile) {
        stui.mobile.slide();
        stui.mobile.popup();
        stui.mobile.share();
    }
    stui.flickity.carousel();
    var lazyloadz = $('#lazyloadz').val();
    if (lazyloadz == 1) {
        stui.images.lazyload();
    }
    stui.common.bootstrap();
    stui.common.headroom();
    stui.common.collapse();
    stui.common.autocomplete();
    stui.common.scrolltop();
    hspanel();
    vhspanel();
    $("#prev").click(function () {
        $(".bs").parent().prev().children().trigger('click');
    });
    $("#next").click(function () {
        $(".bs").parent().next().children().trigger('click');
    })
});
