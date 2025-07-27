@extends('website.layouts.common.website')
@section('css')

@endsection

@section('pageTitle')
{{$pageTitle ?? $product?->name}}
@endsection

@section('content')
<div class="rts-chop-details-area rts-section-gap bg_light-1">
    <div class="container">
        <div class="shopdetails-style-1-wrapper">
            <div class="row g-5">
                <div class="col-xl-8 col-lg-8 col-md-12">
                    <div class="product-details-popup-wrapper in-shopdetails">
                        <div
                            class="rts-product-details-section rts-product-details-section2 product-details-popup-section">
                            <div class="product-details-popup">
                                <div class="details-product-area">
                                    <div class="product-thumb-area">
                                        <div class="cursor"></div>
                                        <div class="thumb-wrapper one filterd-items figure">
                                            <div class="product-thumb zoom" onmousemove="zoom(event)"
                                                style="background-image: url({{$product->getMediaUrl('product', $product, null, 'media', 'product') }})">
                                                <img src="{{$product->getMediaUrl('product', $product, null, 'media', 'product') }}"
                                                    alt="product-thumb">
                                            </div>
                                        </div>
                                        <div class="thumb-wrapper two filterd-items hide">
                                            <div class="product-thumb zoom" onmousemove="zoom(event)"
                                                style="background-image: url({{$product->getMediaUrl('product', $product, null, 'media', 'product') }})">
                                                <img src="{{$product->getMediaUrl('product', $product, null, 'media', 'product') }}"
                                                    alt="product-thumb">
                                            </div>
                                        </div>
                                        <div class="thumb-wrapper three filterd-items hide">
                                            <div class="product-thumb zoom" onmousemove="zoom(event)"
                                                style="background-image: url({{$product->getMediaUrl('product', $product, null, 'media', 'product') }})">
                                                <img src="{{$product->getMediaUrl('product', $product, null, 'media', 'product') }}"
                                                    alt="product-thumb">
                                            </div>
                                        </div>
                                        <div class="thumb-wrapper four filterd-items hide">
                                            <div class="product-thumb zoom" onmousemove="zoom(event)"
                                                style="background-image: url({{$product->getMediaUrl('product', $product, null, 'media', 'product') }})">
                                                <img src="{{$product->getMediaUrl('product', $product, null, 'media', 'product') }}"
                                                    alt="product-thumb">
                                            </div>
                                        </div>
                                        <div class="thumb-wrapper five filterd-items hide">
                                            <div class="product-thumb zoom" onmousemove="zoom(event)"
                                                style="background-image: url({{$product->getMediaUrl('product', $product, null, 'media', 'product') }})">
                                                <img src="{{$product->getMediaUrl('product', $product, null, 'media', 'product') }}"
                                                    alt="product-thumb">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contents">
                                        <h2 class="product-title">{{$product?->name}}</h2>
                                        <p class="mt--20 mb--20">
                                            {{$product?->description}}
                                        </p>
                                        <span class="product-price mb--15 d-block"
                                            style="color: #DC2626; font-weight: 600;"> {{$product?->price}}<span
                                                class="old-price ml--15">{{$product?->price_before_discount}}</span></span>
                                        <div class="product-bottom-action">
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <div
                                                    class="flex-wrap gap-2 d-flex justify-content-between align-items-center">
                                                    <div class="gap-2 d-flex align-items-center">
                                                        <button type="button" class="p-2 btn btn-success rounded-circle"
                                                            onclick="increaseQty(this)">+</button>

                                                        <input name="quantity" id="quantity" type="number" value="1"
                                                            min="1" class="text-center form-control"
                                                            style="width: 60px; height: 40px;">

                                                        <button type="button" class="p-2 btn btn-warning rounded-circle"
                                                            onclick="decreaseQty(this)">−</button>
                                                    </div>
                                                    <button type="submit"
                                                        class="gap-1 rts-btn btn-primary radious-sm with-icon d-flex align-items-center">
                                                        <span class="btn-text">Add To Cart</span>
                                                        <i class="fa-regular fa-cart-shopping"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="product-uniques">
                                            <span class="sku product-unipue mb--10"><span
                                                    style="font-weight: 400; margin-right: 10px;">SKU: </span>
                                                {{$product?->sku}}</span>
                                            <span class="catagorys product-unipue mb--10">
                                                <span style="font-weight: 400; margin-right: 10px;">Category:</span>
                                                {{ $product?->category?->name ?? 'N/A' }}
                                            </span>
                                            <span class="tags product-unipue mb--10">
                                                <span style="font-weight: 400; margin-right: 10px;">Tags: </span>
                                                {{ $product?->tags?->pluck('name')->join(', ') ?? '-' }}
                                            </span>

                                            <span class="tags product-unipue mb--10">
                                                <span style="font-weight: 400; margin-right: 10px;">Type: </span>
                                                {{ $product?->type?->name ?? '-' }}
                                            </span>
                                            <span class="tags product-unipue mb--10">
                                                <span style="font-weight: 400; margin-right: 10px;">Brand: </span>
                                                {{ $product?->brand?->name ?? '-' }}
                                            </span>
                                            <span class="tags product-unipue mb--10">
                                                <span style="font-weight: 400; margin-right: 10px;">Sections: </span>
                                                {{ $product?->tags?->pluck('name')->join(', ') ?? '-' }}
                                            </span>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-xl-4 col-lg-4 col-md-12 pr_lg--50 rts-sticky-column-item">
                    <div class="theiaStickySidebar">
                        <div class="shop-sight-sticky-sidevbar mb--20">
                            <h6 class="title">Available offers</h6>
                            <div class="single-offer-area">
                                <div class="icon">
                                    <img src="assets/images/shop/01.svg" alt="icon">
                                </div>
                                <div class="details">
                                    <p>Get %5 instant discount for the 1st Flipkart Order using Ekomart UPI T&C</p>
                                </div>
                            </div>
                            <div class="single-offer-area">
                                <div class="icon">
                                    <img src="assets/images/shop/02.svg" alt="icon">
                                </div>
                                <div class="details">
                                    <p>Flat $250 off on Citi-branded Credit Card EMI Transactions on orders of $30 and
                                        above T&C</p>
                                </div>
                            </div>
                            <div class="single-offer-area">
                                <div class="icon">
                                    <img src="assets/images/shop/03.svg" alt="icon">
                                </div>
                                <div class="details">
                                    <p>Free Worldwide Shipping on all
                                        orders over $100</p>
                                </div>
                            </div>
                        </div>
                        <div class="our-payment-method">
                            <h5 class="title">Guaranteed Safe Checkout</h5>
                            <img src="assets/images/shop/03.png" alt="">
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
</div>
<!-- Start Related Product -->
<!-- rts grocery feature area start -->
<div class="rts-grocery-feature-area rts-section-gap bg_light-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-area-between">
                    <h2 class="title-left">Related Product</h2>
                    <div class="next-prev-swiper-wrapper">
                        <div class="swiper-button-prev"><i class="fa-regular fa-chevron-left"></i></div>
                        <div class="swiper-button-next"><i class="fa-regular fa-chevron-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="category-area-main-wrapper-one">
                    @php
                    $slidesCount = min(6, $relatedProducts->count());
                    $loopEnabled = $relatedProducts->count() > 6;

                    $swiperOptions = [
                    "spaceBetween" => 16,
                    "slidesPerView" => $slidesCount,
                    "loop" => $loopEnabled,
                    "speed" => 700,
                    "navigation" => [
                    "nextEl" => ".swiper-button-next",
                    "prevEl" => ".swiper-button-prev",
                    ],
                    "breakpoints" => [
                    "0" => ["slidesPerView" => 1, "spaceBetween" => 12],
                    "380" => ["slidesPerView" => 1, "spaceBetween" => 12],
                    "480" => ["slidesPerView" => 2, "spaceBetween" => 12],
                    "640" => ["slidesPerView" => 2, "spaceBetween" => 16],
                    "840" => ["slidesPerView" => 3, "spaceBetween" => 16],
                    "1540" => ["slidesPerView" => 6, "spaceBetween" => 16],
                    ]
                    ];
                    @endphp

                    <div class="swiper mySwiper-category-1 swiper-data" data-swiper='@json($swiperOptions)'>
                        <div class="swiper-wrapper">
                            @forelse ($relatedProducts as $related)
                            <div class="swiper-slide">
                                <div class="single-shopping-card-one">
                                    <div class="image-and-action-area-wrapper">
                                        <a href="{{ route('shop.product.show', $related->id) }}"
                                            class="thumbnail-preview">
                                            <img src="{{ $related->getMediaUrl('product', $related, null, 'media', 'product') }}"
                                                alt="{{ $related->name }}">
                                        </a>
                                    </div>

                                    <div class="body-content">
                                        <a href="{{ route('shop.product.show', $related->id) }}">
                                            <h4 class="title">{{ $related->name }}</h4>
                                        </a>
                                        <span class="availability">{{ $related->stock }}</span>
                                        <div class="price-area">
                                            <span class="current">${{ number_format($related->price, 2) }}</span>
                                            @if ($related->price_before_discount)
                                            <div class="previous">${{ number_format($related->price_before_discount, 2)
                                                }}</div>
                                            @endif
                                        </div>
                                        <div class="cart-counter-action">
                                            <div class="quantity-edit">
                                                <input type="text" class="input" value="1">
                                                <div class="button-wrapper-action">
                                                    <button class="button"><i
                                                            class="fa-regular fa-chevron-down"></i></button>
                                                    <button class="button plus">+<i
                                                            class="fa-regular fa-chevron-up"></i></button>
                                                </div>
                                            </div>
                                            <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                <div class="btn-text">Add To Cart</div>
                                                <div class="arrow-icon"><i class="fa-regular fa-cart-shopping"></i>
                                                </div>
                                                <div class="arrow-icon"><i class="fa-regular fa-cart-shopping"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="swiper-slide">
                                <p>لا توجد منتجات مرتبطة للعرض.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Related Product -->
@endsection

@push('js')
<script>
    function increaseQty(button) {
const input = button.parentElement.querySelector('input[type="number"]');
let current = parseInt(input.value) || 1;
input.value = current + 1;
}

function decreaseQty(button) {
const input = button.parentElement.querySelector('input[type="number"]');
let current = parseInt(input.value) || 1;
if (current > 1) {
input.value = current - 1;
}
}
</script>
@endpush