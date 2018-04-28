@extends('layouts.dashboard')

@section('content')

  
    <!-- Dropzone Css -->
    <link href="{{asset('plugins/dropzone/dropzone.css')}}" rel="stylesheet">
     <!-- Bootstrap Select Css -->
    <link href="{{asset('plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

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
                                Daftar Kecamatan
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a id="btn-tambah-arho" href="#" data-toggle="modal" data-target="#modal-tambah-kecamatan">Tambah Kecamatan</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">

                       

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tabel_kecamatan">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kecamatan</th>
                                            <th>Luas Wilayah</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
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
        <div id="modal-tambah-kecamatan" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Kecamatan</h4>
              </div>
              <div class="modal-body">

                <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="nama_kecamatan" type="text" class="form-control" placeholder="Nama Kecamatan" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="luas_wilayah" type="number" class="form-control" placeholder="Luas Wilayah (km2)" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="lat" type="number" class="form-control" placeholder="Latitude" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="lng" type="number" class="form-control" placeholder="Longitude" />
                                        </div>
                                    </div>
                                </div>
                </div>

                 
                
              </div>
              <div class="modal-footer">
               <button type="button" class="btn btn-success" id="btn-simpan-kecamatan" >Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              </div>
            </div>

          </div>
        </div>

         <!-- Modal -->
        <div id="modal-edit-kecamatan" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Kecamatan</h4>
              </div>
              <div class="modal-body">

                <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">

                                    <input type="hidden" id="id_kecamatan">
                                        <div class="form-line">
                                            <input id="edit_nama_kecamatan" type="text" class="form-control" placeholder="Nama Kecamatan" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="edit_luas_wilayah" type="number" class="form-control" placeholder="Luas Wilayah (km2)" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="edit_lat" type="number" class="form-control" placeholder="Latitude" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="edit_lng" type="number" class="form-control" placeholder="Longitude" />
                                        </div>
                                    </div>
                                </div>
                </div>

                 
                
              </div>
              <div class="modal-footer">
               <button type="button" class="btn btn-success" id="btn-update-kecamatan" >Update</button>
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

    <script type="text/javascript">

    var tabel_kecamatan;

    function hapus_kecamatan(id_kecamatan) {
        // body...
        

         swal({
        title: "Konfirmasi Hapus Kecamatan",
        text: "Apakah anda ingin menghapus Kecamatan ?",
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
            url: "{{route('admin.informasi_kecamatan.hapus')}}",
            type: "POST",
            data: {
                      "id_kecamatan":id_kecamatan
            },
            dataType: "json",
            success: function (data) {
                console.log(data);

              

                if(data==1){
                    swal("Done!", "Kecamatan berhasil dihapus", "success");
                }

                else{
                    swal("Failed!", "Kecamatan gagal dihapus", "error");
                }

               $('#tabel_kecamatan').DataTable().ajax.reload();

                $('#modal-tambah-kecamatan').modal("hide");
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Failed!", "Kecamatan gagal  dihapus", "error");
            }
        });
    });

    }

    function simpan_kecamatan() {
        // body...

        var nama_kecamatan = $('#nama_kecamatan').val();

        var luas_wilayah = $("#luas_wilayah").val();

        var lat = $('#lat').val();

        var lng = $('#lng').val();



        swal({
        title: "Konfirmasi Simpan Kecamatan",
        text: "Apakah anda ingin menyimpan Kecamatan ?",
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
            url: "{{route('admin.informasi_kecamatan.simpan')}}",
            type: "POST",
            data: {
                       "nama_kecamatan":nama_kecamatan,
                       "luas_wilayah":luas_wilayah,
                       "lat":lat,
                       "lng":lng
            },
            dataType: "json",
            success: function (data) {
                console.log(data);

              

                if(data==1){
                    swal("Done!", "Kecamatan berhasil disimpan", "success");
                }

                else{
                    swal("Failed!", "Kecamatan gagal disimpan", "error");
                }

               $('#tabel_kecamatan').DataTable().ajax.reload();

                $('#modal-tambah-kecamatan').modal("hide");
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Failed!", "Kecamatan gagal  disimpan", "error");
            }
        });
    });

    }

function update_kecamatan() {
        // body...

        var id_kecamatan = $('#id_kecamatan').val();

        var nama_kecamatan = $('#edit_nama_kecamatan').val();

        var luas_wilayah = $("#edit_luas_wilayah").val();

        var lat = $('#edit_lat').val();

        var lng = $('#edit_lng').val();



        swal({
        title: "Konfirmasi Update Kecamatan",
        text: "Apakah anda ingin mengupdate Kecamatan ?",
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
            url: "{{route('admin.informasi_kecamatan.update')}}",
            type: "POST",
            data: {
                       "id_kecamatan":id_kecamatan,
                       "nama_kecamatan":nama_kecamatan,
                       "luas_wilayah":luas_wilayah,
                       "lat":lat,
                       "lng":lng
            },
            dataType: "json",
            success: function (data) {
                console.log(data);

              

                if(data==1){
                    swal("Done!", "Kecamatan berhasil diupdate", "success");
                }

                else{
                    swal("Failed!", "Kecamatan gagal diupdate", "error");
                }

               $('#tabel_kecamatan').DataTable().ajax.reload();

                $('#modal-edit-kecamatan').modal("hide");
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Failed!", "Kecamatan gagal  disimpan", "error");
            }
        });
    });

    }



function fetch_kecamatan_by(id_kecamatan) {
        // body...

          $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

        

        $.ajax({
            url: "{{route('admin.informasi_kecamatan.fetch')}}",
            type: "POST",
            data: {
                       "id_kecamatan":id_kecamatan
            },
            dataType: "json",
            success: function (kecamatan) {
                
                //console.log(kecamatan);

                $('#edit_nama_kecamatan').val(kecamatan.nama_kecamatan);

                $('#id_kecamatan').val(id_kecamatan);

                $("#edit_nama_kecamatan").val(kecamatan.nama_kecamatan);

                $('#edit_luas_wilayah').val(kecamatan.luas_wilayah_km2);

                $('#edit_lat').val(kecamatan.lat);

                $('#edit_lng').val(kecamatan.lng);

                $('#modal-edit-kecamatan').modal('show');

              

                
            },
           
        });
    }

$(document).ready(function  () {
            // body...
                

       tabel_kecamatan = $('#tabel_kecamatan').DataTable({
                        'scrollX':true,
                         "processing": true,
                        "serverSide": true,
                        "order": [],
                        "columnDefs": [
                { "orderable": false, "targets": [0,5] }
              ] 
                        ,
                    "ajax":{
                                 "url": "{{route('admin.informasi_kecamatan.list_kecamatan.all_kecamatan')}}",
                                 "dataType": "json",
                                 "type": "POST",
                                 "data":{ _token: "{{csrf_token()}}"}
                               },
                        "columns": [
                            { "data": "no"},
                            { "data": "nama_kecamatan" },
                            { "data": "luas_wilayah" },
                            { "data": "lat" },
                            { "data": "lng" },
                            {"data":"actions"}
                        ]

             });

        $('#tabel_kecamatan tbody').on('click','.btn-hapus-kecamatan',function () {
            // body...
            var id_kecamatan = $(this).data('idkecamatan');

            // alert(id_kecamatan);
            hapus_kecamatan(id_kecamatan);
        });

        $('#tabel_kecamatan tbody').on('click','.btn-edit-kecamatan',function () {
            // body...
            var id_kecamatan = $(this).data('idkecamatan');

            fetch_kecamatan_by(id_kecamatan);

        });

       $('#btn-simpan-kecamatan').click(function () {
           // body...
           simpan_kecamatan();
       });

       $('#btn-update-kecamatan').click(function () {
           // body...
           update_kecamatan();
       });



           
});
    </script>
@endpush
 @stop


