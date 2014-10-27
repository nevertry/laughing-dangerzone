<ul class="sidebar-menu">

    <li class="{{ setActiveMenuClass('dashboard', $pageinfo['menu']) }}">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    @if (has_permission('masterdata'))
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i>
            <span>Master Data</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>                            

        <ul class="treeview-menu">
            @if (has_permission('masterdata.unit'))
            <li><a href="#Master-Unit-Wilayah"><i class="fa fa-angle-double-right"></i> <span>Unit/Wilayah</span></a></li>
            @endif
            @if (has_permission('masterdata.pekerjaan'))
            <li><a href="#Master-Pekerjaan"><i class="fa fa-angle-double-right"></i> <span>Pekerjaan</span></a></li>
            @endif
            @if (has_permission('masterdata.peralatan'))
            <li><a href="#Master-Peralatan"><i class="fa fa-angle-double-right"></i> <span>Peralatan</span></a></li>
            @endif
        </ul>
    </li>
    @endif

    @if (has_permission('tarif'))
    <li class="treeview">
        <a href="#">
            <i class="fa fa-money"></i>
            <span>Tarif</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu">
            @if (has_permission('tarif.sk'))
            <li><a href="#Tarif-SK"><i class="fa fa-angle-double-right"></i> <span>SK Tarif</span></a></li>
            @endif
            @if (has_permission('tarif.jenis'))
            <li><a href="#Tarif-Jenis"><i class="fa fa-angle-double-right"></i> <span>Jenis Tarif</span></a></li>
            @endif
            @if (has_permission('tarif.peruntukan'))
            <li><a href="#Tarif-Peruntukan"><i class="fa fa-angle-double-right"></i> <span>Peruntukan</span></a></li>
            @endif
        </ul>
    </li>
    @endif

    @if (has_permission('akuntansi'))
    <li class="treeview">
        <a href="#">
            <i class="fa fa-book"></i>
            <span>Akuntansi</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>                            

        <ul class="treeview-menu">
            @if (has_permission('akuntansi'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    <span>Daftar Akun</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                @if (has_permission('akuntansi.akun'))
                <ul class="treeview-menu">
                    <li><a href="#CoA"><i class="fa fa-angle-right"></i> <span>Semua</span></a></li>
                    <li><a href="#Aset-Lancar"><i class="fa fa-angle-right"></i> <span>Aset Lancar</span></a></li>
                    <li><a href="#Aset-Tidak-Lancar"><i class="fa fa-angle-right"></i> <span>Aset Tidak Lancar</span></a></li>
                    <li><a href="#Kewajiban-Jangka-Pendek"><i class="fa fa-angle-right"></i> <span>Kewajiban Jangka Pendek</span></a></li>
                    <li><a href="#Kewajiban-Jangka-Panjang-dan-Lain-lain"><i class="fa fa-angle-right"></i> <span>Kewajiban Jangka Panjang dan Lain-lain</span></a></li>
                    <li><a href="#Ekuitas"><i class="fa fa-angle-right"></i> <span>Ekuitas</span></a></li>
                    <li><a href="#Pendapatan"><i class="fa fa-angle-right"></i> <span>Pendapatan</span></a></li>
                    <li><a href="#Beban-Operasional"><i class="fa fa-angle-right"></i> <span>Beban Operasional</span></a></li>
                </ul>
                @endif
            </li>
            @endif

            @if (has_permission('akuntansi.jurnal'))
            <li class="treeview">
                <a href="#Jurnal">
                    <i class="fa fa-angle-double-right"></i>
                    <span>Jurnal</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li><a href="#Daftar-Jurnal"><i class="fa fa-angle-right"></i> <span>Daftar Jurnal</span></a></li>
                </ul>
            </li>
            @endif

        </ul>
    </li>
    @endif

    @if (has_permission('pelanggan'))
    <li class="treeview">
        <a href="#">
            <i class="fa fa-male"></i> <span>Pelanggan</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="#Tambah-Pelanggan">
                    <i class="fa fa-angle-double-right"></i> 
                    <span>Tambah Pelanggan</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#Daftar-Pelanggan">
                    <i class="fa fa-angle-double-right"></i> 
                    <span>Daftar Pelanggan</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li><a href="#Pelanggan-Semua"><i class="fa fa-angle-right"></i> <span>Semua</span></a></li>
                    <li><a href="#Pelanggan-Calon"><i class="fa fa-angle-right"></i> <span>Calon</span></a></li>
                    <li><a href="#Pelanggan-Teguran"><i class="fa fa-angle-right"></i> <span>Teguran</span></a></li>
                    <li><a href="#Pelanggan-Tidah-Aktif"><i class="fa fa-angle-right"></i> <span>Non Aktif</span></a></li>
                    <li><a href="#Pelanggan-Dicabut"><i class="fa fa-angle-right"></i> <span>Dicabut</span></a></li>
                </ul>

            </li>
        </ul>
    </li>
    @endif

    @if (has_permission('tagihan'))
    <li class="treeview">
        <a href="#">
            <i class="fa fa-credit-card">
            </i> <span>Tagihan</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="#Tagihan-Bulanan"><i class="fa fa-angle-double-right"></i> <span>Tagihan Bulanan</span></a></li>
            <li><a href="#Tagihan-RAB"><i class="fa fa-angle-double-right"></i> <span>Tagihan RAB</span></a></li>
        </ul>
    </li>
    @endif

    @if (has_permission('catatmeter'))
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i>
            <span>Catat Meter</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="#Daftar-Pencatatan"><i class="fa fa-angle-double-right"></i> <span>Tambah Catat Meter</span></a></li>
        </ul>
    </li>
    @endif

    @if (has_permission('pengguna'))
    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i>
            <span>Pengguna</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            @if (has_permission('pengguna.profil'))
            <li><a href="#Profil"><i class="fa fa-angle-double-right"></i> <span>Profil</span></a></li>
            @endif
            @if (has_permission('pengguna.id'))
            <li><a href="#Daftar-Pengguna"><i class="fa fa-angle-double-right"></i> <span>Daftar Pengguna</span></a></li>
            @endif
            @if (has_permission('pengguna.grup'))
            <li><a href="#Daftar-Grup"><i class="fa fa-angle-double-right"></i> <span>Daftar Grup</span></a></li>
            @endif
        </ul>
    </li>
    @endif

    @if (has_permission('pengaturan'))
    <li class="treeview {{ setActiveMenuClass('pengaturan', $pageinfo['menu']) }}">
        <a href="#">
            <i class="fa fa-gears"></i>
            <span>Pengaturan</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            @if (has_permission('pengaturan.aplikasi'))
            <li class="{{ setActiveMenuClass('pengaturan.aplikasi', $pageinfo['menu']) }}"><a href="{{ route('pengaturan.aplikasi') }}"><i class="fa fa-angle-double-right"></i> <span>Aplikasi<span></a></li>
            @endif
            @if (has_permission('pengaturan.laporan'))
            <li class="{{ setActiveMenuClass('pengaturan.laporan', $pageinfo['menu']) }}"><a href="{{ route('pengaturan.laporan') }}"><i class="fa fa-angle-double-right"></i> <span>Laporan<span></a></li>
            @endif
        </ul>
    </li>
    @endif
</ul>