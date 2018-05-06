@extends('layouts.dashboard')

@section('content')
	<section class="content">
		<div class="container-fluid">


              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Detail Kecamatan
                            </h2>
                           
                        </div>
                        <div class="body">

                        	    <div class="row clearfix">
					              
					              

					                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						                    <div class="info-box hover-zoom-effect">
						                        <div class="icon bg-cyan">
						                        </div>
						                        <div class="content">
						                            <div class="text">KECAMATAN</div>
						                            <div class="number">{{$kecamatan->nama_kecamatan}}</div>
						                        </div>
						                    </div>
                					</div>
					                
          					  </div>

          		        <table class="table table-bordered">

                        <thead>
                          <tr>
                            <th>Arho</th>
                            <th>Kelurahan</th>
                            <th>OSA</th>
                            <th>Saldo Handling</th>
                            <th>Target Actual</th>
                          </tr>
                        </thead>

                       <tfoot>
                         <tr>
                           <td><b>Total</b></td>
                           <td></td>
                           <td>Rp.{{number_format($total_osa_kecamatan)}}</td>
                           <td>Rp.{{number_format($total_saldo_handling_kecamatan)}}</td> 
                           <td>{{$total_target_actual_kecamatan}} %</td>
                         </tr>
                       </tfoot>

                        <tbody>
                        
                        @for($i=0;$i<count($laporan_saldo_handling_osa);$i++)

                        
                          @php
                           
                           $info = $laporan_saldo_handling_osa[$i];

                          

                           @endphp

                           @foreach($info as $key=>$value)

                           @php
                            $data_laporan = $value;

                              $str_kelurahan = "";

                              $str_osa = "";

                              $str_saldo_handling = "";

                              $str_target_actual = "";

                           @endphp

                           <tr>
                             <td>{{$key}}</td>

                             @php

                             
                             @endphp

                             @for($j=0;$j<count($data_laporan);$j++)


                                  
                                  @foreach($data_laporan[$j] as $key=>$value)
                                   
                                   @php
                                    $str_kelurahan .= "<p>".$key."</p>";

                                    $data_osa_handling = $value;

                                    $str_osa.="<p>Rp.".number_format($data_osa_handling['total_osa'])."</p>";

                                    $str_saldo_handling.="<p>Rp.".number_format($data_osa_handling['total_saldo_handling'])."</p>";

                                    $str_target_actual.="<p>".$data_osa_handling['target_actual']." %</p>";

                                    @endphp
                                  @endforeach

                             @endfor

                             <td>{!!$str_kelurahan!!}</td>
                             <td>{!!$str_osa!!}</td>
                             <td>{!! $str_saldo_handling !!}</td>
                             <td>{!!$str_target_actual!!}</td>
                             
                           </tr>
                              
                           @endforeach
                        

                        @endfor
                         
                        </tbody>
                      

                      </table>
                           
                           
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

	
	</section>
@stop