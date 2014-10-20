@extends('layouts.auth')

@section('content')

        <div class="form-box" id="login-box">
            <div class="header">{{ Lang::get('captions.user.sign_in') }}</div>
            {{ Form::open(array('url' => 'signin', 'method' => 'post')) }}
                <div class="body bg-gray">
                    @include('partials.error')

                    <div class="form-group">
                        {{ Form::text('email', Input::old('email'), ['class' => 'form-control', 'placeholder' => Lang::get('captions.user.user_id'), 'autofocus']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => Lang::get('captions.user.password')]) }}
                    </div>          
                    <div class="form-group">
                        {{ Form::checkbox('remember_me', 'value') }} {{ Lang::get('captions.user.remember') }}
                    </div>
                </div>
                <div class="footer">
                    {{ Form::submit(Lang::get('captions.user.sign_in_btn'), ['class' => 'btn bg-olive btn-block']) }}
<!-- 
                    <p>{{ HTML::link('reset-password', Lang::get('captions.user.forgot_link')) }}</p>
                    <a href="#" class="text-center">{{ Lang::get('captions.user.register_link') }}</a> -->
                </div>
            {{ Form::close() }}
<!-- 
             <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>
            </div> -->
        </div>
@stop