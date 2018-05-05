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
                            <th>Target Actual</th>
                          </tr>
                        </thead>

                        <tbody>
                          
                        
                          <tr>
                            @php
                              
                              $has_kelurahan = $laporan_saldo_handling_kecamatan->has_kelurahan;

                             


                            @endphp

                            @for($i=0;$i<count($has_kelurahan);$i++)

                              @php

                              $str_nama_arho = '';

                              $str_nama_kelurahan = '';

                              $total_osa = 0;

                              @endphp

                              @if($has_kelurahan[$i]->id_arho!=-1 && $has_kelurahan[$i]->id_kelurahan!=-1)

                                @php

                                 $nama_arho = $has_kelurahan[$i]->nama_arho;

                                $id_arho = $has_kelurahan[$i]->id_arho;

                                $str_nama_arho.='<p>'.$nama_arho."</p>";

                                @endphp

                                @for($j=$i;$j<count($has_kelurahan);$j++)
                                    @php

                                    if($has_kelurahan[$j]->id_arho == $id_arho){

                                     $nama_kelurahan = $has_kelurahan[$j]->nama_kelurahan;
                                      $str_nama_kelurahan.="<p>".$nama_kelurahan."</p>";

                                      $total_osa = $total_osa + $has_kelurahan[$j]->osa;
                                      $has_kelurahan[$j]->id_arho = -1;
                                       $has_kelurahan[$j]->id_kelurahan = -1;

                                      

                                    }
                                     
                                    @endphp
                                @endfor

                               

                              @endif

                               <td>{!! $str_nama_arho !!}</td>
                                <td>{!! $str_nama_kelurahan !!}</td>


                            @endfor



                            
                            </tr>
                         
                        </tbody>
                      

                      </table>
                           
                           
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

	
	</section>
@stop