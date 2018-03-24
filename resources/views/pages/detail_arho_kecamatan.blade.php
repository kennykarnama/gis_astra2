@extends('layouts.dashboard')

@section('content')
	<section class="content">
		<div class="container-fluid">


              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Detail Laporan
                            </h2>
                           
                        </div>
                        <div class="body">

                        	    <div class="row clearfix">
					              
					                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					                    <div class="info-box">
					                        <div class="icon" style="background-color: {{$arho[0]->warna_arho}};">
					                            <i class="material-icons">face</i>
					                        </div>
					                        <div class="content scrollable">
					                            <div class="text">ARHO</div>
					                            <div class="number">{{$arho[0]->nama_lengkap}}</div>
					                        </div>
					                    </div>
					                </div>

					                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						                    <div class="info-box hover-zoom-effect">
						                        <div class="icon bg-cyan">
						                            <i class="material-icons">gps_fixed</i>
						                        </div>
						                        <div class="content">
						                            <div class="text">KECAMATAN</div>
						                            <div class="number">{{$kecamatan[0]->nama_kecamatan}}</div>
						                        </div>
						                    </div>
                					</div>
					                
          					  </div>

          		<table class="table table-bordered"  id="tabel_laporan_detail">

                        <thead>
                          <tr>
                          <th style="text-align:center; vertical-align:middle;" rowspan="2">{{$kecamatan[0]->nama_kecamatan}}</th>
                          <th style="text-align:center; vertical-align:middle;" rowspan="2">SALDO</th>
                          <th style="text-align:center; vertical-align:middle;" colspan="2" scope="colgroup">Bal 7</th>
                          <th style="text-align:center; vertical-align:middle;" colspan="2" scope="colgroup">Bal 30</th>
                         
                          </tr>

                          <tr>
                            <th scope="col" style="text-align:center; vertical-align:middle;">Rp.</th>
                            <th scope="col" style="text-align:center; vertical-align:middle;">%.</th>
                            <th scope="col" style="text-align:center; vertical-align:middle;">Rp.</th>
                            <th scope="col" style="text-align:center; vertical-align:middle;">%</th>
                            
                          </tr>
                        </thead>
                        
                        <tbody>
                           
                           
                              @for($i=0;$i < count($detail_laporan); $i++)

                                @php
                                  $detail_laporan_i = $detail_laporan[$i];
                                 


                                @endphp
                               <tr>
                                 <td>Kelurahan {{$detail_laporan_i['nama_kelurahan']}}</td>

                                 @php
                                  $target = $detail_laporan_i['target_arho'];
                                  $jumlah_saldo = $detail_laporan_i['jumlah_saldo'];
                                 @endphp

                                 @if($target > $jumlah_saldo)
                                   <td style="color:red;">{{$detail_laporan_i['jumlah_saldo']}}</td>
                                 @endif

                                 @if($target <= $jumlah_saldo)
                                   <td>{{$detail_laporan_i['jumlah_saldo']}}</td>
                                 @endif
                               
                                <td>{{$detail_laporan_i['bal7']}}</td>
                                <td>{{$detail_laporan_i['persen_bal7']}}</td>
                                <td>{{$detail_laporan_i['bal30']}}</td>
                                <td>{{$detail_laporan_i['persen_bal30']}}</td>
                                
                              </tr>

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