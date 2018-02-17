@extends('layouts.dashboard')

@section('content')

<!-- Sweetalert Css -->
    <link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

<style type="text/css">
#legend {
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 10px;
        border: 3px solid #000;
      }
      #legend h3 {
        margin-top: 0;
      }
      #legend img {
        vertical-align: middle;
      }
</style>
	
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

         <div class="modal fade" id="modal-info-customer" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Detail Customer</h4>
                        </div>
                        <div class="modal-body">

                           <div class="col-sm-12">
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="no_agreement">
                                            <label class="form-label">No Agreement</label>
                                        </div>
                                    </div>
                                   
                              </div>


                           
                            <div class="col-sm-12">

                              <div class="form-group form-float">
                                   <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Alamat" id="alamat_customer"></textarea>
                                      </div>
                              </div>
                                   
                            </div>

                            <div class="col-sm-12">
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="kode_pos">
                                            <label class="form-label">Kode Pos</label>
                                        </div>
                                    </div>
                                   
                              </div>


                                <div class="col-sm-12">
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="kelurahan">
                                            <label class="form-label">Kelurahan</label>
                                        </div>
                                    </div>
                                   
                              </div>

                                <div class="col-sm-12">
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="kecamatan">
                                            <label class="form-label">Kecamatan</label>
                                        </div>
                                    </div>
                                   
                              </div>

                                 <div class="col-sm-12">
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="tgl_due" val="">
                                            <label class="form-label">Tanggal Due</label>
                                        </div>
                                    </div>
                                   
                              </div>

                                 <div class="col-sm-12">
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="saldo">
                                            <label class="form-label">Saldo</label>
                                        </div>
                                    </div>
                                   
                              </div>



                           
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

      var markers;

      function load_detail_customer (customer) {
        // body...
        $('#no_agreement').val(customer.no_agreement);

        $('#alamat_customer').val(customer.alamat);

        $('#kecamatan').val(customer.kecamatan);

        $('#kelurahan').val(customer.kelurahan);

        $('#tgl_due').val(customer.tgl_due);

        $('#kode_pos').val(customer.kode_pos);

        $('#saldo').val(customer.saldo);

        $('.form-line').addClass('focused');

        $('#modal-info-customer').modal('show');
      }

      function load_arho_markers () {
        // body...
          $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

        $.ajax({
                   type:'POST',
                   url:'{{route("admin.visualisasi.umum.fetch_arho_markers")}}',
                   data:{

                    

                   },
                   success:function(data){
                        
                        console.log(data);               

                   }
                });
      }

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

                                // console.log(icon_customer);

                                        markers.addMarker({
                                    lat: customer.latitude,
                                    lng: customer.longitude,
                                    title: 'Customer '+(i+1),
                                    icon : icon_customer,
                                    data_customer:customer,

                                    click: function (e) {
                                        if (console.log)
                                            console.log(e);


                                       load_detail_customer(this.data_customer);
                                    }
                                });

                            }

                                    var icons = {
                              parking: {
                                name: 'Customer < Target',
                                icon: "{{asset('images/mapmarkers')}}" + '/pirates.png'
                              },
                              library: {
                                name: 'Customer >= Target',
                                icon: "{{asset('images/mapmarkers')}}" + '/flag-export.png'
                              },
                              
                            };

                            var legend = "<div id='legend'><h3>Legend</h3>";
                            legend+="<div>"+"<img src='"+"{{asset('images/mapmarkers')}}"+'/red_dot.png'+"'>Customer < Target</div>";
                            legend+="<div>"+"<img src='"+"{{asset('images/mapmarkers')}}"+'/green_dot.png'+"'>Customer >= Target</div></div>";
                             markers.addControl({
                              position: 'right_bottom',
                              content: legend,
                              events: {
                                click: function(){
                                  console.log(this);
                                }
                              }
                            });
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

            load_arho_markers();

        });
     </script>  
    @endpush
@stop