@extends('frontend.layouts.master')

@section('content')

<main>
    <!-- Breadcrumb section -->
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center"
        style="background-image:  url('{{ asset('assets/frontend') }}/img/bg/breadcrumb-02.jpg');">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h1>Blog Details</h1>
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><i class="far fa-angle-double-right"></i></li>
                    <li>Blog Details</li>
                </ul>
            </div>
        </div>
        <h1 class="big-text">
            Blog
        </h1>
    </section>
    <!-- Breadcrumb section End-->
    <section class="blog-details-wrapper section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="post-details">
                        <div class="entry-header">
                            <div class="post-thumb">
                                <img src="{{ asset('uploads/blog') . '/' . $blog->image }}" alt="Image">
                            </div>
                            <ul class="entry-meta list-inline">
                                <li><a href="javascript:void(0)"><i
                                            class="far fa-user-alt"></i>{{ $blog->admin->name }}</a>
                                </li>
                                <li><a href="javascript:void(0)"><i
                                            class="far fa-calendar-alt"></i>{{ dateBlog($blog->created_at) }}</a>
                                </li>
                            </ul>
                            <h1 class="entry-title">{{ $blog->title }}</h1>
                        </div>
                        <div class="entry-content">
                            <p>
                                {!! $blog->content !!}
                            </p>
                        </div>
                        <div class="entry-footer d-flex justify-content-md-between">
                            <ul class="popular-tag list-inline">
                                <li class="title">Popular Tag :</li>
                                <li><a href="#">Hotel,</a></li>
                                <li><a href="#">Luxury,</a></li>
                                <li><a href="#">Living</a></li>
                            </ul>
                            <ul class="social-share list-inline">
                                <li class="title">Share </li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="comment-area">
                        <div class="reviews-head">
                            <h3 class="tab-title comment-title">{{ $total_comments }} Comments</h3>
                            <div class="select-filter">
                                <select name="filter" id="filter-comments">
                                    <option value="latest">Latest</option>
                                    <option value="oldest">Oldest</option>
                                </select>
                            </div>
                        </div>
                        {{-- Comment --}}
                        <div class="comment-all">
                            {{ showComments($comments) }}
                        </div>
                    </div>
                    <div class="comment-form">
                        <h2 class="comment-form-title">Send A Message</h2>
                        <form action="{{ route('comment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-wrap text-area">
                                        <textarea placeholder="Write Message" name="message"></textarea>
                                        <i class="far fa-pencil"></i>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn filled-btn">Send Message <i
                                            class="far fa-long-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Sidebars Area -->
                    <div class="sidebar-wrap">
                        <div class="widget search-widget">
                            <h4 class="widget-title">Search Here</h4>
                            <form>
                                <input type="text" placeholder="Seacrh Keywords">
                                <button><i class="far fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget recent-news">
                            <h4 class="widget-title">Latest News</h4>
                            <ul>
                                @foreach ($new_blogs as $blog)
                                <li>
                                    <div class="recent-post-img">
                                        <img src="{{ asset('uploads/blog') . '/' . $blog->image }}" alt="Image">
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
                                style="background-image: url('{{ asset('uploads/blog-categories/') . '/' . $category->image }}')">
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

@section('script-option')

<script>
    // Order Rating
        $('#filter-comments').change(function(e) {

            const sort_by = $(this).val();

            const _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "GET",
                datatype: 'html',
                url: `{{ route('sort_comments') }}`,
                data: {
                    sort_by: sort_by,
                    _token: _token
                },
                success: function(res) {
                    const html = res.html;
                    $('.comment-all').html(html);

                    // alert('Sort comments successfully !');
                },
                error: function(res) {
                    console.log(res);
                }
            });

        });
</script>

@endsection
