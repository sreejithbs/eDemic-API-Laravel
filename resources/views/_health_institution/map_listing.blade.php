@extends('_health_institution.partials.master')
@section('page_title', 'Map | e-Demic')
@section('page_heading', 'Map')

@section('page_styles')
    <style type="text/css">
        #gmap{
            height: 700px;
        }
        .marker-info{
            text-align: center;
        }
    </style>
@stop

@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="insights px-1">
                                <div style="text-align: center;">
                                    <h5><strong> Location Cluster </strong></h5>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="insights px-1">
                                <div style="text-align: center;">
                                    <h5><strong> Disease Risk Level 1 </strong></h5>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="insights px-1">
                                <div style="text-align: center;">
                                    <h5><strong> Disease Risk Level 2 </strong></h5>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="insights px-1">
                                <div style="text-align: center;">
                                    <h5><strong> Disease Risk Level 3 </strong></h5>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0">
                                    <div class="progress-bar bg-yellow bg-darken-1" role="progressbar" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div id="map-container">
                            <div id="gmap">
                                <!-- Map Appends -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('page_scripts')

    <script src="https://maps.googleapis.com/maps/api/js?v=3&key={!! config('gmaps-oms')['key'] !!}"></script>
    <script type="text/javascript" src="https://googlearchive.github.io/js-marker-clusterer/src/markerclusterer.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script>

    <script type="text/javascript">

        var IMG_BASE_URL = "{!! URL::asset('/') !!}";

        'use strict';
        (function(){

            var gm = google.maps;

            var config = {
                lat: 0,
                lng: 0,
                minZoom: 15,
            };

            var spiderConfig = {
                keepSpiderfied: true,
                // event: 'mouseover',
                markersWontMove: true,
                markersWontHide: true,
                basicFormatEvents: false,
                // nearbyDistance: 0.001 //This will only spiderfy the Markers if they have the exact same position
            };

            // Map data
            var data = {!! $map_data !!};

            function initialize() {

                var map = new gm.Map(document.getElementById('gmap'), {
                    zoom: {!! config('gmaps-oms')['zoom'] !!},
                    center: new gm.LatLng(config.lat, config.lng),
                    streetViewControl: false,
                    mapTypeControl: false,
                    scrollWheelZoom: true,
                    scaleControl: true,
                    mapTypeId: google.maps.MapTypeId.{!! config('gmaps-oms')['type'] !!}
                });

                var markerSpiderfier = new OverlappingMarkerSpiderfier(map, spiderConfig);

                var bounds = new gm.LatLngBounds();
                var markers = [];
                data.forEach(function (x, i) {

                    var loc = new gm.LatLng(x.lat, x.lng);
                    bounds.extend(loc);

                    var marker = new gm.Marker({
                        position: loc,
                        title: x.title,
                        map: map,
                        content: x.content,
                        img: x.color,
                        animation: gm.Animation.{!! config('gmaps-oms')['animation'] !!},
                        // label:'ABC',
                        // icon: {
                        //     url: ""
                        // }
                    });

                    marker.desc = x.title;

                    markers.push(marker); // Saving Markers

                    markerSpiderfier.addMarker(marker);  // Adds the Marker to OverlappingMarkerSpiderfier

                    // gm.event.addListener(marker, 'spider_format', function(status) {
                    //     if(status == OverlappingMarkerSpiderfier.markerStatus.SPIDERFIABLE){
                    //         marker.setIcon({
                    //             url: IMG_BASE_URL + "{!! config('gmaps-oms')['marker_icons']['spiderfy'] !!}",
                    //             // scaledSize: new google.maps.Size(23, 32)  // makes SVG icons work in IE'
                    //         });
                    //     } else if(status == OverlappingMarkerSpiderfier.markerStatus.UNSPIDERFIABLE){
                    //         marker.setIcon({
                    //             url: IMG_BASE_URL + (marker.img),
                    //             // scaledSize: new google.maps.Size(23, 32)  // makes SVG icons work in IE'
                    //         });
                    //     }
                    // });

                });
                map.fitBounds(bounds);

                var iw = new gm.InfoWindow();

                markerSpiderfier.addListener('click', function(marker, e) {
                    iw.setContent('<div class="marker-info"><h4>' +marker.title+ '</h4><hr><p>' +marker.content+ '</p></div>');
                    iw.open(map, marker);
                });

                markerSpiderfier.addListener('spiderfy', function(markers) {
                    for(var i = 0; i < markers.length; i ++) {
                        markers[i].setIcon({
                            url: IMG_BASE_URL + (markers[i].img),
                        });
                        markers[i].setShadow(null);
                    }
                    iw.close();
                });

                markerSpiderfier.addListener('unspiderfy', function(markers) {
                    for(var i = 0; i < markers.length; i ++) {
                        markers[i].setIcon( IMG_BASE_URL + "{!! config('gmaps-oms')['marker_icons']['spiderfy'] !!}" );
                    }
                    iw.close();
                });

                gm.event.addListenerOnce(map, 'idle', function () {
                    var allMarkers = markerSpiderfier.getMarkers();
                    for(var i = 0; i < allMarkers.length; i ++) {
                        allMarkers[i].setIcon({
                            url: IMG_BASE_URL + (allMarkers[i].img),
                        });
                    }

                    var allSpiderfiable = markerSpiderfier.markersNearAnyOtherMarker();
                    for(var j = 0; j < allSpiderfiable.length; j ++) {
                        allSpiderfiable[j].setIcon({
                            url: IMG_BASE_URL + "{!! config('gmaps-oms')['marker_icons']['spiderfy'] !!}",
                        });
                    }
                });

                // var clusterStyles = [{
                //     url: '//ccplugins.co/markerclusterer/images/m1.png',
                //     height: 27,
                //     width: 30,
                //     anchor: [3, 0],
                //     textColor: '#11ffbb',
                //     textSize: 10,
                //     offsetX: 20,
                //     offsetY: 20
                // }, {
                //     url: '//ccplugins.co/markerclusterer/images/m3.png',
                //     height: 36,
                //     width: 40,
                //     anchor: [6, 0],
                //     textColor: '#ff0000',
                //     textSize: 11,
                //     offsetX: 20,
                //     offsetY: 20
                // }, {
                //     url: '//ccplugins.co/markerclusterer/images/m5.png',
                //     width: 50,
                //     height: 45,
                //     anchor: [8, 0],
                //     textSize: 12,
                //     offsetX: 20,
                //     offsetY: 20
                // }];

                // var mcOptions = {
                //     styles: clusterStyles
                // };

                // var markerCluster = new MarkerClusterer(map, markers, mcOptions);
                // markerCluster.setMaxZoom(config.minZoom);
            }

            gm.event.addDomListener(window, 'load', initialize);

        })();
    </script>

@endpush