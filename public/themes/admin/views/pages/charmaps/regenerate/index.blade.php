@extends('layouts.default')

@section('content')
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Regenerate Clues</h3>
                                </div><!-- /.box-header -->

                                @include('partials.info')

                                @if ( $errors->count() > 0 )
                                <div class="row margin">
                                    <div class="col-md-12">
                                        @include('partials.error')
                                    </div>
                                </div>
                                @endif

                                <div class="box-body">

                                    <div id="regen-question">
                                        <div>Do you wish to regenerate riddle's clues by answer? <a id="regen-execute" href="javascript:void(0)" onclick="regenExecute()" class="btn btn-warning btn-lg"><i class="fa fa-repeat"></i> Regen!</a></div>
                                    </div>

                                    <div id="regen-progress" class="hidden">
                                        <div class="progress progress-striped active" id="regen-progress-container">
                                            <div id="regen-progress-bar" class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                <span id="regen-progress-text">0% Complete</span>
                                            </div>
                                        </div>
                                        <div id="regen-log">
                                            <div>
                                                <button class="btn btn-success btn-flat margin"><i class="fa fa-check"></i> <span id="regen-log-success-count">0</span> Success.</button>
                                                <button class="btn btn-danger btn-flat margin"><i class="fa fa-times"></i> <span id="regen-log-fail-count">0</span> Failed.</button>
                                            </div>

                                            <ul class="timeline" id="regen-log-list">

                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div><!-- /.box -->

                        </div>
                    </div>
                </section>

                <form id="executioner" class="hidden" method="post"></form>
@stop

@section('footer')
        <!-- page script -->
        <script type="text/javascript">
            var riddleBatch = [];
            var progressDefault = {
                valuenow: 0,
                width: '%',
                text: '% Complete',
                increment: 0
            }
            var progressActive = {
                valuenow: 0,
            }

            var ajaxManager = (function() {
                var requests = [];

                return {
                    addReq:  function(opt) {
                        requests.push(opt);
                    },
                    removeReq:  function(opt) {
                        if( $.inArray(opt, requests) > -1 )
                            requests.splice($.inArray(opt, requests), 1);
                    },
                    run: function() {
                        var self = this,
                        oriSuc;

                        if( requests.length ) {
                            oriSuc = requests[0].complete;

                            requests[0].complete = function() {
                                if( typeof(oriSuc) === 'function' ) oriSuc();
                                requests.shift();
                                self.run.apply(self, []);
                            };   

                            $.ajax(requests[0]);
                        } else {
                            self.tid = setTimeout(function() {
                                self.run.apply(self, []);
                            }, 1000);
                        }
                    },
                    stop:  function() {
                        requests = [];
                        clearTimeout(this.tid);
                    }
                };
            }());

            function regenExecute()
            {
                var confirmation = confirm('{{ trans("This cannot be undo. Are you sure?") }}');

                if (confirmation)
                {
                    $('#regen-question').hide();
                    $('#regen-progress').removeClass('hidden');

                    regenerateClues(getRiddles());
                }
            }

            function getRiddles()
            {
                riddleIds = [];
                $.ajax({
                        url: "{{ route('ajax.v1.riddle.getids') }}",
                        async: false,
                        success: function(result){
                            riddleIds = result.data;
                        }
                    });
                return riddleIds;
            }

            function regenerateClues(riddleBatch)
            {
                // Reset Progress Bar
                resetProgressBar(progressDefault, 100/riddleBatch.length);

                for (key in riddleBatch)
                {
                    if (riddleBatch.hasOwnProperty(key)  && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294)
                    {
                        setClues(riddleBatch[key]);
                    }
                }
            }

            function setClues(riddleId)
            {
                ajaxManager.addReq({
                    url: "{{ route('ajax.v1.riddle.regenerate') }}",
                    data: {riddle_id: riddleId},
                    success: function(result){
                        generateLog(result);
                    }
                });
            }

            function generateLog(riddleData)
            {
                var d = new Date();
                var time = d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
                var htmlResult = '';

                if (riddleData.error == 0)
                {
                    $('#regen-log-success-count').text(parseInt($('#regen-log-success-count').text())+1);
                    htmlResult =
                        '<li>'+
                            '<i class="fa fa-repeat bg-blue"></i>'+
                            '<div class="timeline-item">'+
                                '<span class="time"><i class="fa fa-clock-o"></i> '+time+'</span>'+
                                '<h3 class="timeline-header"><a href="#">Riddle #'+riddleData.data.id+' clue has regenerated.</a></h3>'+
                                '<div class="timeline-body">'+
                                    'New Clues: '+riddleData.data.clues_box+
                                '</div>'+
                            '</div>'+
                        '</li>';
                }
                else
                {
                    $('#regen-log-fail-count').text(parseInt($('#regen-log-fail-count').text())+1);
                    htmlResult =
                        '<li>'+
                            '<i class="fa fa-repeat bg-blue"></i>'+
                            '<div class="timeline-item">'+
                                '<span class="time"><i class="fa fa-clock-o"></i> '+time+'</span>'+
                                '<h3 class="timeline-header"><a href="#">Riddle #'+riddleData.data.id+' clue has failed to regenerate.</a></h3>'+
                            '</div>'+
                        '</li>';

                }

                progressActive.valuenow = progressActive.valuenow + progressDefault.increment;
                updateProgressBar(progressActive);

                $('#regen-log-list').prepend(htmlResult);

                if (progressActive.valuenow >= 99.9)
                {
                    $('#regen-progress-container').removeClass('active');
                }
            }


            function updateProgressBar(progress)
            {
                $('#regen-progress-bar').attr('aria-valuenow', progress.valuenow);
                $('#regen-progress-bar').css('width', progress.valuenow+progressDefault.width);
                $('#regen-progress-text').text(progress.valuenow+progressDefault.text);
            }

            function resetProgressBar(progress, counter)
            {
                updateProgressBar(progress);
                progressDefault.increment = counter;
            }


            $(function(){
                ajaxManager.run();
            });
        </script>
@stop