@extends('layouts.default')

@section('content')
                <section class="content">
                    <div class="row">
                    	<div class="col-md-6">
                    		{{ ifset($content, 'No content.') }} &alpha; &beta; &gamma; &theta;
                    	</div>
                    </div>
                </section>
@stop