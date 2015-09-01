@extends('layouts.default')

@section('content')
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Editing Guest {{ ifset($guest_data->id) ? "#".$guest_data->id : '' }}</h3>
                                </div><!-- /.box-header -->

                                @if ( $errors->count() > 0 )
                                <div class="row margin">
                                    <div class="col-md-12">
                                        @include('partials.error')
                                    </div>
                                </div>
                                @endif

                                <!-- form start -->
                                {{ Form::open(['action' => ['dashboard.guests.edit', $guest_data->id], 'role' => 'form']) }}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-sm-6 {{ setClassHasError($errors->has('email')) }}">
                                                {{ Form::label('guest_email', "E-mail") }}
                                                {{ Form::text('guest_email', ifset($guest_data->email), ['class'=>"form-control"]) }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6 {{ setClassHasError($errors->has('name')) }}">
                                                {{ Form::label('guest_name', "Name") }}
                                                {{ Form::text('guest_name', ifset($guest_data->name), ['class'=>"form-control"]) }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6 {{ setClassHasError($errors->has('riddle_id')) }}">
                                                {{ Form::label('guest_riddle_id', "Riddle ID") }}
                                                {{ Form::text('guest_riddle_id', ifset($guest_data->riddle_id), ['class'=>"form-control"]) }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6 {{ setClassHasError($errors->has('status')) }}">
                                                {{ Form::label('guest_status', "Status") }}
                                                {{ Form::text('guest_status', ifset($guest_data->status), ['class'=>"form-control"]) }}
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        {{ Form::hidden('guest_id', $guest_data->id) }}
                                        {{ Form::button("Update", ['class'=>"btn btn-primary", 'type'=>"submit", 'name'=>"update", 'value'=>"1"]) }}
                                    </div>
                                {{ Form::close() }}
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section>
@stop