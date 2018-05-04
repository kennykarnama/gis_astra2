@extends('layouts.dashboard')

@section('content')

  
    <!-- Dropzone Css -->
    <link href="{{asset('plugins/dropzone/dropzone.css')}}" rel="stylesheet">
     <!-- Bootstrap Select Css -->
    <link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

      <link href="{{asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet" />

    <style type="text/css">
        
        .btn-group button {
    background-color: #4CAF50; /* Green background */
    border: 1px solid green; /* Green border */
    color: white; /* White text */
    padding: 10px 24px; /* Some padding */
    cursor: pointer; /* Pointer/hand icon */
    float: left; /* Float the buttons side by side */
}

.btn-group button:not(:last-child) {
    border-right: none; /* Prevent double borders */
}

/* Clear floats (clearfix hack) */
.btn-group:after {
    content: "";
    clear: both;
    display: table;
}

/* Add a background color on hover */
.btn-group button:hover {
    background-color: #3e8e41;
}
.foo {
  display: inline-block;
  width: 20px;
  height: 20px;
  margin: 5px;
  border: 1px solid rgba(0, 0, 0, .2);
}

.blue {
  background: #13b4ff;
}

.purple {
  background: #ab3fdd;
}

.wine {
  background: #ae163e;
}

 </style>

  <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Daftar Arho
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a id="btn-tambah-arho" href="#" data-toggle="modal" data-target="#modal-tambah-arho">Tambah Arho</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">

                       

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tabel_arho">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Arho</th>
                                            <th>Warna Arho</th>
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
            <!-- #END# Basic Examples -->
            <!-- Exportable Table -->
           
            <!-- #END# Exportable Table -->
        </div>

        <!-- Modal -->
        <div id="modal-tambah-arho" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah arho</h4>
              </div>
              <div class="modal-body">

                <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="nama_arho" type="text" class="form-control" placeholder="Nama arho" />
                                        </div>
                                    </div>
                                 
                                </div>

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
               <button type="button" class="btn btn-success" id="btn-simpan-arho" >Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              </div>
            </div>

          </div>
        </div>

         <!-- Modal -->
        <div id="modal-edit-arho" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit arho</h4>
              </div>
              <div class="modal-body">

                <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">

                                    <input type="hidden" id="id_arho">
                                        <div class="form-line">
                                            <input id="edit_nama_arho" type="text" class="form-control" placeholder="Nama arho" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                    <b>Kode Warna</b>
                                    <div class="input-group colorpicker">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="#00AABB" id="edit_warna_arho">
                                        </div>
                                        <span class="input-group-addon">
                                            <i></i>
                                        </span>
                                    </div>
                                </div>
                                   
                                </div>
                </div>

                 
                
              </div>
              <div class="modal-footer">
               <button type="button" class="btn btn-success" id="btn-update-arho" >Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              </div>
            </div>

          </div>
        </div>

        
    </section>
@push('scripts')
<!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
     <script src="{{asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
     <!-- SweetAlert Plugin Js -->
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>

      <!-- Dropzone Plugin Js -->
    <script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>

     <script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>

    <script type="text/javascript">

    var tabel_arho;

    function hapus_arho(id_arho) {
        // body...
        

         swal({
        title: "Konfirmasi Hapus arho",
        text: "Apakah anda ingin menghapus arho ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Hapus",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;

        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

        

        $.ajax({
            url: "{{route('admin.informasi_arho.hapus')}}",
            type: "POST",
            data: {
                      "id_arho":id_arho
            },
            dataType: "json",
            success: function (data) {
                console.log(data);

              

                if(data==1){
                    swal("Done!", "arho berhasil dihapus", "success");
                }

                else{
                    swal("Failed!", "arho gagal dihapus", "error");
                }

               $('#tabel_arho').DataTable().ajax.reload();

                $('#modal-tambah-arho').modal("hide");
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Failed!", "arho gagal  dihapus", "error");
            }
        });
    });

    }

    function simpan_arho() {
        // body...

        var nama_arho = $('#nama_arho').val();

        var warna_arho = $('#warna_arho').val();


        swal({
        title: "Konfirmasi Simpan arho",
        text: "Apakah anda ingin menyimpan arho ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Simpan",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;

        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

        

        $.ajax({
            url: "{{route('admin.informasi_arho.simpan')}}",
            type: "POST",
            data: {
                       "nama_arho":nama_arho,
                       "warna_arho":warna_arho
                     
            },
            dataType: "json",
            success: function (data) {
                console.log(data);

              

                if(data==1){
                    swal("Done!", "arho berhasil disimpan", "success");
                }

                else{
                    swal("Failed!", "arho gagal disimpan", "error");
                }

               $('#tabel_arho').DataTable().ajax.reload();

                $('#modal-tambah-arho').modal("hide");
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Failed!", "arho gagal  disimpan", "error");
            }
        });
    });

    }

function update_arho() {
        // body...

        var id_arho = $('#id_arho').val();

        var nama_arho = $('#edit_nama_arho').val();

        var warna_arho = $('#edit_warna_arho').val();


        swal({
        title: "Konfirmasi Update arho",
        text: "Apakah anda ingin mengupdate arho ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Update",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;

        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

        

        $.ajax({
            url: "{{route('admin.informasi_arho.update')}}",
            type: "POST",
            data: {
                       "id_arho":id_arho,
                       "nama_arho":nama_arho,
                       "warna_arho":warna_arho
            },
            dataType: "json",
            success: function (data) {
                console.log(data);

              

                if(data==1){
                    swal("Done!", "arho berhasil diupdate", "success");
                }

                else{
                    swal("Failed!", "arho gagal diupdate", "error");
                }

               $('#tabel_arho').DataTable().ajax.reload();

                $('#modal-edit-arho').modal("hide");
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Failed!", "arho gagal  disimpan", "error");
            }
        });
    });

    }



function fetch_arho_by(id_arho) {
        // body...

          $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

        

        $.ajax({
            url: "{{route('admin.informasi_arho.fetch')}}",
            type: "POST",
            data: {
                       "id_arho":id_arho
            },
            dataType: "json",
            success: function (arho) {
                
                console.log(arho);



                $('#edit_nama_arho').val(arho.nama_lengkap);

                $('#id_arho').val(id_arho);

                $('#edit_warna_arho').val(arho.warna_arho);

                $("#edit_warna_arho").trigger('change');

                $('#modal-edit-arho').modal('show');

              

                
            },
           
        });
    }

$(document).ready(function  () {
            // body...
                

       tabel_arho = $('#tabel_arho').DataTable({
                        'scrollX':true,
                         "processing": true,
                        "serverSide": true,
                        "order": [],
                        "columnDefs": [
                { "orderable": false, "targets": [0,2] }
              ] 
                        ,
                    "ajax":{
                                 "url": "{{route('admin.informasi_arho.list_arho.all_arho')}}",
                                 "dataType": "json",
                                 "type": "POST",
                                 "data":{ _token: "{{csrf_token()}}"}
                               },
                        "columns": [
                            { "data": "no"},
                            { "data": "nama_arho" },
                            {"data":"warna_arho"},
                            {"data":"actions"}
                        ]

             });

        $('#tabel_arho tbody').on('click','.btn-hapus-arho',function () {
            // body...
            var id_arho = $(this).data('idarho');

            // alert(id_arho);
            hapus_arho(id_arho);
        });

        $('#tabel_arho tbody').on('click','.btn-edit-arho',function () {
            // body...
            var id_arho = $(this).data('idarho');

            fetch_arho_by(id_arho);

        });

       $('#btn-simpan-arho').click(function () {
           // body...
           simpan_arho();
       });

       $('#btn-update-arho').click(function () {
           // body...
           update_arho();
       });

        $('.colorpicker').colorpicker();



           
});
    </script>
@endpush
 @stop


