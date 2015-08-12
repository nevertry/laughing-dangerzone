<ul class="sidebar-menu">

    <li class="{{ setActiveMenuClass('dashboard', $pageinfo['menu']) }}">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    @if (has_permission('analytics'))
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i>
            <span>{{ Lang::get('menu.analytics') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>                            

        <ul class="treeview-menu">
            @if (has_permission('analytics.answers'))
            <li class="{{ setActiveMenuClass('analytics.answers', $pageinfo['menu']) }}"><a href="#Analytics-Answers"><i class="fa fa-angle-double-right"></i> <span>{{ Lang::get('menu.analytics.answered_riddles') }}</span></a></li>
            @endif
            @if (has_permission('analytics.winners'))
            <li class="{{ setActiveMenuClass('analytics.winners', $pageinfo['menu']) }}"><a href="#Analytics-Winner"><i class="fa fa-angle-double-right"></i> <span>{{ Lang::get('menu.analytics.riddle_winners') }}</span></a></li>
            @endif
        </ul>
    </li>
    @endif

    @if (has_permission('riddles'))
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i>
            <span>{{ Lang::get('menu.riddles') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>                            

        <ul class="treeview-menu">
            @if (has_permission('riddles.list'))
            <li class="{{ setActiveMenuClass('masterdata.index', $pageinfo['menu']) }}"><a href="#Riddle-List"><i class="fa fa-angle-double-right"></i> <span>{{ Lang::get('menu.riddles.list') }}</span></a></li>
            @endif
            @if (has_permission('riddles.create'))
            <li class="{{ setActiveMenuClass('riddles.create', $pageinfo['menu']) }}"><a href="#Riddle-Create"><i class="fa fa-angle-double-right"></i> <span>{{ Lang::get('menu.riddles.create') }}</span></a></li>
            @endif
        </ul>
    </li>
    @endif

    @if (has_permission('guests'))
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i>
            <span>{{ Lang::get('menu.guests') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>                            

        <ul class="treeview-menu">
            @if (has_permission('guests.list'))
            <li class="{{ setActiveMenuClass('masterdata.index', $pageinfo['menu']) }}"><a href="#User-List"><i class="fa fa-angle-double-right"></i> <span>{{ Lang::get('menu.guests.list')}}</span></a></li>
            @endif
        </ul>
    </li>
    @endif

</ul>