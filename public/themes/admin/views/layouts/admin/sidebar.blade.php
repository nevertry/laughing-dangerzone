            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ Theme::asset('img/avatar3.png') }}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Admin</p>
                            {{-- $userdata --}}<!-- composer pass test -->

<!--                             <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
                        </div>
                    </div>
                    <!-- search form -->
<!--                     <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form> -->
                    <!-- /.search form -->

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    @include('partials.sidemenu')

                </section>
                <!-- /.sidebar -->
            </aside>