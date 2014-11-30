var map         = L.map('map'),
    marker,
    busStops    = [],
    busPattern  = [],
    busRoute,
    pid,
    lat,
    lon,
    updatemap,
    vid,
    dest,
    rt,
    insert,
    dbclick   =   false,
    busicon   =   L.Icon.extend({
                      options: {
                        iconSize:   [30, 30],
                        iconAnchor: [15, 15],
                      }
                    }),
    bluebus   =   new busicon({
                          iconUrl: './_assets/img/bus.png'
                        }),
    circle_options = {
      color: '#F00',      // Stroke color
      opacity: 1,         // Stroke opacity
      weight: 9,         // Stroke weight
      fillColor: '#F00',  // Fill color
      fillOpacity: 0.8    // Fill opacity
  };

$(".list-group").on('click', '.btn-rt', function(){
  $('#loadingSpinner').show();
  vid    =   $(this).attr("data-vid");

  $.getJSON("./_assets/json/location.php?vid=" + vid, function(data){
    lat    =   data.lat,
    lon    =   data.lon,
    pid    =   data.pid,
    map    =   map.setView([lat,lon], 15),
    marker =   L.marker([lat,lon],{icon: bluebus}).addTo(map);
    $.getJSON('./_assets/json/pattern.php?pid=' + pid, function(patterns){
        $.each(patterns['pt'], function(i,v) {
           var tempPat      =   [];
               tempPat[0]   =   v['lat'],
               tempPat[1]   =   v['lon'];
           busPattern.push(tempPat);
           if (v.typ == "S") {
            var tempStop    =   [];
                tempStop[0] =   v['lat'],
                tempStop[1] =   v['lon'];
            var tempSO = new L.Circle(tempStop, 5, circle_options).addTo(map);
            busStops.push(tempSO);
           }
        });
      busRoute = new L.polyline(busPattern).addTo(map);
    });
  });

  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);
  clearTimer();
  startTimer();
  $('#loadingSpinner').hide();
}); 

$("#zoomtobus").dblclick(function(){
  if(dbclick == false) {
    dbclick = true;
    $("#zoomtobus")
      .removeClass('btn-primary')
      .addClass('btn-danger');
  } else {
    dbclick = false;
    $("#zoomtobus")
      .removeClass('btn-danger')
      .addClass('btn-primary');
  }
});

$("#zoomtobus").click(function(){
  map.setView([lat,lon], map.getZoom());
});

function startTimer () {
  updatemap = setInterval(function() {
                timedUpdate(vid, marker, bluebus)
              }, 5000);
}

function clearTimer (){
  clearInterval(updatemap);
  map.eachLayer(function(annoying){
    if(typeof annoying._url == 'undefined') {
      map.removeLayer(annoying);
    }
  });
  busRoute = '';
  busPattern = [];
  busStops = [];
}

function timedUpdate(){
  $.get("./_assets/json/location.php?vid=" + vid, function(data){
    data    =   $.parseJSON(data);
    lat     =   data.lat;
    lon     =   data.lon;
    marker.setLatLng([lat,lon],{icon: bluebus});
    map.setView([lat,lon], map.getZoom());
  });
}

