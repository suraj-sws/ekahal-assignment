<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ url('assets/img/logo/logo.png') }}" alt="" title="" class="clientLogo2" />
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.47365 11.7183C8.11707 12.0749 8.11707 12.6531 8.47365 13.0097L12.071 16.607C12.4615 16.9975 12.4615 17.6305 12.071 18.021C11.6805 18.4115 11.0475 18.4115 10.657 18.021L5.83009 13.1941C5.37164 12.7356 5.37164 11.9924 5.83009 11.5339L10.657 6.707C11.0475 6.31653 11.6805 6.31653 12.071 6.707C12.4615 7.09747 12.4615 7.73053 12.071 8.121L8.47365 11.7183Z" fill-opacity="0.9" />
                <path d="M14.3584 11.8336C14.0654 12.1266 14.0654 12.6014 14.3584 12.8944L18.071 16.607C18.4615 16.9975 18.4615 17.6305 18.071 18.021C17.6805 18.4115 17.0475 18.4115 16.657 18.021L11.6819 13.0459C11.3053 12.6693 11.3053 12.0587 11.6819 11.6821L16.657 6.707C17.0475 6.31653 17.6805 6.31653 18.071 6.707C18.4615 7.09747 18.4615 7.73053 18.071 8.121L14.3584 11.8336Z" fill-opacity="0.4" />
            </svg>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-item">
            <a href="{{ url('products') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-product-hunt-line"></i>
                <div data-i18n="Product Management">Product Management</div>
            </a>
        </li>
        @if (session()->has('type') && session()->get('type') === 'admin')
        <li class="menu-item">
            <a href="{{ url('accounts') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-group-line"></i>
                <div data-i18n="Account Management">Account Management</div>
            </a>
        </li>
        @endif
    </ul>
</aside>
<!-- / Menu -->

<!-- Layout container -->
<div class="layout-page">
    <!-- Navbar -->
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="ri-menu-fill ri-22px"></i>
            </a>
        </div>
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">                
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar me-2 avatar-online">
                            <span class="avatar-initial rounded-circle bg-label-secondary">{{ strpos(session()->get('name'), ' ') ? substr(session()->get('name'), 0, 1) : substr(session()->get('name'), 0, 2) }}</span>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ url('dashboard') }}">
                                <div class="d-flex">
                                    <div class="avatar me-2 avatar-online">
                                        <span class="avatar-initial rounded-circle bg-label-secondary">{{ strpos(session()->get('name'), ' ') ? substr(session()->get('name'), 0, 1) : substr(session()->get('name'), 0, 2) }}</span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-medium d-block small">{{ session()->get('name') }}</span>
                                        <small class="text-muted">{{ (session()->get('type') == 'admin') ? 'Admin' : 'User' }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('dashboard') }}"><i class="ri-user-3-line ri-22px me-3"></i><span class="align-middle">My Profile</span></a>
                        </li>
                        <li>
                            <div class="d-grid px-4 pt-2 pb-1">
                                <a class="btn btn-sm btn-danger d-flex" href="{{ url('logout') }}">
                                    <small class="align-middle">Logout</small><i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>
    <!-- / Navbar -->