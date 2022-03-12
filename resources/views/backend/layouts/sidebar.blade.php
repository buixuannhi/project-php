<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    <img src="{{ asset('assets/backend') }}/img/avatars/avatar.jpg"
                        class="avatar img-fluid rounded me-1" alt="Charles Hall" />
                </div>
                <div class="flex-grow-1 ps-2" style="align-self: center;">
                    <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        {{Auth::guard('admin')->user()->name}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-start">
                        <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                                data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i>
                            Analytics</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="pages-settings.html"><i class="align-middle me-1"
                                data-feather="settings"></i> Settings &
                            Privacy</a>
                        <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i>
                            Help Center</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Log out</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- List menu --}}
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <!-- Dashboard -->
            <li class="sidebar-item active">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                    <i class="align-middle" data-feather="sliders"></i><span class="align-middle">Dashboards</span>
                </a>
            </li>

            <!-- Banner -->
            <li class="sidebar-item">
                <a data-bs-target="#banner" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="far fa-images"></i> <span class="align-middle">Banners</span>
                </a>
                <ul id="banner" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('banners.index') }}">Banners
                            Manager</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('banners.create') }}">Add new
                            Banner</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('banners.trash') }}">Banner
                            trash</a></li>
                </ul>
            </li>

            <!-- Blog -->
            <li class="sidebar-item">
                <a data-bs-target="#blogs" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="far fa-edit"></i> <span class="align-middle">Blogs</span>
                </a>
                <ul id="blogs" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('blogs.index') }}">Blogs Manager</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('blogs.create') }}">Add new Blog</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('blogs.trash') }}">Blogs trash</a>
                    </li>
                </ul>
            </li>

            <!-- Blog Categories -->
            <li class="sidebar-item">
                <a data-bs-target="#blog" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="fa fa-list-alt"></i></i> <span class="align-middle">Blog Categories</span>
                </a>
                <ul id="blog" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('blog-categories.index') }}">Blog
                            Categories
                        </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('blog_categories.trash') }}">Blog
                            Categories trash</a></li>
                </ul>
            </li>

            <!-- Brand -->
            <li class="sidebar-item">
                <a data-bs-target="#brands" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="fas fa-copyright"></i> <span class="align-middle">Brands</span>
                </a>
                <ul id="brands" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('brands.index') }}">Brands
                            Manager</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('brands.trash') }}">Brands trash</a>
                    </li>
                </ul>
            </li>

            <!-- Categories -->
            <li class="sidebar-item">
                <a data-bs-target="#categories" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="fa fa-list-alt"></i> <span class="align-middle">Categories</span>
                </a>
                <ul id="categories" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('categories.index') }}">Category
                            Manager</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('categories.trash') }}">Categories
                            Trash</a></li>
                </ul>
            </li>

            <!-- Room -->
            <li class="sidebar-item">
                <a data-bs-target="#rooms" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="fas fa-hotel"></i> <span class="align-middle">Rooms</span>
                </a>
                <ul id="rooms" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('rooms.index') }}">Room Manager</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('rooms.create') }}">Add new room</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('rooms.trash') }}">Room trash</a>
                    </li>
                </ul>
            </li>

            <!-- Coupon -->
            <li class="sidebar-item">
                <a data-bs-target="#coupon" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="fas fa-hand-holding-usd"></i> <span class="align-middle">Coupon</span>
                </a>
                <ul id="coupon" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('coupons.index') }}">Coupons
                            Manager</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('coupons.create') }}">Add new
                            Coupon</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('coupons.index') }}">Coupons
                            Trash</a></li>
                </ul>
            </li>

            <!-- Service -->
            <li class="sidebar-item">
                <a data-bs-target="#service" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="fas fa-concierge-bell"></i> <span class="align-middle">Services</span>
                </a>
                <ul id="service" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('services.index') }}">Service
                            Manager</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('services.create') }}">Add new
                            Service</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('services.trash') }}">Service Trash
                        </a></li>
                </ul>
            </li>

            <!-- Faq -->
            <li class="sidebar-item">
                <a data-bs-target="#faq" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="fas fa-question-circle"></i> <span class="align-middle">Faq</span>
                </a>
                <ul id="faq" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('faqs.index') }}">Faq Manager</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('faqs.create') }}">Add New Faq</a>
                    </li>
                </ul>
            </li>

            <!-- Payment -->
            <li class="sidebar-item">
                <a href="{{ route('payments.index') }}" class="sidebar-link collapsed">
                    <i class="fab fa-cc-amazon-pay"></i> <span class="align-middle">Payments</span>
                </a>
            </li>



            <!-- Feedback -->
            <li class="sidebar-item">
                <a href="{{ route('feedbacks.show') }}" class="sidebar-link collapsed">
                    <i class="far fa-comment-dots"></i> <span class="align-middle">Feedbacks</span>
                </a>
            </li>

            <!-- User -->
            <li class="sidebar-item">
                <a href="{{ route('backend.user.show') }}" class="sidebar-link collapsed">
                    <i class="fas fa-user"></i><span class="align-middle">Users</span>
                </a>
            </li>

            <!-- Order -->
            <li class="sidebar-item">
                <a href="{{ route('backend.order.show') }}" class="sidebar-link collapsed">
                    <i class="fas fa-file-invoice"></i> <span class="align-middle">Orders</span>
                </a>
            </li>

            <!-- Information -->
            <li class="sidebar-item">
                <a href="{{ route('info.show') }}" class="sidebar-link collapsed">
                    <i class="fas fa-info"></i> <span class="align-middle">Information</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
