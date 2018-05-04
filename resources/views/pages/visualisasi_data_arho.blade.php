@extends('layouts.dashboard')

@section('content')
	

	 <section class="content">
        <div class="container-fluid">
            <!-- Google Maps -->
           

            <!-- visualisasi Arho marker -->

              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Visualisasi ARHO
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Lihat Tabel</a></li>
                                       <!--  <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li> -->
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="visualisasi_arho" class="gmap"></div>
                           
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

          <div class="modal fade" id="modal-detail-arho" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales orci ante, sed ornare eros vestibulum ut. Ut accumsan
                            vitae eros sit amet tristique. Nullam scelerisque nunc enim, non dignissim nibh faucibus ullamcorper.
                            Fusce pulvinar libero vel ligula iaculis ullamcorper. Integer dapibus, mi ac tempor varius, purus
                            nibh mattis erat, vitae porta nunc nisi non tellus. Vivamus mollis ante non massa egestas fringilla.
                            Vestibulum egestas consectetur nunc at ultricies. Morbi quis consectetur nunc.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>

         
    </section>

    @push('scripts')
    	 <!-- Google Maps API Js -->
    <script src="https://maps.google.com/maps/api/js?v=3&key=AIzaSyCyeVc3UAC4QH-BTOMxDmHurREmagwv3DY"></script>

    <!-- GMaps PLugin Js -->
    <!-- <script src="{{asset('plugins/gmaps/gmaps.js')}}"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script>

	 <!-- SweetAlert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

    <script type="text/javascript">

    var visualisasi_arho;

    var isIE = false;

    function hex2rgb(hexStr){
    // note: hexStr should be #rrggbb
    var hex = parseInt(hexStr.substring(1), 16);
    var r = (hex & 0xff0000) >> 16;
    var g = (hex & 0x00ff00) >> 8;
    var b = hex & 0x0000ff;
    return [r, g, b];
}

 var iconWithColours = (function() {
      // generate a data: URI for an SVG marker with specified colors and optional '+' motif
      // I _think_ this will work back to IE9
      function processTemplate(str) {
        var template = str.split('`');
        for (var i = 0, len = template.length; i < len; i += 2) template[i] = encodeURIComponent(template[i]);
        return template;
      }
      function applyTemplate(template, values) {
        var result = template.slice();
        for (var i = 1, len = template.length; i < len; i += 2) result[i] = values[result[i]];
        return result.join('');
      }
      var svgTemplate = processTemplate('<svg viewBox="0 0 23 32" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="M22 11c0 1.42-.226 2.585-.677 3.496l-7.465 15.117c-.218.43-.543.77-.974 1.016-.43.246-.892.37-1.384.37-.492 0-.954-.124-1.384-.37-.43-.248-.75-.587-.954-1.017L1.677 14.496C1.227 13.586 1 12.42 1 11c0-2.76 1.025-5.117 3.076-7.07C6.126 1.977 8.602 1 11.5 1c2.898 0 5.373.977 7.424 2.93C20.974 5.883 22 8.24 22 11z" stroke="`stroke`" stroke-width=".6" fill="`fill`" fill-rule="nonzero"/>`plus`</g></svg>');
      var plusTemplate = processTemplate('<path d="M17 11.012c0-.607-.51-1.117-1.115-1.117h-3.222v-3.23c0-.63-.533-1.165-1.163-1.165s-1.163.534-1.163 1.166v3.23H7.115C6.51 9.895 6 10.405 6 11.01c0 .607.51 1.117 1.115 1.117h3.222v3.204c0 .632.533 1.166 1.163 1.166s1.163-.534 1.163-1.166V12.13h3.222c.606 0 1.115-.51 1.115-1.118z" fill="`fill`"/>');
      var rgbTemplate = processTemplate('rgb(`r`,`g`,`b`)');
      return function(fill, stroke, plus) {
        var svg = applyTemplate(svgTemplate, {
          fill: applyTemplate(rgbTemplate, fill),
          stroke: applyTemplate(rgbTemplate, stroke),
          plus: plus ? applyTemplate(plusTemplate, { fill: applyTemplate(rgbTemplate, plus) }) : ''
        });
        return 'data:image/svg+xml,' + svg;
      }
    })();

    function load_detail_arho () {
      // body...
      $('#modal-detail-arho').modal('show');
    }

    function load_laporan_arho () {
        // body...
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                       type:'POST',
                       url:'{{route("admin.visualisasi.arho.get_laporan_arho")}}',
                       data:{

                      
                       },
                       success:function(data){
                         console.log(data);
                       }
                    });
    };

    function setup_markers (data) {
      // body...

       var oms = new OverlappingMarkerSpiderfier(visualisasi_arho, {
  markersWontMove: true,
  markersWontHide: true,
  basicFormatEvents: true
});



        var iw = new google.maps.InfoWindow();

        function iwClose() { iw.close(); }

         var white = { r: 255, g: 255, b: 255 };

        var obj_peta = [];


      for(var i = 0; i < data.length; i++){
          
          var penugasan = data[i];

          var nama_arho = penugasan.nama_arho;

          var avatar = penugasan.avatar;

          var icon_path = "{{asset('images/mapmarkers')}}"+"/"+avatar;

          



          var pinColor = penugasan.warna_arho;

          warnanya = hex2rgb(pinColor);

          pinColor = pinColor.replace("#","");


          var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
              new google.maps.Size(21, 34),
              new google.maps.Point(0,0),
              new google.maps.Point(10, 34));

          var list_kecamatan = penugasan.kecamatan;

          for(var j=0; j < list_kecamatan.length; j++){
            
            var kecamatan = list_kecamatan[j];

            var latitude = kecamatan.lat;

            var longitude = kecamatan.lng;

            var obj = {
              lng:longitude,
              lat:latitude,
              text:nama_arho +" "+kecamatan.nama_kecamatan+'<p><b>Kecamatan '+kecamatan.nama_kecamatan+"</b></p>"
                                      +"<p style='text-align:center;'> <a target='_blank' href='"+alamat_detail_laporan+"'>Lihat Detail</a>"
                                      +"<p>Jumlah Saldo "+kecamatan.jumlah_saldo+"</p>"
                                      +"<p>Bal 7 "+kecamatan.jumlah_saldo_bal_7+"</p>"
                                      +"<p>% Bal 7 "+kecamatan.persen_bal7+"</p>"
                                      +"<p> Target Arho "+penugasan.target_arho[0].besar_target +"</p>",
             
              rgb:{r:warnanya[0],g:warnanya[1],b:warnanya[2]},
              pin_color:pinColor

            };

            obj_peta.push(obj);

            //console.log(lat+" "+lng);

            //console.log(kecamatan.LAPORAN);
            var mycontent = '<p><b>Kecamatan '+kecamatan.nama_kecamatan+"</b></p>"
                                      +"<p style='text-align:center;'><button class='btn btn-primary btn-detail-arho'"
                                     
                                      +" >Lihat Detail</button>";

            

            var alamat_detail_laporan = "{{route('admin.visualisasi.arho.detail_laporan',[':arho',':kecamatan'])}}";
            alamat_detail_laporan = alamat_detail_laporan.replace(':arho',penugasan.id_arho);
             alamat_detail_laporan = alamat_detail_laporan.replace(':kecamatan',kecamatan.id_kecamatan);



            // visualisasi_arho.addMarker({
            //     lat: latitude,
            //     lng: longitude,
            //     title: nama_arho+" Kecamatan "+kecamatan.nama_kecamatan,
            //     icon : pinImage,
            //     infoWindow: {
            //                   content: '<p><b>Kecamatan '+kecamatan.nama_kecamatan+"</b></p>"
            //                           +"<p style='text-align:center;'> <a target='_blank' href='"+alamat_detail_laporan+"'>Lihat Detail</a>"
            //                           +"<p>Jumlah Saldo "+kecamatan.jumlah_saldo+"</p>"
            //                           +"<p>Bal 7 "+kecamatan.jumlah_saldo_bal7+"</p>"
            //                           +"<p>% Bal 7 "+kecamatan.persen_bal7+"</p>"
            //                           +"<p>Bal 30 "+kecamatan.jumlah_saldo_bal30+"</p>"
            //                           +"<p>% Bal 30"+kecamatan.persen_bal30+"</p>"
            //                           +"<p> Target Arho "+penugasan.target_arho +"</p>"
            //                 },
            // //             mouseover: function(){
            // //     (this.infoWindow).open(this.map, this);
            // // },
            // // mouseout: function(){
            // //     this.infoWindow.close();
            // // },
            // //     click: function(e){
            // //       load_detail_arho();
            // //     }
            //   });


          }

  

      }

       window.mapData = obj_peta;

        for (var i = 0, len = window.mapData.length; i < len; i ++) {
        (function() {  // make a closure over the marker and marker data
          var markerData = window.mapData[i];  // e.g. { lat: 50.123, lng: 0.123, text: 'XYZ' }
          var marker = new google.maps.Marker({ position: markerData,draggable:false,
          optimized: ! isIE   });  // markerData works here as a LatLngLiteral
          //google.maps.event.addListener(marker, 'click', iwClose);
          google.maps.event.addListener(marker, 'spider_format', function(status) {

            //console.log("meeng "+pinColor);

          marker.setIcon({
            url: "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + markerData.pin_color,
            scaledSize: new google.maps.Size(23, 32)  // makes SVG icons work in IE
          });
        });



          google.maps.event.addListener(marker, 'click', function(e) {  // 'spider_click', not plain 'click'
            iw.setContent(markerData.text);
            iw.open(visualisasi_arho, marker);
          })

          ;
          oms.addMarker(marker);  // adds the marker to the spiderfier _and_ the map
        })();
      }
      window.map = visualisasi_arho;  // for debugging/exploratory use in console
      window.oms = oms;  // ditto

      visualisasi_arho.setOptions({draggable:true});
    

    };

    function load_markers () {
        // body...
          $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                       type:'POST',
                       url:'{{route("admin.visualisasi.arho.fetch_markers")}}',
                       data:{

                      
                       },
                       success:function(data){

                        console.log(data);

                        //setup_markers(data);
                         
                       }
                    });
    }

        $(document).ready(function () {
            // body...
         //  visualisasi_arho = new GMaps({
         //    div: '#visualisasi_arho',
         //    lat:  -7.250445,
         //    lng: 112.768845
         // });

         var visualisasi_arho_element = document.getElementById('visualisasi_arho');

         visualisasi_arho = new google.maps.Map(visualisasi_arho_element, { center: { lat:  -7.250445, lng: 112.768845 }, zoom: 7 });

         

            //load_laporan_arho();
            load_markers();

           
        });

    </script>

    @endpush
@stop