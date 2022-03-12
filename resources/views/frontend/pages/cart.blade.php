@extends('frontend.layouts.master')

@section('content')

<main>
    <!-- Breadcrumb section -->
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center"
        style="background-image: url({{ asset('assets/frontend') }}/img/bg/breadcrumb-01.jpg);">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h1>Cart</h1>
                <ul class="list-inline">
                    <li><a href="index-2.html">Home</a></li>
                    <li><i class="far fa-angle-double-right"></i></li>
                    <li>Cart</li>
                </ul>
            </div>
        </div>
        <h1 class="big-text">
            Cart
        </h1>
    </section>
    <!-- Breadcrumb section End-->
    <section class="rooms-warp list-view section-bg">
        <div class="container">
            <div class="cart-page">
                <div class="margin_60">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                {{-- Show Alert --}}
                                @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success !</strong> {{ Session('success') }}.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                @if (!count($cart->content()) > 0)
                                <div class="cart-empty text-center">
                                    <h3>Your cart is empty !</h3>
                                    <a href="{{ route('user.category') }}" class="btn btn-primary p-2 my-3"><i
                                            class="fas fa-arrow-left"></i> Booking
                                        now
                                    </a>
                                </div>
                                @else
                                <div class="table-cart">
                                    <table class="table table-borderless mb-0">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="20%">Image</th>
                                                <th width="20%">Name</th>
                                                <th width="20%">Information</th>
                                                <th width="15%">Room</th>
                                                <th width="15%">Total</th>
                                                <th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart->content() as $key => $item)
                                            <form action="{{ route('cart.update', $key) }}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="key-delete" id="key-{{ $loop->iteration }}"
                                                    value="{{ $key }}">
                                                <tr class="text-center">
                                                    <td>
                                                        <div class="room-img d-flex align-items-center">
                                                            <img class="img-fluid"
                                                                src="{{ asset('uploads/rooms/room_avatar') . '/' . $item['image'] }}"
                                                                alt="Image">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="room-title"><strong>
                                                                <a
                                                                    href="{{ route('user.room', $item['room']->slug) }}">{{ $item['name'] }}</a>
                                                            </strong>
                                                        </div>
                                                        <div class="room-title"><strong>Category:
                                                            </strong>{{ $item['room']->category->name }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="room-bed"><strong>Bed :
                                                            </strong>{{ $item['room']->bed }}
                                                        </div>
                                                        <div class="room-bath">
                                                            <strong>Bath: </strong>{{ $item['room']->bath }}
                                                        </div>
                                                        <div class="room-size"><strong>Area: </strong>
                                                            {{ $item['room']->area }}m<sup>2</sup>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group bootstrap-touchspin">
                                                            <span
                                                                class="input-group-btn input-group-prepend bootstrap-touchspin-injected">
                                                                <button id="{{ $loop->iteration }}"
                                                                    class="btn btn-primary bootstrap-touchspin-down count-down"
                                                                    type="button"> -
                                                                </button>
                                                            </span>
                                                            <input type="text" id="count-{{ $loop->iteration }}"
                                                                class="text-center count touchspin form-control"
                                                                value="{{ $item['quantity'] }}" name="quantity">
                                                            <span
                                                                class="input-group-btn input-group-append bootstrap-touchspin-injected">
                                                                <button id="{{ $loop->iteration }}"
                                                                    class="btn btn-primary bootstrap-touchspin-up count-up"
                                                                    type="button"> + </button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="total-price">
                                                            ${{ $item['quantity'] * $item['price'] }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="room-action">
                                                            <button type="submit" class="text-dark action-cart"><i
                                                                    class="far fa-save"></i></button>
                                                            <a href="{{ route('cart.remove', $key) }}"
                                                                onclick="return confirm('Are you sure to take this action?')"
                                                                class="text-dark action-cart">
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </form>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="match-height row mb-5">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Apply Coupon</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <label class="text-muted">Enter your coupon code if you have one!</label>
                                    <form action="{{ route('check_coupon') }}" method="GET" id="form-add-coupon">
                                        @csrf
                                        <div class="form-body">
                                            <input type="text" class="form-control-lg" name="code" id="code"
                                                placeholder="Enter Coupon Code Here"
                                                value="@if (Session::has('coupon')){{ Session::get('coupon')[0] }}@else{{ old('code') }}@endif">
                                            <div class="mess-error m-1" style="display: none">
                                                <span class="text-danger">Your coupon invalid please try again !</span>
                                            </div>
                                            <div class="mess-success m-1" style="display: none">
                                                <span class="text-success">Apply coupon successfully !</span>
                                            </div>
                                        </div>
                                        <div class="form-actions border-0 pb-0 text-right">
                                            <button type="submit" class="btn btn-info">Apply Code</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Price Details</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="price-detail"><strong>Room :</strong>
                                        <span class="float-right"><strong>Total:</strong></span>
                                    </div>
                                    @foreach ($cart->content() as $key => $item)
                                    <div class="price-detail">{{ $item['name'] }} ({{ $item['quantity'] }} rooms) <span
                                            class="float-right">${{ $item['quantity'] * $item['price'] }}</span>
                                    </div>
                                    @endforeach
                                    <div class="price-detail">Coupon: <span class="float-right">- $ <span
                                                id="discount">0</span></span>
                                    </div>
                                    <input type="hidden" name="total" id="total" value="{{ $cart->getTotalAmount() }}">
                                    <div class="price-detail"><b>Total:</b> <span class="float-right">$
                                            {{ $cart->getTotalAmount() }}</span>
                                    </div>
                                    <hr>
                                    <div class="price-detail">Payable Amount <span class="float-right">$<span
                                                id="total_amount">{{ $cart->getTotalAmount() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-5">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="text-right">
                                        <a href="{{ route('user.category') }}" class="btn btn-info p-2 mr-3"><i
                                                class="fas fa-arrow-left"></i> Book
                                            Room</a>
                                        <a href="{{ route('checkout.show') }}" class="btn btn-primary p-2">
                                            Place Order
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- End Container -->
            </div>
        </div>
    </section>
</main>
@endsection

@section('script-option')
<script>
    $('#form-add-coupon').submit(function(e) {
            e.preventDefault();

            const code = $('#code').val();

            const _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "GET",
                url: `{{ route('check_coupon') }}`,
                data: {
                    code: code,
                    _token: _token
                },
                success: function(res) {
                    $(".mess-error").css('display', 'none');
                    $(".mess-success").css('display', 'block');
                    $('#discount').html(res.discount);
                    $('#total_amount').html(res.total_amount);
                },
                error: function(res) {
                    $(".mess-success").css('display', 'none');
                    $(".mess-error").css('display', 'block');
                    const old_value = $("#total").val();
                    $('#discount').html(0);
                    $('#total_amount').html(old_value);
                }
            });

        });
</script>
@endsection
