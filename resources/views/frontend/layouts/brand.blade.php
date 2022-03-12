<section class="brands-section primary-bg">
    <div class="container">
        <div id="brandsSlideActive" class="row">
            @foreach ($brands as $brand)
            <div class="col-lg-2">
                <div class="brand-item text-center">
                    <img src="{{ asset("uploads/brands/$brand->image") }}" alt="Brands">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
