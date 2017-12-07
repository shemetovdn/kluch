<?php

$bundle = \frontend\assets\ImageAsset::register($this);

$this->registerJs("
$('.marker-poss').click(function(e){
  var data = e.currentTarget.dataset;
  var obj = JSON.parse(data.pos);
  window.markerposs = obj;
  window.markericon = '".$bundle->baseUrl."/images/svg-png/map-marker.png';
  $('#item-modal-map').modal();
});

$('#item-modal-map').on('shown.bs.modal', function (e) {
    initItemMap();
})

function initItemMap() {

  var myLatLng = {'lat': Number(window.markerposs.lat), 'lng': Number(window.markerposs.lng)};

  var map = new google.maps.Map(document.getElementById('itemGoogleMap'), {
    center: myLatLng,
    zoom: 16,
    panControl: false,
    zoomControl: false,
    mapTypeControl: false,
    scaleControl: true,
    streetViewControl: false,
    overviewMapControl: true,
    rotateControl: true
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    icon:  window.markericon
  });
}

", yii\web\View::POS_READY);

$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyDIPaMVi6Ld82YnqZi6PPF1-fdWo-27thc&language=ru&region=RU');

?>

<!-- Modal -->
<div class="modal fade" id="item-modal-map" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding: 10px;">
    <div class="modal-dialog map" role="document">
        <div class="map-modal-block" style="padding-top: 70px;">
            <div class="filter-close-box">
                <button data-dismiss="modal" class="close-button"></button>
            </div>
<!--            <div class="map-out" id="map-out">-->
            <div class="map-out">
                <div class="map-container" id="itemGoogleMap"></div>
            </div>
        </div>
    </div>
</div>