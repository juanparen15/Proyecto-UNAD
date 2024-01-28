<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cyborg/bootstrap.min.css"
    integrity="sha384-nEnU7Ae+3lD52AK+RGNzgieBWMnEfgTbRHIwEvp1XXPdqdO6uLTd/NwXbzboqjc2" crossorigin="anonymous">
<aside class="main-sidebar bg-black elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        {{-- <img src="{!! asset('adminlte/dist/img/1703963963WhatsApp Image 2023-12-28 at 12.46.15 PM.png') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
        <img src="{{ asset('adminlte/dist/img/' . auth()->user()->avatar) }}" class="brand-image img-circle elevation-3"
            style="opacity: .8" alt="{{ Auth::user()->name }}">
        <span class="text-white brand-text font-weight-light">CRC-UNAD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            {{-- <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark""> --}}
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">


                {{--  <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link 
            {!! active_class(route('home')) !!}
            ">
              <i class="nav-icon far fa-calendar-check"></i>
              <p>
                Panel administrador
              </p>
            </a>
          </li>   --}}

                @if (auth()->user()->hasRole('Admin'))
                    {{-- <li class="nav-item">
                        <a href="{{ route('empresa.index') }}"
                            class="nav-link 
            {!! active_class(route('empresa.index')) !!}
            ">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Empresa
                            </p>
                        </a>
                    </li> --}}

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

                    {{-- <li class="nav-item">
                        <a href="{{ route('admin.areas.index') }}"
                            class="nav-link 
            {!! active_class(route('admin.areas.index')) !!}
            ">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Áreas
                            </p>
                        </a>
                    </li> --}}

                    <!-- <li class="nav-item">
            {{-- <a href="{{ route('admin.clases.index') }}" class="nav-link 
            {!! active_class(route('admin.clases.index')) !!} --}}
            ">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>
                Clases
              </p>
            </a>
          </li>  -->

                    {{-- <li class="nav-item">
                        <a href="{{ route('admin.dependencias.index') }}"
                            class="nav-link 
            {!! active_class(route('admin.dependencias.index')) !!}
            ">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                Dependencias
                            </p>
                        </a>
                    </li> --}}

                    {{-- <li class="nav-item">
                        <a href="{{ route('planadquisiciones.index') }}"
                            class="nav-link 
            {!! active_class(route('planadquisiciones.index')) !!}
            ">
                            <i class="nav-icon fas fa-parking"></i>
                            <p>
                                Inventario
                            </p>
                        </a>
                    </li> --}}

                    <!-- <li class="nav-item">
            {{-- <a href="{{ route('admin.estadovigencias.index') }}" class="nav-link  --}}
            {{-- {!! active_class(route('admin.estadovigencias.index')) !!} --}}
            ">
              <i class="nav-icon fas fa-calendar-minus"></i>
              <p>
                Series Documentales
              </p>
            </a>
          </li>  -->

                    {{-- <li class="nav-item">
                        <a href="{{ route('admin.modalidades.index') }}"
                            class="nav-link 
            {!! active_class(route('admin.modalidades.index')) !!}
            ">
                            <i class="nav-icon fas fa-stream"></i>
                            <p>
                                Objeto Documental
                            </p>
                        </a>
                    </li> --}}

                    <li class="nav-item">
                        <a href="{{ route('admin.ciudades.index') }}"
                            class="nav-link 
            {!! active_class(route('admin.ciudades.index')) !!}
            ">
                            <i class="nav-icon fas fa-house-user"></i>

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
                                ESTANDAR
                            </p>
                        </a>
                    </li>

                    {{-- @if (auth()->user()->hasRole('Admin')) --}}
                    <li class="nav-item">
                        <a href="{{ route('planadquisiciones.create') }}"
                            class="nav-link 
            {!! active_class(route('planadquisiciones.create')) !!}
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
                            <i class="nav-icon far fa-calendar-check"></i>
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
                            <i class="nav-icon far fa-calendar-check"></i>
                            <p>
                                ESTADISTICA
                            </p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('planadquisiciones.create') }}"
                            class="nav-link 
            {!! active_class(route('planadquisiciones.create')) !!}
            ">
                            <i class="nav-icon fas fa-parking"></i>
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
                            <i class="nav-icon far fa-calendar-check"></i>
                            <p>
                                ESTADISTICA
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
