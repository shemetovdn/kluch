<?php

$bundle = \frontend\assets\ImageAsset::register($this);

$this->registerJs("
$('#modal-map').on('shown.bs.modal', function (e) {
    initMap();
})

$('#map_filter').click(function(event){
    event.preventDefault();
    var form = $(this).parents(\"form.search-form\").serialize();
        $.ajax({
        url:'/site/markers-json',
        type: 'POST',
        data:form,
        success: function(data){
        $('#modal-map').attr('data-info', data);
        initMap();
        }
        
        })
});
", yii\web\View::POS_READY);

$this->registerJsFile($bundle->baseUrl.'/index-map.js');
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyDIPaMVi6Ld82YnqZi6PPF1-fdWo-27thc&language=ru&region=RU');

$mapinfo = array();
$mapinfo['icon'] = $bundle->baseUrl."/images/svg-png/map-marker-sprite.png";

$adverts = array();
foreach($totaladverts as $advert){
    foreach($advert as $key => $value){
        $advert[$key] = str_replace("\"", "", $advert[$key]);
        $advert[$key] = str_replace("'", "", $advert[$key]);
        $advert[$key] = str_replace("&quot;", "", $advert[$key]);
    }
    $adverts[] = $advert;
}

$mapinfo['adverts'] = $adverts;

$json = json_encode($mapinfo);

?>

<div id="json"></div>

<!-- Modal -->
<div class="modal fade" id="modal-map" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-info='<?=$json?>' style="padding: 10px;">

    <div class="modal-dialog map" role="document">
        <div class="map-modal-block">
            <div class="filter-close-box">
                <div style="height: 70px;">
                    <div class="dv-filter-on-map">
                        <?= \frontend\widgets\mapFilterWidget\MapFilterWidget::widget()?>
                    </div>
                </div>
                <button data-dismiss="modal" class="close-button"></button>
            </div>
            <div class="map-out" id="map-out">
                <div class="map-container" id="googleMap"></div>
            </div>
        </div>
    </div>
</div>