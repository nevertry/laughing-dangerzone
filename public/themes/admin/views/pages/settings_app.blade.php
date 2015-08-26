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
                                {{ Form::open(array('action' => 'dashboard.settings.update', 'role' => 'form')) }}
                                    {{ Form::hidden('setting_name', $setting_name) }}
                                    <div class="box-body">
                                    @forelse ($settings as $k_setting => $setting)
                                        @if (!in_array($k_setting, $settings_excluded))
                                        {{ XForm::generate([
                                                'name'        => $k_setting,
                                                'type'        => $setting['type'],
                                                'label'       => $setting['label'],
                                                'value'       => ifset($setting['value'], $setting['default']),
                                                'class'       => "form-control",
                                                'placeholder' => $setting['placeholder'],
                                                'tip'         => ifset($setting['tip']),
                                            ]); }}
                                        @endif
                                    @empty
                                        No Setting found.
                                    @endforelse
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