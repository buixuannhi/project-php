@extends('frontend.layouts.master')

@section('content')

<main>
    <div class="container margin_60">
        <div class="order-complete-page">
            <div class="complete-pane">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Order History.</h4>
                    </div>
                </div>
                @foreach ($orders as $order)
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex justify-content-around lh-condensed">
                                <div class="order-details text-center">
                                    <div class="order-title"><b>No.</b></div>
                                    <div class="order-info">#{{ $loop->iteration }}</div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>Booking Date</b></div>
                                    <div class="order-info">{{ dateComment($order->created_at) }}</div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>Depart Date</b></div>
                                    <div class="order-info">
                                        {{ dateComment($order->depart_date) }}
                                    </div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>Arrive Date</b></div>
                                    <div class="order-info">
                                        {{ dateComment($order->arrive_date) }}
                                    </div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>Hours</b></div>
                                    <div class="order-info">
                                        {{ countHours($order->depart_date, $order->arrive_date) }} Hours
                                    </div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>Amount Paid</b></div>
                                    <div class="order-info">${{ moneyFormat($order->total_amount) }}</div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>Payment Method</b></div>
                                    <div class="order-info">{{ $order->payment->name }}</div>
                                </div>
                                <div class="order-details text-center">
                                    <div class="order-title"><b>View Details</b></div>
                                    <div class="order-info"><a class="text-secondary"
                                            href="{{ route('order_details', $order->id) }}">View</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Container -->
</main>

@endsection
