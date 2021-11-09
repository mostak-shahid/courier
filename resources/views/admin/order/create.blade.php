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
                        <h1 class="m-0">Add New Order</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.note.index')}}">All Order</a></li>
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
                                    <h3 class="card-title">Sender's Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                            <option value="">Select Merchant</option>
                                        </select>
                                        @if ($errors->has('user_id'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('user_id') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="business_name" name="business_name" type="text" class="form-control @error('business_name') is-invalid @enderror" placeholder="Business Name" value="{{ old('business_name') }}" required pattern="^[A-Za-z0-9 .'-]+$">
                                        @if ($errors->has('business_name'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('business_name') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="business_phone" name="business_phone" type="text" class="form-control @error('business_phone') is-invalid @enderror" placeholder="Business Phone" value="{{ old('business_phone') }}" required>
                                        @if ($errors->has('business_phone'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('business_phone') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <select name="pickup_location" id="pickup_location" class="form-control @error('pickup_location') is-invalid @enderror" required>
                                            <option value="">Select Pickup Location</option>
                                        </select>
                                        @if ($errors->has('pickup_location'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('pickup_location') }}</strong></div>
                                        @endif
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Receiver's Information</h3>
                                </div>
                                <div class="card-body">

                                    <div class="form-group mb-3">
                                        <input id="receiver_name" name="receiver_name" type="text" class="form-control @error('receiver_name') is-invalid @enderror" placeholder="Receiver's  Name" value="{{ old('receiver_name') }}" required pattern="^[A-Za-z0-9 .'-]+$">
                                        @if ($errors->has('receiver_name'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('receiver_name') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="receiver_phone" name="receiver_phone" type="text" class="form-control @error('receiver_phone') is-invalid @enderror" placeholder="Receiver's Phone" value="{{ old('receiver_phone') }}" required>
                                        @if ($errors->has('receiver_phone'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('receiver_phone') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="receiver_email" name="receiver_email" type="email" class="form-control @error('receiver_email') is-invalid @enderror" placeholder="Receiver's Email" value="{{ old('receiver_email') }}">
                                        @if ($errors->has('receiver_email'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('receiver_email') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <select name="destination_location" id="destination_location" class="form-control @error('destination_location') is-invalid @enderror" required>
                                            <option value="">Select Destination Location</option>
                                        </select>
                                        @if ($errors->has('destination_location'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('destination_location') }}</strong></div>
                                        @endif
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Order Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ old('title') }}" required autocomplete="title" autofocus pattern="^[A-Za-z0-9 .'-]+$">
                                        @if ($errors->has('title'))
                                            <div class="text-danger mb-3"><strong>{{ $errors->first('title') }}</strong></div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="product_packaging_type">Packaging Type</label>
                                        <select id="product_packaging_type" name="product_packaging_type" class="form-control select2">

                                            <option value="">Select Packaging Type</option>
                                            <option value="Bag">Bag</option>
                                            <option value="Document">Document</option>
                                            <option value="Box">Box</option>
                                            <option value="Cartun">Cartun</option>

                                        </select>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
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
        /*$(function () {
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
        });*/
    </script>
@endsection