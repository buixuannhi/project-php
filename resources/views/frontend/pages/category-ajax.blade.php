<div class="item-list">
    @foreach ($rooms as $room)
    <!-- Single Room -->
    <div class="single-room list-style">
        <div class="row align-items-center no-gutters">
            <div class="col-lg-6">
                <div class="room-thumb">
                    <img src="{{ asset('uploads/rooms/room_avatar') }}/{{ $room->image }}" alt="Room">
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
                    <img src="{{ asset('uploads/rooms/room_avatar') }}/{{ $room->image }}" alt="{{ $room->name }}">
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
