// for content from admin panel
$(document).ready(function() {
  var arr = document.querySelectorAll(".from-admin-panel img");
  arr.forEach(function(el, i){
    el.parentElement.style.width = "100%";
  });
});
// for content from admin panel END

//retina fix
$(function () {
  window.onload = function() {
    if(window.devicePixelRatio > 1){
      var multiplier = window.devicePixelRatio;
      var images = document.querySelectorAll('img.optimizer');
      images.forEach(function(el){
        var sizeX = el.width;
        var sizeY = el.height;
        var imageType = el.src.substr(-4);
        var imageName = el.src.substr(0, el.src.length - 4);
        imageName += "_x" + multiplier + imageType;
        // imageName += "@" + multiplier + 'x' + imageType;
        var newImg = new Image();
        newImg.src = imageName;
        newImg.onload = function() {
          el.src = imageName;
          el.width = sizeX;
          el.height = sizeY;
        }
      });
    }
  };
});
//retina fix END

// show all item
$(function () {
  var dropdownElements = document.querySelectorAll('.show-all-item');
  dropdownElements.forEach(function(el){
    var innerHeight = null;
    var id = el.getAttribute('id');
    el.querySelector('.show_all').addEventListener('click', function(){
      el.classList.toggle('open');
    });
    innerHeight = el.querySelector('.text_box_out > div').offsetHeight;
    var effectStyle = document.createElement('style');
    effectStyle.type = 'text/css';
    effectStyle.innerHTML = '#' + id + '.open .text_box_out {height: '+ innerHeight +'px;}';
    document.getElementsByTagName('head')[0].appendChild(effectStyle);
  })
});
// show all item END