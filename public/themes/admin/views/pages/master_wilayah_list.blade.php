@extends('layouts.default')

@section('content')
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Hover Data Table</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="dataTableFull" class="table table-bordered table-hover table-with-level">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $indexOf = 0; ?>
                                        @foreach ($wilayahs as $level0)
                                            <?php $indexOf++; ?>
                                            @include('pages.master_wilayah_table_row', ['wilayah' => $level0, 'level' => 0, 'number' => $indexOf])
                                            @if (count($level0->children))
                                                @foreach ($level0->children as $level1)
                                                    <?php $indexOf++; ?>
                                            @include('pages.master_wilayah_table_row', ['wilayah' => $level1, 'level' => 1, 'number' => $indexOf])
                                                    @if (count($level1->children))
                                                        @foreach ($level1->children as $level2)
                                                            <?php $indexOf++; ?>
                                            @include('pages.master_wilayah_table_row', ['wilayah' => $level2, 'level' => 2, 'number' => $indexOf])
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col-xs-12 -->
                    </div><!-- /.row -->
                </section><!-- /.content -->
@stop

@section('footer')
        <!-- DATA TABES SCRIPT -->
        {{ HTML::script(Theme::asset('js/plugins/datatables/jquery.dataTables.js')) }}
        {{ HTML::script(Theme::asset('js/plugins/datatables/dataTables.bootstrap.js')) }}

        <script type="text/javascript">
            $(document).ready(function() {
                $('#dataTableFull').dataTable({
                    // "bPaginate": true,
                    // "bLengthChange": false,
                    // "bFilter": false,
                    // "bSort": true,
                    // "bInfo": true,
                    // "bAutoWidth": false
                });
            });
        </script>
@stop