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
                                    <h3 class="box-title">Editing Riddle {{ ifset($riddle_data->id) ? "#".$riddle_data->id : '' }}</h3>
                                </div><!-- /.box-header -->

                                @if ( $errors->count() > 0 )
                                <div class="row margin">
                                    <div class="col-md-12">
                                        @include('partials.error')
                                    </div>
                                </div>
                                @endif

                                <!-- form start -->
                                {{ Form::open(['action' => ['dashboard.riddles.edit', $riddle_data->id], 'role' => 'form']) }}
                                    <div class="box-body">

                                        <div class="row">
                                            <div class="form-group col-sm-3 {{ setClassHasError($errors->has('type')) }}">
                                                {{ Form::label('riddle_type', "Type") }}
                                                {{ Form::select('riddle_type', Riddle::getContentTypes(), ifset($riddle_data->type), ['class'=>"form-control"]) }}
                                            </div>
                                            <div class="form-group col-sm-3 col-sm-offset-3 {{ setClassHasError($errors->has('publish_status')) }}">
                                                {{ Form::label('riddle_publish_status', "Pubish Status") }}
                                                {{ Form::select('riddle_publish_status', Riddle::getPublishStatuses(), ifset($riddle_data->publish_status, 1), ['class'=>"form-control"]) }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6 {{ setClassHasError($errors->has('content')) }}">
                                                {{ Form::label('riddle_content', "Content") }}
                                                {{ Form::textarea('riddle_content', ifset($riddle_data->content), ['class'=>"form-control", 'placeholder'=>'(ex.: Can be text, or URL to image/video/audio)', 'rows'=>'3']) }}
                                            </div>
                                            <div class="form-group col-sm-6 col-sm-offset-0 {{ setClassHasError($errors->has('question')) }}">
                                                {{ Form::label('riddle_question', "Question") }}
                                                {{ Form::textarea('riddle_question', ifset($riddle_data->question), ['class'=>"form-control", 'placeholder'=>'(ex.: What is the name of the biggest lake in Indonesia? ...)', 'rows'=>'3']) }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6 {{ setClassHasError($errors->has('answer')) }}">
                                                {{ Form::label('riddle_answer', "Answer") }}
                                                {{ Form::text('riddle_answer', ifset($riddle_data->answer), ['class'=>"form-control", 'placeholder'=>'(ex.: Lake Toba)']) }}
                                            </div>
                                            <div class="form-group col-sm-6 col-md-offset-0 {{ setClassHasError($errors->has('clues')) }}">
                                                {{ Form::label('riddle_clues', "Clues") }}
                                                {{ Form::text('riddle_clues', ifset($riddle_data->clues), ['class'=>"form-control", 'placeholder'=>'(ex.: L1, A2, K3, E4, _, T5, O6, B7, A8)']) }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                {{ Form::label('estimated_clues', "Estimated Clues (bot)") }}
                                                {{ Form::text('estimated_clues', '', ['class'=>"form-control", 'readonly'=>"readonly", 'tabindex'=>"-1"]) }}
                                            </div>
                                            <div class="form-group col-sm-6 col-md-offset-0">
                                                {{ Form::label('read_as', "Read As") }}
                                                {{ Form::text('read_as', '', ['class'=>"form-control", 'readonly'=>"readonly", 'tabindex'=>"-1"]) }}
                                            </div>
                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        {{ Form::hidden('riddle_id', $riddle_data->id) }}
                                        {{ Form::button("Update", ['class'=>"btn btn-primary", 'type'=>"submit", 'name'=>"update", 'value'=>"1"]) }}
                                    </div>
                                {{ Form::close() }}
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section>
@stop

@section('footer')
        <!-- page script -->
        <script type="text/javascript">
            $(function(){
                $(document).on('blur', '#riddle_answer', function(){
                    getAutoClues();
                });

                function getAutoClues()
                {
                    var readAs = $('#riddle_answer').val();
                    var postData = {readAs: readAs};

                    $.ajax({
                        url: "{{ route('ajax.v1.dashboard.riddle.autoclues') }}",
                        method: "post",
                        data: postData
                    })
                    .done(function(result){
                        if (result.error == 0)
                        {
                            $('#estimated_clues').val($('<textarea/>').html(result.data.result.autoclues_encoded).text());
                            $('#riddle_clues').val($('<textarea/>').html(result.data.result.autoclues_encoded).text());
                            $('#read_as').val($('<textarea/>').html(result.data.result.autoclues_plain).text());
                        }
                    })
                    .fail(function(result){})
                    .always(function(result){});
                }

                getAutoClues();
            });
        </script>
@stop