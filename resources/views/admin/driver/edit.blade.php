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
                        <h1 class="m-0">Edit Profile of {{$user->name}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.merchants')}}">All Merchants</a></li>
                            <li class="breadcrumb-item active">Edit Profile</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if(Session::has('success'))
                    <p class="alert">{{ Session::get('success') }}</p>
                @endif
                <form id="validteForm" action="{{ route('admin.drivers.update', ['id'=>$user->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Profile Information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="avatar">Profile Photo</label>
                                        @php
                                            $avatar = get_option($profiles, 'avatar');
                                        @endphp
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input img-uploader-input" id="avatar" name="avatar" accept="image/jpeg,image/png,image/gif">
                                            <label class="custom-file-label" for="avatar">Choose Profile Photo</label>
                                        </div>
                                        <div class="mt-2"><img class="img-fluid img-uploader-output {{($avatar)?'':'d-none'}}" id="uploaded-img" src="{{($avatar)?route('image', ['url'=>$avatar, 'width'=>120, 'height'=>120]):'#'}}" alt="Profile Photo" /></div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Full name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="John Doe" value="{{ (old('name'))?old('name'):$user->name }}" required autocomplete="name" autofocus pattern="^[A-Za-z .'-]+$">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('name'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('name') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <div class="input-group">
                                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="johndoe@example.com" value="{{ (old('email'))?old('email'):$user->email }}" autocomplete="email">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('email'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('email') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="username">Phone <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="01xxxxxxxxx" value="{{ (old('username'))?old('username'):$user->username }}" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone-square"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('username'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('username') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="mobile">Mobile</label>
                                        @php
                                            $mobile = get_option($profiles, 'mobile');
                                        @endphp
                                        <div class="input-group">
                                            <input id="mobile" name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="01xxxxxxxxx" value="{{ (old('mobile'))?old('mobile'):$mobile }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone-square"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('mobile'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('mobile') }}</strong></div>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="address_line_1">Current address <span class="text-danger">*</span></label>
                                        @php
                                            $address_line_1 = get_option($profiles, 'address_line_1');
                                            $address_line_2 = get_option($profiles, 'address_line_2');
                                        @endphp
                                        <div class="input-group mb-1">
                                            <input id="address_line_1" name="address_line_1" type="text" class="form-control @error('address_line_1') is-invalid @enderror" placeholder="Address Line 1" value="{{ (old('address_line_1'))?old('address_line_1'):$address_line_1 }}" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-map-marker-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input id="address_line_2" name="address_line_2" type="text" class="form-control @error('address_line_2') is-invalid @enderror" placeholder="Address Line 2" value="{{ (old('address_line_2'))?old('address_line_2'):$address_line_2 }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-map-marker-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('address_line_1'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('address_line_1') }}</strong></div>
                                        @endif
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Additional Information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="nid">National ID</label>
                                        @php
                                            $nid = get_option($profiles, 'nid');
                                        @endphp
                                        <input id="nid" name="nid" type="text" class="form-control @error('nid') is-invalid @enderror" placeholder="National ID" value="{{ (old('nid'))?old('nid'):$nid }}">
                                        @if ($errors->has('nid'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('nid') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="religion">Religion</label>
                                        @php
                                            $religion = get_option($profiles, 'religion');
                                        @endphp
                                        <input id="religion" name="religion" type="text" class="form-control @error('religion') is-invalid @enderror" placeholder="Religion" value="{{ (old('religion'))?old('religion'):$religion }}">
                                        @if ($errors->has('religion'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('religion') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="gender">Gender</label>
                                        @php
                                            $gender = get_option($profiles, 'gender');
                                            $sGender = (old('gender'))?old('gender'):$gender;
                                        @endphp
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Select One</option>
                                            <option {{ ($sGender == 'Male')?'selected':'' }}>Male</option>
                                            <option {{ ($sGender == 'Female')?'selected':'' }}>Female</option>
                                            <option {{ ($sGender == 'Other')?'selected':'' }}>Other</option>
                                        </select>
                                        @if ($errors->has('religion'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('religion') }}</strong></div>
                                        @endif
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="permanent_address_line_1">Permanent address</label>
                                        @php
                                            $permanent_address_line_1 = get_option($profiles, 'permanent_address_line_1');
                                            $permanent_address_line_2 = get_option($profiles, 'permanent_address_line_2');
                                        @endphp
                                        <div class="input-group mb-1">
                                            <input id="permanent_address_line_1" name="permanent_address_line_1" type="text" class="form-control @error('permanent_address_line_1') is-invalid @enderror" placeholder="Address Line 1" value="{{ (old('permanent_address_line_1'))?old('permanent_address_line_1'):$permanent_address_line_1 }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-map-marker-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input id="permanent_address_line_2" name="permanent_address_line_2" type="text" class="form-control @error('permanent_address_line_2') is-invalid @enderror" placeholder="Address Line 2" value="{{ (old('permanent_address_line_2'))?old('permanent_address_line_2'):$permanent_address_line_2 }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-map-marker-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('permanent_address_line_1'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('permanent_address_line_1') }}</strong></div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="role" value="driver">
                    <button type="submit" class="btn btn-primary mb-3">Update User</button>
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
                    name: {
                        required: true,
                    },
                    email: {
                        email: true,
                    },
                    username: {
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
                    name: {
                        required: "Please enter Full name",
                    },
                    email: {
                        email: "Please enter a valid Email",
                    },
                    username: {
                        required: "Please enter Phone",
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