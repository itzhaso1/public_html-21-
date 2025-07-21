@extends('website.layouts.common.website')
@section('css')


<style>
    .quantity-ed {
        display: flex;
        align-items: center;
        max-width: 140px;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .quantity-ed button {
        width: 35px;
        height: 38px;
        border: none;
        background-color: #eee;
        font-size: 18px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .quantity-ed button:hover {
        background-color: #ddd;
    }

    .quantity-ed input[type="number"] {
        width: 60px;
        height: 38px;
        border: none;
        text-align: center;
        font-size: 16px;
        background: transparent;
        outline: none;
        -moz-appearance: textfield;
    }

    .quantity-ed input::-webkit-outer-spin-button,
    .quantity-ed input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endsection

@section('pageTitle')
{{$pageTitle}}
@endsection

@section('content')
    <!-- shop[ grid sidebar wrapper -->
    <div class="shop-grid-sidebar-area rts-section-gap">
        <div class="container">
            <div class="row g-0">
                {{-- Sidebar Filters --}}
                <div class="col-xl-3 col-lg-12 pl--70 pl_lg--10 pl_sm--10 pl_md--5 rts-sticky-column-item">
                    <div class="sidebar-filter-main theiaStickySidebar">
                        <form method="GET" action="{{ route('shop.index') }}">

                            {{-- Price Filter --}}
                            <div class="single-filter-box">
                                <h5 class="title">Filter by Price</h5>
                                <div class="filterbox-body">
                                    <div class="price-input-area">
                                        <div class="half-input-wrapper">
                                            <div class="single">
                                                <label for="min_price">Min price</label>
                                                <input name="min_price" id="min_price" type="number" value="{{ request('min_price') ?? 0 }}">
                                            </div>
                                            <div class="single">
                                                <label for="max_price">Max price</label>
                                                <input name="max_price" id="max_price" type="number" value="{{ request('max_price') ?? 1000 }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Categories Filter --}}
                            <div class="single-filter-box">
                                <h5 class="title">{{trans('site/site.categories')}}</h5>
                                <div class="filterbox-body">
                                    <div class="category-wrapper">
                                        @foreach($categories as $category)
                                            <div class="single-category">
                                                <input 
                                                    type="radio"
                                                    name="category_id"
                                                    id="cat{{ $category->id }}"
                                                    value="{{ $category->id }}"
                                                    {{ request('category_id') == $category->id ? 'checked' : '' }}
                                                >
                                                <label for="cat{{ $category->id }}">
                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Brands Filter --}}
                            <div class="single-filter-box">
                                <h5 class="title">{{trans('site/site.brands')}}</h5>
                                <div class="filterbox-body">
                                    <div class="category-wrapper">
                                        @foreach($brands as $brand)
                                            <div class="single-category">
                                                <input 
                                                    type="radio"
                                                    name="brand_id"
                                                    id="brand{{ $brand->id }}"
                                                    value="{{ $brand->id }}"
                                                    {{ request('brand_id') == $brand->id ? 'checked' : '' }}
                                                >
                                                <label for="brand{{ $brand->id }}">
                                                    {{ $brand->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <div class="single-filter-box mt-2 d-flex justify-content-between gap-2">
                                <button type="submit" class="rts-btn btn-primary w-50">Apply Filters</button>
                                <a href="{{ route('shop.index') }}" class="rts-btn btn-secondary w-50">Reset Filters</a>
                            </div>

                        </form>
                    </div>
                </div>

                {{-- Product Grid --}}
                <div class="col-xl-9 col-lg-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="product-area-wrapper-shopgrid-list mt--20 tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="row g-4">
                                @forelse($products as $product)
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="single-shopping-card-one">
                                            <div class="image-and-action-area-wrapper">
                                                <a href="{{ route('shop.product.show', $product->id) }}" class="thumbnail-preview">
                                                    <img src="{{ $product->getMediaUrl('product', $product, null, 'media', 'product') }}" alt="{{ $product->name }}">
                                                </a>
                                            </div>

                                            <div class="body-content">
                                                <a href="{{ route('shop.product.show', $product->id) }}">
                                                    <h4 class="title">{{ $product->name }}</h4>
                                                </a>
                                                <span class="availability">{{ $product->stock ?? '' }}</span>
                                                <div class="price-area">
                                                    <span class="current">${{ $product->price }}</span>
                                                    @if($product->price_before_discount)
                                                        <div class="previous">${{ $product->price_before_discount }}</div>
                                                    @endif
                                                </div>
                                                <div class="cart-counter-action">
                                                    <form action="{{-- route('cart.add', $product->id) --}}" method="POST">
                                                        @csrf
                                                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                                                            <!-- كمية + - -->
                                                            <div class="d-flex align-items-center gap-2">
                                                                <button type="button" class="btn btn-success rounded-circle p-2" onclick="increaseQty(this)">+</button>

                                                                <input name="quantity" id="quantity" type="number" value="1" min="1"
                                                                    class="form-control text-center"
                                                                    style="width: 60px; height: 40px;">

                                                                <button type="button" class="btn btn-warning rounded-circle p-2" onclick="decreaseQty(this)">−</button>
                                                            </div>

                                                            <!-- زرار Add To Cart -->
                                                            <button type="submit" class="rts-btn btn-primary radious-sm with-icon d-flex align-items-center gap-1">
                                                                <span class="btn-text">Add To Cart</span>
                                                                <i class="fa-regular fa-cart-shopping"></i>
                                                            </button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p>No products found.</p>
                                    </div>
                                @endforelse
                            </div>

                            {{-- Pagination --}}
                            <div class="row mt-4">
                                <div class="col-12 d-flex justify-content-center">
                                    {{ $products->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop[ grid sidebar wrapper end -->
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