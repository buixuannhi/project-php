@extends('frontend.layouts.master')

@section('content')

<main>
    <!-- Breadcrumb section -->
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center"
        style="background-image:  url('{{ asset('assets/frontend')}}/img/blog/blog-breadcrumb.jpg');">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h1>Blog Standard</h1>
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><i class="far fa-angle-double-right"></i></li>
                    <li>Blogs</li>
                </ul>
            </div>
        </div>
        <h1 class="big-text">
            Blogs
        </h1>
    </section>
    <!-- Breadcrumb section End-->
    <section class="blog-wrapper section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="filter-view">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="input-wrap">
                                    <select name="sort" id="sort">
                                        <option value="default">Default Sorting</option>
                                        <option value="price-low-to-hight">Price Low To High</option>
                                        <option value="price-hight-to-low">Price High To Low</option>
                                        <option value="name-a-z">Name A to Z</option>
                                        <option value="name-z-a">Name Z to A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <ul class="view-option">
                                    <li><a href="#" class="item-icon toggle-grid active"><i class="fas fa-th"></i></a>
                                    </li>
                                    <li><a href="#" class="item-icon toggle-list"><i class="fa fa-list"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="item-list">
                        <div class="post-loop">
                            @foreach ($blogs as $blog)
                            <div class="single-blog-wrap">
                                <div class="post-thumbnail">
                                    <img src="{{ asset('uploads/blog').'/'. $blog->image}}" alt="Image">
                                </div>
                                <div class="post-desc">
                                    <ul class="blog-meta list-inline">
                                        <li><a href="javascript:void(0)"><i
                                                    class="far fa-user-alt"></i>{{ $blog->admin->name }}</a>
                                        </li>
                                        <li><a href="javascript:void(0)"><i
                                                    class="far fa-calendar-alt"></i>{{ dateBlog($blog->created_at) }}</a>
                                        </li>
                                    </ul>
                                    <h3><a href="">{{ $blog->title }}</a></h3>
                                    <a href="" class="btn filled-btn">View post <i
                                            class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="item-grid active">
                        <div class="post-loop">
                            <div class="row">
                                @foreach ($blogs as $blog)
                                <div class="col-md-6">
                                    <div class="single-blog-wrap">
                                        <div class="post-thumbnail">
                                            <img src="{{ asset('uploads/blog').'/'. $blog->image}}" alt="Image">
                                        </div>
                                        <div class="post-desc">
                                            <ul class="blog-meta list-inline">
                                                <li><a href="javascript:void(0)"><i
                                                            class="far fa-calendar-alt"></i>{{ dateBlog($blog->created_at) }}</a>
                                                </li>
                                            </ul>
                                            <h3><a
                                                    href="{{ route('user.blog_details', $blog->slug) }}">{{ $blog->title }}</a>
                                            </h3>
                                            <a href="{{ route('user.blog_details', $blog->slug) }}"
                                                class="read-more">Read More <i class="far fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Pagination Wrap -->
                    <div class="pagination-wrap">
                        <ul class="list-inline">
                            @if ($blogs->onFirstPage())
                            <li class="disabled"><a href="#"><i class="far fa-angle-left"></i></a></li>
                            @else
                            <li>
                                <a href="{{ $blogs->previousPageUrl() }}">
                                    <i class="far fa-angle-left"></i>
                                </a>
                            </li>
                            @endif

                            {{-- Loop Other page --}}
                            @for ($i = 1; $i <= $blogs->lastPage(); $i++)
                                <li class="{{ $i == $blogs->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $blogs->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor

                                {{-- Last page --}}
                                @if ($blogs->hasMorePages())
                                <li><a href="{{ $blogs->nextPageUrl() }}"><i class="far fa-angle-right"></i></a>
                                </li>
                                @else
                                <li class="disabled"><a href="#"><i class="far fa-angle-right"></i></a></li>
                                @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Sidebars Area -->
                    <div class="sidebar-wrap">
                        <div class="widget search-widget">
                            <h4 class="widget-title">Search Here</h4>
                            <form>
                                <input type="text" placeholder="Search Keywords">
                                <button><i class="far fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget recent-news">
                            <h4 class="widget-title">Latest News</h4>
                            <ul>
                                @foreach ($new_blogs as $blog)
                                <li>
                                    <div class="recent-post-img">
                                        <img src="{{ asset('uploads/blog').'/'. $blog->image}}" alt="Image">
                                    </div>
                                    <div class="recent-post-desc">
                                        <h6><a
                                                href="{{ route('user.blog_details', $blog->slug) }}">{{ $blog->title }}</a>
                                        </h6>
                                        <span class="date">{{ dateBlog($blog->created_at) }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget category-widget">
                            <h4 class="widget-title">Category</h4>
                            @foreach ($new_blog_categories as $category)
                            <div class="single-cat bg-img-center"
                                style="background-image: url('{{ asset('uploads/blog-categories/').'/'.$category->image }}')">
                                <a href="#">{{ $category->name }}</a>
                            </div>
                            @endforeach
                        </div>
                        <div class="widget banner-widget"
                            style="background-image: url(assets/img/blog/sidebar-banner.jpg);">
                            <h2>Booking Your Latest apartment</h2>
                            <a href="#" class="btn filled-btn">BOOK NOW <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Brands section start -->
    @includeIf('frontend.layouts.brand')
    <!-- Brands section End -->
</main>

@endsection
