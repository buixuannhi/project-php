@extends('frontend.layouts.master')

@section('css-option')
<style>
    .custom-checkbox {
        width: 16px;
        height: 16px;
        margin: 5px;
    }
</style>
@endsection

@section('content')

<main>
    <div class="container margin_60">
        <div class="checkout-page">
            @if (!Auth::check())
            <ul class="default-links">
                <li>You need login to checkout !<a href="#">Click here to login.</a>
                </li>
            </ul>x
            @else
            @if (!count($cart->content()) > 0)
            <div class="cart-empty text-center">
                <h3>Your basket is empty! Please choose your room first.</h3>
                <a href="{{ route('user.category') }}" class="btn btn-primary p-2 my-3"><i
                        class="fas fa-arrow-left"></i> Choose Room
                </a>
            </div>
            @else
            <form action="{{ route('checkout.handle') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-details">
                            <div class="shop-form">
                                <form method="post">
                                    <div class="default-title">
                                        <h2>Billing Details</h2>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Full name <sup>*</sup>
                                            </label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') ?? Auth::user()->name }}">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Email Address <sup>*</sup>
                                            </label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') ?? Auth::user()->email }}">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Phone <sup>*</sup>
                                            </label>
                                            <input type="text" value="{{ old('phone') ?? Auth::user()->phone }}"
                                                name="phone" class="form-control">
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Address <sup>*</sup>
                                            </label>
                                            <input type="text" value="{{ old('address') ?? Auth::user()->address }}"
                                                name="address" class="form-control">
                                            @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Depart Date <sup>*</sup>
                                            </label>
                                            <input type="text" name="depart_date" id="depart-date-picker"
                                                class="form-control"
                                                value="{{ Session::get('depart_date')[0] ?? old('depart_date') }}">
                                            @error('depart_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Arrive Date <sup>*</sup>
                                            </label>
                                            <input type="text" name="arrive_date" id="arrive-date-picker"
                                                class="form-control"
                                                value="{{ Session::get('arrive_date')[0] ?? old('arrive_date') }}">
                                            @error('arrive_date')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="children">Children<sup>*</sup></label>
                                            <select name="children" id="children" class="form-control">
                                                <option value="children">Children</option>
                                                @foreach (range(0, 10) as $item)
                                                <option
                                                    {{ (Session::get('children')[0] ?? old('children')) == $item ? 'selected' : '' }}
                                                    value="{{ $item }}">{{ $item }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('children')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="adult">Adult<sup>*</sup></label>
                                            <select name="adult" id="adult" class="form-control">
                                                <option value="adult">Adult</option>
                                                @foreach (range(0, 10) as $item)
                                                <option
                                                    {{ (Session::get('adult')[0] ?? old('adult')) == $item ? 'selected' : '' }}
                                                    value="{{ $item }}">{{ $item }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('adult')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Order note</label>
                                            <textarea id="note" name="note" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--End Billing Details-->
                    </div>
                    <!--End Col-->
                    <div class="col-lg-5">
                        <div class="your-order">
                            <div class="default-title">
                                <h2>Your Order</h2>
                            </div>
                            <ul class="orders-table">
                                <li class="table-header clearfix">
                                    <div class="col">
                                        <strong>Service</strong>
                                    </div>
                                    <div class="col">
                                        <strong>Total</strong>
                                    </div>
                                </li>
                                {{-- Room --}}
                                @foreach ($cart->content() as $item)
                                <li class="clearfix">
                                    <div class="col" style="text-transform:none;">
                                        <img src="{{ asset('uploads/rooms/room_avatar') . '/' . $item['image'] }}"
                                            width="50" height="50" alt="Room images"><span>{{ $item['name'] }}
                                            x
                                            {{ $item['quantity'] }}</span>
                                    </div>
                                    <div class="col second">
                                        ${{ $item['price'] * $item['quantity'] }}
                                    </div>
                                </li>
                                @endforeach
                                {{-- Service --}}
                                <li class="clearfix">
                                    <div class="col second">
                                        <div class="form-checkbox">
                                            <input type="checkbox" class="custom-checkbox" id="all-service"
                                                name="all_service" value="all">
                                            <label class="form-control-label" for="all-service"><b>Choose
                                                    Services</b></label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="hours" id="hours" value="{{ $hours }}">
                                    <div class="col hours">
                                        Price
                                    </div>
                                </li>
                                @foreach ($services as $service)
                                <li class="clearfix">
                                    <div class="col second">
                                        <div class="form-checkbox">
                                            <input type="checkbox" data-price="{{ $service->price }}"
                                                class="custom-checkbox service-checkbox" id="service-{{ $service->id }}"
                                                name="services[]" value="{{ $service->id }}">
                                            <label class="form-control-label"
                                                for="service-{{ $service->id }}">{{ $service->title }}</label>
                                        </div>
                                    </div>
                                    <div class="col second">
                                        ${{ moneyFormat($service->price) }}
                                    </div>
                                </li>
                                @endforeach
                                {{-- Hours --}}
                                <li class="clearfix">
                                    <div class="col" style="text-transform:none;">
                                        <b>Hours</b>
                                    </div>
                                    <input type="hidden" name="hours" id="hours" value="{{ $hours }}">
                                    <div class="col hours">
                                        {{ $hours }} Hours
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="col" style="text-transform:none;">
                                        <b>Price</b>
                                    </div>
                                    <div class="col second">
                                        ${{ $cart->getTotalAmount() }} / h
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="col">
                                        <strong>Total:</strong>
                                    </div>
                                    <div class="col second">
                                        <strong
                                            id="show-total">${{ moneyFormat($cart->getTotalAmount() * $hours) }}</strong>
                                        <input type="hidden" name="total" id="total"
                                            value="{{ moneyFormat($cart->getTotalAmount() * $hours) }}">
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="col" style="text-transform:none;">
                                        <b>Discount</b>
                                    </div>
                                    <div class="col second">
                                        - $ <span id="discount">0</span>
                                    </div>
                                </li>
                                <li class="clearfix total">
                                    <div class="col" style="text-transform:none;">
                                        <b>Payable Amount:</b>
                                    </div>
                                    <div class="col second">
                                        <input type="hidden" name="total_amount" id="total_amount"
                                            value="{{ $cart->getTotalAmount() * $hours }}">
                                        <input type="hidden" name="old_total_amount" id="old_total_amount">
                                        <strong
                                            id="show-total-amount">${{ moneyFormat($cart->getTotalAmount() * $hours) }}</strong>
                                    </div>
                                </li>
                            </ul>
                            <div class="coupon-code">
                                <div class="form-group">
                                    <div class="field-group">
                                        <div class="form-group mr-3">
                                            <input type="hidden" name="coupon_id" id="coupon_id">
                                            <input type="text" name="code" class="form-control"
                                                placeholder="Enter your coupon ..."
                                                value="@if (Session::has('coupon')){{ Session::get('coupon')[0] }}@else{{ old('code') }}@endif"
                                                id="code" autocomplete="off">
                                            <div class="mess-error m-1" style="display: none">
                                                <span class="text-danger">Your coupon invalid !</span>
                                            </div>
                                            <div class="mess-success m-1" style="display: none">
                                                <span class="text-success">Apply coupon success !</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field-group btn-field">
                                        <button id="check-code" type="button" class="btn filled-btn">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Your Order-->
                        <div class="place-order">
                            <div class="default-title">
                                <h2>Payment Method</h2>
                            </div>
                            <div class="payment-options">
                                <ul>
                                    @foreach ($payments as $payment)
                                    <li>
                                        <div class="radio-option">
                                            <input type="radio" name="payment_id" id="payment-{{ $payment->id }}"
                                                value="{{ $payment->id }}" {{ $payment->id == 1 ? 'checked' : '' }}>
                                            <label for="payment-{{ $payment->id }}">{{ $payment->name }}</label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="pay-pal my-3">
                                <p class="my-2">Account: sb-wt6bp7807118@business.example.com</p>
                                <div id="paypal-button"></div>
                            </div>
                            <button id="checkout-button" type="submit" class="btn filled-btn p-3">Place Order <i
                                    class="icon-left"></i>
                            </button>
                        </div>
                        <!--End Place Order-->
                    </div>
                </div>
            </form>
            @endif
            @endif
        </div>
    </div>
    <!-- End Container -->
</main>
@endsection

@section('script-option')
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    $(document).ready(function() {
            // Select all service
            $("#all-service").click(function(event) {
                if (this.checked) {
                    $(":checkbox").each(function() {
                        this.checked = true;
                    });
                } else {
                    $(":checkbox").each(function() {
                        this.checked = false;
                    });
                }
            });

            $(function() {
                $('.custom-checkbox').click(function() {

                    // Uncheck All Service
                    // $("#all-service").prop('checked', false);

                    var services = [];
                    var total_service_price = 0;

                    $('.service-checkbox:checked').each(function(i) {
                        services[i] = $(this).val();

                        // Get price each service
                        let price = parseFloat($(this).attr('data-price'));

                        // Calculate total service
                        total_service_price += price;

                    });

                    console.log(services);
                    console.log(total_service_price);

                    // Get token
                    const _token = $('meta[name="csrf-token"]').attr('content');
                    const old_total_amount = $('#old_total_amount').val();

                    // Ajax calculate total price after choose service
                    $.ajax({
                        type: "GET",
                        url: `{{ route('select_services') }}`,
                        data: {
                            total_amount: old_total_amount,
                            total_service_price: total_service_price,
                            _token: _token
                        },
                        success: function(res) {
                            console.log(res);

                            // Set new total amount
                            $('#total_amount').val(parseFloat(res.total_amount).toFixed(
                                2));
                            $('#show-total-amount').html('$' + parseFloat(res
                                .total_amount).toFixed(
                                2));
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    });


                });
            });

            $('#children').niceSelect('destroy');
            $('#adult').niceSelect('destroy');
            $('select').niceSelect(
                'destroy');

            // Toggle layouts
            $(function() {
                $('.pay-pal').hide();

                $("#payment-1").click(function() {
                    $('.pay-pal').hide();
                    $("#checkout-button").show();
                });

                $("#payment-2").click(function() {
                    $('.pay-pal').show();
                    $("#checkout-button").hide();
                });
            });

            // Call check coupon
            function checkCoupon() {
                const code = $('#code').val();

                if (!(code.trim().length == 0)) {
                    const _token = $('meta[name="csrf-token"]').attr('content');
                    const total_amount = $('#total').val();

                    $.ajax({
                        type: "GET",
                        url: `{{ route('check_coupon') }}`,
                        data: {
                            code: code,
                            page: 'checkout',
                            total_amount: total_amount,
                            _token: _token
                        },
                        success: function(res) {
                            // console.log(res);
                            $(".mess-success").css('display', 'block');
                            $(".mess-error").css('display', 'none');

                            $('#discount').html(parseFloat(res.discount).toFixed(2));
                            $('#total_amount').val(parseFloat(res.total_amount).toFixed(2));
                            $('#old_total_amount').val(parseFloat(res.total_amount).toFixed(2));
                            $('#coupon_id').val(res.coupon_id);
                            $('#show-total-amount').html('$' + res.total_amount);
                        },
                        error: function(res) {
                            $(".mess-success").css('display', 'none');
                            $(".mess-error").css('display', 'block');
                            $(".mess-error").text('display');

                            const old_value = $("#total").val();
                            $('#discount').html(0);
                            $('#coupon_id').val(0);
                            $('#total_amount').val(old_value);
                            $('#old_total_amount').val(old_value);
                            $('#show-total-amount').html('$' + old_value);
                        }
                    });
                }
            }

            // Check coupon
            $('#check-code').click(function(e) {
                e.preventDefault();
                checkCoupon();
            });

            // Date Picker
            $(function() {
                var startDepart = moment();
                var startArrive = moment().add(2, "days");

                // Check session date exits
                var depart_date = $('#depart-date-picker').val();
                if (!depart_date) {
                    depart_date = startDepart;
                }

                var arrive_date = $('#arrive-date-picker').val();
                if (!arrive_date) {
                    arrive_date = startArrive;
                }

                $("#depart-date-picker").daterangepicker({
                    timePicker: true,
                    singleDatePicker: true,
                    timePickerSeconds: false,
                    startDate: depart_date,
                    locale: {
                        format: "M/DD/Y hh:mm A",
                    },
                });

                $("#arrive-date-picker").daterangepicker({
                    timePicker: true,
                    singleDatePicker: true,
                    timePickerSeconds: false,
                    startDate: arrive_date,
                    locale: {
                        format: "M/DD/Y hh:mm A",
                    },
                });
            });

            // Change Date
            $('#depart-date-picker').change(function(e) {
                dateChange();
            });

            $('#arrive-date-picker').change(function(e) {
                dateChange();
            });

            function dateChange() {
                const depart_date = $('#depart-date-picker').val();
                const arrive_date = $('#arrive-date-picker').val();

                // Get token
                const _token = $('meta[name="csrf-token"]').attr('content');
                const url = "{{ route('checkout.change_date') }}";

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        depart_date: depart_date,
                        arrive_date: arrive_date,
                        _token: _token
                    },
                    success: function(res) {
                        if (res.hours) {
                            $('#hours').val(res.hours);
                            $('.hours').html(res.hours + ' Hours');
                            $('#total_amount').val((parseFloat(res.hours *
                                    "{{ $cart->getTotalAmount() }}")
                                .toFixed(2)));

                            $('#show-total').html('$' + (parseFloat(res.hours *
                                "{{ $cart->getTotalAmount() }}").toFixed(2)));

                            $("#total").val(parseFloat(res.hours *
                                    "{{ $cart->getTotalAmount() }}")
                                .toFixed(2));

                            $('#show-total-amount').html('$' + (parseFloat(res.hours *
                                "{{ $cart->getTotalAmount() }}").toFixed(2)));
                        }

                        // Call Check coupon
                        checkCoupon();
                    }
                });
            }

            paypal.Button.render({
                // Configure environment
                env: 'sandbox',
                client: {
                    sandbox: 'Ad4-Hp9VFeiA_XcRBt-cCu136Oc8YE1bJ2UQOk2jhxgwTxW6ma-TvHWq1vph-J-Ih_gYPZKeSqAbrxDX',
                    production: 'demo_production_client_id'
                },
                // Customize button (optional)
                locale: 'en_US',
                style: {
                    size: 'medium',
                    color: 'gold',
                    shape: 'pill',
                },

                // Enable Pay Now checkout flow (optional)
                commit: true,

                // Set up a payment
                payment: function(data, actions) {

                    // Get total amount

                    const total = $('#total_amount').val();

                    return actions.payment.create({
                        transactions: [{
                            amount: {
                                total: total,
                                currency: 'USD'
                            }
                        }]
                    });
                },
                // Execute the payment
                onAuthorize: function(data, actions) {
                    return actions.payment.execute().then(function(data) {
                        // Show a confirmation message to the buyer
                        window.alert('Thank you for your purchase!');

                        // Get value order
                        const total_amount = data.transactions[0].amount.total;
                        const name = $('input[name="name"]').val();
                        const email = $('input[name="email"]').val();
                        const phone = $('input[name="phone"]').val();
                        const address = $('input[name="address"]').val();
                        const arrive_date = $('input[name="arrive_date"]').val();
                        const depart_date = $('input[name="depart_date"]').val();
                        const children = $("#children").val();
                        const adult = $('#adult').val();
                        const payment_id = 2;
                        const coupon_id = $("#coupon_id").val();
                        const note = $('#note').val();

                        var services = [];
                        $('.service-checkbox:checked').each(function(i) {
                            services[i] = $(this).val();
                        });

                        const url = "{{ route('checkout.handle') }}";
                        const _token = $('meta[name="csrf-token"]').attr('content');

                        if (data) {
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: {
                                    _token: _token,
                                    'name': name,
                                    'email': email,
                                    'phone': phone,
                                    'address': address,
                                    'arrive_date': arrive_date,
                                    'depart_date': depart_date,
                                    'children': children,
                                    'adult': adult,
                                    'note': note,
                                    'status': 1,
                                    'services': services,
                                    'coupon_id': coupon_id,
                                    'payment_id': payment_id,
                                    'total_amount': total_amount
                                },
                                success: function(response) {
                                    // Redirect route success
                                    console.log(res);
                                    window.location.replace(response
                                        .success);
                                },
                                error: function(response) {
                                    console.log(response);
                                }
                            });
                        }
                    });
                }
            }, '#paypal-button');
        });
</script>
@endsection
