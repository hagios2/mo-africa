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
                        {!! $dataTable->table(['class' => 'table align-items-center',]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        {{--        <button type="button" class="btn btn-block btn-primary mb-3" >Default</button>--}}
        <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Reason For Joining</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">

                       <p id="reasons_div" class=""></p>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
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
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="{{asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>
    <script>
        $(document).ready(function (){


        });

    </script>

@endsection
