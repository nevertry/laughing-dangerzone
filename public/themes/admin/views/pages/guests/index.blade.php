@extends('layouts.default')

@section('content')
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Guest List</h3>
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
                                                <th>E-mail</th>
                                                <th>Name</th>
                                                <th>Riddle ID</th>
                                                <th>Status</th>
                                                <th width="150px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($data_guests as $guest)
                                            <tr>
                                                <td>{{{ $guest->id }}}</td>
                                                <td>{{{ $guest->email }}}</td>
                                                <td>{{{ $guest->name }}}</td>
                                                <td>{{{ $guest->riddle_id }}}</td>
                                                <td>{{{ $guest->status }}}</td>
                                                <td><a class="btn btn-warning" href="{{ route('dashboard.guests.edit', ['id' => $guest->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                                <a class="btn btn-danger" href="javascript:void(0)" onclick="deleteData('{{$guest->id}}')"><i class="fa fa-trash-o"></i> Delete</button></td>
                                            </tr>
                                        @empty
                                            
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>E-mail</th>
                                                <th>Name</th>
                                                <th>Riddle ID</th>
                                                <th>Status</th>
                                                <th width="150px">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </div>
                    </div>
                </section>

                <form id="executioner" class="hidden" method="post"></form>
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

            function deleteData(id)
            {
                var confirmation = confirm('{{ trans("Are you sure want to delete this data?") }}');
                var delete_url = '{{ route('dashboard.guests') }}/'+id+'/delete';
                var form = $('#executioner');

                if (confirmation)
                {
                    form.attr('action', delete_url);
                    form.submit();
                }
            }
        </script>
@stop