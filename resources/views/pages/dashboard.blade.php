 @extends('layouts.dashboard')

@section('content')
 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance_wallet</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah Saldo OSA</div>
                            <div class="number"  id="jumlah_osa">
                                {{number_format($jumlah_osa)}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah Customer</div>
                            <div class="number" >
                                {{number_format($jumlah_customer)}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah Saldo Handling</div>
                            <div class="number" >
                                {{number_format($jumlah_saldo_handling)}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                 <div class="card">
                        <div class="header">

                            <h2>Summary</h2>
                           
                        </div>
                        <div class="body">

                       

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tabel_informasi_arho">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Arho</th>
                                            <th>Wilayah</th>
                                            <th>Jumlah Account</th>
                                            
                                            <th>Luas Wilayah (km2)</th>
                                            
                                        </tr>
                                    </thead>

                                    @php
                                        $puter = 1;
                                    @endphp
                                    
                                    <tbody>

                                      @for($i=0; $i<count($summary_arho_dashboard);$i++)
                                        
                                        @php
                                            $arho_dashboard = $summary_arho_dashboard[$i];
                                        @endphp
                                        
                                        <tr>

                                            <td>{{$puter++}}</td>
                                            <td>{{$arho_dashboard->nama_arho}}</td>

                                            

                                                @php
                                                    $has_kelurahan = $arho_dashboard->has_kelurahan;
                                                     $str_nama_kecamatan = "";
                                                     $str_total_acc = '';
                                                     $str_total_osa = '';
                                                     $str_luas_wilayah = '';
                                                @endphp



                                                @for($j=0; $j < count($has_kelurahan); $j++)



                                                  @php
                                                    $nama_kecamatan = $has_kelurahan[$j]->nama_kecamatan;

                                                    $id_kecamatan = $has_kelurahan[$j]->id_kecamatan;

                                                    $total_acc = $has_kelurahan[$j]->acc;

                                                    $total_osa = $has_kelurahan[$j]->osa;

                                                    if($id_kecamatan!=-1){

                                                     $str_nama_kecamatan.="<p>".$nama_kecamatan."</p>";

                                                     $str_luas_wilayah.="<p>".$has_kelurahan[$j]->luas_wilayah."</p>";
                                                    }


                                                  @endphp



                                                @if($id_kecamatan!=-1)



                                                  @for($k=$j+1;$k<count($has_kelurahan);$k++)

                                                    @php



                                                        if($has_kelurahan[$k]->id_kecamatan == $id_kecamatan
                                                            &&$has_kelurahan[$k]->id_kecamatan!=-1){
                                                            $total_acc = $total_acc + $has_kelurahan[$k]->acc;
                                                            $total_osa = $total_osa + $has_kelurahan[$k]->osa;

                                                            $has_kelurahan[$k]->id_kecamatan = -1;
                                                        }


                                                         

                                                    @endphp

                                                  @endfor

                                                   @php
                                                    $str_total_acc.="<p>".$total_acc."</p>";
                                                    $str_total_osa.="<p>".$total_osa."</p>";
                                                @endphp


                                                @endif

                                                

                                               
                                                  
                                                @endfor

                                               
                                                 <td><p>{!! $str_nama_kecamatan !!}</p></td>
                                                 <td>{!! $str_total_acc !!}</td>
                                                 <td>{!! $str_luas_wilayah !!}</td>


                                           
                                            

                                        </tr>
                                      @endfor



                                    
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

               
              
            </div>
            <!-- #END# Widgets -->
         
          
        </div>
    </section>

    @push('scripts')
         <!-- Flot Charts Plugin Js -->
    <script src="{{asset('plugins/flot-charts/jquery.flot.js')}}"></script>
    <script src="{{asset('plugins/flot-charts/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('plugins/flot-charts/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('plugins/flot-charts/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('plugins/flot-charts/jquery.flot.time.js')}}"></script>
    <script src="{{asset('js/pages/index.js')}}"></script>

    <script type="text/javascript">
        
        $(document).ready(function () {
            // body...
            $('#jumlah_osa').countTo({
              from: 0,
              to: "{{$jumlah_osa}}",
              speed: 1500,
              formatter: function (value, options) {
                value = value.toFixed(options.decimals);
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                return value;
              }
            });
        });

    </script>
    @endpush
    @stop