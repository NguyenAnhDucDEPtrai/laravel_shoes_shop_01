<!-- resources/views/front/partials/shoe-list.blade.php -->
@foreach($shoes as $shoe)
<div class="col-md-4">
    <div class="card product-card">
        <div class="product-image position-relative">
            @if ($shoe->images->isNotEmpty())
            <a href="{{ route('front.shoeDetail', $shoe->id) }}" class="product-img"><img class="card-img-top" src="{{ asset($shoe->images->first()->image_url) }}" alt=""></a>
            @endif
        </div>
        <div class="card-body text-center mt-3">
            <a class="h6 link" href="{{ route('front.shoeDetail', $shoe->id) }}">{{ $shoe->shoe_name }}</a>
            <div class="price mt-2">
                <span class="h5"><strong>${{ $shoe->price }}</strong></span>
            </div>
        </div>
    </div>
</div>
@endforeach