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
                        <h1 class="m-0">Change Password</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.merchants')}}">All Merchant</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form id="validteForm" action="{{ route('admin.merchants.updatepassword', ['id'=>$user->id]) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Change Password</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="old_password">Old Password</label>
                                        <div class="input-group">
                                            <input id="old_password" name="old_password" type="text" class="form-control @error('old_password') is-invalid @enderror" placeholder="Old Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('old_password'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('old_password') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <input id="password" name="password" type="text" class="form-control @error('password') is-invalid @enderror" placeholder="Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('password'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('password') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password_confirmation">Retype Password</label>
                                        <div class="input-group">
                                            <input id="password_confirmation" name="password_confirmation" type="text" class="form-control" placeholder="Retype Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Change Password</button>
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

            $('#validteForm').validate({
                rules: {
                    profile_photo: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    email: {
                        email: true,
                    },
                    username: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 8,
                        equalTo: password,
                    },
                    buseness_logo: {
                        required: true,
                    },
                    business_name: {
                        required: true,
                    },
                    address_line_1: {
                        required: true,
                    },
                },
                messages: {
                    profile_photo: {
                        required: "Please enter Profile Photo",
                    },
                    name: {
                        required: "Please enter Full name",
                    },
                    email: {
                        email: "Please enter a valid Email",
                    },
                    username: {
                        required: "Please enter Phone",
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    buseness_logo: {
                        required: "Please enter Business Logo",
                    },
                    business_name: {
                        required: "Please enter Business Name",
                    },
                    address_line_1: {
                        required: "Please enter Business Address",
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