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
                          <th style="text-align:center; vertical-align:middle;" rowspan="2">Nama Arho</th>
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
                           
                          @for($i=0; $i < count($list_laporan); $i++)

                            @php
                              $laporan = $list_laporan[$i];

                              $arho = $laporan['arho'];

                              $kecamatan = $laporan['kecamatan'];

                              $laporan_kecamatan = $kecamatan[0]->LAPORAN;

                              $jumlah_saldo = $laporan_kecamatan['jumlah_saldo'];

                              $target_arho = $laporan_kecamatan['target_arho'];


                            @endphp

                            <tr>
                              <td>{{$arho->nama_lengkap}}</td>

                              @if($target_arho > $jumlah_saldo)
                                <td style="color:red;">{{$jumlah_saldo}}</td>
                              @endif

                              @if($jumlah_saldo >= $target_arho)
                                <td>{{$laporan_kecamatan['jumlah_saldo']}}</td>
                              @endif
                              
                              <td>{{$laporan_kecamatan['bal7']}}</td>
                              <td>{{$laporan_kecamatan['persen_bal7']}}</td>
                              <td>{{$laporan_kecamatan['bal30']}}</td>
                              <td>{{$laporan_kecamatan['persen_bal30']}}</td>
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