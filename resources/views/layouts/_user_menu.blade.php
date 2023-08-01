<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

      <img src="{{asset('adminlte/dist/img/'.auth()->user()->avatar)}}" class="user-image img-circle elevation-2" alt="{{Auth::user()->name}}">

      <span class="d-none d-md-inline">{{Auth::user()->name}}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <!-- User image -->
      <li class="user-header bg-primary">
        <img src="{{asset('adminlte/dist/img/'.auth()->user()->avatar)}}" class="img-circle elevation-2" alt="{{Auth::user()->name}}">

        <p>
          {{Auth::user()->name}}
          <small>{{Auth::user()->created_at->diffForHumans()}}</small>
        </p>
      </li>
      <!-- Menu Body -->
      {{--  <li class="user-body">
        <div class="row">
          <div class="col-4 text-center">
            <a href="#">Followers</a>
          </div>
          <div class="col-4 text-center">
            <a href="#">Sales</a>
          </div>
          <div class="col-4 text-center">
            <a href="#">Friends</a>
          </div>
        </div>
        <!-- /.row -->
      </li>  --}}
      <!-- Menu Footer-->
      <li class="user-footer">
        <a 
        {{--  @if (Auth::user()->hasRole('Patient'))  --}}
        {{--  href="{{route('patient.index')}}"  --}}
        {{--  @else  --}}
        href="{{route('users.show', Auth::user())}}"
        {{--  @endif  --}}
        class="btn btn-default btn-flat">Perfil de Usuario</a>
        <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right">Cerrar Sesión</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </li>
    </ul>
</li>