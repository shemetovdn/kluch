var globalCountires=[];

function getGlobalCountries(baseUrl){
    $.ajax({'url':baseUrl+'/countries.json',dataType:'json',success:function(data){
        globalCountires=data;
    }});
}

(function($) {
    /**
     * $ is an alias to jQuery object
     *
     */
    $.fn.countryStateSelector = function(settings) {
        settings = jQuery.extend({
            'stateSelect':$(),
            'country':0,
            'state':0
        }, settings);

        var country=this;

        function addCountries(){
            country.find('option').not(country.find('option[value=0]')).remove();
            for (var num in globalCountires){
                var option=$('<option value="'+globalCountires[num].id+'">'+globalCountires[num].title+'</option>');
                if(settings.country==globalCountires[num].id){
                    option.attr('selected','selected');
                    addRegions(settings.state);
                }

                country.append(option);
            }
            country.trigger("liszt:updated");
            country.trigger("chosen:updated");
        }

        function attachEvent() {
            country.unbind('change').bind('change',function(){addRegions();})
        }

        function addRegions(state_id){
            var state=settings.stateSelect;
            var foundCountry;
            var countryVal=0;

            if(!state_id){
                countryVal=country.val()
            }else{
                countryVal=settings.country;
            }
            for (var num in globalCountires){
                if(globalCountires[num].id==countryVal){
                    foundCountry=globalCountires[num];
                }
            }
            state.find('option').not(state.find('option[value=0]')).remove();
            var regions=foundCountry.regions;

            for (var num in regions){
                var option=$('<option value="'+regions[num].id+'">'+regions[num].title+'</option>');
                if(state_id==regions[num].id){
                    option.attr('selected','selected');
                }
                state.append(option);
            }
            state.trigger("liszt:updated");
            state.trigger("chosen:updated");
        }

        function compare(a,b) {
            if (a.sort < b.sort)
                return -1;
            else if (a.sort > b.sort)
                return 1;
            else{
                if (a.title < b.title)
                    return -1;
                else if (a.title > b.title)
                    return 1;
                else
                    return 0;
            }
        }



        function _initialize() {
            if(!globalCountires.length){
                setTimeout(function(){
                    country.countryStateSelector(settings);
                },100);
                return false;
            }

            globalCountires.sort(compare);
            addCountries();
            attachEvent();
        }


        _initialize();
        return this;
    }
})(jQuery);
