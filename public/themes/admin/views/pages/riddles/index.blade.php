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
                                        @foreach ($data_riddles as $data_riddle)
                                            <tr>
                                                <td>{{{ $data_riddle->id }}}</td>
                                                <td>{{{ $data_riddle->question }}}</td>
                                                <td>{{{ $data_riddle->type }}}</td>
                                                <td>{{{ $data_riddle->content }}}</td>
                                                <td>{{{ $data_riddle->clues }}}</td>
                                                <td>{{{ $data_riddle->answer }}}</td>
                                                <td>{{{ $data_riddle->publish_text }}}</td>
                                                <td><a class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a> <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button></td>
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