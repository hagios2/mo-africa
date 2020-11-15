@extends('layouts.master')
@section('extra-css')
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">
@endsection
@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Registered Users</h3>
                    </div>

                    @include('includes.errorrs')
                    <!-- Light table -->
                    <div class="table-responsive" >
                        {!! $dataTable->table(['class' => 'table align-items-center table-striped',]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra-js')

    <!-- third party js ends -->
    {!! $dataTable->scripts() !!}
    <script src="{{ elixir('js/datatables.js') }}"></script>
{{--    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>--}}

{{--    <script src="{{asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>--}}
{{--    <script src="{{asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>--}}
    <script src="{{asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>

    <script>
        $(document).ready(function (){

            $('.trigger').click(function(){

                console.log($(this).attr('title'))
                console.log($(this).children('.revisions_id_holder').attr('title'))
                console.log($(this).children('.main_id_holder').attr('title'))


                $('#file_type_id').val($(this).attr('title'))
                $('#revisions_id').val($(this).children('.revisions_id_holder').attr('title'))
                $('#main_id').val($(this).children('.main_id_holder').attr('title'))
            });

            $('#form-submit').click(function(){

                $('#file-form').submit();
            })
        });

    </script>

@endsection
