@extends('layouts.dashboard')

@section('content')

<!-- Colorpicker Css -->
    <link href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />
<link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
 <section class="content">
        <div class="container-fluid">
            <!-- Google Maps -->
           

            <!-- visualisasi Arho marker -->

              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Warna Arho
                            </h2>
                            <!-- <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Lihat Tabel</a></li>
                                     
                                    </ul>
                                </li>
                            </ul> -->
                        </div>
                        <div class="body">

                        		<div class="table-responsive">
                        		 <table class="table table-bordered table-striped table-hover" id="tabel_warna_arho">
                        		 	<thead>
                        		 		<th style="text-align:center;">No</th>
                        		 		<th style="text-align:center;">Nama</th>
                        		 		<th style="text-align:center;">Warna</th>
                        		 		<th style="text-align:center;">Actions</th>
                        		 	</thead>

                        		 	<tbody>

                        		 		@php
                        		 			$no = 1;
                        		 		@endphp

                        		 		@foreach($list_arho as $arho)
                        		 			<tr>
                        		 				<td style="text-align:center;">{{$no++}}</td>
                        		 				<td style="text-align:center;">{{$arho->nama_lengkap}}</td>
                        		 				<td style="text-align:center;">{{$arho->warna_arho}}</td>
                        		 				<td style="text-align-center">
                        		 					<button class="btn btn-primary btn-update-warna center-block"
                        		 					data-idarho={{$arho->id_arho}}
                        		 					>Pilih Warna</button>
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

         <!-- Default Size -->
            <div class="modal fade" id="modal-pilih-warna-arho" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Pilih Warna Arho</h4>
                        </div>
                        <div class="modal-body">

                        	<input type="hidden" id="id_arho">

                      <div class="row clearfix">
                                <div class="col-md-12">
                                    <b>Kode Warna</b>
                                    <div class="input-group colorpicker">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="#00AABB" id="warna_arho">
                                        </div>
                                        <span class="input-group-addon">
                                            <i></i>
                                        </span>
                                    </div>
                                </div>
                                
                            </div>

                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" id="btn-simpan-warna-arho">Simpan</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Batal</button>
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
	  <!-- Autosize Plugin Js -->
    <script src="{{asset('plugins/autosize/autosize.js')}}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{asset('plugins/momentjs/moment.js')}}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
      <!-- Bootstrap Colorpicker Js -->
    <script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript">

    var tabel_warna_arho;

    function show_modal_pilih_warna (id_arho) {
    	// body...

    	$('#id_arho').val(id_arho);

    	$('#modal-pilih-warna-arho').modal('show');
    }

    function update_warna_arho () {
    	// body...
    	var id_arho = $('#id_arho').val();

    	var warna_arho = $('#warna_arho').val();

    	//alert(id_arho+" "+warna_arho);

    	  swal({
        title: "Konfirmasi Update Warna Arho",
        text: "Apakah anda ingin mengupdate warna arho?",
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
            url: "{{route('admin.laporan.upload_warna_arho.update_warna_arho')}}",
            type: "POST",
            data: {
             "id_arho":id_arho,
             "warna_arho":warna_arho
            },
            dataType: "json",
            success: function (data) {
             

              if(data==1){
                swal("Done!", "Warna arho berhasil diubah", "success");

                //location.reload();
              }

              else{
                swal("Failed!", "Warna arho gagal diubah", "error");
              }

            location.reload();
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Please try again", "error");
            }
        });
    });
    }

    $(document).ready(function  () {
    	// body...
    	tabel_warna_arho = $('#tabel_warna_arho').DataTable({});

    	$('#tabel_warna_arho tbody').on('click','.btn-update-warna',function  () {
    		// body...
    		var id_arho = $(this).data('idarho');

    		//alert(id_arho);

    		show_modal_pilih_warna(id_arho);

    		 $('.colorpicker').colorpicker();
    	});

    	$('#btn-simpan-warna-arho').click(function  () {
    		// body...
    		update_warna_arho();
    	});

    });

    </script>
    @endpush
@stop