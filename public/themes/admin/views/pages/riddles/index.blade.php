@extends('layouts.default')

@section('content')
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Riddle List</h3>
                                </div><!-- /.box-header -->

                                @include('partials.info')

                                @if ( $errors->count() > 0 )
                                <div class="row margin">
                                    <div class="col-md-12">
                                        @include('partials.error')
                                    </div>
                                </div>
                                @endif

                                <div class="box-body table-responsive">
                                    <table id="table-list" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Question</th>
                                                <th>Type</th>
                                                <th>Content</th>
                                                <th>Clues</th>
                                                <th>Answer</th>
                                                <th>Status</th>
                                                <th width="150px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($data_riddles as $riddle)
                                            <tr>
                                                <td>{{{ $riddle->id }}}</td>
                                                <td>{{{ $riddle->question }}}</td>
                                                <td>{{{ $riddle->type }}}</td>
                                                <td>{{{ $riddle->content }}}</td>
                                                <td>{{{ $riddle->clues }}}</td>
                                                <td>{{{ $riddle->answer }}}</td>
                                                <td>{{{ $riddle->publish_text }}}</td>
                                                <td><a class="btn btn-warning" href="{{ route('dashboard.riddles.edit', ['id' => $riddle->id]) }}"><i class="fa fa-edit"></i> Edit</a> <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Question</th>
                                                <th>Type</th>
                                                <th>Content</th>
                                                <th>Clues</th>
                                                <th>Answer</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </div>
                    </div>
                </section>
@stop

@section('footer')
        <!-- page script -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#table-list').dataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false,
                    "aaSorting": []
                });
            });
        </script>
@stop