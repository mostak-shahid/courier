@extends('layouts.layout')
@section('topnav')

@include('admin.navbar')

@endsection
@section('sidebar_left')
    @include('admin.sidebar_left')
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add New Notiece</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.note.index')}}">All Notices</a></li>
                            <li class="breadcrumb-item active">Add New</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form id="validateForm" action="{{route('admin.note.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Compose New Message</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ old('title') }}" required autocomplete="title" autofocus pattern="^[A-Za-z0-9 .'-]+$">
                                        @if ($errors->has('title'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('title') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <select name="to[]" class="form-control select2bs4" style="width: 100%;" multiple data-placeholder="To:">
                                            @if($merchants->count())
                                            <optgroup label="Merchants">
                                                <option value="all-merchants">All Merchants</option>
                                                @foreach($merchants as $merchant)
                                                <option value="{{$merchant->id}}">{{$merchant->username}}</option>
                                                @endforeach
                                            </optgroup>
                                            @endif
                                            @if($drivers->count())
                                            <optgroup label="Drivers">
                                                <option value="all-drivers">All Drivers</option>
                                                @foreach($drivers as $driver)
                                                <option value="{{$driver->id}}">{{$driver->username}}</option>
                                                @endforeach
                                            </optgroup>
                                            @endif
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <textarea id="compose-textarea" name="editor" class="form-control" style="height: 300px"></textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input img-uploader-input" id="media" name="media">
                                            <label class="custom-file-label" for="media">Attachment</label>
                                        </div>
                                        @if ($errors->has('media'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('media') }}</strong></div>
                                        @endif
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Send</button>
                </form>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@section('sidebar_right')
    @include('layouts.sidebar_right')
@endsection
@section('footer')
    @include('layouts.footer')
@endsection
@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('script')
    <!-- Select2 -->
    <script src="{{ asset('adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('adminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('adminLTE/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('adminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $('#compose-textarea').summernote();
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            bsCustomFileInput.init();

            $('#validateForm').validate({
                rules: {
                    title: {
                        required: true,
                    },
                },
                messages: {
                    title: {
                        required: "Please enter Notice Title",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection