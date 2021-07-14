@extends('layouts.layout')
@section('topnav')

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
        {{--<li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>--}}

        <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('adminLTE/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('adminLTE/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('adminLTE/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

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
                        <h1 class="m-0">Add Merchant</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                            <li class="breadcrumb-item active">Add Merchant</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form id="registerForm" action="{{ route('admin.merchants.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Profile Information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="profile_photo">Profile Photo <span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input img-uploader-input" id="profile_photo" name="profile_photo" accept="image/jpeg,image/png,image/gif" required>
                                            <label class="custom-file-label" for="profile_photo">Choose Profile Photo</label>
                                        </div>
                                        <div class="text-center mt-2"><img class="img-fluid d-none img-uploader-output" id="uploaded-img" src="#" alt="Profile image" /></div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Full name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="John Doe" value="{{ old('name') }}" required autocomplete="name" autofocus pattern="^[A-Za-z .'-]+$">
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
                                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="johndoe@example.com" value="{{ old('email') }}" autocomplete="email">
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
                                            <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="01xxxxxxxxx" value="{{ old('username') }}" required>
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
                                        <div class="input-group">
                                            <input id="mobile" name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="01xxxxxxxxx" value="{{ old('mobile') }}">
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
                                        <div class="input-group mb-1">
                                            <input id="address_line_1" name="address_line_1" type="text" class="form-control @error('address_line_1') is-invalid @enderror" placeholder="Address Line 1" value="{{ old('address_line_1') }}" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-map-marker-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input id="address_line_2" name="address_line_2" type="text" class="form-control @error('address_line_2') is-invalid @enderror" placeholder="Address Line 2" value="{{ old('address_line_2') }}">
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
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Business Information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="buseness_logo">Business Logo <span class="text-danger">*</span></label>

                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input img-uploader-input" id="buseness_logo" name="buseness_logo" accept="image/jpeg,image/png,image/gif" required>
                                            <label class="custom-file-label" for="exampleInputFile">Upload Business Logo</label>
                                        </div>

                                        <div class="text-center mt-2"><img class="img-fluid d-none img-uploader-output" id="uploaded-img" src="#" alt="Profile image" /></div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="business_name">Business name <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input id="business_name" name="business_name" type="text" class="form-control @error('business_name') is-invalid @enderror" placeholder="Business Name" value="{{ old('business_name') }}" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('business_name'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('business_name') }}</strong></div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Additional Information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="nid">National ID</label>
                                        <input id="nid" name="nid" type="text" class="form-control @error('nid') is-invalid @enderror" placeholder="National ID" value="{{ old('nid') }}">
                                        @if ($errors->has('nid'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('nid') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="religion">Religion</label>
                                        <input id="religion" name="religion" type="text" class="form-control @error('religion') is-invalid @enderror" placeholder="Religion" value="{{ old('religion') }}">
                                        @if ($errors->has('religion'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('religion') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Select One</option>
                                            <option {{ (old('gender') == 'Male')?'selected':'' }}>Male</option>
                                            <option {{ (old('gender') == 'Female')?'selected':'' }}>Female</option>
                                            <option {{ (old('gender') == 'Other')?'selected':'' }}>Other</option>
                                        </select>
                                        @if ($errors->has('religion'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('religion') }}</strong></div>
                                        @endif
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="permanent_address_line_1">Permanent address</label>
                                        <div class="input-group mb-1">
                                            <input id="permanent_address_line_1" name="permanent_address_line_1" type="text" class="form-control @error('permanent_address_line_1') is-invalid @enderror" placeholder="Address Line 1" value="{{ old('permanent_address_line_1') }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-map-marker-alt"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input id="permanent_address_line_2" name="permanent_address_line_2" type="text" class="form-control @error('permanent_address_line_2') is-invalid @enderror" placeholder="Address Line 2" value="{{ old('permanent_address_line_2') }}">
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
                    <button type="submit" class="btn btn-primary mb-3">Register</button>
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

            $('#registerForm').validate({
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