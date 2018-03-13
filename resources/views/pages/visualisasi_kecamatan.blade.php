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
                                Visualisasi Kecamatan
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
                            <div id="visualisasi_kecamatan" class="gmap"></div>
                           
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        

         
    </section>

    @push('scripts')

    <!-- Google Maps API Js -->
    <script src="https://maps.google.com/maps/api/js?v=3&key=AIzaSyCyeVc3UAC4QH-BTOMxDmHurREmagwv3DY"></script>

    <!-- GMaps PLugin Js -->
    <script src="{{asset('plugins/gmaps/gmaps.js')}}"></script>

    <script type="text/javascript">
    	var visualisasi_kecamatan;

    	function setup_markers (data) {
    		// body...
    		for(var i=0; i < data.length; i++){
    			var kecamatan = data[i];

    			var nama_kecamatan = kecamatan.nama_kecamatan;

    			var latitude = kecamatan.lat;

    			var longitude = kecamatan.lng;

    			var luas_wilayah = kecamatan.luas_wilayah_km2;

    			var pinColor = "FE7569";
			   
			    var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
			        new google.maps.Size(21, 34),
			        new google.maps.Point(0,0),
			        new google.maps.Point(10, 34));


			    var alamat_detail_kecamatan = "{{route('admin.visualisasi.kecamatan.detail_kecamatan',':kecamatan')}}";

			    alamat_detail_kecamatan = alamat_detail_kecamatan.replace(":kecamatan",kecamatan.id_kecamatan);

			    visualisasi_kecamatan.addMarker({
			    	lat: latitude,
	                lng: longitude,
	                title: nama_kecamatan,
	                icon : pinImage,
	                infoWindow: {
	                	content:"<p style='text-align:center;'>Kecamatan "+nama_kecamatan+"</p>"
	                			+"<p style='text-align:center;'> <a target='_blank' href='"+alamat_detail_kecamatan+"'>Lihat Detail</a>"
	                			+"<p style='text-align:center;'>Luas Wilayah "+luas_wilayah+" km2 </p>"
	                			
	                }
			    });


    		}
    	}

    	function load_marker_kecamatan () {
    		// body...
    		$.ajaxSetup({
    		          headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                       type:'POST',
                       url:'{{route("admin.visualisasi.kecamatan.get_list_kecamatan")}}',
                       data:{

                      
                       },
                       success:function(data){

                        console.log(data);

                        setup_markers(data);
                         
                       }
                    });
    	};

    	$(document).ready(function  () {
    		// body...
    		visualisasi_kecamatan =  new GMaps({
		            div: '#visualisasi_kecamatan',
		            lat:  -7.250445,
		            lng: 112.768845
		         
		         });

    		load_marker_kecamatan();
    	});
    </script>
    @endpush

@stop