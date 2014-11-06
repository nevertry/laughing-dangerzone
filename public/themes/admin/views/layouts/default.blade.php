<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Air Minum Terpadu</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        {{ HTML::style(Theme::asset('css/bootstrap.min.css')) }}
        {{ HTML::style(Theme::asset('css/font-awesome.min.css')) }}
        {{ HTML::style(Theme::asset('css/ionicons.min.css')) }}
        <!-- Morris chart -->
        {{ HTML::style(Theme::asset('css/morris/morris.css')) }}
        <!-- jvectormap -->
        {{ HTML::style(Theme::asset('css/jvectormap/jquery-jvectormap-1.2.2.css')) }}
        <!-- Date Picker -->
        {{ HTML::style(Theme::asset('css/datepicker/datepicker3.css')) }}
        <!-- Daterange picker -->
        {{ HTML::style(Theme::asset('css/daterangepicker/daterangepicker-bs3.css')) }}
        <!-- bootstrap wysihtml5 - text editor -->
        {{ HTML::style(Theme::asset('css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')) }}
        <!-- selectize -->
        {{ HTML::style(Theme::asset('css/selectize.css')) }}
        {{ HTML::style(Theme::asset('css/selectize.bootstrap3.css')) }}
        <!-- Theme style -->
        {{ HTML::style(Theme::asset('css/AdminLTE.css')) }}
        <!-- Custom Theme style -->
        {{ HTML::style(Theme::asset('css/custom.css')) }}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-grue">
        <!-- header logo: style can be found in header.less -->
        @include('layouts.admin.header')
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.admin.sidebar')

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                @include('partials.content_header')

                <!-- Main content -->
                @yield('content', 'No content.')
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->

        {{ HTML::script(Theme::asset('js/jquery.min.js')) }}
        {{ HTML::script(Theme::asset('js/jquery-ui.min.js')) }}
        {{ HTML::script(Theme::asset('js/bootstrap.min.js')) }}
        <!-- Morris.js charts -->
        {{-- HTML::script(Theme::asset('js/raphael-min.js')) --}}
        {{-- HTML::script(Theme::asset('js/plugins/morris/morris.min.js')) --}}
        <!-- Sparkline -->
        {{ HTML::script(Theme::asset('js/plugins/sparkline/jquery.sparkline.min.js')) }}
        <!-- jvectormap -->
        {{ HTML::script(Theme::asset('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')) }}
        {{ HTML::script(Theme::asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')) }}
        <!-- jQuery Knob Chart -->
        {{ HTML::script(Theme::asset('js/plugins/jqueryKnob/jquery.knob.js')) }}
        <!-- daterangepicker -->
        {{ HTML::script(Theme::asset('js/plugins/daterangepicker/daterangepicker.js')) }}
        <!-- datepicker -->
        {{ HTML::script(Theme::asset('js/plugins/datepicker/bootstrap-datepicker.js')) }}
        <!-- Bootstrap WYSIHTML5 -->
        {{ HTML::script(Theme::asset('js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')) }}
        <!-- iCheck -->
        {{ HTML::script(Theme::asset('js/plugins/iCheck/icheck.min.js')) }}

        <!-- AdminLTE App -->
        {{ HTML::script(Theme::asset('js/AdminLTE/app.js')) }}

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        {{-- HTML::script(Theme::asset('js/AdminLTE/dashboard.js')) --}}

        <!-- AdminLTE for demo purposes -->
        <!-- {{ HTML::script(Theme::asset('js/AdminLTE/demo.js')) }} -->
        @yield('footer')
    </body>
</html>