/**
 * Created by Alex on 24.05.2017.
 */
$(document).ready(function(){
    var timerId;
    if($("#url").val()) {
        var url = JSON.parse($("#url").val());

        var cat_id = $(".category_list").find('option[data-href= "' + url.category + '"]').val();
        var object_id = $(".object_list").find('option[data-href= "' + url.object + '"]').val();
        if(!object_id || url.object == "exclusive"){
            object_id = '1';
        }

        function changeTitlesByFiltering(){
            var category_href = $(".catalog_filter .category_list").find("option:selected").attr("data-href");
            var object_href = $(".catalog_filter .object_list").find("option:selected").attr("data-href");
            var category_id = $(".catalog_filter .category_list").find("option:selected").val();
            var object_id = $(".catalog_filter .object_list").find("option:selected").val();
            var title = "";
            var subtitle = "";
            if(category_id == 1){
                title += "Продажа ";
                subtitle = "Продажа недвижимости";
            }else if(category_id == 2){
                title += "Долгосрочная аренда ";
                subtitle = "Долгосрочная аренда";
            }else if(category_id == 3) {
                title += "Краткосрочная аренда ";
                subtitle = "Краткосрочная аренда";
            }else{
                subtitle ="Каталог";
            }
            console.log(url.object);
            console.log(url.object.replace(/[^A-Za-zА-Яа-яЁё]/g, ""));

            if(object_id){
                if (object_id == 1) {
                    title += "квартир";
                } else if (object_id == 2) {
                    title += "квартир в новострое";
                } else if (object_id == 3) {
                    title += "Домов";
                } else if (object_id == 4) {
                    title += "Земельных участков ";
                } else if (object_id == 5) {
                    title += "Дач";
                } else if (object_id == 6) {
                    title += "Гаражей ";
                } else if (object_id == 7) {
                    title += "Комерческой недвижимости";
                } else if (object_id == 8) {
                    title += "Гостиниц ";
                } else if (object_id == 9) {
                    title += "Зарубежной недвижимости";
                } else if (!object_id) {
                    title = "";
                }
            }else{
                title = "";
            }
            if(url.object.replace(/[^A-Za-zА-Яа-яЁё]/g, "") == "exclusive"){
                if(url.category.replace(/[^A-Za-zА-Яа-яЁё]/g, "") == "kupit"){

                    title = "Эксклюзивная продажа";

                }else if(url.category.replace(/[^A-Za-zА-Яа-яЁё]/g, "") == "arenda"){
                    title = "Эксклюзивная аренда";
                }
            }
            var subtitle_href = "";
            if(category_href){
                subtitle_href = "/"+category_href;
            }

            var title_href = "";
            if(object_href){
                title_href = "/"+object_href;
            }

             $("span.page-title").text(title);
            $("span.page-subtitle").text(subtitle);
            $("span.page-subtitle").parents("a").attr("href", "/catalog"+subtitle_href);
            $("span.page-title").parents("a").attr("href", "/catalog/"+category_href+title_href);
        }
        changeFilterByObjectId(object_id, $('.category_list'));

        if (url.object == "zemelnye-uchastki" || url.object == "dachi" || url.object == "ellingi" || url.object == "kommercheskaya-nedvizhimost") {

            if (url.object == "zemelnye-uchastki" || url.object == "dachi") {
                $("#units").html("сот");
            } else {
                $("#units").html("м<sup>2</sup>");
            }
        }
    }else{
        var object_id = $(".object_list").find("option:selected").val();
        if(!object_id){
            object_id = '1';
        }
        changeFilterByObjectId(object_id, $('.category_list'));
    }
        function changeAction(){
            var category_slug = $("#search_form").attr("data-category");
            var object_slug = $("#search_form").attr("data-object");
            var action = $("#search_form").attr("action");
            var new_action = "/catalog";
            if(category_slug){
                new_action += "/"+category_slug;
            }
            if(object_slug){
                new_action += "/"+object_slug;
            }
            if(category_slug || object_slug){
                $("#search_form").attr("action", new_action);
            }
        }
        function outputSummary(){
            var count = $("#summary").val();
            if(!count){
                count = 0;
            }
            var text = count+"  предложений";
            if(count > 5){}
            $(".number-of-offers").text(text);
        }

        function changeFilterByObjectId(id, elem){
            var parent = $(elem).parents("div.search-bar");
            var filtr_items = $("#filter_form > .filters-body > ul>li");
            if(filtr_items.length != 0){
                for(var i = 0; i<filtr_items.length; i++){
                    var ids = $(filtr_items[i]).attr("data-ids");
                    if(ids){
                        ids = ids.split(',');
                        if(ids.indexOf(id) == -1){
                            $(filtr_items[i]).addClass("hide");
                            $(filtr_items[i]).find("input").val("");
                            $(filtr_items[i]).find("select").val("");
                            // $(filtr_items[i]).find("select.multi-select").multipleSelect("uncheckAll");
                        }else{
                            $(filtr_items[i]).removeClass("hide");
                        }
                    }

                }
            }

            if(id == 7 || id == 8 || id == 3){
                $(parent).find("#units").html("м<sup>2</sup>");
            }else if(id == 4 || id == 5){
                $(parent).find("#units").html("сот");
            }

            if(id == 7 || id == 8 || id == 4 || id == 5 || id == 3){
                $(parent).find("#cars, #rooms").addClass("hide");

                if($(parent).find("#rooms .ms-parent li.selected").length != 0){
                    // $(parent).find("#rooms").find("select.multi-select").multipleSelect("uncheckAll");
                }
                if($(parent).find("#cars .ms-parent li.selected").length != 0) {
                    // $(parent).find("#cars").find("select.multi-select").multipleSelect("uncheckAll");
                }
                $(parent).find("#area").removeClass('hide');
            }
            else if(id == 6){
                $(parent).find("#rooms, #area").addClass("hide");
                $(parent).find("#cars").removeClass('hide');

                $(parent).find("#area").find("input").val("");
                if($(parent).find("#rooms .ms-parent li.selected").length != 0){
                    $(parent).find("#rooms").find("select.multi-select").multipleSelect("uncheckAll");
                }

            }
            else{
                $(parent).find("#cars, #area").addClass('hide');
                $(parent).find("#rooms").removeClass('hide');

                $(parent).find("#area").find("input").val("");
                if($(parent).find("#cars .ms-parent li.selected").length != 0) {
                    $(parent).find("#cars").find("select.multi-select").multipleSelect("uncheckAll");
                }
            }

        }

        outputSummary()
        $(".catalog .search-now > a").click(function(event){
            event.preventDefault();
            var form = $(this).parents("form.search-form").serialize();
            var category = $(".category_list").find("option:selected").attr("data-href");
            var object = $(".object_list").find("option:selected").attr("data-href");
            if(category){url.category = category}
            if(object){url.object = object}else{
                object = "";
            }
            if(url.category){url.category = "/"+url.category}
            if(url.object){object = "/"+url.object}
            var url_to = '/catalog'+url.category+object;
            $.pjax.reload({url: url_to,"container":"#catalogPjax", history:true,type: "POST", data: form, timeout: 10000}).done(function() {
                outputSummary();
                changeTitlesByFiltering();
            });
        });
        $(".category_list").change(function(){
            var id = $(this).val();
            var self = this;
            $.ajax({
                url:"/catalog/get-object-types",
                type:"POST",
                data:"id="+id,
                success: function(data){
                    data = JSON.parse(data);
                    var html = "<option value=''>Тип объекта</option>";
                    $.each( data, function( key, value ) {
                        html += "<option value=\""+value.id+"\" data-href=\""+value.href+"\"  data-image=\""+value.image+"\">"+value.title+"</option>";
                    });
                    var object_list = $(self).parents("ul").find(".object_list");
                    var parent = $(object_list).parents("li");

                    $(object_list).html($(html));
                    $(parent).append(object_list);
                    $(parent).find(".ns-sys.nselect").remove();
                    $(object_list).nSelect({
                        afterChange: function(event){
                            $(event).parents('.nselect').find('select').change();
                        }
                    });

                    if($("#search_form")){
                        var slug = $(self).find("option:selected").attr("data-href");
                        if(slug){
                            $("#search_form").attr("data-category", slug);
                        }
                        changeAction();

                    }
                }
            })
        })

        $(".object_list").change(function(){
            var id = $(this).val();
            var self = this;
            changeFilterByObjectId(id, this);
            if($("#search_form")){
                var slug = $(self).find("option:selected").attr("data-href");
                if(slug){
                    $("#search_form").attr("data-object", slug);
                }
                changeAction();

            }
        });

    function filter(){
        var filter_form = $("#filter_form").serialize();
        var search_form = $(".search-form.catalog_filter").serialize();
        var form = filter_form+"&"+search_form;
        var category = $(".category_list").find("option:selected").attr("data-href");
        var object = $(".object_list").find("option:selected").attr("data-href");
        if(category){url.category = category}
        if(object){url.object = object}else{
            object = "";
        }
        if(url.category){url.category = "/"+url.category}
        if(url.object){object = "/"+url.object}
        var url_to = '/catalog'+url.category+object;

        $.pjax.reload({url: url_to,"container":"#catalogPjax", history:true,type: "POST", data: form, timeout: 10000}).done(function() {
            outputSummary();
            changeTitlesByFiltering();
        });
    }

    if(window.innerWidth >= 991){
        $("#filter_form select").change(function(){
            filter();
        })

        $("#filter_form input").keyup(function(){
            clearTimeout(timerId);
            timerId = setTimeout(function(){
                filter();
            }, 1500);
        })
    }else{
        $(".filtering_mobail").click(function(event) {
            event.preventDefault();
            clearTimeout(timerId);
            timerId = setTimeout(function(){
                filter();
            },200);
        })
    }



    $(".filters-reset button[type='reset']").click(function(event){
        clearTimeout(timerId);
        timerId = setTimeout(function(){
            $("#filter_form").find("select.multi-select").multipleSelect("uncheckAll");
            $("#filter_form").find(".filter-parameter .nselect__list li").removeClass('_active');
            $("#filter_form").find(".filter-parameter .nselect__list li:first-child").addClass('_active');

            var selects = $("#filter_form").find(".filter-parameter");
            for(var i = 0; i < selects.length; i ++){
                var title = $(selects[i]).find(".nselect__list li:first-child span").text();
                $(selects[i]).find(".nselect__head span").text(title);
            }
            if(window.innerWidth < 991){
                $(".catalog_filter")[0].reset();
                $(".catalog_filter").find("select.multi-select").multipleSelect("uncheckAll");
                $(".catalog_filter").find(".filter-parameter .nselect__list li").removeClass('_active');
                $(".catalog_filter").find(".filter-parameter .nselect__list li:first-child").addClass('_active');

                var selects = $(".catalog_filter").find(".filter-parameter");
                for(var i = 0; i < selects.length; i ++){
                    var title = $(selects[i]).find(".nselect__list li:first-child span").text();
                    $(selects[i]).find(".nselect__head span").text(title);
                }
            }

            filter();
        },200);
    });
    $(".submit_form").click(function (event) {
        event.preventDefault();
        $(this).parents("form").submit();
    });
    $('#modal-map').on('shown.bs.modal', function (e) {
        initMap();
    });

    $(".main-banner .object_list").change(function(){
        var banner = $(this).find("option:selected").attr("data-image");

            if(banner){
                $(".main-banner").css("background-image", "url("+banner+")");
            }else{
                $(".main-banner").css("background-image", "");
            }

    })

    $(".search_by_id").click(function(event){
        event.preventDefault();
        $("#search_by_id_form").toggle();

    });
    function choiceUnit (that, divChanged) {
        if(! that.hasClass('active')){
            var newUnit = that.html();
            that.parents('.drop-unit-container').find(divChanged).html(newUnit);
            that.parent().find('.active').removeClass('active');
            that.addClass('active');
            var href = $(that).parents('.list-items').attr("data-href");
            var id = $(that).parents('.list-items').attr("data-id");
            if($(that).hasClass('price')){
                var form = "price="+$(that).attr("data-price")+"&id="+id;
                var url_to = '/adverts/'+href;
                $.pjax.reload({url: url_to,"container":"#similarPjax", history:true,type: "POST", data: form, timeout: 10000}).done(function() {

                });
            }
            if($(that).hasClass('nearby')){
                var form = "city_id="+$(that).attr("data-city-id")+"&id="+id;
                var url_to = '/adverts/'+href;
                $.pjax.reload({url: url_to,"container":"#similarPjax", history:true,type: "POST", data: form, timeout: 10000}).done(function() {
                });
            }
            if($(that).hasClass('size')){
                var form = "size="+$(that).attr("data-size")+"&id="+id;
                var url_to = '/adverts/'+href;
                $.pjax.reload({url: url_to,"container":"#similarPjax", history:true,type: "POST", data: form, timeout: 10000}).done(function() {
                });
            }
        }
    }

    // Изменение денежной единицы
    $('.unit-list .unit-item').click(function () {
        choiceUnit($(this), '.unit-selected');
    });

    // Изменение похожие рядом
    $('.related-list .related-item').click(function () {
        choiceUnit($(this), '.related-selected .blue-label');
    });

    if($("#search_form")){
        var slug_category = $("#search_form .category_list").find("option:selected").attr("data-href");
        var slug_object = $("#search_form .object_list").find("option:selected").attr("data-href");
        if(slug_category){
            $("#search_form").attr("data-category", slug_category);
        }
        if(slug_object){
            $("#search_form").attr("data-object", slug_object);
        }
        changeAction();

    }

    $(".print_advert").click(function(){
        var printContents  = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    })
});