@extends('layouts.default')

@section('content')
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Letter Substitution List</h3>
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
                                                <th>Letter</th>
                                                <th>Substitution</th>
                                                <th>HTML Entities</th>
                                                <th width="150px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data_charmaps as $charmap)
                                            <tr>
                                                <td>{{ $charmap->letter }}</td>
                                                <td>{{ $charmap->symbol }}</td>
                                                <td>{{ htmlentities($charmap->symbol) }}</td>
                                                <td><a class="btn btn-warning" href="{{ route('dashboard.charmaps.edit', ['letter' => $charmap->letter]) }}"><i class="fa fa-edit"></i> Edit</a></td>
                                            </tr>
                                            @empty

                                            @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Letter</th>
                                                <th>Substitution/Symbol</th>
                                                <th>HTML Entities</th>
                                                <th width="150px">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div><!-- /.box -->

                        </div>
                    </div>
                </section>

                <form id="executioner" class="hidden" method="post"></form>
@stop

@section('footer')
        <!-- page script -->
@stop