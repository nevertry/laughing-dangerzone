@extends('layouts.default')

@section('content')
                <!-- Main content -->
                <section class="content">
                    <div class='row'>
                        <!-- left column -->
                        <div class="col-md-6">
                            @include('partials.error')
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Wilayah/Unit</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                {{ Form::open(array('action' => 'dashboard.master.wilayah.store', 'role' => 'form')) }}

                                    <div class="box-body">

                                            @foreach ($formdatas as $form_keys => $form_details)
                                            	{{ form_element_set($form_details, $form_keys) }}
                                            @endforeach

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                {{ Form::close() }}
                            </div><!-- /.box -->

                        </div><!--/.col (left) -->
                    </div><!-- /.row -->
                </section><!-- /.content -->
@stop