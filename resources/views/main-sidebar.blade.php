<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link elevation-4">
    <img src="{{asset('images/logo_oasis_assistant_min-2.png')}}"
        alt="Oasis Assistant Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">{{ __('Oasis Assistant') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                @if (Session::get('access') <= 8)
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                {{ __('Master Page') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/MasterPublishers" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        {{ __('Publicadores') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/MasterRequest" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        {{ __('Solicitações') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/Report" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        {{ __('Relatórios') }}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Session::get('access') >= 2)
                    <li class="nav-header">{{ __('Território') }}</li>

                    @if (Session::get('access') < 8)
                        <li class="nav-item">
                            <a href="/Report" class="nav-link">
                                <i class="nav-icon fas fa-street-view"></i>
                                <p>
                                    {{ __('Meus Relatórios') }}
                                </p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="/Territory" class="nav-link">
                            <i class="nav-icon fas fa-map"></i>
                            <p>
                                {{ __('Visualizar Territórios') }}
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">{{ __('Outros') }}</li>

                <li class="nav-item">
                    <a href="/ContactUs" class="nav-link">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>
                            {{ __('Fale Conosco') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/FAQ" class="nav-link">
                        <i class="nav-icon fas fa-question"></i>
                        <p>
                            {{ __('F.A.Q.') }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.Main Sidebar Container -->
