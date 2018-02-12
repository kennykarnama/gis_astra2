@extends('layouts.dashboard')

@section('content')

<!-- Sweetalert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

	
	 <section class="content">
        <div class="container-fluid">
            <!-- Google Maps -->
           

            <!-- visualisasi umum marker -->

              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Visualisasi Umum
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="visualisasi_umum" class="gmap"></div>
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

	 <!-- SweetAlert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

     <script type="text/javascript">

      var markers;

     function load_markers () {
         // body...
        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                $.ajax({
                       type:'POST',
                       url:'{{route("admin.visualisasi.umum.fetch_customer_markers")}}',
                       data:{

                  

                       },
                       success:function(data){
                            
                            for(var i=0;i<data.length;i++){
                                
                                var customer = data[i];

                                var icon_customer = "{{asset('images/mapmarkers')}}"+"/"+customer.icon;

                                console.log(icon_customer);

                                        markers.addMarker({
                                    lat: customer.latitude,
                                    lng: customer.longitude,
                                    title: 'Customer '+(i+1),
                                    icon : icon_customer,

                                    click: function (e) {
                                        if (console.log)
                                            console.log(e);
                                        swal("Arho", customer.arho, "success");
                                    }
                                });

                            }
                       }
                    });
     }

        $(document).ready(function  () {
            // body...

    markers = new GMaps({
        div: '#visualisasi_umum',
        lat: 0.412490,
        lng: 0.899876
    });

            load_markers();

        });
     </script>  
    @endpush
@stop