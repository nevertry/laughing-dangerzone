<?php //setActiveMenuClass('dashboard', $pageinfo['menu']); ?>
<ul class="sidebar-menu">

    <li class="{{ setActiveMenuClass('dashboard', $pageinfo['menu']) }}">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

<!--
    @if (has_permission('analytics'))
    <li class="treeview {{ setActiveMenuClass('analytics', $pageinfo['menu']) }}">
        <a href="#">
            <i class="fa fa-table"></i>
            <span>{{ Lang::get('menu.analytics') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>                            

        <ul class="treeview-menu">
            @if (has_permission('analytics.answers'))
            <li class="{{ setActiveMenuClass('analytics.answers', $pageinfo['menu']) }}"><a href="{{ route('dashboard.analytics.index') }}"><i class="fa fa-angle-double-right"></i> <span>{{ Lang::get('menu.analytics.answered_riddles') }}</span></a></li>
            @endif
            @if (has_permission('analytics.winners'))
            <li class="{{ setActiveMenuClass('analytics.winners', $pageinfo['menu']) }}"><a href="{{ route('dashboard.analytics.index') }}"><i class="fa fa-angle-double-right"></i> <span>{{ Lang::get('menu.analytics.riddle_winners') }}</span></a></li>
            @endif
        </ul>
    </li>
    @endif
-->

    @if (has_permission('riddles'))
    <li class="treeview {{ setActiveMenuClass('riddles', $pageinfo['menu']) }}">
        <a href="#">
            <i class="fa fa-table"></i>
            <span>{{ Lang::get('menu.riddles') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>                            

        <ul class="treeview-menu">
            @if (has_permission('riddles.index'))
            <li class="{{ setActiveMenuClass('riddles.index', $pageinfo['menu']) }}"><a href="{{ route('dashboard.riddles.index') }}"><i class="fa fa-angle-double-right"></i> <span>{{ Lang::get('menu.riddles.index') }}</span></a></li>
            @endif
            @if (has_permission('riddles.create'))
            <li class="{{ setActiveMenuClass('riddles.create', $pageinfo['menu']) }}"><a href="{{ route('dashboard.riddles.create') }}"><i class="fa fa-angle-double-right"></i> <span>{{ Lang::get('menu.riddles.create') }}</span></a></li>
            @endif
        </ul>
    </li>
    @endif

<!--
    @if (has_permission('guests'))
    <li class="treeview {{ setActiveMenuClass('guests', $pageinfo['menu']) }}">
        <a href="#">
            <i class="fa fa-table"></i>
            <span>{{ Lang::get('menu.guests') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>                            

        <ul class="treeview-menu">
            @if (has_permission('guests.index'))
            <li class="{{ setActiveMenuClass('guests.index', $pageinfo['menu']) }}"><a href="{{ route('dashboard.guests.index') }}"><i class="fa fa-angle-double-right"></i> <span>{{ Lang::get('menu.guests.index')}}</span></a></li>
            @endif
        </ul>
    </li>
    @endif

    @if (has_permission('charmaps'))
    <li class="treeview {{ setActiveMenuClass('charmaps', $pageinfo['menu']) }}">
        <a href="#">
            <i class="fa fa-table"></i>
            <span>{{ Lang::get('menu.charmaps') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>                            

        <ul class="treeview-menu">
            @if (has_permission('charmaps.index'))
            <li class="{{ setActiveMenuClass('charmaps.index', $pageinfo['menu']) }}"><a href="{{ route('dashboard.charmaps.index') }}"><i class="fa fa-angle-double-right"></i> <span>{{ Lang::get('menu.charmaps.index')}}</span></a></li>
            @endif
        </ul>
    </li>
    @endif
-->
    @if (has_permission('settings'))
    <li class="treeview {{ setActiveMenuClass('settings', $pageinfo['menu']) }}">
        <a href="#">
            <i class="fa fa-table"></i>
            <span>{{ Lang::get('menu.settings') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>                            

        <ul class="treeview-menu">
            @if (has_permission('settings.index'))
            <li class="{{ setActiveMenuClass('settings.index', $pageinfo['menu']) }}"><a href="{{ route('dashboard.settings.app') }}"><i class="fa fa-angle-double-right"></i> <span>{{ Lang::get('menu.settings.index')}}</span></a></li>
            @endif
        </ul>
    </li>
    @endif

</ul>