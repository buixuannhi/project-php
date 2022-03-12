@extends('backend.layouts.master')

@section('css-option')
<style>
    #map {
        height: 100%;
    }
</style>

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3 mx-2">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>{{ $page }}</strong></h3>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('info.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    @includeIf('backend.layouts.alert')
                    <div class="row">
                        <div class="col-lg-6 px-3">
                            {{-- Name --}}
                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                    name="name" value="{{ old('name') ?? $info->name }}" autofocus>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Email --}}
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" id="email"
                                    name="email" value="{{ old('email') ?? $info->email }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Logo --}}
                            <div class="form-group">
                                <label for="category_image">Choose Logo :</label>
                                <input class="form-control-file" type="file" name="logo_image" id="category_image">
                                @error('logo_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="my-2">
                                <img id="image-show" style="padding: 10px 10px 10px 0;" width="70%"
                                    src="{{ asset('uploads/logo') . '/' . $info->logo }}">
                            </div>
                        </div>
                        <div class="col-lg-6 px-3">
                            {{-- Phone --}}
                            <div class="form-group">
                                <label for="phone">Phone :</label>
                                <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone"
                                    name="phone" value="{{ old('phone') ?? $info->phone }}">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Address --}}
                            <div class="form-group">
                                <label for="address">Address :</label>
                                <input class="form-control @error('address') is-invalid @enderror" type="address"
                                    id="address" name="address" value="{{ old('address') ?? $info->address }}">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 mx-1 my-4" style="height: 400px">
                            <div class="form-group">
                                @error('map')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <input type="hidden" name="map" id="location" value="{{ $info->map }}">
                            </div>
                            <div id="map"></div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" class="btn btn-warning btn-lg mx-1">
                        Update Information !
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('script-option')
@includeIf('backend.layouts.preview-input-selected')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFGZV7aczW8BFE53IKMt4DeiPWEFDCRwE&callback=initMap&v=weekly"
    async>
</script>
{{-- Getting Lat/Lng from a Click Event --}}
<script>
    const input = document.getElementById("location").value;
        const latlngStr = input.split(",", 2);
        const myLatlng = {
            lat: parseFloat(latlngStr[0]),
            lng: parseFloat(latlngStr[1]),
        };

        function initMap() {
            // const myLatlng = {
            //     lat: 21.046571907695437,
            //     lng: 105.78343945608991
            // };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: myLatlng,
            });
            // Create the initial InfoWindow.
            let infoWindow = new google.maps.InfoWindow({
                content: "This is your location !",
                position: myLatlng,
            });

            infoWindow.open(map);
            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => {
                // Close the current InfoWindow.
                infoWindow.close();
                // Create a new InfoWindow.
                infoWindow = new google.maps.InfoWindow({
                    position: mapsMouseEvent.latLng,
                });
                infoWindow.setContent(
                    JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                );
                infoWindow.open(map);

                $('#location').val(mapsMouseEvent.latLng.lat() + ',' + mapsMouseEvent.latLng.lng());
            });
        }
</script>
@endsection
