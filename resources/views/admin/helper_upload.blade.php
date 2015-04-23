@extends('layout.admin')
@section('css')
<link href="{{$static}}/css/plugins/dropzone/dropzone.css" rel="stylesheet">
@stop
@section('content')
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{trans('admin.filehelper')}}</h5>
                    <div class="ibox-tools">

                    </div>
                </div>
                <div class="ibox-content">
                    <form id="my-awesome-dropzone" class="dropzone" action="upload">
                        <div class="dropzone-previews"></div>
                        {{\Tools::token()}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script src="{{$static}}/js/plugins/dropzone/dropzone.js"></script>
<script>
    $(document).ready(function(){

        Dropzone.options.myAwesomeDropzone = {

            autoProcessQueue: true,
            uploadMultiple: false,
            addRemoveLinks:  true,
            method: 'post',
            parallelUploads: 100,
            maxFiles: 100,
            maxFilesize: 100,

            // Dropzone settings
            init: function() {
                this.on("success", function(files, response) {
                    files.previewElement.childNodes[9].innerHTML = '<span data-dz-errormessage="">'+response.url+'</span>';
                   console.log(files.previewElement.childNodes[9].innerHTML);

                });
            }

        }

    });
</script>
@stop