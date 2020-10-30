@extends('layouts.master')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">File Types</h3>
                    </div>

                    @include('includes.errorrs')
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name"># ID</th>
                                <th scope="col" class="sort" data-sort="budget">VERSION NO.</th>
                                <th scope="col" class="sort" data-sort="status">FILE TYPE</th>
                                <th scope="col" class="sort" data-sort="status"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @forelse($file_types as $file_type)

                                <tr>
                                    <td class="budget">{{$file_type['id']}}</td>
                                    <td>{{$file_type['versionNo']}}</td>
                                    <td>{{$file_type['name']}}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a style="display: none;" id="main_id_holder" href="{{$file_type['main_id']}}"></a>
                                                <a style="display: none;" id="revisions_id_holder" href="{{$file_type['revisions_id']}}"></a>
                                                <a class="dropdown-item" data-toggle="modal" id="trigger"  data-target="#modal-default" title="{{$file_type['id']}}"> Submit File</a>
{{--                                                <a class="dropdown-item" href="#">Another action</a>--}}
{{--                                                <a class="dropdown-item" href="#">Something else here</a>--}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="jumbotron text-center"> No File Types Available</div>
                            @endforelse
                            </tbody>
                        </table>
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
                        <h6 class="modal-title" id="modal-title-default">File Attachment</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <form id="file-form" method="POST" action="{{route('file.submit')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="customFileLang" lang="en">
                                <label class="custom-file-label" for="customFileLang">Select file</label>
                                <input type="hidden" name="file_type_id" id="file_type_id">
                                <input type="hidden" name="main_id" id="main_id">
                                <input type="hidden" name="revisions_id" id="revisions_id">
                            </div>
                        </form>

                    </div>

                    <div class="modal-footer">
                        <button type="button" id="form-submit" class="btn btn-primary">Submit file</button>
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('extra-js')

    <script>
        $(document).ready(function (){

            $('#trigger').click(function(){

                $('#file_type_id').val($('#trigger').attr('title'))
                $('#revisions_id').val($('#revisions_id_holder').attr('href'))
                $('#main_id').val($('#main_id_holder').attr('href'))

            });

            $('#form-submit').click(function(){

                $('#file-form').submit();
            })
        });

    </script>

@endsection
