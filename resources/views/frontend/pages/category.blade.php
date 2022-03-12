@extends('frontend.layouts.master')

@section('content')

<main>
    <!-- Breadcrumb section -->
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center"
        style="background-image: url({{ asset('assets/frontend') }}/img/bg/breadcrumb-01.jpg)">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h1>Our Room</h1>
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><i class="far fa-angle-double-right"></i></li>
                    <li>Room</li>
                </ul>
            </div>
        </div>
        <h1 class="big-text">
            Room
        </h1>
    </section>
    <!-- Breadcrumb section End-->
    <!-- Latest Room Section -->
    <section class="rooms-warp list-view section-bg section-padding">
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
                <div class="col-lg-8 show-ajax">
                    @if (count($rooms) > 0)
                    <div class="item-list">
                        @foreach ($rooms as $room)
                        <!-- Single Room -->
                        <div class="single-room list-style">
                            <div class="row align-items-center no-gutters">
                                <div class="col-lg-6">
                                    <div class="room-thumb">
                                        <img src="{{ asset('uploads/rooms/room_avatar') }}/{{ $room->image }}"
                                            alt="Room">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="room-desc">
                                        <div class="room-cat">
                                            <p>{{ $room->category->name }}</p>
                                        </div>
                                        <h4><a href="{{ route('user.room', $room->slug) }}">{{ $room->name }}</a>
                                        </h4>
                                        <ul class="room-info list-inline">
                                            <li><i class="far fa-bed"></i>{{ $room->bed }} Bed</li>
                                            <li><i class="far fa-bath"></i>{{ $room->bath }} Bath</li>
                                            <li><i class="far fa-ruler-triangle"></i>{{ $room->area }}
                                                m<sup>2</sup>
                                            </li>
                                        </ul>
                                        <div class="room-price">
                                            <p>${{ moneyFormat($room->sale_price) }}<del
                                                    class="ml-2 text-secondary">${{ moneyFormat($room->price) }}</del>
                                            </p>
                                        </div>
                                        <div class="room-book float-right">
                                            <a href="{{ route('user.room', $room->slug) }}">Book now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="item-grid active">
                        <div class="row">
                            @foreach ($rooms as $room)
                            <div class="col-md-6">
                                <!-- Single Room -->
                                <div class="single-room">
                                    <div class="room-thumb">
                                        <img src="{{ asset('uploads/rooms/room_avatar') }}/{{ $room->image }}"
                                            alt="{{ $room->name }}">
                                    </div>
                                    <div class="room-desc">
                                        <div class="room-cat">
                                            <p>{{ $room->category->name }}</p>
                                        </div>
                                        <h4><a href="{{ route('user.room', $room->slug) }}">{{ $room->name }}</a>
                                        </h4>
                                        <p>{!! $room->description !!}</p>
                                        <ul class="room-info list-inline">
                                            <li><i class="far fa-bed"></i>{{ $room->bed }} Bed</li>
                                            <li><i class="far fa-bath"></i>{{ $room->bath }} Bath</li>
                                            <li><i class="far fa-ruler-triangle"></i>{{ $room->area }}
                                                m<sup>2</sup>
                                            </li>
                                        </ul>
                                        <div class="room-price">
                                            <p>${{ moneyFormat($room->sale_price) }}<del
                                                    class="ml-2 text-secondary">${{ moneyFormat($room->price) }}</del>
                                            </p>
                                        </div>
                                        <div class="room-book float-right">
                                            <a href="{{ route('user.room', $room->slug) }}">Book now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Pagination -->
                    <div class="pagination-wrap">
                        <ul class="list-inline">
                            @if ($rooms->onFirstPage())
                            <li class="disabled"><a href="#"><i class="far fa-angle-left"></i></a></li>
                            @else
                            <li>
                                <a href="{{ $rooms->previousPageUrl() }}">
                                    <i class="far fa-angle-left"></i>
                                </a>
                            </li>
                            @endif

                            @for ($i = 1; $i <= $rooms->lastPage(); $i++)
                                <li class="{{ $i == $rooms->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $rooms->url($i) }}">{{ $i }}</a>
                                </li>
                                @endfor

                                {{-- Last page --}}
                                @if ($rooms->hasMorePages())
                                <li><a href="{{ $rooms->nextPageUrl() }}"><i class="far fa-angle-right"></i></a>
                                </li>
                                @else
                                <li class="disabled"><a href="#"><i class="far fa-angle-right"></i></a></li>
                                @endif
                        </ul>
                    </div>
                    @else
                    <div class="show-alert col-12 py-5">
                        <h4 class="text-center my-5">No rooms were found !</h4>
                    </div>
                    @endif
                </div>
                {{-- Filter --}}
                <div class="col-lg-4">
                    <div class="sidebar-wrap">
                        <div class="widget fillter-widget">
                            <h4 class="widget-title">Your Selection</h4>
                            <form method="GET">
                                <div class="input-wrap">
                                    <select name="category_id" id="category">
                                        <option value="">Choose Category</option>
                                        @foreach ($categories as $category)
                                        <option {{ request()->category_id == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-wrap">
                                    <input type="text" placeholder="Name" name="name"
                                        value="{{ request()->name ?? old('name') }}">
                                    <i class="far fa-search"></i>
                                </div>
                                <div class="input-wrap">
                                    <select name="bed">
                                        <option value="" selected>Bed</option>
                                        @foreach (range(1, 4) as $item)
                                        <option {{ request()->bed == $item ? 'selected' : '' }} value="{{ $item }}">
                                            {{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-wrap">
                                    <select name="bath">
                                        <option value="" selected>Bath</option>
                                        @foreach (range(1, 4) as $item)
                                        <option {{ request()->bath == $item ? 'selected' : '' }} value="{{ $item }}">
                                            {{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-wrap">
                                    <div class="price-range-wrap">
                                        <div class="slider-range">
                                            <div id="slider-range"></div>
                                        </div>
                                        <div class="price-ammount">
                                            <input disabled type="text" id="amount">
                                            <input type="hidden" value="{{ $max_price }}" id="max" name="max">
                                            <input type="hidden" value="{{ $min_price }}" id="min" name="min">
                                            <input type="hidden" name="price_from" id="price_from"
                                                value="{{ request()->price_from ?? $min_price }}">
                                            <input type="hidden" name="price_to" id="price_to"
                                                value="{{ request()->price_to ?? $max_price }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-wrap">
                                    <button type="submit" class="btn filled-btn btn-block">
                                        Filter Results <i class="far fa-long-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Room Section Ends -->
    <!-- Brands section Start -->
    @includeIf('frontend.layouts.brand')
    <!-- ./ Brands section End -->
</main>

@endsection

@section('script-option')
<script>
    $('#sort').change(function(e) {

            const sortBy = $('#sort').val();

            const _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "GET",
                datatype: 'html',
                url: `{{ route('user.category_search_ajax') }}`,
                data: {
                    sort_by: sortBy,
                    _token: _token
                },
                success: function(res) {
                    console.log(res.status);
                    const html = res.html;
                    $('.show-ajax').html(html);
                },
                error: function(res) {
                    console.log(res);
                }
            });
        });
</script>
@endsection
