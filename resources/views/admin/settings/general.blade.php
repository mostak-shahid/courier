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
                        <h1 class="m-0">General Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                            <li class="breadcrumb-item active">General Settings</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form id="validateForm" action="{{route('admin.settings.general.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="company_logo">Company Logo</label>
                                        @php($company_logo = get_option($settings, 'company_logo'))
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input img-uploader-input" id="company_logo" name="company_logo" accept="image/jpeg,image/png,image/gif">
                                            <label class="custom-file-label" for="company_logo">Choose Company Logo</label>
                                        </div>
                                        <div class="mt-2"><img class="img-fluid img-uploader-output {{($company_logo)?'':'d-none'}}" id="uploaded-img" src="{{($company_logo)?route('image', ['url'=>$company_logo, 'width'=>120, 'height'=>120]):'#'}}" alt="Profile Photo" /></div>
                                        @if ($errors->has('company_logo'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('company_logo') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="company_favicon">Favicon <span class="text-danger">*</span></label>
                                        @php($company_favicon = get_option($settings, 'company_favicon'))
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input img-uploader-input" id="company_favicon" name="company_favicon" accept="image/jpeg,image/png,image/gif">
                                            <label class="custom-file-label" for="company_favicon">Choose Company Logo</label>
                                        </div>
                                        <div class="mt-2"><img class="img-fluid img-uploader-output {{($company_favicon)?'':'d-none'}}" id="uploaded-img" src="{{($company_favicon)?route('image', ['url'=>$company_favicon, 'width'=>120, 'height'=>120]):'#'}}" alt="Profile Photo" /></div>
                                        @if ($errors->has('company_favicon'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('company_favicon') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="company_name">Site Title <span class="text-danger">*</span></label>
                                        @php($company_name = (old('company_name'))?old('company_name'):get_option($settings, 'company_name'))
                                        <input id="company_name" name="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" placeholder="Site Title" value="{{ $company_name }}" required autocomplete="company_name" autofocus pattern="^[A-Za-z0-9 .'-]+$">
                                        @if ($errors->has('company_name'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('company_name') }}</strong></div>
                                        @endif
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Update</button>
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
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection
@section('script')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('adminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('adminLTE/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminLTE/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            bsCustomFileInput.init();
            function readURL(input) {
                if (input.files && input.files[0]) {
                    console.log(input.files[0]);
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $(input).parent().siblings().find('.img-uploader-output').removeClass('d-none').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }
            $(".img-uploader-input").change(function() {
                readURL(this);
                //console.log(this);
            });

            $('#validateForm').validate({
                rules: {
                    company_name: {
                        required: true,
                    },
                },
                messages: {
                    company_name: {
                        required: "Please enter Site Title",
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