@extends('layouts.default')

@section('content')
                <!-- Main content -->
                <section class="content">
                    <div class='row'>
                        <!-- left column -->
                        <div class="col-md-6">

                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Aplikasi PDAM</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="pdam_nama">Nama PDAM</label>
                                            <input type="text" class="form-control" id="pdam_nama" placeholder="Masukkan nama PDAM" value="{{ $settings['pdam_nama'] }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="pdam_alamat">Alamat PDAM</label>
                                            <input type="text" class="form-control" id="pdam_alamat" placeholder="Masukkan alamat PDAM" value="{{ $settings['pdam_alamat'] }}">
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->

                        </div><!--/.col (left) -->
                    </div><!-- /.row -->
                </section><!-- /.content -->
@stop