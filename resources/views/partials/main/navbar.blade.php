<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <img src="{{ asset('logo.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item {{ Route::is('dashboard.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dashboard"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/dashboard</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="13" r="2"></circle>
                                <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line>
                                <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>
                @can('role-management')
                <li class="nav-item {{ Route::is('role.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('role.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/adjustments</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="6" cy="10" r="2"></circle>
                                <line x1="6" y1="4" x2="6" y2="8"></line>
                                <line x1="6" y1="12" x2="6" y2="20"></line>
                                <circle cx="12" cy="16" r="2"></circle>
                                <line x1="12" y1="4" x2="12" y2="14"></line>
                                <line x1="12" y1="18" x2="12" y2="20"></line>
                                <circle cx="18" cy="7" r="2"></circle>
                                <line x1="18" y1="4" x2="18" y2="5"></line>
                                <line x1="18" y1="9" x2="18" y2="20"></line>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Role
                        </span>
                    </a>
                </li>
                @endcan
                @can('user-management')
                <li class="nav-item {{ Route::is('user.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('user.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/users</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            User
                        </span>
                    </a>
                </li>
                @endcan
                @can('item-management')
                <li class="nav-item {{ Route::is('item.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('item.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/box</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline>
                                <line x1="12" y1="12" x2="20" y2="7.5"></line>
                                <line x1="12" y1="12" x2="12" y2="21"></line>
                                <line x1="12" y1="12" x2="4" y2="7.5"></line>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Item
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('serial-number.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('serial-number.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/box</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3"></polyline>
                                <line x1="12" y1="12" x2="20" y2="7.5"></line>
                                <line x1="12" y1="12" x2="12" y2="21"></line>
                                <line x1="12" y1="12" x2="4" y2="7.5"></line>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Serial Number
                        </span>
                    </a>
                </li>
                @endcan
                @can('warehouse-management')
                <li class="nav-item {{ Route::is('warehouse.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('warehouse.index')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-building-warehouse" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/building-warehouse
                                </desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 21v-13l9 -4l9 4v13"></path>
                                <path d="M13 13h4v8h-10v-6h6"></path>
                                <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Warehouse
                        </span>
                    </a>
                </li>
                @endcan
                @can('inventory-management')
                <li class="nav-item {{ Route::is('inventory.index') ? 'active' : '' }}">
                    <a class="nav-link" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                <line x1="9" y1="9" x2="10" y2="9"></line>
                                <line x1="9" y1="13" x2="15" y2="13"></line>
                                <line x1="9" y1="17" x2="15" y2="17"></line>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Inventory
                        </span>
                    </a>
                </li>
                @endcan
                @can('supplier-management')
                {{-- <li class="nav-item {{ Route::is('supplier.index') ? 'active' : '' }}">
                <a class="nav-link" href="#}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="3" y1="21" x2="21" y2="21"></line>
                            <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4">
                            </path>
                            <line x1="5" y1="21" x2="5" y2="10.85"></line>
                            <line x1="19" y1="21" x2="19" y2="10.85"></line>
                            <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
                        </svg>
                    </span>
                    <span class="nav-link-title">
                        Supplier
                    </span>
                </a>
                </li> --}}
                @endcan
                @can('transfer-stock-management')
                <li class="nav-item dropdown {{ Route::is('transfer-stock.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button"
                        aria-expanded="{{ Route::is('transfer-stock.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkup-list"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/checkup-list</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                </path>
                                <rect x="9" y="3" width="6" height="4" rx="2"></rect>
                                <path d="M9 14h.01"></path>
                                <path d="M9 17h.01"></path>
                                <path d="M12 16l1 1l3 -3"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Transfer Stock
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Route::is('transfer-stock.*') ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <div class="dropend">
                                    @can('purchase-order-management')
                                    <a href="#"
                                        class="dropdown-item {{ Route::is('transfer-stock.purchase-order.index') ? 'active' : '' }}">Purchase
                                        Order</a>
                                    @endcan
                                    {{-- edit after refresh prod --}}
                                    @can('purchase-order-management')
                                    <a href="#"
                                        class="dropdown-item {{ Route::is('transfer-stock.negres.index') ? 'active' : '' }}">Negres</a>
                                    @endcan
                                    @can('material-request-management')
                                    <a href="#"
                                        class="dropdown-item {{ Route::is('transfer-stock.material-request.index') ? 'active' : '' }}">Material
                                        Request</a>
                                    @endcan
                                    @can('picking-form-management')
                                    <a href="#"
                                        class="dropdown-item {{ Route::is('transfer-stock.picking-form.index') ? 'active' : '' }}">Delivery</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                </li>
                @endcan
                @can('logistic-management')
                <li class="nav-item {{ Route::is('logistic.index') ? 'active' : '' }}">
                    <a class="nav-link" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="7" cy="17" r="2"></circle>
                                <circle cx="17" cy="17" r="2"></circle>
                                <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            ASP
                        </span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</aside>