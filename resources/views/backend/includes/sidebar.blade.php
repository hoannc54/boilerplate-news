<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                {{ __('menus.backend.sidebar.general') }}
            </li>

            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}" href="{{ route('admin.dashboard') }}"><i class="icon-speedometer"></i> {{ __('menus.backend.sidebar.dashboard') }}</a>
            </li>
            <li class="nav-title">
                Tài nguyên
            </li>
            @if($logged_in_user->hasRole(['administrator', 'admod']))
            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/category*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="icon-list"></i> Quản lý danh mục
                </a>

                <ul class="nav-dropdown-items">
                    @can('view_categories')
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/category')) }}" href="{{ route('admin.category.index') }}">
                            <i class="fa fa-list-alt"></i> Danh sách
                        </a>
                    </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/category/create')) }}" href="{{ route('admin.category.create') }}">
                            <i class="fa fa-plus-circle"></i> Thêm mới
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/post*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fa fa-edit"></i> Quản lý bài viết
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/post')) }}" href="{{ route('admin.post.index') }}">
                            <i class="fa fa-list-alt"></i> Danh sách
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/post/create')) }}" href="{{ route('admin.post.create') }}">
                            <i class="fa fa-plus-circle"></i> Thêm mới
                        </a>
                    </li>
                </ul>
            </li>
            @if ($logged_in_user->isAdmin())
            <li class="nav-title">
                Hệ thống
            </li>
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="icon-user"></i> Quản lý truy cập

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}" href="{{ route('admin.auth.user.index') }}">
                                {{--{{ __('labels.backend.access.users.management') }}--}}
                                Quản lý người dùng
                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/role*')) }}" href="{{ route('admin.auth.role.index') }}">
{{--                                {{ __('labels.backend.access.roles.management') }}--}}
                                Quản lý vai trò
                            </a>
                        </li>
                    </ul>
                </li>

            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="icon-list"></i> {{ __('menus.backend.log-viewer.main') }}
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer')) }}" href="{{ route('log-viewer::dashboard') }}">
                            {{ __('menus.backend.log-viewer.dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}" href="{{ route('log-viewer::logs.list') }}">
                            {{ __('menus.backend.log-viewer.logs') }}
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </nav>
</div><!--sidebar-->