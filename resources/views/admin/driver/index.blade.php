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
                        <h1 class="m-0">All Drivers</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                            <li class="breadcrumb-item active">All Drivers</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                {{--@if($drivers->count())--}}
                    {{--@foreach($drivers as $driver)--}}
                        {{--{{$driver->name}}--}}
                    {{--@endforeach--}}
                {{--@endif--}}
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Joining Data</th>
                                </tr>
                                </thead>

                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Joining Data</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

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
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(function () {
        $("#example1").DataTable({
            //"pagingType": "simple",
            language: {
                "lengthMenu": "Show _MENU_ drivers",
                "zeroRecords": "Nothing found - sorry",
                "info": "Showing page _PAGE_ of _PAGES_", //Showing 1 to 10 of 24 entries
                "infoEmpty": "No drivers available",
                "infoFiltered": "(filtered from _MAX_ total drivers)"
            },
            order: [[ 0, "desc" ]],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.drivers') }}",
            },

            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'active',
                    name: 'active'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                }
            ],
            responsive: true,
            //"lengthChange": false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        })//.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('body').on('click', '.delete-user', function (e){
        //$('.delete-user').click(function(e){
            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('Are you sure?')) {
                // Post the form
                $(e.target).closest('form').submit() // Post the surrounding form
            }
        });
    });
</script>
@endsection