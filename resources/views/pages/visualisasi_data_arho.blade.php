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
                                Visualisasi Arho
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
                       }
                    });
    }

        $(document).ready(function () {
            // body...

            //load_laporan_arho();
            load_markers();
        });

    </script>

    @endpush
@stop