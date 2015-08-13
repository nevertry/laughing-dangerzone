@extends('layouts.default')

@section('content')
                <section class="content">
                    <div class="row">
                    	{{ ifset($content, 'No content.') }} &alpha; &beta; &gamma;
                    </div>
                </section>
@stop