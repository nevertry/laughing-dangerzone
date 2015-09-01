@extends('layouts.default')

@section('content')
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3 id="node_riddle_count">
                                        (counting...)
                                    </h3>
                                    <p>
                                        Registered Riddles
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="{{ route('dashboard.guests') }}" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3 id="node_guest_count">
                                        (counting...)
                                    </h3>
                                    <p>
                                        Guest Registration
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-7 connectedSortable">
                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable">
                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->
                </section>
@stop

@section('footer')
<script type="text/javascript">
// Run document ready script
$(function(){
    function getRiddleCount()
    {
        var element = $('#node_riddle_count');
        $.ajax({
            url: "{{ route('ajax.v1.dashboard.riddle.count') }}"
        })
        .done(function(result) {
            if (result.error == 0)
            {
                element.text(result.data.count);
            }
        })
        .fail(function(result) {
            console.log(result);
        })
        .always(function(result) {
            console.log(result);
        });
    }

    function getGuestCount()
    {
        var element = $('#node_guest_count');
        $.ajax({
            url: "{{ route('ajax.v1.dashboard.guest.count') }}"
        })
        .done(function(result) {
            if (result.error == 0)
            {
                element.text(result.data.count);
            }
        })
        .fail(function(result) {
            console.log(result);
        })
        .always(function(result) {
            console.log(result);
        });
    }

    // get number of riddle
    getRiddleCount();

    // get number of registered guests
    getGuestCount();
});
</script>
@stop