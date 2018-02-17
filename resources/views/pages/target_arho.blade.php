@extends('layouts.dashboard')

@section('content')


	<section class="content">
		<div class="container-fluid">
			<div class="row clearfix">
				 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				 	<div class="card">
				 		<div class="header">
                            <h2>
                                Target Arho
                            </h2>
                          
                        </div>

                        <div class="body">

                        	<div class="table-responsive">
                        		 <table class="table table-bordered table-striped table-hover" id="tabel_target_arho">
                        		 	<thead>
                        		 		<th style="text-align:center;">No</th>
                        		 		<th style="text-align:center;">Nama</th>
                        		 		<th style="text-align:center;">Target</th>
                        		 		<th style="text-align:center;">Tanggal</th>
                        		 		<th style="text-align:center;">Status Target</th>
                        		 		<th style="text-align:center;">Actions</th>
                        		 	</thead>

                        		 	<tbody>

                        		 		@php
                        		 			$no = 1;
                        		 		@endphp

                        		 		@foreach($list_target_arho as $target_arho)
                        		 			<tr>
                        		 				<td style="text-align:center;">{{$no++}}</td>
                        		 				<td style="text-align:center;">{{$target_arho->nama_lengkap}}</td>
                        		 				<td style="text-align:center;">{{$target_arho->besar_target}}</td>
                        		 				<td style="text-align:center;">{{$target_arho->tgl_target}}</td>

                        		 				@if($target_arho->is_deleted == 1)
                        		 					<td style="text-align:center;">
                        		 						 <div class="demo-google-material-icon"> 
                        		 						 	<i class="material-icons">check_circle</i> 
                        		 						 	
                        		 						 </div>
                        		 					</td>

                        		 					@else

                        		 					<td style="text-align:center;">
                        		 						 <div class="demo-google-material-icon"> 
                        		 						 	<i class="material-icons">cancel</i> 
                        		 						 	
                        		 						 </div>

                        		 					</td>
                        		 				@endif

                        		 				<td style="text-align:center;">
                        		 					<button class="btn btn-primary">Edit</button>
                        		 				</td>
                        		 				
                        		 			</tr>
                        		 		@endforeach

                        		 	</tbody>
                        		 </table>
                        	</div>
                        	
                        </div>
				 	</div>
				 </div>
			</div>
		</div>
	</section>

	@push('scripts')
	<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
     <script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
	 <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>

	 <script type="text/javascript">
	 	
	 	var tabel_target_arho;

	 	$(document).ready(function  () {
	 		// body...
	 		tabel_target_arho = $('#tabel_target_arho').DataTable({});
	 	});
	 </script>
	@endpush
@stop