var button=document.querySelector('button');
var map;
var tabMarker=[];


/// RECUPERATION DES DONNEES DE FORMULAIRE/////
button.addEventListener('click',getAdress);
document.addEventListener('gps-ok',onEventPlacedMarker);



//////////////////////  AFFICHAGE DE LA MAP GOOGLE/////////////////////////////
window.eqfeed_callback = function(results) {
  for (var i = 0; i < results.features.length; i++) {
    var coords = results.features[i].geometry.coordinates;
    var latLng = new google.maps.LatLng(coords[1],coords[0]);
    var marker = new google.maps.Marker({
      position: latLng,
      map: map
    });
  }
};

///////////////////JS FRONT/////////////////////////////////////
let openform=document.querySelector('.form');
let buttonSearch = document.querySelector('.search');
let cross=document.querySelector('.cross');
console.log(cross);
buttonSearch.addEventListener('click',function () {
  openform.classList.toggle('close');
});

cross.addEventListener('click',closeForm);

function closeForm() {
  openform.classList.toggle('close');
}