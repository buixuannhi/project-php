@extends('backend.layouts.master')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Dashboard</strong></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Rooms</h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="fas fa-hotel"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ $rooms }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Orders</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="shopping-bag"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ $orders }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Unpaid</h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="activity"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ $unpaid }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Accounts</h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="far fa-user"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">{{ $accounts }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle"><strong>Reservation List</strong></h1>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">User booking room</h5>
                </div>
                <div class="card-body">
                    <div id="fullcalendar"></div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('script-option')

<script src="{{ asset('assets/backend') }}/js/fullcalendar.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
            // Call ajax get all events
            const url = "{{ route('admin.events') }}";

            const _token = $('meta[name="csrf-token"]').attr('content');

            var events = [];
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    _token: _token
                },
                success: function(res) {
                    if (res.status) {
                        events = res.events;

                        // Get current date
                        var today = new Date();
                        var day = String(today.getDate()).padStart(2, '0');
                        var month = String(today.getMonth() + 1).padStart(2, '0');  //January is 0!
                        var year = today.getFullYear();

                        var init_date = `${year}-${month}-01`;

                        // Render Calender
                        var calendarEl = document.getElementById("fullcalendar");
                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            themeSystem: "Materia",
                            initialView: "dayGridMonth",
                            initialDate: init_date,
                            headerToolbar: {
                                left: "prev,next today",
                                center: "title",
                                right: "dayGridMonth,timeGridWeek,timeGridDay"
                            },
                            events: events
                        });
                        setTimeout(function() {
                            console.log(events);
                            calendar.render();
                        }, 250)
                    }
                },
                error: function(res) {
                    console.log(res);
                }
            });


        });
</script>

@endsection
