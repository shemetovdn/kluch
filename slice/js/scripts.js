/**
 * Created by Alex on 24.05.2017.
 */


if (! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

    $('.multi-select').multipleSelect({
        width: '100%',
        minimumCountSelected: 6,
        allSelected: false,
        selectAllText: 'Выбрать все',
        onUncheckAll: function() {
            $('select.multi-select').multipleSelect();
        },
        onClick: function() {
            changeColorSearch();
        }
    });

    $('select.multi-select').multipleSelect();

    $('select.nselect').nSelect({
        afterChange: function(event){
            $(event).parents('.nselect').find('select').change();
            changeColorSearch();
        }
    });

    function changeColorSearch() {
        var bar = $('.search-bar');
        if (! bar.hasClass('changed')){
            bar.addClass('changed');
        }
    }
}


$(document).ready(function(){

    $(".exclusive-sale-carousel").owlCarousel({
        nav: true,
        navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>","<i class='fa fa-angle-right' aria-hidden='true'></i>"],
        loop: true,
        mouseDrag: false,
        responsive : {
            768 : {
                items : 2
            },
            0 : {
                items : 1
            },
            992 : {
                items : 3
            }
        }
    });
    $(".new-options-carousel").owlCarousel({
        nav: true,
        navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>","<i class='fa fa-angle-right' aria-hidden='true'></i>"],
        loop: true,
        mouseDrag: false,
        responsive : {
            768 : {
                items : 3
            },
            0 : {
                items : 1
            },
            992 : {
                items: 4
            }
        }
    });
    $(".main-news-carousel").owlCarousel({
        loop: true,
        items: 2,
        autoplay: true
    });
    $(".newcarousel").owlCarousel({
        loop: false,
        items: 1,
        nav: true,
        autoplay: false,
        mouseDrag: false,
        navText: false
    });
    $(".related-nearby-carousel").owlCarousel({
        nav: true,
        navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>","<i class='fa fa-angle-right' aria-hidden='true'></i>"],
        loop: true,
        items: 4,
        mouseDrag: false,
        responsive : {
            768 : {
                items : 3
            },
            0 : {
                items : 1
            },
            992 : {
                items: 4
            }
        }
    });

    // Mobile menu
    function overlayMenu () {
        if($(window).width() <992) {
            $('header .burger.closed').click(function () {
                $('.mobile-menu').slideDown();
            });
            $('button.close-menu').click(function () {
                $('.mobile-menu').slideUp();
            })
        }
    }
    overlayMenu();
    //

    $('.call-partners-modal').click(function () {
        var content = $(this).html();
        if($(window).width() <= 767){
            $('#partners-modal').find('.modal-content').html(content);
            $('#partners-modal').modal('show');
        }
    });

    $('#filtersCall').click(function (event) {
        if ($(window).width() <992){
            if ($(this).hasClass('closed')) {
                $(this).removeClass('closed');
                $('.filter-wrapper').addClass('open-filter');
                $(this).find('.filter-caret img').css({'transform' : 'rotate(180deg)'});
                $('.filter-wrapper').slideDown("slow");
            }
            else {
                $(this).addClass('closed');
                $(this).find('.filter-caret img').css({'transform' : 'rotate(0)'});
                $('.filter-wrapper').removeClass('open-filter');
                $('.filter-wrapper').slideUp("slow");
            }
        }
    });

    $(document).click(function(event) {
        if ($(window).width() <992){
            if($('.filter-wrapper').hasClass('open-filter')) {
                if ($(event.target).closest(".filter-wrapper, #filtersCall").length) return;
                $('.filter-wrapper').slideUp("slow");
                $('.filter-wrapper').removeClass('open-filter');
                $('#filtersCall').addClass('closed');
                $('.filtersCall .filter-caret img').css({'transform' : 'rotate(0)'});
                event.stopPropagation();
            }
        }
    });


    function openDrop (that, backGr, fontColor, divList) {
        if (that.hasClass('closed')){
            that.removeClass('closed');
            that.addClass('opened');
            that.parent().addClass('open-drop').css({'background' : backGr, 'color' : fontColor});
            that.find('i').css({'transform' : 'rotate(180deg)'});

            that.parent().stop().animate({
                height : 150,
                marginLeft : -20,
                paddingLeft : 20
            });

            that.parent().find(divList).fadeIn(800);
        }
        else {
            closeDrop(that, divList);
        }
    }
    function closeDrop (that, divList) {
        that.parent().find(divList).css({'display' : 'none'});

        that.removeClass('opened');
        that.addClass('closed');
        that.parent().css({'background' : 'transparent', 'color' : '#000'});
        that.find('i').css({'transform' : 'rotate(0)'});

        that.parent().stop().animate({
            height : 70,
            marginLeft : 0,
            paddingLeft : 0
        });
    }

    $(document).on('click', function(e) {
        if (!$(e.target).closest(".drop-unit-container").length) {
            closeDrop($('.drop-unit-container button'), '.list-items');
        }
        e.stopPropagation();
    });




    // Выпадашка для денежной единицы
    $('button.choice-unit-drop').click(function () {
        openDrop($(this), '#308fb8', '#fff' ,'.unit-list');
    });

    // Выпадашка для похожие рядом
    $('button.related-drop').click(function () {
        openDrop($(this), '#fff', '#000', '.related-list');
    });


    $('.search-for-id').click(function () {
        if($(this).hasClass('deactivated')){
            $('.main-banner .search-bar ul li').hide();
            $('.div-search-id').fadeIn(500);
            $('.search-bar-submit button').html('Найти');
            $('.search-bar-submit button').addClass("search_now");
            $(".search-form .search_now").click(function (event) {
                event.preventDefault();
                var id = $("div.div-search-id").find('input').val();
                console.log(id);
                window.location.href = "/adverts/"+id;
            });
            $(this).removeClass('deactivated').addClass('activated').html('Нормальный поиск');
        }
        else if($(this).hasClass('activated')){
            $('.div-search-id').hide();
            $('.search-bar-submit button').html('Подобрать');
            $('.search-bar-submit button').removeClass("search_now");
            $(this).removeClass('activated').addClass('deactivated').html('Искать по ID');
            $('.search-bar ul li').fadeIn(500);
        }
    });


    $('.fotorama').fotorama({
        arrows: 'always',
        width: '100%',
        maxwidth: '100%',
        height: 400,
        maxheight: '100%',
        nav: 'thumbs',
        thumbwidth : 90,
        thumbheight  : 70,
        thumbmargin: 9,
        fit: 'cover',
        keyboard: true,
        swipe: false,
        click: false,
        allowfullscreen: true,
        transition: 'dissolve',
    });
    if($(window).width() <= 991) {
        $('.fotorama').fotorama({
            height: 250,
            nav: false,
        });
    }

});
