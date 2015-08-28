<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <title>{{ XApp::getOrConfig('_app_title') }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        {{ HTML::style(Theme::asset('css/bootstrap.min.css')) }}
        {{ HTML::style(Theme::asset('css/font-awesome.min.css')) }}
        <!-- Theme style -->
        {{ HTML::style(Theme::asset('css/AdminLTE.css')) }}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-bruen">

        @yield('content')

        {{ HTML::script(Theme::asset('js/jquery.min.js')) }}
        {{ HTML::script(Theme::asset('js/bootstrap.min.js')) }}

        @yield('footer')
    </body>
</html>