@extends('layouts.dashboard')

@section('content')
	
	<section class="content">

		<div class="container-fluid">
			 <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Status Customer
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tabel_customers">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Agreement</th>
                                            <th>Saldo</th>
                                            <th>Saldo2</th>
                                            <th>Arho</th>
                                            <th>Kecamatan</th>
                                            <th>Kelurahan</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    
                                   	<tbody>

                                   	
                                      
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
	<script type="text/javascript">
		$(document).ready(function  () {
			// body...
			  $('#tabel_customers').DataTable({
            "processing": true,
            "serverSide": true,
             "order": [],
            "columnDefs": [
			    { "orderable": false, "targets": [0,1,7] }
			  ],
            "ajax":{
                     "url": "{{ route('admin.laporan.status_customer.allCustomers') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "no" },
                { "data": "agreement" },
                { "data": "saldo" },
                { "data": "saldo2" },
                {"data":"arho"},
                { "data": "kecamatan" },
                {"data":"kelurahan"},
                {"data":"actions"}
            ]	 

        });
		});
	</script>
@endpush
@stop