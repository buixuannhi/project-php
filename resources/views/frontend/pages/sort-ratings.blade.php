@foreach ($ratings as $rating)
<li>
    <div class="comment-author">
        <img src="{{ asset('assets/frontend') }}/img/blog-details/04.jpg" alt="reviews">
    </div>
    <div class="comment-desc">
        <h6>{{ $rating->user->name }}<span
                class="comment-date mx-2">{{ date_format($rating->created_at, 'F d, Y \a\t g:i') }}</span>
        </h6>
        <p>{{ $rating->message }}</p>
        <div class="autor-rating">
            <div class="ratings-full">
                <span class="ratings" style="width:{{ ($rating->star / 5) * 100 }}%">
                </span>
                <span class="tooltiptext tooltip-top">{{ $rating->star }}</span>
            </div>
        </div>
    </div>
</li>
@endforeach
