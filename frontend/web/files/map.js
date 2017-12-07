function initMap() {

  var article = document.querySelector('#modal-map');
  var data = article.dataset;
  var obj = JSON.parse(data.info);
  var icon = obj.icon;

  var markerImage = new google.maps.MarkerImage(
      icon,
      new google.maps.Size(40.5,38),
      new google.maps.Point(0,0)
  );
  var markerImageHover = new google.maps.MarkerImage(
      icon,
      new google.maps.Size(40.5,38),
      new google.maps.Point(40.5,0)
  );

  window.adverts = obj.adverts;

  var myLatLng = {lat: 45.242061, lng: 34.627569};

  var map = new google.maps.Map(document.getElementById('googleMap'), {
    center: myLatLng,
    zoom: 4,
    panControl: false,
    zoomControl: false,
    mapTypeControl: false,
    scaleControl: true,
    streetViewControl: false,
    overviewMapControl: true,
    rotateControl: true
  });

  var latlngbounds = new google.maps.LatLngBounds();
    var last_marker;
    adverts.forEach(function (element, i) {
        var myLatLng = {lat: Number(element.lat), lng: Number(element.lng)};
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: element.title,
            icon: markerImage
        });
        marker.addListener('click', function(){
            removeAllInfowindow();
            createInfoWindow(i);
        });

      marker.addListener('mouseover', function(){
        marker.setIcon(markerImageHover);
      });
      marker.addListener('mouseout', function(){
        marker.setIcon(markerImage);
      });

        latlngbounds.extend(myLatLng);
        last_marker=marker;
    });

    if(adverts.length>1) {
        map.setCenter(latlngbounds.getCenter(), map.fitBounds(latlngbounds));
    }else{
        map.setZoom(12);
        map.setCenter( last_marker.getPosition());
    }

  google.maps.event.addDomListener(window, "resize", initialize);
}

function createInfoWindow(i){

  var owlItems = window.adverts[i].images.reduce(function(sum, current) {
    return sum + '<div class="item"><img class="image" src="'+ current +'"></div>\n';
  }, '\n');

  var infobox = `<div class="infowindow animation">
        <span class="btn-close"></span>
        <div class="for-both-columns">
          <div class="img-column">
          
              <div class="owl-carousel">`+ owlItems +`</div>
          </div>
          <div class="cont-column">
              <div class="desc-out">
                  <div class="title"><a href="`+ window.adverts[i].href +`">`+ window.adverts[i].title +`</a></div>
                  <div class="desc">`+ window.adverts[i].address +`</div>
              </div>
              <div class="price-box">
                  <div class="price">`+ Number(window.adverts[i].price).toLocaleString() +` Р</div>
                  <div class="photos"><span class="number">`+ window.adverts[i].images.length +` фото</span></div>
              </div>
          </div>
        </div>
    </div>`;

  $("#map-out").append(infobox);
  $(".infowindow").hide().fadeIn();

  $(".owl-carousel").owlCarousel({
    items: 1,
    nav: true,
    navText: ['','']
  });

  $(".infowindow .btn-close").on('click', function () {
    $(this).parents('.infowindow').remove();
  });

}

function removeAllInfowindow(){
  $(".infowindow").remove();
}

