<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                @if (auth()->user()->roles->role == 1)
                    <li class="{{ request()->is('/home') ? 'sidebar-item selected' : 'sidebar-item' }}"> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link" href="/home"
                            aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                class="hide-menu">Dashboard</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)" aria-expanded="false"><i class="fas fa-cogs"></i><span
                                class="hide-menu">Manajemen Admin </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/admin/monitoring') }}" aria-expanded="false">
                                    <i class="fa fa-file"></i>
                                    <span class="hide-menu">Monitoring Pengisian</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/admin/unlock') }}" aria-expanded="false">
                                    <i class="fa fa-unlock"></i>
                                    <span class="hide-menu">Unlock Finalisasi</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/admin/showUser') }}" aria-expanded="false">
                                    <i class="fa fa-sitemap"></i>
                                    <span class="hide-menu">Akun Login Sekolah</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-asterisk"></i><span
                                class="hide-menu">Admin </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/admin/allSekolah') }}" aria-expanded="false">
                                    <i class="mdi mdi-home-variant"></i>
                                    <span class="hide-menu">SMA/SMK</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/admin/smp') }}" aria-expanded="false">
                                    <i class="mdi mdi-home-variant"></i>
                                    <span class="hide-menu">SMP/MTS</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/admin/dp') }}" aria-expanded="false">
                                    <i class="mdi mdi-account"></i>
                                    <span class="hide-menu">Siswa Tidak Fix</span>
                                </a>
                            </li>
                            <!-- <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/admin/monitoring') }}" aria-expanded="false">
                                    <i class="mdi mdi-account"></i>
                                    <span class="hide-menu">Monitoring</span>
                                </a>
                            </li> -->
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/admin/siswas') }}" aria-expanded="false">
                                    <i class="mdi mdi-account"></i>
                                    <span class="hide-menu">Siswa Fix</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-all-inclusive"></i><span
                                class="hide-menu">Management </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/admin/genUsers') }}" aria-expanded="false">
                                    <i class="mdi mdi-math-compass"></i>
                                    <span class="hide-menu">Generate User</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/admin/showUser') }}" aria-expanded="false">
                                    <i class="mdi mdi-magnify-minus"></i>
                                    <span class="hide-menu">Show UserName</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/admin/unlock') }}" aria-expanded="false">
                                    <i class="mdi mdi-account"></i>
                                    <span class="hide-menu">Unlock</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/admin/siswas') }}" aria-expanded="false">
                                    <i class="mdi mdi-account"></i>
                                    <span class="hide-menu">Siswa Fix</span>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="/logout" aria-expanded="false"><i class="mdi mdi-power"></i><span
                                class="hide-menu">Logout</span></a></li>
                @else
                    <li class="{{ request()->is('/home') ? 'sidebar-item selected' : 'sidebar-item' }}"> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link" href="/home"
                            aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                class="hide-menu">Dashboard</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)" aria-expanded="false"><i class="fas fa-cogs"></i><span
                                class="hide-menu">Manajemen Operator </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/op/siswas') }}" aria-expanded="false">
                                    <i class="fas fa-users"></i>
                                    <span class="hide-menu">Master Siswa</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/op/siswaNilai') }}" aria-expanded="false">
                                    <i class="fas fa-tag"></i>
                                    <span class="hide-menu">Master Nilai</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/op/finalisasi') }}" aria-expanded="false">
                                    <i class="fas fa-bookmark"></i>
                                    <span class="hide-menu">Finalisasi Data</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ url('/op/changePass') }}" aria-expanded="false">
                                    <i class="fas fa-unlock"></i>
                                    <span class="hide-menu">Ubah Password</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="/logout" aria-expanded="false"><i class="mdi mdi-power"></i><span
                                class="hide-menu">Logout</span></a></li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
