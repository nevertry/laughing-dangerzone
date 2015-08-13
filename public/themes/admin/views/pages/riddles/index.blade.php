@extends('layouts.default')

@section('content')
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-6">
                            {{ ifset($content, "No content yet.") }}
                        </div>
                    </div>
                </section>
@stop