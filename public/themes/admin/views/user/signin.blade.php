@extends('layouts.auth')

@section('content')

        <div class="form-box" id="login-box">
            <div class="header">{{ Lang::get('captions.user.sign_in') }}</div>
            {{ Form::open(array('url' => 'signin', 'method' => 'post')) }}
                <div class="body bg-gray">
    @if ( $errors->count() > 0 )
      <ul>
        @foreach( $errors->all() as $message )
          <li>{{ $message }}</li>
        @endforeach
      </ul>
    @endif
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="{{ Lang::get('captions.user.user_id') }}" autofocus value="{{ Input::old('email') }}"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="{{ Lang::get('captions.user.password') }}"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> {{ Lang::get('captions.user.remember') }}
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block">{{ Lang::get('captions.user.sign_in_btn') }}</button>
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