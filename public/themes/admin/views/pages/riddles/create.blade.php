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
                                    <h3 class="box-title">New Riddle</h3>
                                </div><!-- /.box-header -->

                                @if ( $errors->count() > 0 )
                                <div class="row margin">
                                    <div class="col-md-12">
                                        @include('partials.error')
                                    </div>
                                </div>
                                @endif

                                <!-- form start -->
                                {{ Form::open(array('action' => 'dashboard.riddles.create', 'role' => 'form')) }}
                                    <div class="box-body">

                                        <div class="row">
                                            <div class="form-group col-sm-3 {{ setClassHasError($errors->has('type')) }}">
                                                {{ Form::label('riddle_type', "Type") }}
                                                {{ Form::select('riddle_type', Riddle::getContentTypes(), ifpset($riddle_data, 'riddle_type'), ['class'=>"form-control"]) }}
                                            </div>
                                            <div class="form-group col-sm-3 col-sm-offset-3 {{ setClassHasError($errors->has('publish_status')) }}">
                                                {{ Form::label('riddle_publish_status', "Pubish Status") }}
                                                {{ Form::select('riddle_publish_status', Riddle::getPublishStatuses(), ifpset($riddle_data, 'riddle_publish_status', 1), ['class'=>"form-control"]) }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6 {{ setClassHasError($errors->has('content')) }}">
                                                {{ Form::label('riddle_content', "Content") }}
                                                {{ Form::textarea('riddle_content', ifpset($riddle_data, 'riddle_content'), ['class'=>"form-control", 'placeholder'=>'(ex.: Can be text, or URL to image/video/audio)', 'rows'=>'3']) }}
                                            </div>
                                            <div class="form-group col-sm-6 col-sm-offset-0 {{ setClassHasError($errors->has('question')) }}">
                                                {{ Form::label('riddle_question', "Question") }}
                                                {{ Form::textarea('riddle_question', ifpset($riddle_data, 'riddle_question'), ['class'=>"form-control", 'placeholder'=>'(ex.: What is the name of the biggest lake in Indonesia? ...)', 'rows'=>'3']) }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6 {{ setClassHasError($errors->has('answer')) }}">
                                                <label class="form-item-floating-text">Generate Autoclues <input id="autoclue_switch" type="checkbox" class="flat-red" checked="checked"></label>
                                                {{ Form::label('riddle_answer', "Answer") }}
                                                {{ Form::text('riddle_answer', ifpset($riddle_data, 'riddle_answer'), ['class'=>"form-control", 'placeholder'=>'(ex.: Lake Toba)']) }}
                                                <span id="autoclue_spinner" style="display:none"><i class="fa fa-spinner fa-spin"></i></span>
                                            </div>
                                            <div class="form-group col-sm-6 col-md-offset-0 {{ setClassHasError($errors->has('clues')) }}">
                                                {{ Form::label('riddle_clues', "Clues") }}
                                                {{ Form::text('riddle_clues', ifpset($riddle_data, 'riddle_clues'), ['class'=>"form-control", 'placeholder'=>'(ex.: L1, A2, K3, E4, _, T5, O6, B7, A8)']) }}
                                                <span id="autoread_spinner" style="display:none"><i class="fa fa-spinner fa-spin"></i></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                {{ Form::label('estimated_clues', "Estimated Clues (bot)") }}
                                                {{ Form::text('estimated_clues', '', ['class'=>"form-control", 'readonly'=>"readonly", 'tabindex'=>"-1"]) }}
                                                <span id="autoclue_copy" class="btn btn-warning btn-sm">Copy as Clues</span>
                                            </div>
                                            <div class="form-group col-sm-6 col-md-offset-0">
                                                {{ Form::label('read_as', "Read As") }}
                                                {{ Form::text('read_as', '', ['class'=>"form-control", 'readonly'=>"readonly", 'tabindex'=>"-1"]) }}
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        {{ Form::button("Save &amp; Continue", ['class'=>"btn btn-primary", 'type'=>"submit", 'name'=>"createMore", 'value'=>"1"]) }}
                                        {{ Form::button("Save", ['class'=>"btn btn-primary", 'type'=>"submit", 'name'=>"createOnce", 'value'=>"1"]) }}
                                    </div>
                                {{ Form::close() }}
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section>
@stop

@section('footer')
    @include('partials.js.riddles_autoclues')
@stop