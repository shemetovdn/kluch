<?
$this->registerCss("
    a{
        color: #e04545;
    }
");

$this->registerJs("

    function selectElementText(element) {
        if (document.selection) {
            var range = document.body.createTextRange();
            range.moveToElementText(element);
            range.select();
        } else if (window.getSelection) {
            var range = document.createRange();
            range.selectNode(element);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
        }
    }
    
    function makeCopy(name){
        var tmpElement = document.createElement('div');
        tmpElement.id = 'tmpItem';
        tmpElement.innerText = name;
        document.body.appendChild(tmpElement);
        selectElementText(tmpElement);
        document.execCommand('copy');
        tmpElement.remove();
    }
    
    $('i[class^=\"icon\"]').each(function( index ) {
        var el = $( this );
        var jsel = el[0];
        var className = jsel.classList[0];
        el.removeClass(className).parent().addClass(className);
    }); 
    
    
    $('#glyphicons_regular a').on('click', function(){
        var el = $(this)[0];
        var iconName = el.classList[1];
        makeCopy(iconName)
    });
    
    $('#fontawesome a').on('click', function(){
        var el = $(this)[0];
        var iconName = el.classList[0];
        makeCopy(iconName)
    });
");
?>

<div class="innerLR icons-container">
    <div class="widget widget-tabs">
        <div class="widget-head">
            <ul>
                <li class="active"><a href="#fontawesome" data-toggle="tab">Font Awesome</a></li>
                <li class=""><a href="#glyphicons_regular" data-toggle="tab">Glyphicons Regular &nbsp;<span class="badge">470</span></a></li>
                <li class=""><a href="#glyphicons_social" data-toggle="tab">Glyphicons Social &nbsp;<span class="badge">50</span></a></li>
                <li class=""><a href="#glyphicons_filetypes" data-toggle="tab">Glyphicons Filetypes &nbsp;<span class="badge">130</span></a></li>
            </ul>
        </div>
        <div class="widget-body">
            <div class="tab-content">

                <div class="tab-pane" id="glyphicons_regular">
                    <section>
                        <h4>Glyphicons Regular <span class="badge badge-inverse">470</span></h4>
                        <div class="row row-icons">
                            <div class="col-md-3"><a href="#" class="glyphicons glass"><i></i><strong>glass</strong><span>UTF E001</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons leaf"><i></i><strong>leaf</strong><span>UTF E002</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons dog"><i></i><strong>dog</strong><span>UTF 1F415</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons user"><i></i><strong>user</strong><span>UTF E004</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons girl"><i></i><strong>girl</strong><span>UTF 1F467</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons car"><i></i><strong>car</strong><span>UTF E006</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons user_add"><i></i><strong>user_add</strong><span>UTF E007</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons user_remove"><i></i><strong>user_remove</strong><span>UTF E008</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons film"><i></i><strong>film</strong><span>UTF E009</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons magic"><i></i><strong>magic</strong><span>UTF E010</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons envelope"><i></i><strong>envelope</strong><span>UTF 2709</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons camera"><i></i><strong>camera</strong><span>UTF 1F4F7</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons heart"><i></i><strong>heart</strong><span>UTF E013</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons beach_umbrella"><i></i><strong>beach_umbrella</strong><span>UTF E014</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons train"><i></i><strong>train</strong><span>UTF 1F686</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons print"><i></i><strong>print</strong><span>UTF E016</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bin"><i></i><strong>bin</strong><span>UTF E017</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons music"><i></i><strong>music</strong><span>UTF E018</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons note"><i></i><strong>note</strong><span>UTF E019</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons heart_empty"><i></i><strong>heart_empty</strong><span>UTF E020</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons home"><i></i><strong>home</strong><span>UTF E021</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons snowflake"><i></i><strong>snowflake</strong><span>UTF 2744</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons fire"><i></i><strong>fire</strong><span>UTF 1F525</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons magnet"><i></i><strong>magnet</strong><span>UTF E024</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons parents"><i></i><strong>parents</strong><span>UTF E025</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons binoculars"><i></i><strong>binoculars</strong><span>UTF E026</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons road"><i></i><strong>road</strong><span>UTF E027</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons search"><i></i><strong>search</strong><span>UTF E028</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cars"><i></i><strong>cars</strong><span>UTF E029</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons notes_2"><i></i><strong>notes_2</strong><span>UTF E030</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons pencil"><i></i><strong>pencil</strong><span>UTF 270F</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bus"><i></i><strong>bus</strong><span>UTF 1F68C</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons wifi_alt"><i></i><strong>wifi_alt</strong><span>UTF E033</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons luggage"><i></i><strong>luggage</strong><span>UTF E034</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons old_man"><i></i><strong>old_man</strong><span>UTF E035</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons woman"><i></i><strong>woman</strong><span>UTF 1F469</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons file"><i></i><strong>file</strong><span>UTF E037</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons coins"><i></i><strong>coins</strong><span>UTF E038</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons airplane"><i></i><strong>airplane</strong><span>UTF 2708</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons notes"><i></i><strong>notes</strong><span>UTF E040</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons stats"><i></i><strong>stats</strong><span>UTF E041</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons charts"><i></i><strong>charts</strong><span>UTF E042</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons pie_chart"><i></i><strong>pie_chart</strong><span>UTF E043</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons group"><i></i><strong>group</strong><span>UTF E044</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons keys"><i></i><strong>keys</strong><span>UTF E045</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons calendar"><i></i><strong>calendar</strong><span>UTF 1F4C5</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons router"><i></i><strong>router</strong><span>UTF E047</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons camera_small"><i></i><strong>camera_small</strong><span>UTF E048</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons dislikes"><i></i><strong>dislikes</strong><span>UTF E049</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons star"><i></i><strong>star</strong><span>UTF E050</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons link"><i></i><strong>link</strong><span>UTF E051</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons eye_open"><i></i><strong>eye_open</strong><span>UTF E052</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons eye_close"><i></i><strong>eye_close</strong><span>UTF E053</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons alarm"><i></i><strong>alarm</strong><span>UTF E054</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons clock"><i></i><strong>clock</strong><span>UTF E055</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons stopwatch"><i></i><strong>stopwatch</strong><span>UTF E056</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons projector"><i></i><strong>projector</strong><span>UTF E057</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons history"><i></i><strong>history</strong><span>UTF E058</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons truck"><i></i><strong>truck</strong><span>UTF E059</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cargo"><i></i><strong>cargo</strong><span>UTF E060</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons compass"><i></i><strong>compass</strong><span>UTF E061</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons keynote"><i></i><strong>keynote</strong><span>UTF E062</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons paperclip"><i></i><strong>paperclip</strong><span>UTF 1F4CE</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons power"><i></i><strong>power</strong><span>UTF E064</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons lightbulb"><i></i><strong>lightbulb</strong><span>UTF E065</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons tag"><i></i><strong>tag</strong><span>UTF E066</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons tags"><i></i><strong>tags</strong><span>UTF E067</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cleaning"><i></i><strong>cleaning</strong><span>UTF E068</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons ruller"><i></i><strong>ruller</strong><span>UTF E069</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons gift"><i></i><strong>gift</strong><span>UTF E070</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons umbrella"><i></i><strong>umbrella</strong><span>UTF 2602</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons book"><i></i><strong>book</strong><span>UTF E072</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bookmark"><i></i><strong>bookmark</strong><span>UTF 1F516</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons wifi"><i></i><strong>wifi</strong><span>UTF E074</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cup"><i></i><strong>cup</strong><span>UTF E075</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons stroller"><i></i><strong>stroller</strong><span>UTF E076</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons headphones"><i></i><strong>headphones</strong><span>UTF E077</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons headset"><i></i><strong>headset</strong><span>UTF E078</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons warning_sign"><i></i><strong>warning_sign</strong><span>UTF E079</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons signal"><i></i><strong>signal</strong><span>UTF E080</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons retweet"><i></i><strong>retweet</strong><span>UTF E081</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons refresh"><i></i><strong>refresh</strong><span>UTF E082</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons roundabout"><i></i><strong>roundabout</strong><span>UTF E083</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons random"><i></i><strong>random</strong><span>UTF E084</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons heat"><i></i><strong>heat</strong><span>UTF E085</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons repeat"><i></i><strong>repeat</strong><span>UTF E086</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons display"><i></i><strong>display</strong><span>UTF E087</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons log_book"><i></i><strong>log_book</strong><span>UTF E088</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons address_book"><i></i><strong>address_book</strong><span>UTF E089</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons building"><i></i><strong>building</strong><span>UTF E090</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons eyedropper"><i></i><strong>eyedropper</strong><span>UTF E091</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons adjust"><i></i><strong>adjust</strong><span>UTF E092</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons tint"><i></i><strong>tint</strong><span>UTF E093</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons crop"><i></i><strong>crop</strong><span>UTF E094</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons vector_path_square"><i></i><strong>vector_path_square</strong><span>UTF E095</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons vector_path_circle"><i></i><strong>vector_path_circle</strong><span>UTF E096</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons vector_path_polygon"><i></i><strong>vector_path_polygon</strong><span>UTF E097</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons vector_path_line"><i></i><strong>vector_path_line</strong><span>UTF E098</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons vector_path_curve"><i></i><strong>vector_path_curve</strong><span>UTF E099</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons vector_path_all"><i></i><strong>vector_path_all</strong><span>UTF E100</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons font"><i></i><strong>font</strong><span>UTF E101</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons italic"><i></i><strong>italic</strong><span>UTF E102</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bold"><i></i><strong>bold</strong><span>UTF E103</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons text_underline"><i></i><strong>text_underline</strong><span>UTF E104</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons text_strike"><i></i><strong>text_strike</strong><span>UTF E105</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons text_height"><i></i><strong>text_height</strong><span>UTF E106</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons text_width"><i></i><strong>text_width</strong><span>UTF E107</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons text_resize"><i></i><strong>text_resize</strong><span>UTF E108</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons left_indent"><i></i><strong>left_indent</strong><span>UTF E109</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons right_indent"><i></i><strong>right_indent</strong><span>UTF E110</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons align_left"><i></i><strong>align_left</strong><span>UTF E111</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons align_center"><i></i><strong>align_center</strong><span>UTF E112</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons align_right"><i></i><strong>align_right</strong><span>UTF E113</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons justify"><i></i><strong>justify</strong><span>UTF E114</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons list"><i></i><strong>list</strong><span>UTF E115</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons text_smaller"><i></i><strong>text_smaller</strong><span>UTF E116</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons text_bigger"><i></i><strong>text_bigger</strong><span>UTF E117</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons embed"><i></i><strong>embed</strong><span>UTF E118</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons embed_close"><i></i><strong>embed_close</strong><span>UTF E119</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons table"><i></i><strong>table</strong><span>UTF E120</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons message_full"><i></i><strong>message_full</strong><span>UTF E121</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons message_empty"><i></i><strong>message_empty</strong><span>UTF E122</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons message_in"><i></i><strong>message_in</strong><span>UTF E123</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons message_out"><i></i><strong>message_out</strong><span>UTF E124</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons message_plus"><i></i><strong>message_plus</strong><span>UTF E125</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons message_minus"><i></i><strong>message_minus</strong><span>UTF E126</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons message_ban"><i></i><strong>message_ban</strong><span>UTF E127</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons message_flag"><i></i><strong>message_flag</strong><span>UTF E128</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons message_lock"><i></i><strong>message_lock</strong><span>UTF E129</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons message_new"><i></i><strong>message_new</strong><span>UTF E130</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons inbox"><i></i><strong>inbox</strong><span>UTF E131</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons inbox_plus"><i></i><strong>inbox_plus</strong><span>UTF E132</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons inbox_minus"><i></i><strong>inbox_minus</strong><span>UTF E133</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons inbox_lock"><i></i><strong>inbox_lock</strong><span>UTF E134</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons inbox_in"><i></i><strong>inbox_in</strong><span>UTF E135</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons inbox_out"><i></i><strong>inbox_out</strong><span>UTF E136</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cogwheel"><i></i><strong>cogwheel</strong><span>UTF E137</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cogwheels"><i></i><strong>cogwheels</strong><span>UTF E138</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons picture"><i></i><strong>picture</strong><span>UTF E139</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons adjust_alt"><i></i><strong>adjust_alt</strong><span>UTF E140</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons database_lock"><i></i><strong>database_lock</strong><span>UTF E141</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons database_plus"><i></i><strong>database_plus</strong><span>UTF E142</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons database_minus"><i></i><strong>database_minus</strong><span>UTF E143</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons database_ban"><i></i><strong>database_ban</strong><span>UTF E144</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons folder_open"><i></i><strong>folder_open</strong><span>UTF E145</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons folder_plus"><i></i><strong>folder_plus</strong><span>UTF E146</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons folder_minus"><i></i><strong>folder_minus</strong><span>UTF E147</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons folder_lock"><i></i><strong>folder_lock</strong><span>UTF E148</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons folder_flag"><i></i><strong>folder_flag</strong><span>UTF E149</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons folder_new"><i></i><strong>folder_new</strong><span>UTF E150</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons edit"><i></i><strong>edit</strong><span>UTF E151</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons new_window"><i></i><strong>new_window</strong><span>UTF E152</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons check"><i></i><strong>check</strong><span>UTF E153</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons unchecked"><i></i><strong>unchecked</strong><span>UTF E154</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons more_windows"><i></i><strong>more_windows</strong><span>UTF E155</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons show_big_thumbnails"><i></i><strong>show_big_thumbnails</strong><span>UTF E156</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons show_thumbnails"><i></i><strong>show_thumbnails</strong><span>UTF E157</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons show_thumbnails_with_lines"><i></i><strong>show_thumbnails_with_lines</strong><span>UTF E158</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons show_lines"><i></i><strong>show_lines</strong><span>UTF E159</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons playlist"><i></i><strong>playlist</strong><span>UTF E160</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons imac"><i></i><strong>imac</strong><span>UTF E161</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons macbook"><i></i><strong>macbook</strong><span>UTF E162</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons ipad"><i></i><strong>ipad</strong><span>UTF E163</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons iphone"><i></i><strong>iphone</strong><span>UTF E164</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons iphone_transfer"><i></i><strong>iphone_transfer</strong><span>UTF E165</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons iphone_exchange"><i></i><strong>iphone_exchange</strong><span>UTF E166</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons ipod"><i></i><strong>ipod</strong><span>UTF E167</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons ipod_shuffle"><i></i><strong>ipod_shuffle</strong><span>UTF E168</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons ear_plugs"><i></i><strong>ear_plugs</strong><span>UTF E169</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons record"><i></i><strong>record</strong><span>UTF E170</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons step_backward"><i></i><strong>step_backward</strong><span>UTF E171</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons fast_backward"><i></i><strong>fast_backward</strong><span>UTF E172</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons rewind"><i></i><strong>rewind</strong><span>UTF E173</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons play"><i></i><strong>play</strong><span>UTF E174</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons pause"><i></i><strong>pause</strong><span>UTF E175</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons stop"><i></i><strong>stop</strong><span>UTF E176</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons forward"><i></i><strong>forward</strong><span>UTF E177</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons fast_forward"><i></i><strong>fast_forward</strong><span>UTF E178</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons step_forward"><i></i><strong>step_forward</strong><span>UTF E179</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons eject"><i></i><strong>eject</strong><span>UTF E180</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons facetime_video"><i></i><strong>facetime_video</strong><span>UTF E181</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons download_alt"><i></i><strong>download_alt</strong><span>UTF E182</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons mute"><i></i><strong>mute</strong><span>UTF E183</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons volume_down"><i></i><strong>volume_down</strong><span>UTF E184</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons volume_up"><i></i><strong>volume_up</strong><span>UTF E185</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons screenshot"><i></i><strong>screenshot</strong><span>UTF E186</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons move"><i></i><strong>move</strong><span>UTF E187</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons more"><i></i><strong>more</strong><span>UTF E188</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons brightness_reduce"><i></i><strong>brightness_reduce</strong><span>UTF E189</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons brightness_increase"><i></i><strong>brightness_increase</strong><span>UTF E190</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons circle_plus"><i></i><strong>circle_plus</strong><span>UTF E191</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons circle_minus"><i></i><strong>circle_minus</strong><span>UTF E192</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons circle_remove"><i></i><strong>circle_remove</strong><span>UTF E193</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons circle_ok"><i></i><strong>circle_ok</strong><span>UTF E194</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons circle_question_mark"><i></i><strong>circle_question_mark</strong><span>UTF E195</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons circle_info"><i></i><strong>circle_info</strong><span>UTF E196</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons circle_exclamation_mark"><i></i><strong>circle_exclamation_mark</strong><span>UTF E197</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons remove"><i></i><strong>remove</strong><span>UTF E198</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons ok"><i></i><strong>ok</strong><span>UTF E199</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons ban"><i></i><strong>ban</strong><span>UTF E200</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons download"><i></i><strong>download</strong><span>UTF E201</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons upload"><i></i><strong>upload</strong><span>UTF E202</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons shopping_cart"><i></i><strong>shopping_cart</strong><span>UTF E203</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons lock"><i></i><strong>lock</strong><span>UTF 1F512</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons unlock"><i></i><strong>unlock</strong><span>UTF E205</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons electricity"><i></i><strong>electricity</strong><span>UTF E206</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons ok_2"><i></i><strong>ok_2</strong><span>UTF E207</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons remove_2"><i></i><strong>remove_2</strong><span>UTF E208</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cart_out"><i></i><strong>cart_out</strong><span>UTF E209</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cart_in"><i></i><strong>cart_in</strong><span>UTF E210</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons left_arrow"><i></i><strong>left_arrow</strong><span>UTF E211</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons right_arrow"><i></i><strong>right_arrow</strong><span>UTF E212</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons down_arrow"><i></i><strong>down_arrow</strong><span>UTF E213</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons up_arrow"><i></i><strong>up_arrow</strong><span>UTF E214</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons resize_small"><i></i><strong>resize_small</strong><span>UTF E215</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons resize_full"><i></i><strong>resize_full</strong><span>UTF E216</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons circle_arrow_left"><i></i><strong>circle_arrow_left</strong><span>UTF E217</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons circle_arrow_right"><i></i><strong>circle_arrow_right</strong><span>UTF E218</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons circle_arrow_top"><i></i><strong>circle_arrow_top</strong><span>UTF E219</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons circle_arrow_down"><i></i><strong>circle_arrow_down</strong><span>UTF E220</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons play_button"><i></i><strong>play_button</strong><span>UTF E221</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons unshare"><i></i><strong>unshare</strong><span>UTF E222</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons share"><i></i><strong>share</strong><span>UTF E223</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons chevron-right"><i></i><strong>chevron-right</strong><span>UTF E224</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons chevron-left"><i></i><strong>chevron-left</strong><span>UTF E225</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bluetooth"><i></i><strong>bluetooth</strong><span>UTF E226</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons euro"><i></i><strong>euro</strong><span>UTF 20AC</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons usd"><i></i><strong>usd</strong><span>UTF E228</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons gbp"><i></i><strong>gbp</strong><span>UTF E229</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons retweet_2"><i></i><strong>retweet_2</strong><span>UTF E230</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons moon"><i></i><strong>moon</strong><span>UTF E231</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sun"><i></i><strong>sun</strong><span>UTF 2609</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cloud"><i></i><strong>cloud</strong><span>UTF 2601</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons direction"><i></i><strong>direction</strong><span>UTF E234</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons brush"><i></i><strong>brush</strong><span>UTF E235</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons pen"><i></i><strong>pen</strong><span>UTF E236</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons zoom_in"><i></i><strong>zoom_in</strong><span>UTF E237</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons zoom_out"><i></i><strong>zoom_out</strong><span>UTF E238</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons pin"><i></i><strong>pin</strong><span>UTF E239</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons albums"><i></i><strong>albums</strong><span>UTF E240</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons rotation_lock"><i></i><strong>rotation_lock</strong><span>UTF E241</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons flash"><i></i><strong>flash</strong><span>UTF E242</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons google_maps"><i></i><strong>google_maps</strong><span>UTF E243</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons anchor"><i></i><strong>anchor</strong><span>UTF 2693</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons conversation"><i></i><strong>conversation</strong><span>UTF E245</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons chat"><i></i><strong>chat</strong><span>UTF E246</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons male"><i></i><strong>male</strong><span>UTF E247</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons female"><i></i><strong>female</strong><span>UTF E248</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons asterisk"><i></i><strong>asterisk</strong><span>UTF 002A</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons divide"><i></i><strong>divide</strong><span>UTF 00F7</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons snorkel_diving"><i></i><strong>snorkel_diving</strong><span>UTF E251</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons scuba_diving"><i></i><strong>scuba_diving</strong><span>UTF E252</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons oxygen_bottle"><i></i><strong>oxygen_bottle</strong><span>UTF E253</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons fins"><i></i><strong>fins</strong><span>UTF E254</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons fishes"><i></i><strong>fishes</strong><span>UTF E255</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons boat"><i></i><strong>boat</strong><span>UTF E256</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons delete"><i></i><strong>delete</strong><span>UTF E257</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sheriffs_star"><i></i><strong>sheriffs_star</strong><span>UTF E258</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons qrcode"><i></i><strong>qrcode</strong><span>UTF E259</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons barcode"><i></i><strong>barcode</strong><span>UTF E260</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons pool"><i></i><strong>pool</strong><span>UTF E261</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons buoy"><i></i><strong>buoy</strong><span>UTF E262</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons spade"><i></i><strong>spade</strong><span>UTF E263</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bank"><i></i><strong>bank</strong><span>UTF 1F3E6</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons vcard"><i></i><strong>vcard</strong><span>UTF E265</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons electrical_plug"><i></i><strong>electrical_plug</strong><span>UTF E266</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons flag"><i></i><strong>flag</strong><span>UTF E267</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons credit_card"><i></i><strong>credit_card</strong><span>UTF E268</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons keyboard-wireless"><i></i><strong>keyboard-wireless</strong><span>UTF E269</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons keyboard-wired"><i></i><strong>keyboard-wired</strong><span>UTF E270</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons shield"><i></i><strong>shield</strong><span>UTF E271</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons ring"><i></i><strong>ring</strong><span>UTF 02DA</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cake"><i></i><strong>cake</strong><span>UTF E273</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons drink"><i></i><strong>drink</strong><span>UTF E274</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons beer"><i></i><strong>beer</strong><span>UTF E275</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons fast_food"><i></i><strong>fast_food</strong><span>UTF E276</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cutlery"><i></i><strong>cutlery</strong><span>UTF E277</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons pizza"><i></i><strong>pizza</strong><span>UTF E278</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons birthday_cake"><i></i><strong>birthday_cake</strong><span>UTF E279</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons tablet"><i></i><strong>tablet</strong><span>UTF E280</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons settings"><i></i><strong>settings</strong><span>UTF E281</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bullets"><i></i><strong>bullets</strong><span>UTF E282</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cardio"><i></i><strong>cardio</strong><span>UTF E283</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons t-shirt"><i></i><strong>t-shirt</strong><span>UTF E284</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons pants"><i></i><strong>pants</strong><span>UTF E285</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sweater"><i></i><strong>sweater</strong><span>UTF E286</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons fabric"><i></i><strong>fabric</strong><span>UTF E287</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons leather"><i></i><strong>leather</strong><span>UTF E288</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons scissors"><i></i><strong>scissors</strong><span>UTF E289</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bomb"><i></i><strong>bomb</strong><span>UTF 1F4A3</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons skull"><i></i><strong>skull</strong><span>UTF 1F480</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons celebration"><i></i><strong>celebration</strong><span>UTF E292</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons tea_kettle"><i></i><strong>tea_kettle</strong><span>UTF E293</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons french_press"><i></i><strong>french_press</strong><span>UTF E294</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons coffe_cup"><i></i><strong>coffe_cup</strong><span>UTF E295</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons pot"><i></i><strong>pot</strong><span>UTF E296</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons grater"><i></i><strong>grater</strong><span>UTF E297</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons kettle"><i></i><strong>kettle</strong><span>UTF E298</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons hospital"><i></i><strong>hospital</strong><span>UTF 1F3E5</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons hospital_h"><i></i><strong>hospital_h</strong><span>UTF E300</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons microphone"><i></i><strong>microphone</strong><span>UTF 1F3A4</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons webcam"><i></i><strong>webcam</strong><span>UTF E302</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons temple_christianity_church"><i></i><strong>temple_christianity_church</strong><span>UTF E303</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons temple_islam"><i></i><strong>temple_islam</strong><span>UTF E304</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons temple_hindu"><i></i><strong>temple_hindu</strong><span>UTF E305</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons temple_buddhist"><i></i><strong>temple_buddhist</strong><span>UTF E306</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bicycle"><i></i><strong>bicycle</strong><span>UTF 1F6B2</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons life_preserver"><i></i><strong>life_preserver</strong><span>UTF E308</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons share_alt"><i></i><strong>share_alt</strong><span>UTF E309</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons comments"><i></i><strong>comments</strong><span>UTF E310</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons flower"><i></i><strong>flower</strong><span>UTF 2698</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons baseball"><i></i><strong>baseball</strong><span>UTF 26BE</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons rugby"><i></i><strong>rugby</strong><span>UTF E313</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons ax"><i></i><strong>ax</strong><span>UTF E314</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons table_tennis"><i></i><strong>table_tennis</strong><span>UTF E315</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bowling"><i></i><strong>bowling</strong><span>UTF 1F3B3</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons tree_conifer"><i></i><strong>tree_conifer</strong><span>UTF E317</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons tree_deciduous"><i></i><strong>tree_deciduous</strong><span>UTF E318</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons more_items"><i></i><strong>more_items</strong><span>UTF E319</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sort"><i></i><strong>sort</strong><span>UTF E320</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons filter"><i></i><strong>filter</strong><span>UTF E321</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons gamepad"><i></i><strong>gamepad</strong><span>UTF E322</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons playing_dices"><i></i><strong>playing_dices</strong><span>UTF E323</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons calculator"><i></i><strong>calculator</strong><span>UTF E324</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons tie"><i></i><strong>tie</strong><span>UTF E325</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons wallet"><i></i><strong>wallet</strong><span>UTF E326</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons piano"><i></i><strong>piano</strong><span>UTF E327</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sampler"><i></i><strong>sampler</strong><span>UTF E328</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons podium"><i></i><strong>podium</strong><span>UTF E329</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons soccer_ball"><i></i><strong>soccer_ball</strong><span>UTF E330</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons blog"><i></i><strong>blog</strong><span>UTF E331</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons dashboard"><i></i><strong>dashboard</strong><span>UTF E332</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons certificate"><i></i><strong>certificate</strong><span>UTF E333</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bell"><i></i><strong>bell</strong><span>UTF 1F514</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons candle"><i></i><strong>candle</strong><span>UTF E335</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons pushpin"><i></i><strong>pushpin</strong><span>UTF 1F4CC</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons iphone_shake"><i></i><strong>iphone_shake</strong><span>UTF E337</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons pin_flag"><i></i><strong>pin_flag</strong><span>UTF E338</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons turtle"><i></i><strong>turtle</strong><span>UTF 1F422</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons rabbit"><i></i><strong>rabbit</strong><span>UTF 1F407</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons globe"><i></i><strong>globe</strong><span>UTF E341</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons briefcase"><i></i><strong>briefcase</strong><span>UTF 1F4BC</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons hdd"><i></i><strong>hdd</strong><span>UTF E343</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons thumbs_up"><i></i><strong>thumbs_up</strong><span>UTF E344</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons thumbs_down"><i></i><strong>thumbs_down</strong><span>UTF E345</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons hand_right"><i></i><strong>hand_right</strong><span>UTF E346</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons hand_left"><i></i><strong>hand_left</strong><span>UTF E347</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons hand_up"><i></i><strong>hand_up</strong><span>UTF E348</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons hand_down"><i></i><strong>hand_down</strong><span>UTF E349</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons fullscreen"><i></i><strong>fullscreen</strong><span>UTF E350</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons shopping_bag"><i></i><strong>shopping_bag</strong><span>UTF E351</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons book_open"><i></i><strong>book_open</strong><span>UTF E352</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons nameplate"><i></i><strong>nameplate</strong><span>UTF E353</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons nameplate_alt"><i></i><strong>nameplate_alt</strong><span>UTF E354</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons vases"><i></i><strong>vases</strong><span>UTF E355</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bullhorn"><i></i><strong>bullhorn</strong><span>UTF E356</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons dumbbell"><i></i><strong>dumbbell</strong><span>UTF E357</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons suitcase"><i></i><strong>suitcase</strong><span>UTF E358</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons file_import"><i></i><strong>file_import</strong><span>UTF E359</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons file_export"><i></i><strong>file_export</strong><span>UTF E360</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bug"><i></i><strong>bug</strong><span>UTF 1F41B</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons crown"><i></i><strong>crown</strong><span>UTF 1F451</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons smoking"><i></i><strong>smoking</strong><span>UTF E363</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cloud-upload"><i></i><strong>cloud-upload</strong><span>UTF E364</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cloud-download"><i></i><strong>cloud-download</strong><span>UTF E365</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons restart"><i></i><strong>restart</strong><span>UTF E366</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons security_camera"><i></i><strong>security_camera</strong><span>UTF E367</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons expand"><i></i><strong>expand</strong><span>UTF E368</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons collapse"><i></i><strong>collapse</strong><span>UTF E369</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons collapse_top"><i></i><strong>collapse_top</strong><span>UTF E370</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons globe_af"><i></i><strong>globe_af</strong><span>UTF E371</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons global"><i></i><strong>global</strong><span>UTF E372</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons spray"><i></i><strong>spray</strong><span>UTF E373</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons nails"><i></i><strong>nails</strong><span>UTF E374</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons claw_hammer"><i></i><strong>claw_hammer</strong><span>UTF E375</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons classic_hammer"><i></i><strong>classic_hammer</strong><span>UTF E376</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons hand_saw"><i></i><strong>hand_saw</strong><span>UTF E377</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons riflescope"><i></i><strong>riflescope</strong><span>UTF E378</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons electrical_socket_eu"><i></i><strong>electrical_socket_eu</strong><span>UTF E379</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons electrical_socket_us"><i></i><strong>electrical_socket_us</strong><span>UTF E380</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons message_forward"><i></i><strong>message_forward</strong><span>UTF E381</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons coat_hanger"><i></i><strong>coat_hanger</strong><span>UTF E382</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons dress"><i></i><strong>dress</strong><span>UTF 1F457</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons bathrobe"><i></i><strong>bathrobe</strong><span>UTF E384</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons shirt"><i></i><strong>shirt</strong><span>UTF E385</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons underwear"><i></i><strong>underwear</strong><span>UTF E386</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons log_in"><i></i><strong>log_in</strong><span>UTF E387</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons log_out"><i></i><strong>log_out</strong><span>UTF E388</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons exit"><i></i><strong>exit</strong><span>UTF E389</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons new_window_alt"><i></i><strong>new_window_alt</strong><span>UTF E390</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons video_sd"><i></i><strong>video_sd</strong><span>UTF E391</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons video_hd"><i></i><strong>video_hd</strong><span>UTF E392</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons subtitles"><i></i><strong>subtitles</strong><span>UTF E393</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sound_stereo"><i></i><strong>sound_stereo</strong><span>UTF E394</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sound_dolby"><i></i><strong>sound_dolby</strong><span>UTF E395</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sound_5_1"><i></i><strong>sound_5_1</strong><span>UTF E396</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sound_6_1"><i></i><strong>sound_6_1</strong><span>UTF E397</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sound_7_1"><i></i><strong>sound_7_1</strong><span>UTF E398</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons copyright_mark"><i></i><strong>copyright_mark</strong><span>UTF E399</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons registration_mark"><i></i><strong>registration_mark</strong><span>UTF E400</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons radar"><i></i><strong>radar</strong><span>UTF E401</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons skateboard"><i></i><strong>skateboard</strong><span>UTF E402</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons golf_course"><i></i><strong>golf_course</strong><span>UTF E403</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sorting"><i></i><strong>sorting</strong><span>UTF E404</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sort-by-alphabet"><i></i><strong>sort-by-alphabet</strong><span>UTF E405</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sort-by-alphabet-alt"><i></i><strong>sort-by-alphabet-alt</strong><span>UTF E406</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sort-by-order"><i></i><strong>sort-by-order</strong><span>UTF E407</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sort-by-order-alt"><i></i><strong>sort-by-order-alt</strong><span>UTF E408</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sort-by-attributes"><i></i><strong>sort-by-attributes</strong><span>UTF E409</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons sort-by-attributes-alt"><i></i><strong>sort-by-attributes-alt</strong><span>UTF E410</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons compressed"><i></i><strong>compressed</strong><span>UTF E411</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons package"><i></i><strong>package</strong><span>UTF 1F4E6</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cloud_plus"><i></i><strong>cloud_plus</strong><span>UTF E413</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons cloud_minus"><i></i><strong>cloud_minus</strong><span>UTF E414</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons disk_save"><i></i><strong>disk_save</strong><span>UTF E415</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons disk_open"><i></i><strong>disk_open</strong><span>UTF E416</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons disk_saved"><i></i><strong>disk_saved</strong><span>UTF E417</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons disk_remove"><i></i><strong>disk_remove</strong><span>UTF E418</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons disk_import"><i></i><strong>disk_import</strong><span>UTF E419</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons disk_export"><i></i><strong>disk_export</strong><span>UTF E420</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons tower"><i></i><strong>tower</strong><span>UTF E421</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons send"><i></i><strong>send</strong><span>UTF E422</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons git_branch"><i></i><strong>git_branch</strong><span>UTF E423</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons git_create"><i></i><strong>git_create</strong><span>UTF E424</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons git_private"><i></i><strong>git_private</strong><span>UTF E425</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons git_delete"><i></i><strong>git_delete</strong><span>UTF E426</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons git_merge"><i></i><strong>git_merge</strong><span>UTF E427</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons git_pull_request"><i></i><strong>git_pull_request</strong><span>UTF E428</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons git_compare"><i></i><strong>git_compare</strong><span>UTF E429</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons git_commit"><i></i><strong>git_commit</strong><span>UTF E430</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons construction_cone"><i></i><strong>construction_cone</strong><span>UTF E431</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons shoe_steps"><i></i><strong>shoe_steps</strong><span>UTF E432</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons plus"><i></i><strong>plus</strong><span>UTF 002B</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons minus"><i></i><strong>minus</strong><span>UTF 2212</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons redo"><i></i><strong>redo</strong><span>UTF E435</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons undo"><i></i><strong>undo</strong><span>UTF E436</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons golf"><i></i><strong>golf</strong><span>UTF E437</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons hockey"><i></i><strong>hockey</strong><span>UTF E438</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons pipe"><i></i><strong>pipe</strong><span>UTF E439</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons wrench"><i></i><strong>wrench</strong><span>UTF 1F527</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons folder_closed"><i></i><strong>folder_closed</strong><span>UTF E441</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons phone_alt"><i></i><strong>phone_alt</strong><span>UTF E442</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons earphone"><i></i><strong>earphone</strong><span>UTF E443</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons floppy_disk"><i></i><strong>floppy_disk</strong><span>UTF E444</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons floppy_saved"><i></i><strong>floppy_saved</strong><span>UTF E445</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons floppy_remove"><i></i><strong>floppy_remove</strong><span>UTF E446</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons floppy_save"><i></i><strong>floppy_save</strong><span>UTF E447</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons floppy_open"><i></i><strong>floppy_open</strong><span>UTF E448</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons translate"><i></i><strong>translate</strong><span>UTF E449</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons fax"><i></i><strong>fax</strong><span>UTF E450</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons factory"><i></i><strong>factory</strong><span>UTF 1F3ED</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons shop_window"><i></i><strong>shop_window</strong><span>UTF E452</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons shop"><i></i><strong>shop</strong><span>UTF E453</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons kiosk"><i></i><strong>kiosk</strong><span>UTF E454</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons kiosk_wheels"><i></i><strong>kiosk_wheels</strong><span>UTF E455</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons kiosk_light"><i></i><strong>kiosk_light</strong><span>UTF E456</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons kiosk_food"><i></i><strong>kiosk_food</strong><span>UTF E457</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons transfer"><i></i><strong>transfer</strong><span>UTF E458</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons money"><i></i><strong>money</strong><span>UTF E459</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons header"><i></i><strong>header</strong><span>UTF E460</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons blacksmith"><i></i><strong>blacksmith</strong><span>UTF E461</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons saw_blade"><i></i><strong>saw_blade</strong><span>UTF E462</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons basketball"><i></i><strong>basketball</strong><span>UTF E463</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons server"><i></i><strong>server</strong><span>UTF E464</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons server_plus"><i></i><strong>server_plus</strong><span>UTF E465</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons server_minus"><i></i><strong>server_minus</strong><span>UTF E466</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons server_ban"><i></i><strong>server_ban</strong><span>UTF E467</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons server_flag"><i></i><strong>server_flag</strong><span>UTF E468</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons server_lock"><i></i><strong>server_lock</strong><span>UTF E469</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons server_new"><i></i><strong>server_new</strong><span>UTF E470</span></a></div>
                        </div>
                    </section>					</div>
                <div class="tab-pane" id="glyphicons_social">
                    <section>
                        <h4>Glyphicons Social <span class="badge badge-inverse">50</span></h4>
                        <div class="row row-icons">
                            <div class="col-md-3"><a href="#" class="glyphicons-social pinterest"><i></i><strong>pinterest</strong><span>UTF E001</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social dropbox"><i></i><strong>dropbox</strong><span>UTF E002</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social google_plus"><i></i><strong>google_plus</strong><span>UTF E003</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social jolicloud"><i></i><strong>jolicloud</strong><span>UTF E004</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social yahoo"><i></i><strong>yahoo</strong><span>UTF E005</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social blogger"><i></i><strong>blogger</strong><span>UTF E006</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social picasa"><i></i><strong>picasa</strong><span>UTF E007</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social amazon"><i></i><strong>amazon</strong><span>UTF E008</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social tumblr"><i></i><strong>tumblr</strong><span>UTF E009</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social wordpress"><i></i><strong>wordpress</strong><span>UTF E010</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social instapaper"><i></i><strong>instapaper</strong><span>UTF E011</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social evernote"><i></i><strong>evernote</strong><span>UTF E012</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social xing"><i></i><strong>xing</strong><span>UTF E013</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social zootool"><i></i><strong>zootool</strong><span>UTF E014</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social dribbble"><i></i><strong>dribbble</strong><span>UTF E015</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social deviantart"><i></i><strong>deviantart</strong><span>UTF E016</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social read_it_later"><i></i><strong>read_it_later</strong><span>UTF E017</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social linked_in"><i></i><strong>linked_in</strong><span>UTF E018</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social forrst"><i></i><strong>forrst</strong><span>UTF E019</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social pinboard"><i></i><strong>pinboard</strong><span>UTF E020</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social behance"><i></i><strong>behance</strong><span>UTF E021</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social github"><i></i><strong>github</strong><span>UTF E022</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social youtube"><i></i><strong>youtube</strong><span>UTF E023</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social skitch"><i></i><strong>skitch</strong><span>UTF E024</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social foursquare"><i></i><strong>foursquare</strong><span>UTF E025</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social quora"><i></i><strong>quora</strong><span>UTF E026</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social badoo"><i></i><strong>badoo</strong><span>UTF E027</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social spotify"><i></i><strong>spotify</strong><span>UTF E028</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social stumbleupon"><i></i><strong>stumbleupon</strong><span>UTF E029</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social readability"><i></i><strong>readability</strong><span>UTF E030</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social facebook"><i></i><strong>facebook</strong><span>UTF E031</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social twitter"><i></i><strong>twitter</strong><span>UTF E032</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social instagram"><i></i><strong>instagram</strong><span>UTF E033</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social posterous_spaces"><i></i><strong>posterous_spaces</strong><span>UTF E034</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social vimeo"><i></i><strong>vimeo</strong><span>UTF E035</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social flickr"><i></i><strong>flickr</strong><span>UTF E036</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social last_fm"><i></i><strong>last_fm</strong><span>UTF E037</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social rss"><i></i><strong>rss</strong><span>UTF E038</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social skype"><i></i><strong>skype</strong><span>UTF E039</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social e-mail"><i></i><strong>e-mail</strong><span>UTF E040</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social vine"><i></i><strong>vine</strong><span>UTF E041</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social myspace"><i></i><strong>myspace</strong><span>UTF E042</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social goodreads"><i></i><strong>goodreads</strong><span>UTF E043</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social apple"><i></i><strong>apple</strong><span>UTF F8FF</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social windows"><i></i><strong>windows</strong><span>UTF E045</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social yelp"><i></i><strong>yelp</strong><span>UTF E046</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social playstation"><i></i><strong>playstation</strong><span>UTF E047</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social xbox"><i></i><strong>xbox</strong><span>UTF E048</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social android"><i></i><strong>android</strong><span>UTF E049</span></a></div>
                            <div class="col-md-3"><a href="#" class="glyphicons-social ios"><i></i><strong>ios</strong><span>UTF E050</span></a></div>
                        </div>
                    </section>					</div>
                <div class="tab-pane" id="glyphicons_filetypes">
                    <section>
                        <h4>Glyphicons Filetypes <span class="badge badge-inverse">130</span></h4>
                        <div class="row row-icons">
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype txt"><i></i><strong>txt</strong><span>UTF E001</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype doc"><i></i><strong>doc</strong><span>UTF E002</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype rtf"><i></i><strong>rtf</strong><span>UTF E003</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype log"><i></i><strong>log</strong><span>UTF E004</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype tex"><i></i><strong>tex</strong><span>UTF E005</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype msg"><i></i><strong>msg</strong><span>UTF E006</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype text"><i></i><strong>text</strong><span>UTF E007</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype wpd"><i></i><strong>wpd</strong><span>UTF E008</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype wps"><i></i><strong>wps</strong><span>UTF E009</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype docx"><i></i><strong>docx</strong><span>UTF E010</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype page"><i></i><strong>page</strong><span>UTF E011</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype csv"><i></i><strong>csv</strong><span>UTF E012</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype dat"><i></i><strong>dat</strong><span>UTF E013</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype tar"><i></i><strong>tar</strong><span>UTF E014</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype xml"><i></i><strong>xml</strong><span>UTF E015</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype vcf"><i></i><strong>vcf</strong><span>UTF E016</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype pps"><i></i><strong>pps</strong><span>UTF E017</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype key"><i></i><strong>key</strong><span>UTF 1F511</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype ppt"><i></i><strong>ppt</strong><span>UTF E019</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype pptx"><i></i><strong>pptx</strong><span>UTF E020</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype sdf"><i></i><strong>sdf</strong><span>UTF E021</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype gbr"><i></i><strong>gbr</strong><span>UTF E022</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype ged"><i></i><strong>ged</strong><span>UTF E023</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype mp3"><i></i><strong>mp3</strong><span>UTF E024</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype m4a"><i></i><strong>m4a</strong><span>UTF E025</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype waw"><i></i><strong>waw</strong><span>UTF E026</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype wma"><i></i><strong>wma</strong><span>UTF E027</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype mpa"><i></i><strong>mpa</strong><span>UTF E028</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype iff"><i></i><strong>iff</strong><span>UTF E029</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype aif"><i></i><strong>aif</strong><span>UTF E030</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype ra"><i></i><strong>ra</strong><span>UTF E031</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype mid"><i></i><strong>mid</strong><span>UTF E032</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype m3v"><i></i><strong>m3v</strong><span>UTF E033</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype e_3gp"><i></i><strong>e_3gp</strong><span>UTF E034</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype shf"><i></i><strong>shf</strong><span>UTF E035</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype avi"><i></i><strong>avi</strong><span>UTF E036</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype asx"><i></i><strong>asx</strong><span>UTF E037</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype mp4"><i></i><strong>mp4</strong><span>UTF E038</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype e_3g2"><i></i><strong>e_3g2</strong><span>UTF E039</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype mpg"><i></i><strong>mpg</strong><span>UTF E040</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype asf"><i></i><strong>asf</strong><span>UTF E041</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype vob"><i></i><strong>vob</strong><span>UTF E042</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype wmv"><i></i><strong>wmv</strong><span>UTF E043</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype mov"><i></i><strong>mov</strong><span>UTF E044</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype srt"><i></i><strong>srt</strong><span>UTF E045</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype m4v"><i></i><strong>m4v</strong><span>UTF E046</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype flv"><i></i><strong>flv</strong><span>UTF E047</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype rm"><i></i><strong>rm</strong><span>UTF E048</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype png"><i></i><strong>png</strong><span>UTF E049</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype psd"><i></i><strong>psd</strong><span>UTF E050</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype psp"><i></i><strong>psp</strong><span>UTF E051</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype jpg"><i></i><strong>jpg</strong><span>UTF E052</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype tif"><i></i><strong>tif</strong><span>UTF E053</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype tiff"><i></i><strong>tiff</strong><span>UTF E054</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype gif"><i></i><strong>gif</strong><span>UTF E055</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype bmp"><i></i><strong>bmp</strong><span>UTF E056</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype tga"><i></i><strong>tga</strong><span>UTF E057</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype thm"><i></i><strong>thm</strong><span>UTF E058</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype yuv"><i></i><strong>yuv</strong><span>UTF E059</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype dds"><i></i><strong>dds</strong><span>UTF E060</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype ai"><i></i><strong>ai</strong><span>UTF E061</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype eps"><i></i><strong>eps</strong><span>UTF E062</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype ps"><i></i><strong>ps</strong><span>UTF E063</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype svg"><i></i><strong>svg</strong><span>UTF E064</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype pdf"><i></i><strong>pdf</strong><span>UTF E065</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype pct"><i></i><strong>pct</strong><span>UTF E066</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype indd"><i></i><strong>indd</strong><span>UTF E067</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype xlr"><i></i><strong>xlr</strong><span>UTF E068</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype xls"><i></i><strong>xls</strong><span>UTF E069</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype xlsx"><i></i><strong>xlsx</strong><span>UTF E070</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype db"><i></i><strong>db</strong><span>UTF E071</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype dbf"><i></i><strong>dbf</strong><span>UTF E072</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype mdb"><i></i><strong>mdb</strong><span>UTF E073</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype pdb"><i></i><strong>pdb</strong><span>UTF E074</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype sql"><i></i><strong>sql</strong><span>UTF E075</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype aacd"><i></i><strong>aacd</strong><span>UTF E076</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype app"><i></i><strong>app</strong><span>UTF E077</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype exe"><i></i><strong>exe</strong><span>UTF E078</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype com"><i></i><strong>com</strong><span>UTF E079</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype bat"><i></i><strong>bat</strong><span>UTF E080</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype apk"><i></i><strong>apk</strong><span>UTF E081</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype jar"><i></i><strong>jar</strong><span>UTF E082</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype hsf"><i></i><strong>hsf</strong><span>UTF E083</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype pif"><i></i><strong>pif</strong><span>UTF E084</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype vb"><i></i><strong>vb</strong><span>UTF E085</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype cgi"><i></i><strong>cgi</strong><span>UTF E086</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype css"><i></i><strong>css</strong><span>UTF E087</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype js"><i></i><strong>js</strong><span>UTF E088</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype php"><i></i><strong>php</strong><span>UTF E089</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype xhtml"><i></i><strong>xhtml</strong><span>UTF E090</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype htm"><i></i><strong>htm</strong><span>UTF E091</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype html"><i></i><strong>html</strong><span>UTF E092</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype asp"><i></i><strong>asp</strong><span>UTF E093</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype cer"><i></i><strong>cer</strong><span>UTF E094</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype jsp"><i></i><strong>jsp</strong><span>UTF E095</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype cfm"><i></i><strong>cfm</strong><span>UTF E096</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype aspx"><i></i><strong>aspx</strong><span>UTF E097</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype rss"><i></i><strong>rss</strong><span>UTF E098</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype csr"><i></i><strong>csr</strong><span>UTF E099</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype less"><i></i><strong>less</strong><span>UTF 003C</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype otf"><i></i><strong>otf</strong><span>UTF E101</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype ttf"><i></i><strong>ttf</strong><span>UTF E102</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype font"><i></i><strong>font</strong><span>UTF E103</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype fnt"><i></i><strong>fnt</strong><span>UTF E104</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype eot"><i></i><strong>eot</strong><span>UTF E105</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype woff"><i></i><strong>woff</strong><span>UTF E106</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype zip"><i></i><strong>zip</strong><span>UTF E107</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype zipx"><i></i><strong>zipx</strong><span>UTF E108</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype rar"><i></i><strong>rar</strong><span>UTF E109</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype targ"><i></i><strong>targ</strong><span>UTF E110</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype sitx"><i></i><strong>sitx</strong><span>UTF E111</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype deb"><i></i><strong>deb</strong><span>UTF E112</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype e_7z"><i></i><strong>e_7z</strong><span>UTF E113</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype pkg"><i></i><strong>pkg</strong><span>UTF E114</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype rpm"><i></i><strong>rpm</strong><span>UTF E115</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype cbr"><i></i><strong>cbr</strong><span>UTF E116</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype gz"><i></i><strong>gz</strong><span>UTF E117</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype dmg"><i></i><strong>dmg</strong><span>UTF E118</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype cue"><i></i><strong>cue</strong><span>UTF E119</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype bin"><i></i><strong>bin</strong><span>UTF E120</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype iso"><i></i><strong>iso</strong><span>UTF E121</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype hdf"><i></i><strong>hdf</strong><span>UTF E122</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype vcd"><i></i><strong>vcd</strong><span>UTF E123</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype bak"><i></i><strong>bak</strong><span>UTF E124</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype tmp"><i></i><strong>tmp</strong><span>UTF E125</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype ics"><i></i><strong>ics</strong><span>UTF E126</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype msi"><i></i><strong>msi</strong><span>UTF E127</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype cfg"><i></i><strong>cfg</strong><span>UTF E128</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype ini"><i></i><strong>ini</strong><span>UTF E129</span></a></div>
                            <div class="col-md-3"><a href="#" class="col-md-3 glyphicons-filetype prf"><i></i><strong>prf</strong><span>UTF E130</span></a></div>
                        </div>
                    </section>					</div>
                <div class="tab-pane active" id="fontawesome">
                    <section>
                        <h3>New Icons</h3>
                        <div class="row row-icons">
                            <div class="col-md-3"><a href="#"><i class="icon-compass"></i> icon-compass</a> </div>
                            <div class="col-md-3"><a href="#"><i class="icon-collapse"></i> icon-collapse</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-collapse-top"></i> icon-collapse-top</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-expand"></i> icon-expand</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-eur"></i> icon-eur</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-euro"></i> icon-euro <span class="muted">(alias)</span> </a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-gbp"></i> icon-gbp</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-usd"></i> icon-usd</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-dollar"></i> icon-dollar <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-inr"></i> icon-inr</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-rupee"></i> icon-rupee <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-jpy"></i> icon-jpy</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-yen"></i> icon-yen <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-cny"></i> icon-cny</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-renminbi"></i> icon-renminbi <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-krw"></i> icon-krw</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-won"></i> icon-won <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-btc"></i> icon-btc</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bitcoin"></i> icon-bitcoin <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-file"></i> icon-file</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-file-text"></i> icon-file-text</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-by-alphabet"></i> icon-sort-by-alphabet</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-by-alphabet-alt"></i> icon-sort-by-alphabet-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-by-attributes"></i> icon-sort-by-attributes</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-by-attributes-alt"></i> icon-sort-by-attributes-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-by-order"></i> icon-sort-by-order</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-by-order-alt"></i> icon-sort-by-order-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-thumbs-up"></i> icon-thumbs-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-thumbs-down"></i> icon-thumbs-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-youtube-sign"></i> icon-youtube-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-youtube"></i> icon-youtube</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-xing"></i> icon-xing</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-xing-sign"></i> icon-xing-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-youtube-play"></i> icon-youtube-play</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-dropbox"></i> icon-dropbox</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-stackexchange"></i> icon-stackexchange</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-instagram"></i> icon-instagram</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-flickr"></i> icon-flickr</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-adn"></i> icon-adn</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bitbucket"></i> icon-bitbucket</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bitbucket-sign"></i> icon-bitbucket-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-tumblr"></i> icon-tumblr</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-tumblr-sign"></i> icon-tumblr-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-long-arrow-down"></i> icon-long-arrow-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-long-arrow-up"></i> icon-long-arrow-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-long-arrow-left"></i> icon-long-arrow-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-long-arrow-right"></i> icon-long-arrow-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-apple"></i> icon-apple</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-windows"></i> icon-windows</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-android"></i> icon-android</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-linux"></i> icon-linux</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-dribble"></i> icon-dribble</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-skype"></i> icon-skype</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-foursquare"></i> icon-foursquare</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-trello"></i> icon-trello</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-female"></i> icon-female</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-male"></i> icon-male</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-gittip"></i> icon-gittip</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sun"></i> icon-sun</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-moon"></i> icon-moon</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-archive"></i> icon-archive</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bug"></i> icon-bug</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-vk"></i> icon-vk</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-weibo"></i> icon-weibo</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-renren"></i> icon-renren</a></div>
                        </div>
                    </section>

                    <section>
                        <h3 class="separator">Web Application Icons</h3>
                        <div class="row row-icons">
                            <div class="col-md-3"><a href="#"><i class="icon-adjust"></i> icon-adjust</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-anchor"></i> icon-anchor</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-archive"></i> icon-archive</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-asterisk"></i> icon-asterisk</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-ban-circle"></i> icon-ban-circle</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bar-chart"></i> icon-bar-chart</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-barcode"></i> icon-barcode</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-beaker"></i> icon-beaker</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-beer"></i> icon-beer</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bell"></i> icon-bell</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bell-alt"></i> icon-bell-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bolt"></i> icon-bolt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-book"></i> icon-book</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bookmark"></i> icon-bookmark</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bookmark-empty"></i> icon-bookmark-empty</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-briefcase"></i> icon-briefcase</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bug"></i> icon-bug</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-building"></i> icon-building</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bullhorn"></i> icon-bullhorn</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bullseye"></i> icon-bullseye</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-calendar"></i> icon-calendar</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-calendar-empty"></i> icon-calendar-empty</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-camera"></i> icon-camera</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-camera-retro"></i> icon-camera-retro</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-certificate"></i> icon-certificate</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-check"></i> icon-check</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-check-empty"></i> icon-check-empty</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-check-minus"></i> icon-check-minus</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-check-sign"></i> icon-check-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-circle"></i> icon-circle</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-circle-blank"></i> icon-circle-blank</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-cloud"></i> icon-cloud</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-cloud-download"></i> icon-cloud-download</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-cloud-upload"></i> icon-cloud-upload</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-code"></i> icon-code</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-code-fork"></i> icon-code-fork</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-coffee"></i> icon-coffee</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-cog"></i> icon-cog</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-cogs"></i> icon-cogs</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-collapse"></i> icon-collapse</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-collapse-alt"></i> icon-collapse-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-collapse-top"></i> icon-collapse-top</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-comment"></i> icon-comment</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-comment-alt"></i> icon-comment-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-comments"></i> icon-comments</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-comments-alt"></i> icon-comments-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-compass"></i> icon-compass</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-credit-card"></i> icon-credit-card</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-crop"></i> icon-crop</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-dashboard"></i> icon-dashboard</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-desktop"></i> icon-desktop</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-download"></i> icon-download</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-download-alt"></i> icon-download-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-edit"></i> icon-edit</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-edit-sign"></i> icon-edit-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-ellipsis-horizontal"></i> icon-ellipsis-horizontal</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-ellipsis-vertical"></i> icon-ellipsis-vertical</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-envelope"></i> icon-envelope</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-envelope-alt"></i> icon-envelope-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-eraser"></i> icon-eraser</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-exchange"></i> icon-exchange</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-exclamation"></i> icon-exclamation</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-exclamation-sign"></i> icon-exclamation-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-expand"></i> icon-expand</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-expand-alt"></i> icon-expand-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-external-link"></i> icon-external-link</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-external-link-sign"></i> icon-external-link-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-eye-close"></i> icon-eye-close</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-eye-open"></i> icon-eye-open</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-facetime-video"></i> icon-facetime-video</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-female"></i> icon-female</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-fighter-jet"></i> icon-fighter-jet</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-film"></i> icon-film</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-filter"></i> icon-filter</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-fire"></i> icon-fire</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-fire-extinguisher"></i> icon-fire-extinguisher</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-flag"></i> icon-flag</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-flag-alt"></i> icon-flag-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-flag-checkered"></i> icon-flag-checkered</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-folder-close"></i> icon-folder-close</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-folder-close-alt"></i> icon-folder-close-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-folder-open"></i> icon-folder-open</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-folder-open-alt"></i> icon-folder-open-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-food"></i> icon-food</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-frown"></i> icon-frown</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-gamepad"></i> icon-gamepad</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-gift"></i> icon-gift</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-glass"></i> icon-glass</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-globe"></i> icon-globe</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-group"></i> icon-group</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-hdd"></i> icon-hdd</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-headphones"></i> icon-headphones</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-heart"></i> icon-heart</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-heart-empty"></i> icon-heart-empty</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-home"></i> icon-home</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-inbox"></i> icon-inbox</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-info"></i> icon-info</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-info-sign"></i> icon-info-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-key"></i> icon-key</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-keyboard"></i> icon-keyboard</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-laptop"></i> icon-laptop</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-leaf"></i> icon-leaf</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-legal"></i> icon-legal</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-lemon"></i> icon-lemon</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-level-down"></i> icon-level-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-level-up"></i> icon-level-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-lightbulb"></i> icon-lightbulb</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-location-arrow"></i> icon-location-arrow</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-lock"></i> icon-lock</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-magic"></i> icon-magic</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-magnet"></i> icon-magnet</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-mail-forward"></i> icon-mail-forward <span class="muted">(alias)</span> </a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-mail-reply"></i> icon-mail-reply <span class="muted">(alias)</span> </a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-mail-reply-all"></i> icon-mail-reply-all</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-male"></i> icon-male</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-map-marker"></i> icon-map-marker</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-meh"></i> icon-meh</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-microphone"></i> icon-microphone</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-microphone-off"></i> icon-microphone-off</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-minus"></i> icon-minus</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-minus-sign"></i> icon-minus-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-minus-sign-alt"></i> icon-minus-sign-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-mobile-phone"></i> icon-mobile-phone</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-money"></i> icon-money</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-moon"></i> icon-moon</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-move"></i> icon-move</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-music"></i> icon-music</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-off"></i> icon-off</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-ok"></i> icon-ok</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-ok-circle"></i> icon-ok-circle</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-ok-sign"></i> icon-ok-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-pencil"></i> icon-pencil</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-phone"></i> icon-phone</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-phone-sign"></i> icon-phone-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-picture"></i> icon-picture</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-plane"></i> icon-plane</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-plus"></i> icon-plus</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-plus-sign"></i> icon-plus-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-plus-sign-alt"></i> icon-plus-sign-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-power-off"></i> icon-power-off <span class="muted">(alias)</span> </a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-print"></i> icon-print</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-pushpin"></i> icon-pushpin</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-puzzle-piece"></i> icon-puzzle-piece</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-qrcode"></i> icon-qrcode</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-question"></i> icon-question</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-question-sign"></i> icon-question-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-quote-left"></i> icon-quote-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-quote-right"></i> icon-quote-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-random"></i> icon-random</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-refresh"></i> icon-refresh</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-remove"></i> icon-remove</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-remove-circle"></i> icon-remove-circle</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-remove-sign"></i> icon-remove-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-reorder"></i> icon-reorder</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-reply"></i> icon-reply</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-reply-all"></i> icon-reply-all</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-resize-horizontal"></i> icon-resize-horizontal</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-resize-vertical"></i> icon-resize-vertical</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-retweet"></i> icon-retweet</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-road"></i> icon-road</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-rocket"></i> icon-rocket</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-rss"></i> icon-rss</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-rss-sign"></i> icon-rss-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-screenshot"></i> icon-screenshot</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-search"></i> icon-search</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-share"></i> icon-share</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-share-alt"></i> icon-share-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-share-sign"></i> icon-share-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-shield"></i> icon-shield</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-shopping-cart"></i> icon-shopping-cart</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sign-blank"></i> icon-sign-blank</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-signal"></i> icon-signal</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-signin"></i> icon-signin</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-signout"></i> icon-signout</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sitemap"></i> icon-sitemap</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-smile"></i> icon-smile</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort"></i> icon-sort</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-by-alphabet"></i> icon-sort-by-alphabet</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-by-alphabet-alt"></i> icon-sort-by-alphabet-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-by-attributes"></i> icon-sort-by-attributes</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-by-attributes-alt"></i> icon-sort-by-attributes-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-by-order"></i> icon-sort-by-order</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-by-order-alt"></i> icon-sort-by-order-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-down"></i> icon-sort-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sort-up"></i> icon-sort-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-spinner"></i> icon-spinner</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-star"></i> icon-star</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-star-empty"></i> icon-star-empty</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-star-half"></i> icon-star-half</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-star-half-empty"></i> icon-star-half-empty</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-star-half-full"></i> icon-star-half-full <span class="muted">(alias)</span> </a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-subscript"></i> icon-subscript</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-suitcase"></i> icon-suitcase</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-sun"></i> icon-sun</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-superscript"></i> icon-superscript</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-tablet"></i> icon-tablet</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-tag"></i> icon-tag</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-tags"></i> icon-tags</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-tasks"></i> icon-tasks</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-terminal"></i> icon-terminal</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-thumbs-down"></i> icon-thumbs-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-thumbs-down-alt"></i> icon-thumbs-down-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-thumbs-up"></i> icon-thumbs-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-thumbs-up-alt"></i> icon-thumbs-up-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-ticket"></i> icon-ticket</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-time"></i> icon-time</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-tint"></i> icon-tint</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-trash"></i> icon-trash</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-trophy"></i> icon-trophy</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-truck"></i> icon-truck</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-umbrella"></i> icon-umbrella</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-unchecked"></i> icon-unchecked <span class="muted">(alias)</span> </a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-unlock"></i> icon-unlock</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-unlock-alt"></i> icon-unlock-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-upload"></i> icon-upload</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-upload-alt"></i> icon-upload-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-user"></i> icon-user</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-volume-down"></i> icon-volume-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-volume-off"></i> icon-volume-off</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-volume-up"></i> icon-volume-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-warning-sign"></i> icon-warning-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-wrench"></i> icon-wrench</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-zoom-in"></i> icon-zoom-in</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-zoom-out"></i> icon-zoom-out</a></div>
                        </div>
                    </section>

                    <section>
                        <h3 class="separator">Currency Icons</h3>
                        <div class="row row-icons">
                            <div class="col-md-3"><a href="#"><i class="icon-bitcoin"></i> icon-bitcoin <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-btc"></i> icon-btc</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-cny"></i> icon-cny</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-dollar"></i> icon-dollar <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-eur"></i> icon-eur</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-euro"></i> icon-euro <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-gbp"></i> icon-gbp</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-inr"></i> icon-inr</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-jpy"></i> icon-jpy</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-krw"></i> icon-krw</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-renminbi"></i> icon-renminbi <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-rupee"></i> icon-rupee <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-usd"></i> icon-usd</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-won"></i> icon-won <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-yen"></i> icon-yen <span class="muted">(alias)</span></a></div>
                        </div>
                    </section>

                    <section>
                        <h3 class="separator">Text Editor Icons</h3>
                        <div class="row row-icons">
                            <div class="col-md-3"><a href="#"><i class="icon-align-center"></i> icon-align-center</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-align-justify"></i> icon-align-justify</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-align-left"></i> icon-align-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-align-right"></i> icon-align-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bold"></i> icon-bold</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-columns"></i> icon-columns</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-copy"></i> icon-copy</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-cut"></i> icon-cut</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-eraser"></i> icon-eraser</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-file"></i> icon-file</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-file-alt"></i> icon-file-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-file-text"></i> icon-file-text</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-file-text-alt"></i> icon-file-text-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-font"></i> icon-font</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-indent-left"></i> icon-indent-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-indent-right"></i> icon-indent-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-italic"></i> icon-italic</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-link"></i> icon-link</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-list"></i> icon-list</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-list-alt"></i> icon-list-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-list-ol"></i> icon-list-ol</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-list-ul"></i> icon-list-ul</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-paper-clip"></i> icon-paper-clip</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-paperclip"></i> icon-paperclip <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-paste"></i> icon-paste</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-repeat"></i> icon-repeat</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-rotate-left"></i> icon-rotate-left <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-rotate-right"></i> icon-rotate-right <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-save"></i> icon-save</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-strikethrough"></i> icon-strikethrough</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-table"></i> icon-table</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-text-height"></i> icon-text-height</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-text-width"></i> icon-text-width</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-th"></i> icon-th</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-th-large"></i> icon-th-large</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-th-list"></i> icon-th-list</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-underline"></i> icon-underline</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-undo"></i> icon-undo</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-unlink"></i> icon-unlink</a></div>
                        </div>
                    </section>

                    <section>
                        <h3 class="separator">Directional Icons</h3>
                        <div class="row row-icons">
                            <div class="col-md-3"><a href="#"><i class="icon-angle-down"></i> icon-angle-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-angle-left"></i> icon-angle-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-angle-right"></i> icon-angle-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-angle-up"></i> icon-angle-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-arrow-down"></i> icon-arrow-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-arrow-left"></i> icon-arrow-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-arrow-right"></i> icon-arrow-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-arrow-up"></i> icon-arrow-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-caret-down"></i> icon-caret-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-caret-left"></i> icon-caret-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-caret-right"></i> icon-caret-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-caret-up"></i> icon-caret-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-chevron-down"></i> icon-chevron-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-chevron-left"></i> icon-chevron-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-chevron-right"></i> icon-chevron-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-chevron-sign-down"></i> icon-chevron-sign-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-chevron-sign-left"></i> icon-chevron-sign-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-chevron-sign-right"></i> icon-chevron-sign-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-chevron-sign-up"></i> icon-chevron-sign-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-chevron-up"></i> icon-chevron-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-circle-arrow-down"></i> icon-circle-arrow-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-circle-arrow-left"></i> icon-circle-arrow-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-circle-arrow-right"></i> icon-circle-arrow-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-circle-arrow-up"></i> icon-circle-arrow-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-double-angle-down"></i> icon-double-angle-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-double-angle-left"></i> icon-double-angle-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-double-angle-right"></i> icon-double-angle-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-double-angle-up"></i> icon-double-angle-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-hand-down"></i> icon-hand-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-hand-left"></i> icon-hand-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-hand-right"></i> icon-hand-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-hand-up"></i> icon-hand-up</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-long-arrow-down"></i> icon-long-arrow-down</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-long-arrow-left"></i> icon-long-arrow-left</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-long-arrow-right"></i> icon-long-arrow-right</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-long-arrow-up"></i> icon-long-arrow-up</a></div>
                        </div>
                    </section>

                    <section>
                        <h3 class="separator">Video Player Icons</h3>
                        <div class="row row-icons">
                            <div class="col-md-3"><a href="#"><i class="icon-backward"></i> icon-backward</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-eject"></i> icon-eject</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-fast-backward"></i> icon-fast-backward</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-fast-forward"></i> icon-fast-forward</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-forward"></i> icon-forward</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-fullscreen"></i> icon-fullscreen</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-pause"></i> icon-pause</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-play"></i> icon-play</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-play-circle"></i> icon-play-circle</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-play-sign"></i> icon-play-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-resize-full"></i> icon-resize-full</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-resize-small"></i> icon-resize-small</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-step-backward"></i> icon-step-backward</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-step-forward"></i> icon-step-forward</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-stop"></i> icon-stop</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-youtube-play"></i> icon-youtube-play</a></div>
                        </div>
                    </section>

                    <section>
                        <h3 class="separator">Brand Icons</h3>
                        <div class="alert alert-info">
                            <ul class="margin-bottom-none">
                                <li>All brand icons are trademarks of their respective owners.</li>
                                <li>The use of these trademarks does not indicate endorsement
                                    of the trademark holder by Font Awesome, nor vice versa.</li>
                            </ul>
                        </div>
                        <div class="row row-icons">
                            <div class="col-md-3"><a href="#"><i class="icon-adn"></i> icon-adn</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-android"></i> icon-android</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-apple"></i> icon-apple</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bitbucket"></i> icon-bitbucket</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bitbucket-sign"></i> icon-bitbucket-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-bitcoin"></i> icon-bitcoin <span class="muted">(alias)</span></a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-btc"></i> icon-btc</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-css3"></i> icon-css3</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-dribble"></i> icon-dribble</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-dropbox"></i> icon-dropbox</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-facebook"></i> icon-facebook</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-facebook-sign"></i> icon-facebook-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-flickr"></i> icon-flickr</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-foursquare"></i> icon-foursquare</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-github"></i> icon-github</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-github-alt"></i> icon-github-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-github-sign"></i> icon-github-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-gittip"></i> icon-gittip</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-google-plus"></i> icon-google-plus</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-google-plus-sign"></i> icon-google-plus-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-html5"></i> icon-html5</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-instagram"></i> icon-instagram</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-linkedin"></i> icon-linkedin</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-linkedin-sign"></i> icon-linkedin-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-linux"></i> icon-linux</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-maxcdn"></i> icon-maxcdn</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-pinterest"></i> icon-pinterest</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-pinterest-sign"></i> icon-pinterest-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-renren"></i> icon-renren</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-skype"></i> icon-skype</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-stackexchange"></i> icon-stackexchange</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-trello"></i> icon-trello</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-tumblr"></i> icon-tumblr</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-tumblr-sign"></i> icon-tumblr-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-twitter"></i> icon-twitter</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-twitter-sign"></i> icon-twitter-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-vk"></i> icon-vk</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-weibo"></i> icon-weibo</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-windows"></i> icon-windows</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-xing"></i> icon-xing</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-xing-sign"></i> icon-xing-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-youtube"></i> icon-youtube</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-youtube-play"></i> icon-youtube-play</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-youtube-sign"></i> icon-youtube-sign</a></div>
                        </div>
                    </section>

                    <section>
                        <h3 class="separator">Medical Icons</h3>
                        <div class="row row-icons">
                            <div class="col-md-3"><a href="#"><i class="icon-ambulance"></i> icon-ambulance</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-h-sign"></i> icon-h-sign</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-hospital"></i> icon-hospital</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-medkit"></i> icon-medkit</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-plus-sign-alt"></i> icon-plus-sign-alt</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-stethoscope"></i> icon-stethoscope</a></div>
                            <div class="col-md-3"><a href="#"><i class="icon-user-md"></i> icon-user-md</a></div>
                        </div>
                    </section>					</div>

            </div>
        </div>
    </div>
</div>