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
					                        <div class="icon" style="background-color: {{$arho->warna_arho}};">
					                            <i class="material-icons">face</i>
					                        </div>
					                        <div class="content scrollable">
					                            <div class="text">ARHO</div>
					                            <div class="number">{{$arho->nama_lengkap}}</div>
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
						                            <div class="number">{{$kecamatan->nama_kecamatan}}</div>
						                        </div>
						                    </div>
                					</div>
					                
          					  </div>

                      <table class="table table-bordered" id="tabel_laporan_detail">

                        <thead>
                          <tr>
                            <th>Saldo Handling</th>
                            <th>OSA</th>
                            <th>Target Perusahaan</th>
                            <th>Actual</th>
                          </tr>
                        </thead>

                        <tbody>

                        <tr>
                          
                          <td>Rp. {{number_format($total_saldo_handling)}}</td>
                          <td>Rp. {{number_format($laporan_osa_arho_kecamatan->total_osa)}}</td>
                          <td><p style="color: {{$status_target}}">{{$target_perusahaan}}</p></td>
                          <td><p style="color: {{$status_target}}">{{$actual}} %</p></td>

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