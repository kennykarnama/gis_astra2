@extends('layouts.dashboard')

@section('content')
 <!-- Sweetalert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                
            </div>
 <!-- File Upload | Drag & Drop OR With Click & Choose -->
  <!-- Dropzone Css -->
    <link href="{{asset('plugins/dropzone/dropzone.css')}}" rel="stylesheet">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Upload File Laporan     
                            </h2>
                           
                        </div>
                        <div class="body">
                            <form action="{{route('admin.upload_file.import')}}" id="frmFileUpload" class="dropzone" method="post"
                            files="true"
                            >
                              {{ csrf_field() }}  
                                <div class="dz-message">
                                    <div class="drag-icon-cph">
                                        <i class="material-icons">touch_app</i>
                                    </div>
                                    <h3>Drop files here or click to upload.</h3>
                                </div>
                                <div class="fallback">
                                    <input name="file" id="file" type="file" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->
        </div>
    </section>

   @push('scripts')
   	  <!-- Dropzone Plugin Js -->
    <script src="../../plugins/dropzone/dropzone.js"></script>
    <!-- SweetAlert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

     <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('5fa72d9a1e34cb5edb3c', {
      cluster: 'ap1',
      encrypted: true
    });

    var channel = pusher.subscribe('test-channel');
    channel.bind('App\\Events\\ImportLaporanEvent', addMessage);

    function addMessage(data) {
        swal("Good job!", data.message, "success");
      }

    </script>
   @endpush
@stop