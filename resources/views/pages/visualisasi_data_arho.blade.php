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
    <script src="{{asset('plugins/gmaps/gmaps.js')}}"></script>

	 <!-- SweetAlert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

    <script type="text/javascript">

    var visualisasi_arho;

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
      for(var i = 0; i < data.length; i++){
          
          var penugasan = data[i];

          var nama_arho = penugasan.arho.nama_lengkap;

          var avatar = penugasan.arho.avatar;

          var icon_path = "{{asset('images/mapmarkers')}}"+"/"+avatar;

          var list_kecamatan = penugasan.kecamatan;

          for(var j=0; j < list_kecamatan.length; j++){
            
            var kecamatan = list_kecamatan[j];

            var latitude = kecamatan.lat;

            var longitude = kecamatan.lng;

            //console.log(lat+" "+lng);

            //console.log(kecamatan.LAPORAN);
            var mycontent = '<p><b>Kecamatan '+kecamatan.nama_kecamatan+"</b></p>"
                                      +"<p style='text-align:center;'><button class='btn btn-primary btn-detail-arho'"
                                     
                                      +" >Lihat Detail</button>";

            

            var alamat_detail_laporan = "{{route('admin.visualisasi.arho.detail_laporan',[':arho',':kecamatan'])}}";
            alamat_detail_laporan = alamat_detail_laporan.replace(':arho',penugasan.arho.id_arho);
             alamat_detail_laporan = alamat_detail_laporan.replace(':kecamatan',kecamatan.id_kecamatan);

           

            visualisasi_arho.addMarker({
                lat: latitude,
                lng: longitude,
                title: nama_arho+" Kecamatan "+kecamatan.nama_kecamatan,
                icon : icon_path,
                infoWindow: {
                              content: '<p><b>Kecamatan '+kecamatan.nama_kecamatan+"</b></p>"
                                      +"<p style='text-align:center;'> <a target='_blank' href='"+alamat_detail_laporan+"'>Lihat Detail</a>"
                                      +"<p>Jumlah Saldo "+kecamatan.LAPORAN.jumlah_saldo+"</p>"
                                      +"<p>Bal 7 "+kecamatan.LAPORAN.bal7+"</p>"
                                      +"<p>% Bal 7 "+kecamatan.LAPORAN.persen_bal7+"</p>"
                                      +"<p>Bal 30 "+kecamatan.LAPORAN.bal30+"</p>"
                                      +"<p>% Bal 30"+kecamatan.LAPORAN.persen_bal30+"</p>"
                                      +"<p> Target Arho "+kecamatan.TARGET +"</p>"
                            },
                        mouseover: function(){
                (this.infoWindow).open(this.map, this);
            },
            // mouseout: function(){
            //     this.infoWindow.close();
            // },
            //     click: function(e){
            //       load_detail_arho();
            //     }
              });


          }

  

      }
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

                        setup_markers(data);
                         
                       }
                    });
    }

        $(document).ready(function () {
            // body...
          visualisasi_arho = new GMaps({
            div: '#visualisasi_arho',
            lat:  -7.250445,
            lng: 112.768845
         });
            //load_laporan_arho();
            load_markers();

           
        });

    </script>

    @endpush
@stop