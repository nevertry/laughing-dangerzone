@extends('layouts.default')

@section('content')
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Editing Letter {{ ifset($data_charmap->letter) ? '<strong>'.$data_charmap->letter.'</strong>' : '' }}</h3>
                                </div><!-- /.box-header -->

                                @if ( $errors->count() > 0 )
                                <div class="row margin">
                                    <div class="col-md-12">
                                        @include('partials.error')
                                    </div>
                                </div>
                                @endif
                                
                                <div class="box-body">
                                    <h4 class="page-header">Dictionary</h4>
                                    <div class="row">
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;alpha;</div><div class="col-sm-1 col-sm-offset-3">&alpha;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;beta;</div><div class="col-sm-1 col-sm-offset-3">&beta;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;gamma;</div><div class="col-sm-1 col-sm-offset-3">&gamma;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;delta;</div><div class="col-sm-1 col-sm-offset-3">&delta;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;epsilon;</div><div class="col-sm-1 col-sm-offset-3">&epsilon;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;zeta;</div><div class="col-sm-1 col-sm-offset-3">&zeta;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;eta;</div><div class="col-sm-1 col-sm-offset-3">&eta;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;theta;</div><div class="col-sm-1 col-sm-offset-3">&theta;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;iota;</div><div class="col-sm-1 col-sm-offset-3">&iota;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;kappa;</div><div class="col-sm-1 col-sm-offset-3">&kappa;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;lambda;</div><div class="col-sm-1 col-sm-offset-3">&lambda;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;mu;</div><div class="col-sm-1 col-sm-offset-3">&mu;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;nu;</div><div class="col-sm-1 col-sm-offset-3">&nu;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;xi;</div><div class="col-sm-1 col-sm-offset-3">&xi;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;omicron;</div><div class="col-sm-1 col-sm-offset-3">&omicron;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;pi;</div><div class="col-sm-1 col-sm-offset-3">&pi;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;rho;</div><div class="col-sm-1 col-sm-offset-3">&rho;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;sigmaf;</div><div class="col-sm-1 col-sm-offset-3">&sigmaf;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;sigma;</div><div class="col-sm-1 col-sm-offset-3">&sigma;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;tau;</div><div class="col-sm-1 col-sm-offset-3">&tau;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;upsilon;</div><div class="col-sm-1 col-sm-offset-3">&upsilon;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;phi;</div><div class="col-sm-1 col-sm-offset-3">&phi;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;chi;</div><div class="col-sm-1 col-sm-offset-3">&chi;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;psi;</div><div class="col-sm-1 col-sm-offset-3">&psi;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;omega;</div><div class="col-sm-1 col-sm-offset-3">&omega;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;thetasym;</div><div class="col-sm-1 col-sm-offset-3">&thetasym;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;upsih;</div><div class="col-sm-1 col-sm-offset-3">&upsih;</div></div></div>
                                        <div class="col-sm-2"><div class="row"><div class="col-sm-1">&amp;piv;</div><div class="col-sm-1 col-sm-offset-3">&piv;</div></div></div>
                                    </div> <!-- /.row Dictionary -->
                                </div><!-- /.box-body -->

                                {{ Form::open(['action' => ['dashboard.charmaps.edit', $data_charmap->letter], 'role' => 'form']) }}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-sm-4 {{ setClassHasError($errors->has('letter')) }}">
                                                {{ Form::label('charmap_letter', "Letter") }}
                                                {{ Form::text('charmap_letter', ifset($data_charmap->letter), ['class'=>"form-control", 'readonly'=>"readonly"]) }}
                                            </div>
                                            <div class="form-group col-sm-4 {{ setClassHasError($errors->has('symbol')) }}">
                                                {{ Form::label('charmap_symbol', "Substitution/Symbol") }}
                                                {{ Form::text('charmap_symbol', ifset(htmlentities($data_charmap->symbol)), ['class'=>"form-control"]) }}
                                            </div>
                                            <div class="form-group col-sm-4">
                                                {{ Form::label('charmap_read_as', "Read As") }}
                                                {{ Form::text('charmap_read_as', ifset($data_charmap->symbol), ['class'=>"form-control", 'readonly'=>"readonly"]) }}
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        {{ Form::hidden('charmap_letter', $data_charmap->letter) }}
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
                $(document).on('keyup blur change', '#charmap_symbol', function(){
                    var readAs = $(this).val();
                    $('#charmap_read_as').val($('<textarea/>').html(readAs).text());
                });
            });
        </script>
@stop