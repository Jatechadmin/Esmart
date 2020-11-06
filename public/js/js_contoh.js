var overlays = [];
var selectedShape;
var areaWide;
var infowindow;
var geocoder = new google.maps.Geocoder();

var gmarkers = [];

var locname = [];

function removeMarkers() {
  for (i = 0; i < gmarkers.length; i++) {
    gmarkers[i].setMap(null);
  }
}

function removelocname() {
  while (locname.length > 0) {
    locname.pop();
  }
}


function initMap() {
  // Get Current Location
  var currentPosition = new google.maps.LatLng(-6.124931, 106.786487);
  // Save data to input form
  $("#currentLocation_lat").val("-6.124931");
  $("#currentLocation_lng").val("106.786487");

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        currentPosition = new google.maps.LatLng(
          position.coords.latitude,
          position.coords.longitude
        );
        // Save data to input form
        $("#currentLocation_lat").val(position.coords.latitude);
        $("#currentLocation_lng").val(position.coords.longitude);

        var map = new google.maps.Map(document.getElementById("map"), {
          center: currentPosition,
          zoom: 25,
          disableDefaultUI: true,
          mapTypeId: "satellite"
        });
        // var gmarkers = [];
        // Clear out the old markers.
        // gmarkers.forEach(function (marker) {
        //   marker.setMap(null);
        // });
        // markers = [];
        // gmarkers = [];


        var marker = new google.maps.Marker({
          position: currentPosition,
          draggable: true,
          title: "Lokasi Saya"
        });
        marker.setMap(map);
        gmarkers.push(marker);
        // gmarkers.push(marker);

        geocoder.geocode({
          'latLng': currentPosition
        }, function (results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
              $('#latitude,#longitude').show();
              locname.push(results[0].formatted_address)
              // console.log('array init locname' + locname)

              $('#address').val(results[0].formatted_address);
              $('#join-location').val(locname[locname.length - 1]);

              $('#pac-input').val(results[0].formatted_address);
              $('#latitude').val(marker.getPosition().lat());
              $('#longitude').val(marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
            }
          }
        });

        google.maps.event.addListener(marker, 'dragend', function () {

          geocoder.geocode({
            'latLng': marker.getPosition()
          }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              if (results[0]) {

                locname.push(results[0].formatted_address)
                // console.log('array init locname' + locname)


                $('#pac-input').val(results[0].formatted_address);
                $('#address').val(results[0].formatted_address);
                // $('#join-location').val(results[0].formatted_address);
                $('#join-location').val(locname[locname.length - 1]);
                $('#latitude').val(marker.getPosition().lat());
                $('#longitude').val(marker.getPosition().lng());
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
              }
            }
          });
        });

        infowindow = new google.maps.InfoWindow({
          pixelOffset: new google.maps.Size(-40, 31)
        });

        initFullscreenControl(map);
        initCurrentLocationControl(map, marker);
        initZoomControl(map);
        initDrawControl(map);
        initSearchBox(map);
        // initMapTypeControl(map);
        initSideNavMapTypeControl(map);
        // initMapNextBtn(map);
        // initShowUndoBtn();
      },
      function error(msg) {}, {
        maximumAge: 10000,
        timeout: 5000,
        enableHighAccuracy: true
      }
    );
  } else {
    alert("Geolocation tidak mendukung di browser ini.");

    var map = new google.maps.Map(document.getElementById("map"), {
      center: currentPosition,
      zoom: 25,
      disableDefaultUI: true,
      mapTypeId: "roadmap"
    });

    var marker = new google.maps.Marker({
      position: currentPosition,
      draggable: true,
      title: "Lokasi Saya"
    });
    marker.setMap(map);

    initFullscreenControl(map);
    initCurrentLocationControl(map, marker);
    initZoomControl(map);
    initDrawControl(map);
    initSearchBox(map);
    // initMapTypeControl(map);
    initSideNavMapTypeControl(map);
    // initMapNextBtn(map);
    // initShowUndoBtn();
  }
  // google.maps.event.addDomListener(window, 'load', initMap);
}



function initFullscreenControl(map) {
  var elementToSendFullscreen = map.getDiv().firstChild;
  var fullscreenControl = document.querySelector(".fullscreen-control");
  map.controls[google.maps.ControlPosition.RIGHT_TOP].push(fullscreenControl);

  fullscreenControl.onclick = function () {
    if (isFullscreen(elementToSendFullscreen)) {
      $(".fullscreen-control")
        .find("img")
        .attr("src", "img/np_maximize.png");
      exitFullscreen();
    } else {
      $(".fullscreen-control")
        .find("img")
        .attr("src", "img/np_minimize.png");
      requestFullscreen(elementToSendFullscreen);
    }
  };

  document.onwebkitfullscreenchange = document.onmsfullscreenchange = document.onmozfullscreenchange = document.onfullscreenchange = function () {
    if (isFullscreen(elementToSendFullscreen)) {
      fullscreenControl.classList.add("is-fullscreen");
    } else {
      fullscreenControl.classList.remove("is-fullscreen");
    }
  };
}

function initCurrentLocationControl(map, marker) {
  var elementToSendCurrentLocation = map.getDiv().firstChild;
  var currentlocation = document.querySelector(".currentlocation-control");
  map.controls[google.maps.ControlPosition.RIGHT_TOP].push(currentlocation);

  currentlocation.onclick = function () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
        var latlng = new google.maps.LatLng(
          position.coords.latitude,
          position.coords.longitude
        );
        marker.setPosition(latlng);
        map.setCenter(latlng);
        map.setZoom(25);
      });
    }
  };
}

function isFullscreen(element) {
  return (
    (document.fullscreenElement ||
      document.webkitFullscreenElement ||
      document.mozFullScreenElement ||
      document.msFullscreenElement) == element
  );
}

function requestFullscreen(element) {
  if (element.requestFullscreen) {
    element.requestFullscreen();
  } else if (element.webkitRequestFullScreen) {
    element.webkitRequestFullScreen();
  } else if (element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if (element.msRequestFullScreen) {
    element.msRequestFullScreen();
  }
}

function exitFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  } else if (document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if (document.msCancelFullScreen) {
    document.msCancelFullScreen();
  }
}

function initZoomControl(map) {
  document.querySelector(".zoom-control-in").onclick = function () {
    map.setZoom(map.getZoom() + 1);
  };
  document.querySelector(".zoom-control-out").onclick = function () {
    map.setZoom(map.getZoom() - 1);
  };
  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(
    document.querySelector(".zoom-control")
  );
}

function initDrawControl(map) {
  var mapDrawControlDiv = document.querySelector(".draw-control");
  var drawingManager = new google.maps.drawing.DrawingManager({
    drawingControl: false,
    polygonOptions: {
      fillColor: "#8FC400",
      fillOpacity: 0.5,
      strokeWeight: 2,
      strokeColor: "#FCAE3F",
      clickable: false,
      editable: true,
      zIndex: 1,
      draggable: true
    }
  });
  drawingManager.setMap(map);
  document.querySelector(".draw-control-poligon").onclick = function () {
    $(".draw-control button.draw-control-poligon").css("background", "#8FC400");
    $(".draw-control button.draw-control-poligon").addClass("active");
    $("#draw-control-undo").addClass("active");
    drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
  };

  document.querySelector(".draw-control-null").onclick = function () {
    $(".draw-control button.draw-control-poligon").css("background", "#fff");
    $(".draw-control button.draw-control-poligon").removeClass("active");
    if (overlays.length == 0) {
      $("#draw-control-undo").removeClass("active");
    }
    drawingManager.setDrawingMode(google.maps.drawing.OverlayType.NULL);
  };

  google.maps.event.addListener(drawingManager, "overlaycomplete", function (
    event
  ) {
    // Add an event listener that selects the newly-drawn shape when the user
    // mouses down on it.
    overlays.push(event); // store reference to added overlay
    var newShape = event.overlay;
    newShape.type = event.type;
    selectedShape = newShape;

    // Switch back to non-drawing mode after drawing a shape.
    $(".draw-control button.draw-control-poligon").css("background", "#fff");
    $(".draw-control button.draw-control-poligon").removeClass("active");
    if (overlays.length == 0) {
      $("#draw-control-undo").removeClass("active");
    }
    drawingManager.setDrawingMode(google.maps.drawing.OverlayType.NULL);
  });

  google.maps.event.addListener(drawingManager, "drawingmode_changed", function (
    event
  ) {
    if (selectedShape) {
      if (
        drawingManager.getDrawingMode() ==
        google.maps.drawing.OverlayType.POLYGON
      ) {
        selectedShape.setMap(null);
        infowindow.close();
      }
    }
  });

  google.maps.event.addListener(drawingManager, "polygoncomplete", function (
    polygon
  ) {
    let polygonCoordinateArray = polygon.getPath().getArray().toString();
    // console.log(polygon.getPath().getAt(0).lat());
    $("#currentLocation_lat").val(polygon.getPath().getAt(0).lat());
    $("#currentLocation_lng").val(polygon.getPath().getAt(0).lng());
    // console.log("cur pos lat "+$("#currentLocation_lat").val());
    // console.log("cur pos lng "+$("#currentLocation_lng").val());
    //
    // console.log("poly pos lat "+polygon.getPath().getAt(0).lat());
    // console.log("poly pos lng "+polygon.getPath().getAt(0).lng());

    // $("#currentLocation_lat").val(polygon.getPath().getAt(0).lat());
    // $("#currentLocation_lng").val(polygon.getPath().getAt(0).lat());
    // console.log(polygonCoordinateArray);
    $("#polygon_input").val(polygonCoordinateArray);
    areaWide = google.maps.geometry.spherical.computeArea(polygon.getPath());
    if (areaWide <= 0) {
      alert("Coba gambar ulang");
      for (var i = 0; i < overlays.length; i++) {
        overlays[i].overlay.setMap(null);
      }
      overlays = [];
    } else {
      infowindow.setContent(
        "<span class='wide'>" +
        numberWithCommas(areaWide.toFixed(2).replace(/\./g, ",")) +
        " </span><span class='satuan'>m<sup>2</sup></span><br><span class='txt'>LUAS AREA</span>"
      );

      $("#buildable_area_input").val(
        numberWithCommas(
          areaWide
          .toFixed(2)
          .toString()
          .replace(/\./g, ",")
        )
      );
      $("#buildable_area_input")
        .parent()
        .find(".custome-label")
        .css("opacity", 1)
        .css("visibility", "visible");
      infowindow.setPosition(polygon.getPath().getAt(0));
      infowindow.open(map);
    }
  });

  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(
    mapDrawControlDiv
  );
}

function numberWithCommas(x) {
  return x
    .toString()
    .replace(/\./g, ",")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function removeLineSegment() {
  var lastOverlay = overlays.length > 0 ? overlays[overlays.length - 1] : null;

  if (lastOverlay && lastOverlay.type == "polygon") {
    var path = lastOverlay.overlay.getPath();
    if (path.length - 1 == 0) {
      $("#draw-control-undo").removeClass("active");
      $(".draw-control-null").click();
    }
    path.pop(); // remove last line segment
    // infowindow.close();
    // infowindow.setPosition(polygon.getPath().getAt(0));
    // infowindow.open(map);
  }
}

function initSearchBox(map) {
  // Create the search box and link it to the UI element.
  var input = document.getElementById("pac-input");
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener("bounds_changed", function () {
    searchBox.setBounds(map.getBounds());
  });

  // var markers = [];
  // var gmarkers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener("places_changed", function () {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    // gmarkers.forEach(function (marker) {
    //   marker.setMap(null);
    // });
    // markers = [];
    // gmarkers = [];

    removeMarkers()
    removelocname()

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    var counter = 0;

    places.forEach(function (place) {
      if (counter < 1) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }
        var icon = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25)
        };

        // Create a marker for each place.
        // markers.push(
        //   new google.maps.Marker({
        //     map: map,
        //     //   icon: icon,
        //     draggable: true,
        //     title: place.formatted_address,
        //     position: place.geometry.location,
        //   })
        // );



        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location,
          draggable: true,
          // title: place.formatted_address,
          title: place.formatted_address,
        });
        // markers.push(marker);
        gmarkers.push(marker);

        //   function removeMarkers(){
        //     for(i=0; i<gmarkers.length; i++){
        //         gmarkers[i].setMap(null);
        //     }
        // }
        var initloc = document.getElementById("join-location").value
        // console.log('initloc di hapus ' + initloc)
        locname.push(initloc)
        // console.log('locname baru ' + locname)

        geocoder.geocode({
          'latLng': place.geometry.location
        }, function (results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
              locname.push(results[0].formatted_address)
              console.log('array init locname baru 1' + locname)
              $('#latitude,#longitude').show();
              $('#pac-input').val(results[0].formatted_address);
              $('#address').val(results[0].formatted_address);
              $('#latitude').val(marker.getPosition().lat());
              $('#longitude').val(marker.getPosition().lng());
              $('#join-location').val(locname[locname.length - 1]);
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
            }
          }
        });

        google.maps.event.addListener(marker, 'dragend', function () {
          geocoder.geocode({
            'latLng': marker.getPosition()
          }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
              if (results[0]) {

                locname.push(results[0].formatted_address)
                // console.log('array init locname baru 2' + locname)

                $('#join-location').val(locname[locname.length - 1]);
                $('#pac-input').val(results[0].formatted_address);
                $('#address').val(results[0].formatted_address);
                $('#latitude').val(marker.getPosition().lat());
                $('#longitude').val(marker.getPosition().lng());
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
              }
            }
          });
        });

        // document.getElementById("join-location").innerText =
        //   place.formatted_address;
        // console.log(place.formatted_address)
        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      }
      counter++
    });
    map.fitBounds(bounds);
    google.maps.event.addDomListener(window, 'load', initMap);
  });

  map.controls[google.maps.ControlPosition.TOP_LEFT].push(
    document.querySelector("#calculator-map-search-menu")
  );
  // map.controls[google.maps.ControlPosition.TOP_LEFT].push(
  // 	document.querySelector('#search-btn'));
}

/*function initMapTypeControl(map) {
    document.querySelector(
    ".maptype-control-satellite"
    ).onclick = function() {
    map.setMapTypeId("hybrid");
    $(this).addClass("hide");
    $(".maptype-control-street").removeClass("hide");
    };
    document.querySelector(
    ".maptype-control-street"
    ).onclick = function() {
    map.setMapTypeId("roadmap");
    $(this).addClass("hide");
    $(".maptype-control-satellite").removeClass("hide");
    };
    map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(
    document.querySelector(".maptype-control")
    );
}*/

function initSideNavMapTypeControl(map) {
  document.querySelector(".sidenav-peta-btn").onclick = function () {
    map.setMapTypeId("roadmap");
    $(this).addClass("active");
    $(".sidenav-satellite-btn").removeClass("active");
  };

  document.querySelector(".sidenav-satellite-btn").onclick = function () {
    map.setMapTypeId("hybrid");
    $(this).addClass("active");
    $(".sidenav-peta-btn").removeClass("active");
  };
}