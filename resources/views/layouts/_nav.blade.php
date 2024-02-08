<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/lumen/bootstrap.min.css">
<aside class="main-sidebar elevation-6" style="background: #ffc107">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        {{-- <img src="{!! asset('adminlte/dist/img/1703963963WhatsApp Image 2023-12-28 at 12.46.15 PM.png') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
        <img src="{{ asset('adminlte/dist/img/' . auth()->user()->avatar) }}" class="brand-image img-circle elevation-3"
            style="opacity: .8" alt="{{ Auth::user()->name }}">
        <span class="text-white brand-text font-weight-light">RADSODI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2 ">
            {{-- <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark""> --}}
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (auth()->user()->hasRole('Admin'))
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link 
            {!! active_class(route('users.index')) !!}
            ">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                USUARIOS
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ciudades.index') }}"
                            class="nav-link 
            {!! active_class(route('admin.ciudades.index')) !!}
            ">
                            <i class="nav-icon fas fa-city"></i>

                            <p>
                                CIUDAD
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.estandares.index') }}"
                            class="nav-link 
            {!! active_class(route('admin.estandares.index')) !!}
            ">
                            <i class="nav-icon fas fa-th-list"></i>

                            <p>
                                ESTÁNDAR
                            </p>
                        </a>
                    </li>

                    {{-- @if (auth()->user()->hasRole('Admin')) --}}
                    <li class="nav-item">
                        <a href="{{ route('planadquisiciones.show') }}"
                            class="nav-link 
            {!! active_class(route('planadquisiciones.show')) !!}
            ">
                            <i class="nav-icon fas fa-map"></i>
                            <p>
                                SIMULACIONES XIRIO
                            </p>
                        </a>
                    </li>
                    {{-- @endif --}}

                    <li class="nav-item">
                        <a href="{{ route('importar_datos') }}"
                            class="nav-link 
            {!! active_class(route('importar_datos')) !!}
            ">
                            <i class="nav-icon fas fa-file-import"></i>
                            <p>
                                IMPORTAR DATOS
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('estadistica') }}"
                            class="nav-link 
            {!! active_class(route('estadistica')) !!}
            ">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                ESTADÍSTICA
                            </p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('planadquisiciones.show') }}"
                            class="nav-link 
            {!! active_class(route('planadquisiciones.show')) !!}
            ">
                            <i class="nav-icon fas fa-map"></i>
                            <p>
                                SIMULACIONES XIRIO
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('estadistica') }}"
                            class="nav-link 
            {!! active_class(route('estadistica')) !!}
            ">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                ESTADÍSTICA
                            </p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('importar_datos') }}"
                            class="nav-link 
            {!! active_class(route('importar_datos')) !!}
            ">
                            <i class="nav-icon far fa-calendar-check"></i>
                            <p>
                                IMPORTAR DATOS
                            </p>
                        </a>
                    </li> --}}
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
