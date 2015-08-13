@extends('layouts.default')

@section('content')
                <section class="content">
                    <div class="error-page">
                        <h2 class="headline text-info"> +</h2>
                        <div class="error-content">
                        	@if (isset($content))
                        		{{ $content }}
                        	@else
                            <h3><i class="fa fa-warning text-yellow"></i> A sleeping admin is blocking the way!</h3>
                            <p>
                                Go to the top of the admin tower in lavender town and beat team rocket and then Mr. Fuji will give you the admin flute.
                                Then use it on the admin and catch it. First you have to obtain the Silph Scope from the Rocket Hideout in Saffron City.
                                <br/>
                                Meanwhile, you may <a href='/'>return to dashboard</a> or try praying.
                            </p>
                            @endif
                        </div><!-- /.error-content -->
                    </div><!-- /.error-page -->
                </section>
@stop