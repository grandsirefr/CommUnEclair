

function initMap() {
  
  
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: new google.maps.LatLng(48.8534,2.3488),
    mapTypeId: 'terrain'
  });

  
  var script = document.createElement('script');

  
  document.getElementsByTagName('head')[0].appendChild(script);
  
}


function placedMarq(coordun,coorddeux,utilisateur){

  let marker;
  if(utilisateur==1){
     marker = new google.maps.Marker({
    position: {lat:coordun, lng: coorddeux },
    icon: {path: google.maps.SymbolPath.CIRCLE,scale : 10},
    map: map});
    console.log(marker);
  }
  else{
    marker = new google.maps.Marker({
    position: {lat:coordun, lng: coorddeux },
    map: map});
    console.log(marker);
  }
 
  
  tabMarker.push(marker);

  
}

function deleteMarq(tabmarker){
  for(var i=0; i<tabmarker.length;i++){
    //console.log(tabmarker[i]);
    tabMarker[i].setMap(null);
  }
}

