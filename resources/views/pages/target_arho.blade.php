@extends('layouts.dashboard')

@section('content')

 <link href="{{asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />
  <link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

	<section class="content">
		<div class="container-fluid">
			<div class="row clearfix">
				 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				 	<div class="card">
				 		<div class="header">
                            <h2>
                                Target Perusahaan
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
                        		 					<button class="btn btn-primary btn-edit-target"
                        		 					data-idtargetarho={{$target_arho->id_target_arho}}
                        		 					data-idarho={{$target_arho->id_arho}}
                        		 					>Edit</button>
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

	 <div class="modal fade" id="modal-target-arho" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Target Arho</h4>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id_arho" id="id_arho"/>

                          <input type="hidden" name="id_target_arho" id="id_target_arho"/>

                          <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="nilai_target">
                                            <label class="form-label">Nilai Target</label>
                                        </div>
                                    </div>
                            </div>

                              <div class="col-sm-12">
                                    <div class="form-group">

                                    
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="tgl_target" placeholder="tanggal">
                                           
                                        </div>
                                    </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btn-simpan-target" class="btn btn-link waves-effect">Simpan</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            </div>


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
	  <!-- Autosize Plugin Js -->
    <script src="{{asset('plugins/autosize/autosize.js')}}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{asset('plugins/momentjs/moment.js')}}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
	 
	 <script type="text/javascript">
	 	
	 	var tabel_target_arho;

	 	function update_target_arho () {
	 		// body...

	 		var id_target_arho = $('#id_target_arho').val();

	 		var id_arho = $('#id_arho').val();

	 		var besar_target = $('#nilai_target').val();

	 		var tgl_target = $("#tgl_target").val();

	 		

	 		    swal({
        title: "Konfirmasi Update Target Arho",
        text: "Apakah anda ingin mengupdate target arho?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Proceed!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;

        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

        $.ajax({
            url: "{{route('admin.laporan.target_arho.update_target')}}",
            type: "POST",
            data: {
             "id_target_arho":id_target_arho,
             'id_arho':id_arho,
             'besar_target':besar_target,
             'tgl_target':tgl_target
            },
            dataType: "json",
            success: function (data) {
             

              if(data==1){
                swal("Done!", "Target Customer berhasil diubah", "success");

                location.reload();
              }

              else{
                swal("Failed!", "Target customer gagal diubah", "error");
              }

            
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Please try again", "error");
            }
        });
    });
	 	}

	 	$(document).ready(function  () {
	 		// body...
	 		tabel_target_arho = $('#tabel_target_arho').DataTable({});

	 		$('#tabel_target_arho tbody').on('click','.btn-edit-target',function  () {
	 			// body...

	 			var id_target_arho = $(this).data('idtargetarho');

	 			var id_arho = $(this).data('idarho');

	 			

	 			$('#id_target_arho').val(id_target_arho);

	 			$('#id_arho').val(id_arho);

	 			$('#modal-target-arho').modal('show');
	 		});

	 		$('#btn-simpan-target').click(function  () {
	 			// body...
	 			update_target_arho();
	 		});

	 		$('#tgl_target').bootstrapMaterialDatePicker({
		        format: 'YYYY-MM-DD',
		        clearButton: true,
		        weekStart: 1,
		        time: false
		    });
	 	});
	 </script>
	@endpush
@stop