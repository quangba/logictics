<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="dropdown site-menu-item has-sub {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">
                            <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    @can(MANAGE_USERS)
                    <li class="dropdown site-menu-item has-sub {{ Request::is('users*') ? 'active' : '' }}">
                        <a data-toggle="dropdown" data-dropdown-toggle="false" href="javascript:void(0)">
                            <i class="site-menu-icon md-accounts" aria-hidden="true"></i>
                            <span class="site-menu-title">Quản lý User</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="site-menu-scroll-wrap is-list">
                                <div>
                                    <div>
                                        <ul class="site-menu-sub site-menu-normal-list">
                                            <li class="site-menu-item {{ Request::is('users') ? 'active' : '' }}">
                                                <a class="animsition-link" href="{{ route('users.index') }}">
                                                    <span class="site-menu-title">List User</span>
                                                </a>
                                            </li>
                                            <li
                                                class="site-menu-item {{ Request::is('users/create') ? 'active' : '' }}">
                                                <a class="animsition-link" href="{{ route('users.create') }}">
                                                    <span class="site-menu-title">Tạo mới user</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endcan

                    @if(Gate::check(VIEW_CARRIER) || Gate::check(MANAGE_CARRIER))
                        <li class="dropdown site-menu-item has-sub {{ Request::is('carrier/*') || Request::is('carrier') ? 'active' : '' }}">
                            <a data-toggle="dropdown" data-dropdown-toggle="false" href="javascript:void(0)">
                                <i class="icon md-stackoverflow" aria-hidden="true"></i>
                                <span class="site-menu-title">Quản lý Freight</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="site-menu-scroll-wrap is-list">
                                    <div>
                                        <div>
                                            <ul class="site-menu-sub site-menu-normal-list">
                                                <li class="site-menu-item {{ Request::is('carrier') ? 'active' : '' }}">
                                                    <a class="animsition-link" href="{{route('carrier.index')}}">
                                                        <span class="site-menu-title">Danh sách Freight</span>
                                                    </a>
                                                </li>
                                                @can(MANAGE_CARRIER)
                                                <li
                                                    class="site-menu-item {{ Request::is('carrier/create') ? 'active' : '' }}">
                                                    <a class="animsition-link" href="{{route('carrier.create')}}">
                                                        <span class="site-menu-title">Tạo mới Freight</span>
                                                    </a>
                                                </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>
