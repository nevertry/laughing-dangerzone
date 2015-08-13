@extends('layouts.default')

@section('content')
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">New Riddle</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="riddle_type">Type</label>
                                            <select id="riddle_type" class="form-control" name="riddle_type">
                                                <option value="0">Text</option>
                                                <option value="1">Image</option>
                                                <option value="2">Video</option>
                                                <option value="3">Audio</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="riddle_content">Content</label>
                                            <textarea id="riddle_content" class="form-control" rows="3" placeholder="(ex.: Can be text, or URL to image/video/audio)" name="riddle_content"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="riddle_question">Question</label>
                                            <textarea id="riddle_question" class="form-control" rows="3" placeholder="(ex.: What is the name of the biggest lake in Indonesia? ...)" name="riddle_question"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="riddle_answer">Answer</label>
                                            <input id="riddle_answer" type="text" class="form-control" placeholder="(ex.: Lake Toba)" name="riddle_answer">
                                        </div>

                                        <div class="form-group">
                                            <label for="riddle_clues">Clues</label>
                                            <input id="riddle_clues" type="text" class="form-control" placeholder="(ex.: A1, B2, G1, T2)">
                                        </div>

                                        <div class="form-group">
                                            <label for="riddle_publish_status">Type</label>
                                            <select id="riddle_publish_status" class="form-control" name="riddle_publish_status">
                                                <option value="0">Published</option>
                                                <option value="1">Not Published</option>
                                            </select>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section>
@stop