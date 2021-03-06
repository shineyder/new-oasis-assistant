<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('profile') }}" class="brand-link elevation-4">
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
                @if (Auth::user()->access >= 8)
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
                                <a href="{{ route('publisher.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        {{ __('Publicadores') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('contactusmaster.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        {{ __('Solicita????es') }}
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reportmaster.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        {{ __('Relat??rios') }}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->access >= 1)
                    <li class="nav-header">{{ __('Territ??rio') }}</li>

                    <li class="nav-item">
                        <a href="{{ route('report.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-street-view"></i>
                            <p>
                                {{ __('Meus Relat??rios') }}
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('territory.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-map"></i>
                            <p>
                                {{ __('Visualizar Territ??rios') }}
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">{{ __('Outros') }}</li>

                <li class="nav-item">
                    <a href="{{ route('contactus.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>
                            {{ __('Fale Conosco') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('FAQ') }}" class="nav-link">
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
