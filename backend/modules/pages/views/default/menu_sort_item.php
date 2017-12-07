<?php
/**
 * Created by PhpStorm.
 * User: Maksim Sergeevich (doctorpepper608@gmail.com)
 * Date: 28.10.2015
 * Time: 14:29
 */
if(count($topMenuList)) {
    echo '<ul id="sortable">';
    foreach ($topMenuList as $id => $v) {
        echo ' <li data-id="' . $id . '" title="'.$v['url'][0].'" class="ui-state-default btn-success"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' . str_replace(" ", "&nbsp;", $v['label']) . '</li>';
    }
    echo '</ul>
    <script>
        $(function() {
            $( "#sortable" ).sortable({
                placeholder: "ui-state-highlight",
                handle: ".ui-icon-arrowthick-2-n-s",
                stop:function(){
                    var sort = $(this).sortable("toArray",{"attribute":"data-id"});
                    setMenuSorter(sort);
                }
            });
            $( "#sortable" ).disableSelection();
        });
    </script>
    ';
}else{
    echo Yii::t('admin','There is no any top menu item');
}
?>
