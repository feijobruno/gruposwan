@include('layouts.header')

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-nav">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#"><img src="{{ asset('img/logo-blanco.svg') }}" style=" width:90%;"
                class="img-fluid m-2" alt="..."></a>
        {{-- <a class="navbar-brand ps-3" href="#">Polymer Solutions</a> --}}

        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">

            <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                @if (auth()->check())
                    {{ auth()->user()->name }}
                @endif

            </a>
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Perfil</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="{{ route('login.destroy') }}">Salir</a></li>
            </ul>
            </>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-five" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'dashboard']) href="{{ route('dashboard.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-line text-secondary"></i></div>
                            Dashboard
                        </a>

                        @can('index-customer')
                            <a @class([
                                'nav-link collapsed',
                                'active' => isset($menu) && $menu == 'commercial',
                            ]) href="{{ route('customer.index') }}" data-bs-toggle="collapse"
                                data-bs-target="#collapseCustomers" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">  <i class="fa-regular fa-handshake text-secondary"></i></div>
                                Comercial
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCustomers" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('customer.index') }}"> Clientes</a>
                                    <a class="nav-link" href="{{ route('supplier.index') }}"> Proveedores</a>
                                </nav>
                            </div>
                        @endcan 

                        @can('index-product')
                            <a @class([
                                'nav-link collapsed',
                                'active' => isset($menu) && $menu == 'products',
                            ]) data-bs-toggle="collapse" data-bs-target="#collapseProducts"
                                aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping text-secondary"></i></div>
                                Productos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProducts" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('product.index') }}"> Listado</a>
                                    {{-- <a class="nav-link" href="#">Stock</a> --}}
                                </nav>
                            </div>
                        @endcan

                        @can('index-stock')
                        <a @class([
                            'nav-link collapsed',
                            'active' => isset($menu) && $menu == 'additives',
                        ]) href="{{ route('customer.index') }}" data-bs-toggle="collapse"
                            data-bs-target="#collapseStock" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon">  <i class="fa-solid fa-cart-shopping text-secondary"></i></div>
                            Stock
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseStock" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a @class(['nav-link', 'active' => isset($menu) && $menu == 'stock']) href="{{ route('stockMovement.index') }}">
                                    Movimientos
                                </a>
                                <a class="nav-link" href="#">Produtos</a>
                            </nav>
                        </div>
                    @endcan 

                        @can('index-customer-orders')
                            <a @class([
                                'nav-link collapsed',
                                'active' => isset($menu) && $menu == 'orders',
                            ]) data-bs-toggle="collapse" data-bs-target="#collapseOrders"
                                aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-flatbed text-secondary"></i></div>
                                Pedidos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseOrders" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('ordersCustomer.index') }}"> Clientes</a>
                                    <a class="nav-link" href="{{ route('ordersSupplier.index') }}"> Proveedores</a>                                    
                                    <a class="nav-link" href="{{ route('ordersPa.index') }}"> PA</a>
                                    <a class="nav-link" href="#">Albarán</a>
                                </nav>
                            </div>
                        @endcan

                        @can('index-invoice')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu == 'invoices']) href="{{ route('invoice.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-file-invoice text-secondary"></i></div>
                                Facturas
                            </a>
                        @endcan

                        @can('index-financial')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu == 'financial']) href="{{ route('financial.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-money-check-dollar text-secondary"></i></div>
                                Financiero
                            </a>
                        @endcan

                       

                        @can('index-polymerAdditives')
                        <a @class([
                            'nav-link collapsed',
                            'active' => isset($menu) && $menu == 'additives',
                        ]) href="{{ route('customer.index') }}" data-bs-toggle="collapse"
                            data-bs-target="#collapsePolymerAdditives" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon">  <i class="fa-regular fa-building text-secondary"></i></div>
                            Polymer Additives
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePolymerAdditives" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a @class(['nav-link', 'active' => isset($menu) && $menu == 'polymerAdditives']) href="{{ route('polymerAdditives.index') }}">
                                    Proveedores
                                </a>
                                <a class="nav-link" href="#">Albarán</a>
                            </nav>
                        </div>
                    @endcan 

                        @can('index-customer')
                        <a @class([
                            'nav-link collapsed',
                            'active' => isset($menu) && ($menu == 'users' || $menu == 'roles' || $menu == 'permissions')]) href="{{ route('user.index') }}" data-bs-toggle="collapse"
                            data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users text-secondary"></i></i></div>
                            Usuarios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseUsers" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" @class(['nav-link', 'active' => isset($menu) && $menu == 'users'])  href="{{ route('user.index') }}"> Listado</a>
                                <a class="nav-link" @class(['nav-link', 'active' => isset($menu) && $menu == 'roles'])  href="{{ route('role.index') }}"> Perfiles</a>
                                <a class="nav-link" @class(['nav-link', 'active' => isset($menu) && $menu == 'permissions'])  href="{{ route('permission.index') }}"> Permisos</a>
                            </nav>
                        </div>
                    @endcan


                    <a @class([
                        'nav-link collapsed',
                        'active' => isset($menu) && $menu == 'helperTables',
                    ]) href="{{ route('helperTables.index') }}" data-bs-toggle="collapse"
                        data-bs-target="#collapseHelperTables" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon">  <i class="fa-solid fa-table-list text-secondary"></i></div>
                        Tablas auxiliares
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseHelperTables" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a @class(['nav-link', 'active' => isset($menu) && $menu == 'helperTables']) href="{{ route('helperTables.index') }}">
                                Países
                            </a>
                        </nav>
                    </div>

                        {{-- @can('index-user')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu == 'users']) href="{{ route('user.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Usuarios
                            </a>
                        @endcan

                        @can('index-role')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu == 'roles']) href="{{ route('role.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-network-wired"></i></div>
                                Perfil
                            </a>
                        @endcan
                        @can('index-permission')
                            <a @class([
                                'nav-link',
                                'active' => isset($menu) && $menu == 'permissions',
                            ]) class="nav-link" href="{{ route('permission.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-file"></i></div>
                                Permisos
                            </a>
                        @endcan --}}


                        <a class="nav-link" href="{{ route('login.destroy') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-arrow-right-from-bracket text-secondary"></i></div>
                            Sair
                        </a>
                    </div>
                </div>

                <div class="sb-sidenav-footer">
                    <div class="small">Logado:
                        @if (auth()->check())
                            {{ auth()->user()->name }}
                        @endif
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">

            <main>
                @yield('content')
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Polymer Solutions {{ date('Y') }}</div>
                        <div>
                            <a href="{{ route('dashboard.privacyPolicy') }}"
                                class="text-decoration-none text-muted">Política de Privacidad</a>
                            {{-- &middot; --}}
                            |
                            <a href="{{ route('dashboard.legalNotice') }}"
                                class="text-decoration-none text-muted">Aviso Legal</a>
                            |
                            <a href="{{ route('dashboard.cookies') }}"
                                class="text-decoration-none text-muted">Cookies</a>
                        </div>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    @include('layouts.footer')
    @stack('js')

</body>

</html>
