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
                                Daftar Kelurahan
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a id="btn-tambah-arho" href="#"  data-toggle="modal" data-target="#modal-tambah-kelurahan">Tambah kelurahan</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                               <table class="table table-bordered table-striped table-hover" id="tabel_kelurahan">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kelurahan</th>
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
        <div id="modal-tambah-kelurahan" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Kelurahan</h4>
              </div>
              <div class="modal-body">

                <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="nama_kelurahan" type="text" class="form-control" placeholder="Nama Kelurahan" />
                                        </div>
                                    </div>

                                    <label>Kecamatan</label>

                                     <select class="form-control" id="kecamatan">

                                        @foreach($list_kecamatan as $kecamatan)
                                            <option value="{{$kecamatan->id_kecamatan}}">{{$kecamatan->nama_kecamatan}}</option>
                                        @endforeach
                                       
                                    </select>

 
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
               <button type="button" class="btn btn-success" id="btn-simpan-kelurahan" >Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              </div>
            </div>

          </div>
        </div>

        <div id="modal-edit-kelurahan" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Kelurahan</h4>
              </div>
              <div class="modal-body">

                <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <input type="hidden" id="id_kelurahan">
                                        <div class="form-line">
                                            <input id="edit_nama_kelurahan" type="text" class="form-control" placeholder="Nama Kelurahan" />
                                        </div>
                                    </div>

                                    <label>Kecamatan</label>

                                     <select class="form-control" id="edit_kecamatan">

                                        @foreach($list_kecamatan as $kecamatan)
                                            <option value="{{$kecamatan->id_kecamatan}}">{{$kecamatan->nama_kecamatan}}</option>
                                        @endforeach
                                       
                                    </select>

 
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
               <button type="button" class="btn btn-success" id="btn-update-kelurahan" >Update</button>
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
     <!-- Select Plugin Js -->
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
      <!-- SweetAlert Plugin Js -->
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
      <!-- Dropzone Plugin Js -->
    <script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>

    <script type="text/javascript">

    var tabel_kelurahan;

function simpan_kelurahan() {
        // body...

        var nama_kelurahan = $('#nama_kelurahan').val();

        var kecamatan = $("#kecamatan").val();

        var lat = $('#lat').val();

        var lng = $('#lng').val();



        swal({
        title: "Konfirmasi Simpan Kelurahan",
        text: "Apakah anda ingin menyimpan Kelurahan ?",
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
            url: "{{route('admin.informasi_kelurahan.simpan')}}",
            type: "POST",
            data: {
                       "nama_kelurahan":nama_kelurahan,
                        "kecamatan":kecamatan,
                       "lat":lat,
                       "lng":lng
            },
            dataType: "json",
            success: function (data) {
                console.log(data);

              

                if(data==1){
                    swal("Done!", "Kelurahan berhasil disimpan", "success");
                }

                else{
                    swal("Failed!", "Kelurahan gagal disimpan", "error");
                }

               $('#tabel_kelurahan').DataTable().ajax.reload();

                $('#modal-tambah-kelurahan').modal("hide");
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Failed!", "Kelurahan gagal  disimpan", "error");
            }
        });
    });

    }

    function hapus_kelurahan(id_kelurahan) {
        // body...
        

         swal({
        title: "Konfirmasi Hapus Kelurahan",
        text: "Apakah anda ingin menghapus Kelurahan ?",
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
            url: "{{route('admin.informasi_kelurahan.hapus')}}",
            type: "POST",
            data: {
                      "id_kelurahan":id_kelurahan
            },
            dataType: "json",
            success: function (data) {
                console.log(data);

              

                if(data==1){
                    swal("Done!", "Kelurahan berhasil dihapus", "success");
                }

                else{
                    swal("Failed!", "Kelurahan gagal dihapus", "error");
                }

               $('#tabel_kelurahan').DataTable().ajax.reload();

                $('#modal-tambah-kelurahan').modal("hide");
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Failed!", "Kelurahan gagal  dihapus", "error");
            }
        });
    });

    }

    function update_kelurahan() {
        // body...

        var id_kelurahan = $('#id_kelurahan').val();

        var nama_kelurahan = $('#edit_nama_kelurahan').val();

        var kecamatan = $("#edit_kecamatan").val();

        var lat = $('#edit_lat').val();

        var lng = $('#edit_lng').val();



        swal({
        title: "Konfirmasi Update Kelurahan",
        text: "Apakah anda ingin mengupdate Kelurahan ?",
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
            url: "{{route('admin.informasi_kelurahan.update')}}",
            type: "POST",
            data: {
                       "id_kelurahan":id_kelurahan,
                       "kecamatan":kecamatan,
                       "nama_kelurahan":nama_kelurahan,
                       
                       "lat":lat,
                       "lng":lng
            },
            dataType: "json",
            success: function (data) {
                console.log(data);

              

                if(data==1){
                    swal("Done!", "Kelurahan berhasil diupdate", "success");
                }

                else{
                    swal("Failed!", "Kelurahan gagal diupdate", "error");
                }

               $('#tabel_kelurahan').DataTable().ajax.reload();

                $('#modal-edit-kelurahan').modal("hide");
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Failed!", "Kelurahan gagal  disimpan", "error");
            }
        });
    });

    }


    function fetch_kelurahan_by(id_kelurahan) {
        // body...

          $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

        

        $.ajax({
            url: "{{route('admin.informasi_kelurahan.fetch')}}",
            type: "POST",
            data: {
                       "id_kelurahan":id_kelurahan
            },
            dataType: "json",
            success: function (kelurahan) {
                
            //console.log(kelurahan);

                $('#edit_nama_kelurahan').val(kelurahan.nama_kelurahan);

                $('#id_kelurahan').val(id_kelurahan);

                $("#edit_kecamatan").val(kelurahan.id_kecamatan);

                
                $('#edit_lat').val(kelurahan.lat);

                $('#edit_lng').val(kelurahan.lng);

                $('#modal-edit-kelurahan').modal('show');

              

                
            },
           
        });
    }

        $(document).ready(function  () {
            // body...

              tabel_kelurahan = $('#tabel_kelurahan').DataTable({
                        'scrollX':true,
                         "processing": true,
                        "serverSide": true,
                        "order": [],
                        "columnDefs": [
                { "orderable": false, "targets": [0,4] }
              ] 
                        ,
                    "ajax":{
                                 "url": "{{route('admin.informasi_kelurahan.list_kelurahan')}}",
                                 "dataType": "json",
                                 "type": "POST",
                                 "data":{ _token: "{{csrf_token()}}"}
                               },
                        "columns": [
                            { "data": "no"},
                            { "data": "nama_kelurahan" },
                            { "data": "lat" },
                            { "data": "lng" },
                            {"data":"actions"}
                        ]

             });

            $('#btn-simpan-kelurahan').click(function () {
                // body...
                simpan_kelurahan();
            });

            $('#tabel_kelurahan tbody').on('click','.btn-hapus-kelurahan',function () {
                // body...
                var id_kelurahan = $(this).data('idkelurahan');

                hapus_kelurahan(id_kelurahan);
            });

            $('#tabel_kelurahan tbody').on('click','.btn-edit-kelurahan',function () {
                // body...
                var id_kelurahan = $(this).data('idkelurahan');

                 fetch_kelurahan_by(id_kelurahan);

            });

            $('#btn-update-kelurahan').click(function () {
                // body...
                update_kelurahan();
            });
          
        });
    </script>
@endpush
 @stop


