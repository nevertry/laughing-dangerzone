        <!-- page script -->
        <script type="text/javascript">
            $(function(){
                var autoGen = true;
                var converter = $('<textarea/>');
                var delay = delay = (function(){
                    var timer = 0;
                    return function (callback, ms){
                        clearTimeout (timer);
                        timer = setTimeout(callback, ms);
                    }
                })();

                // Check on keyup event
                $(document).on('keyup', '#riddle_answer', function(){
                    $('#autoclue_spinner').show();
                    delay(function(){
                        getAutoClues();
                    }, 2000);
                });

                // Check on checkbox checked event
                $('#autoclue_switch').on('ifChecked',function(event){
                    autoGen = true;
                    $('#autoclue_spinner').show();
                    getAutoClues();
                });

                $('#autoclue_switch').on('ifUnchecked',function(event){
                    autoGen = false;
                });

                function getAutoClues()
                {
                    var readAs = $('#riddle_answer').val();
                    var postData = {readAs: readAs};

                    $.ajax({
                        url: "{{ route('ajax.v1.dashboard.riddle.autoclues') }}",
                        method: "post",
                        data: postData
                    })
                    .done(function(result){
                        if (result.error == 0)
                        {
                            if (autoGen)
                            {
                                $('#riddle_clues').val(result.data.result.autoclues_plain);
                                readAutoClues(converter.html(result.data.result.autoclues_plain).text());
                            }

                            $('#estimated_clues').val(converter.html(result.data.result.autoclues_encoded).text());

                            $('#autoclue_spinner').hide();
                        }
                    })
                    .fail(function(result){})
                    .always(function(result){});
                }

                function initAutoClues()
                {
                    var readAs = $('#riddle_answer').val();
                    var postData = {readAs: readAs};

                    $.ajax({
                        url: "{{ route('ajax.v1.dashboard.riddle.autoclues') }}",
                        method: "post",
                        data: postData
                    })
                    .done(function(result){
                        if (result.error == 0)
                        {
                            $('#estimated_clues').val(converter.html(result.data.result.autoclues_encoded).text());
                            $('#autoclue_spinner').hide();
                        }
                    })
                    .fail(function(result){})
                    .always(function(result){});
                }

                function readAutoClues(newValue)
                {
                    $('#autoread_spinner').show();
                    if (newValue.length == 0)
                    {
                        $('#read_as').val($('#riddle_clues').val());
                    }
                    else
                    {
                        $('#read_as').val(newValue);
                    }

                    $('#autoread_spinner').hide();
                }

                // Check on keyup event
                $(document).on('keyup change', '#riddle_clues', function(){
                    readAutoClues('');
                });

                // On Copy as Clues click
                $(document).on('click', '#autoclue_copy', function(){
                    var estValue = $('#estimated_clues').val();
                    $('#riddle_clues').val(estValue);
                    readAutoClues(converter.html(estValue).text());
                });

                initAutoClues();
                readAutoClues('');
            });
        </script>