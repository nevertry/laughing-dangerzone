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
                                    <h3 class="box-title">{{ $pageinfo['content']['subtitle'] }}</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                {{ Form::open(array('action' => 'dashboard.settings.app.update', 'role' => 'form')) }}
                                    {{ Form::hidden('setting_name', $setting_name) }}
                                    <div class="box-body">
                                        @if ($setting->name == $setting_name)
                                            @foreach (json_decode($setting->meta_data) as $meta_key => $meta_detail)
                                                @if ($meta_detail->type == 'text')
                                                    <div class="form-group">
                                                        <label for="{{ $meta_key }}">{{ $meta_detail->label }}</label>
                                                        <input type="text" class="form-control" id="{{ $meta_key }}" name="{{ $meta_key }}" placeholder="{{ $meta_detail->tip }}" value="{{ $meta_detail->value }}">
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
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