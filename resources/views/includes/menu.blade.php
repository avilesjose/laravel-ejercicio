<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
            <a class="nav-link">
                <i class="nav-icon far fa-user-circle"></i>
                <p>
                    {{Auth::user()->username}}
                </p>
            </a>
        </li>
        <li class="nav-header">Principal</li>
        <li class="nav-item">
            <a href="{{route('feed')}}" class="nav-link {{(isset($menu_active) && $menu_active=='feed')?'active':''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Feed
                </p>
            </a>
        </li>
        <li class="nav-header">Otros</li>
        <li class="nav-item">
            <a href="{{route('get_profile')}}" class="nav-link {{(isset($menu_active) && $menu_active=='profile')?'active':''}}">
                <i class="nav-icon fa fa-user"></i>
                <p>
                    Mi perfil
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link">
                <i class="nav-icon fas fa-sign-in-alt"></i>
                <p>
                    Cerrar sesión
                </p>
            </a>
        </li>
    </ul>
</nav>