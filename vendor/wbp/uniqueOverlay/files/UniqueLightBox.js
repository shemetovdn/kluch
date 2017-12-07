var uniqueOverlay,ChosenConfig,uniqueOverlayOpen=false,historyOnClose=false, absolutePosition=false,UniqueLightBoxMaskColor='#000';;
$(function(){
    if(!$('.UniqueLightbox').length){
        $('body').prepend('<div class="UniqueLightbox"><div id="ajaxOverlayResult"></div><div id="ajaxOverlayResultHidden" style="display: none;"></div></div>');
        $('body').prepend($('<div />').addClass('UniqueLightboxOpener'));
    }
    $('.UniqueLightboxOpener').overlay({
        target:'.UniqueLightbox',
        mask:{
            color:UniqueLightBoxMaskColor,
            loadSpeed:0,
            'z-index':9996
        },
        left:'left',
        top:'top',
        load:uniqueOverlayOpen,
        speed:100,
        onBeforeLoad:function(){
            if(uniqueOverlay) uniqueOverlay.getConf().mask.color=UniqueLightBoxMaskColor;
            centeruniqueOverlay();
            if(absolutePosition){
                $('.UniqueLightbox').css('position','absolute');
                var top=($(window).height()-$('.UniqueLightbox').height())/2;
                if(top<0) top=0;
                $('.UniqueLightbox').css('margin-top',$(document).scrollTop()+top);
            }else{
                $('.UniqueLightbox').css('position','fixed');
            }
            hideAjaxerMask();


        },
        onLoad:function(){
            centeruniqueOverlay();
            if(absolutePosition){
                $('.UniqueLightbox').css('position','absolute');
                var top=($(window).height()-$('.UniqueLightbox').height())/2;
                if(top<0) top=0;
                $('.UniqueLightbox').css('margin-top',$(document).scrollTop()+top);
            }else{
                $('.UniqueLightbox').css('position','fixed');
            }

            if(ChosenConfig)
                for (var selector in ChosenConfig) {
                    $(selector).chosen(ChosenConfig[selector]);
                }
        },
        onClose:function(){
            if(historyOnClose){
                history.pushState(null, null, historyOnClose);
                //history.go(-1);
            }
        }
    });
    uniqueOverlay=$(".UniqueLightboxOpener").data("overlay");
    $(window).resize(function(){
        centeruniqueOverlay();
    });
});
function centeruniqueOverlay(time){
    var top=($(window).height()-$('.UniqueLightbox').height())/2;
    if(top<0) top=0;
    if(time > 0){
        $('.UniqueLightbox').stop(true,true).animate({'margin-left':($(window).width()-$('.UniqueLightbox').width())/2},time);
        if(!absolutePosition) $('.UniqueLightbox').stop(true,true).animate({'margin-top':top},time);
    }else{
        $('.UniqueLightbox').css('margin-left',($(window).width()-$('.UniqueLightbox').width())/2);
        if(!absolutePosition) $('.UniqueLightbox').css('margin-top',top);
    }
}
function changeOverlayBlock() {
    $('#ajaxOverlayResult').attr('id', 'ajaxOverlayActive');
    $('#ajaxOverlayResultHidden').attr('id', 'ajaxOverlayHidden');
    $('#ajaxOverlayHidden').attr('id', 'ajaxOverlayResult').show();
    $('#ajaxOverlayActive').attr('id', 'ajaxOverlayResultHidden').hide().html('');
}
