<ul class="sidebar-menu">
    <li class="active">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>Pengguna</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="/user/profile"><i class="fa fa-user"></i> Profil</a></li>
            <li><a href="/user/list"><i class="fa fa-user"></i> Daftar Pengguna</a></li>
            <li><a href="/user/group"><i class="fa fa-group"></i> Daftar Grup</a></li>
        </ul>
    </li>
</ul>