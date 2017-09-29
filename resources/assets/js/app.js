require('./bootstrap');

window.GoogleMapsLoader = require('google-maps');

GoogleMapsLoader.KEY = 'AIzaSyC9VORjwOD028_nHPuegZgJ_GNYbDZfn6M';

if(document.querySelector('#map')) {
    GoogleMapsLoader.load(function(google) {




        let RouteBoxer = require('./RouteBoxer');

        let directionsService = new google.maps.DirectionsService();
        let directionsDisplay = new google.maps.DirectionsRenderer();
        let boxpolys = null;

        let elem = document.querySelector('#map');
        let latitude = elem.getAttribute('latitude') ? elem.getAttribute('latitude') : 55.7;
        let longitude = elem.getAttribute('longitude') ? elem.getAttribute('longitude') : 37.5;

        let mapOptions = {
            center: {lat: parseFloat(latitude), lng: parseFloat(longitude)},
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 13
        };

        let map = new google.maps.Map(document.getElementById("map"), mapOptions);

        directionsDisplay.setMap(map);

        let marker = new google.maps.Marker({
            position: {lat: parseFloat(latitude), lng: parseFloat(longitude)},
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
        });

        marker.addListener('dragend', function() {
            document.querySelector('[name=latitude]').setAttribute('value', Number(marker.getPosition().lat().toFixed(6)));
            document.querySelector('[name=longitude]').setAttribute('value', Number(marker.getPosition().lng().toFixed(6)));
        });

        document.getElementById('search').addEventListener("click", calcRoute);

        function calcRoute() {

            clearBoxes();

            let start = document.getElementById('origin').value;
            let end = document.getElementById('destination').value;
            let distance = parseFloat(document.getElementById("distance").value);
            let request = {
                origin: start,
                destination: end,
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };

            directionsService.route(request, function (response, status) {

                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);

                    let routeBoxer = new RouteBoxer();

                    // Box around the overview path of the first route
                    let path = response.routes[0].overview_path;
                    let boxes = routeBoxer.box(path,  distance); // Precision in KM

                    drawBoxes(boxes);
                } else {
                    alert("Directions query failed: " + status);
                }
            });
        }

        // Draw the array of boxes as polylines on the map
        function drawBoxes(boxes) {
            boxpolys = new Array(boxes.length);
            for (let i = 0; i < boxes.length; i++) {

                boxpolys[i] = new google.maps.Rectangle({
                    bounds: boxes[i],
                    fillOpacity: 0,
                    strokeOpacity: 1.0,
                    strokeColor: '#000000', //change color here
                    strokeWeight: 1, //change width of line from 1 to 0
                    map: map
                });

                jQuery.ajax({
                    type: 'GET',
                    url: '/affiliates/contains',
                    data: {
                        southWestLng: boxes[i].getSouthWest().lng(),
                        southWestLat: boxes[i].getSouthWest().lat(),
                        southNorthLng: boxes[i].getNorthEast().lat(),
                        southNorthLat: boxes[i].getNorthEast().lat(),
                    },
                    success: function(response) {
                        console.log('success');
                    }
                });
            }
        }

        // Clear boxes currently on the map
        function clearBoxes() {
            if (boxpolys != null) {
                for (let i = 0; i < boxpolys.length; i++) {
                    boxpolys[i].setMap(null);
                }
            }
            boxpolys = null;
        }
    });
}
