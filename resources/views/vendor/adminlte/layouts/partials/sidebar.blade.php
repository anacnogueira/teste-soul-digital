<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ $user_img_path }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            @if ($user->type->name == 'admin')
                <li><a href="{{ route('tipos.index') }}"><i class='fa fa-link'></i> <span>Tipos de Usuários</span></a></li>
                <li><a href="{{ route('usuarios.index') }}"><i class='fa fa-link'></i> <span>Usuários</span></a></li>
            @endif
            <li><a href="{{ route('tickets.index') }}"><i class='fa fa-link'></i> <span>Tickets</span> </a>
                
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
