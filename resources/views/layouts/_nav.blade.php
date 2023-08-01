<aside class="main-sidebar bg-black elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{!!asset('adminlte/dist/img/AdminLTELogo.png')!!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="text-light brand-text font-weight-light">Inventario Documental</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         

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

          

          <li class="nav-item">
            <a href="{{route('empresa.index')}}" class="nav-link 
            {!! active_class(route('empresa.index')) !!}
            ">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Empresa
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link 
            {!! active_class(route('users.index')) !!}
            ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="{{route('admin.areas.index')}}" class="nav-link 
            {!! active_class(route('admin.areas.index')) !!}
            ">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Áreas
              </p>
            </a>
          </li> 

          <!-- <li class="nav-item">
            <a href="{{route('admin.clases.index')}}" class="nav-link 
            {!! active_class(route('admin.clases.index')) !!}
            ">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>
                Clases
              </p>
            </a>
          </li>  -->
           
          <li class="nav-item">
            <a href="{{route('admin.dependencias.index')}}" class="nav-link 
            {!! active_class(route('admin.dependencias.index')) !!}
            ">       
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Dependencias
              </p>
            </a>
          </li>   

          <li class="nav-item">
            <a href="{{route('planadquisiciones.index')}}" class="nav-link 
            {!! active_class(route('planadquisiciones.index')) !!}
            ">
            <i class="nav-icon fas fa-parking"></i>
              <p>
                Inventario
              </p>
            </a>
          </li>        

          <!-- <li class="nav-item">
            <a href="{{route('admin.estadovigencias.index')}}" class="nav-link 
            {!! active_class(route('admin.estadovigencias.index')) !!}
            ">
              <i class="nav-icon fas fa-calendar-minus"></i>
              <p>
                Series Documentales
              </p>
            </a>
          </li>  -->

          <li class="nav-item">
            <a href="{{route('admin.modalidades.index')}}" class="nav-link 
            {!! active_class(route('admin.modalidades.index')) !!}
            ">
              <i class="nav-icon fas fa-stream"></i>
              <p>
                Objeto Documental
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{route('admin.segmentos.index')}}" class="nav-link 
            {!! active_class(route('admin.segmentos.index')) !!}
            ">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
              Series Documentales
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="{{route('admin.familias.index')}}" class="nav-link 
            {!! active_class(route('admin.familias.index')) !!}
            ">
              <i class="nav-icon fas fa-house-user"></i>
              <p>
                Subserie Documental
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="{{route('admin.fuentes.index')}}" class="nav-link 
            {!! active_class(route('admin.fuentes.index')) !!}
            ">
              <i class="nav-icon fas fa-location-arrow"></i>
              <p>
                Soporte Documental
              </p>
            </a>
          </li> 

          <!-- <li class="nav-item">
            <a href="{{route('admin.meses.index')}}" class="nav-link 
            {!! active_class(route('admin.meses.index')) !!}
            ">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Meses
              </p>
            </a>
          </li>   --> 

          

          <!-- <li class="nav-item">
            <a href="{{route('admin.productos.index')}}" class="nav-link 
            {!! active_class(route('admin.productos.index')) !!}
            ">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Productos
              </p>
            </a>
          </li>  -->

{{-- 
          <li class="nav-item">
            <a href="{{route('admin.tipoadquicsiciones.index')}}" class="nav-link 
            {!! active_class(route('admin.tipoadquicsiciones.index')) !!}
            ">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                OTROS
              </p>
            </a>
          </li> --}}

           {{-- <li class="nav-item">
            <a href="{{route('admin.tipoadquicsiciones55.index')}}" class="nav-link 
            {!! active_class(route('admin.tipoadquicsiciones55.index')) !!}
            ">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Tipo de Adquisiciones
              </p>
            </a>
          </li>  --}}

          <li class="nav-item">
            <a href="{{route('admin.tipoprioridades.index')}}" class="nav-link 
            {!! active_class(route('admin.tipoprioridades.index')) !!}
            ">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Frecuencia de Consulta
              </p>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a href="{{route('admin.tipoprocesos.index')}}" class="nav-link 
            {!! active_class(route('admin.tipoprocesos.index')) !!}
            ">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Subserie Documental
              </p>
            </a>
          </li>  -->

          <!-- <li class="nav-item">
            <a href="{{route('tipozonas.index')}}" class="nav-link 
            {!! active_class(route('tipozonas.index')) !!}
            ">
              <i class="nav-icon far fa-map"></i>
              <p>
                Tipo de Zonas
              </p>
            </a>
          </li>  -->

          {{--  <li class="nav-item">
            <a href="{{route('admin.vigenfuturas.index')}}" class="nav-link 
            {!! active_class(route('admin.vigenfuturas.index')) !!}
            ">
              <i class="nav-icon far fa-calendar-check"></i>
              <p>
                Vigencia fututa
              </p>
            </a>
          </li>   --}}
          
          <li class="nav-item">
            <a href="{{route('admin.proyectos.index')}}" class="nav-link 
            {!! active_class(route('admin.proyectos.index')) !!}
            ">
              <i class="nav-icon fas fa-poll"></i>
              <p>
                Codigo de Dependencia
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="{{route('importar_datos')}}" class="nav-link 
            {!! active_class(route('importar_datos')) !!}
            ">
              <i class="nav-icon far fa-calendar-check"></i>
              <p>
                Importar datos 
              </p>
            </a>
          </li>    
          
          @else
          
          <li class="nav-item">
            <a href="{{route('planadquisiciones.index')}}" class="nav-link 
            {!! active_class(route('planadquisiciones.index')) !!}
            ">
            <i class="nav-icon fas fa-parking"></i>
              <p>
                Inventario
              </p>
            </a>
          </li> 

          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>