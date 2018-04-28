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
                            <div class="text">Jumlah Saldo</div>
                            <div class="number count-to" data-from="0" data-to="{{$jumlah_saldo}}" data-speed="1000" data-fresh-interval="20"></div>
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
                            <div class="number count-to" data-from="0" data-to="{{$jumlah_customer}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_balance</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah Saldo Bal 7</div>
                            <div class="number count-to" data-from="0" data-to="{{$jumlah_bal7}}" data-speed="1000" data-fresh-interval="20"></div>
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
                                            <th>Jumlah Account</th>
                                            <th>Wilayah</th>
                                            <th>Luas Wilayah (km2)</th>
                                            
                                        </tr>
                                    </thead>

                                    @php
                                        $puter = 1;
                                    @endphp
                                    
                                    <tbody>

                                        @for($i=0; $i < count($summary_arho); $i++)

                                            @php
                                                 $informasi_i = $summary_arho[$i];

                                                 $list_informasi = $informasi_i->informasi;
                                            @endphp

                                            <tr>

                                                <td>{{$puter++}}</td>
                                                <td>{{$informasi_i->arho}}</td>

                                                @php

                                                    $jumlah_account_str = "";
                                                    $wilayah_str = "";
                                                    $luas_wilayah_str = "";

                                                @endphp

                                              @for($j=0; $j < count($list_informasi); $j++)

                                                @php
                                                $item = $list_informasi[$j];
                                                $jumlah_account_str.="<p>".$item['jumlah_account']."</p>";
                                                $wilayah_str.="<p>".$item['wilayah']."</p>";
                                                $luas_wilayah_str.="<p>".$item['luas_wilayah']."</p>";
                                                @endphp

                                                
                                              @endfor  

                                             

                                                <td>{!! $jumlah_account_str !!}</td>
                                                <td>{!! $wilayah_str !!}</td>
                                                <td>{!! $luas_wilayah_str !!}</td>
                                           

                                        
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
    @endpush
    @stop