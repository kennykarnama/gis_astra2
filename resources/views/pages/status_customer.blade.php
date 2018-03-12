@extends('layouts.dashboard')

@section('content')

 <!-- Sweetalert Css -->
    <link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
	
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
                                            <th>Status</th>
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
	 <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">

    var tabel_customers;

    function ubah_status_customer (status_customer,no_agreement) {
        // body...

        if(status_customer == 0){
            status_customer = 1;
        }

        else{
            status_customer = 0;
        }

        swal({
        title: "Konfirmasi Update Status Customer",
        text: "Apakah anda ingin mengupdate status customer?",
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
            url: "{{route('admin.laporan.status_customer.ubah_status_customer')}}",
            type: "POST",
            data: {
              "no_agreement":no_agreement,
              'status_customer':status_customer
            },
            dataType: "json",
            success: function (data) {
              console.log(data);

              if(data==1){
                swal("Done!", "Status Customer berhasil diubah", "success");

                
              }

              else{
                swal("Failed!", "Status customer gagal diubah", "error");
              }

             tabel_customers.ajax.reload();
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Please try again", "error");
            }
        });
    });
    }
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
                {"data":"status_customer"},
                {"data":"actions"}
            ]	 

        });

              $('#tabel_customers tbody').on('click','.btn-ubah-status-customer',function  () {
                  // body...
                  var status_customer = $(this).data('statuscustomer');

                  var no_agreement = $(this).data('noagreement');

                  ubah_status_customer(status_customer,no_agreement);
              });
		});
	</script>
@endpush
@stop