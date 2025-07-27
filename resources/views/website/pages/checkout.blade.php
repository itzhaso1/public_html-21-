@extends('website.layouts.common.website')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('pageTitle')
{{ $pageTitle }}
@endsection

@section('content')
<div class="checkout-area rts-section-gap">
    <div class="container">
        <div class="row">
            <div class="order-2 col-lg-8 pr--40 pr_md--5 pr_sm--5 order-xl-1 order-lg-2 order-md-2 order-sm-2 mt_md--30 mt_sm--30">
                <!-- Start Billing -->
                <div class="rts-billing-details-area">
                    <h3 class="title">Billing Details</h3>
                    <form action="{{route('checkout')}}" method="POST">
                        @csrf
                        <div class="single-input">
                            <label for="coupon_code">Enter Coupon Code</label>
                            <input id="coupon_code" name="coupon_code" type="text" placeholder="Enter Coupon Code" />
                        </div>
                        <div class="single-input">
                            <label for="email">Email Address*</label>
                            <input id="email" name="addr[billing][email]" type="text" required />
                        </div>
                        <div class="half-input-wrapper">
                            <div class="single-input">
                                <label for="f-name">First Name*</label>
                                <input id="f-name" name="addr[billing][first_name]" type="text" required />
                            </div>
                            <div class="single-input">
                                <label for="l-name">Last Name*</label>
                                <input id="l-name" name="addr[billing][last_name]" type="text" />
                            </div>
                        </div>
                        <div class="single-input">
                            <label for="country">Country</label>
                            <input id="country" name="addr[billing][country]" type="text" />
                        </div>
                        <div class="single-input">
                            <label for="city">City*</label>
                            <input id="city" name="addr[billing][city]" type="text" />
                        </div>
                        <div class="single-input">
                            <label for="state">State*</label>
                            <input id="state" name="addr[billing][state]" type="text" />
                        </div>
                        <div class="single-input">
                            <label for="street">Street Address*</label>
                            <input name="addr[billing][street]" type="text" required />
                        </div>
                        <div class="single-input">
                            <label for="phone">Phone*</label>
                            <input id="phone" name="addr[billing][phone]" type="text" />
                        </div>
                        <div class="single-input">
                            <label for="ordernotes">Order Notes*</label>
                            <textarea name="addr[billing][order_notes]" id="ordernotes"></textarea>
                        </div>
                        @if(auth()->check()) 
                                <button type="submit" class="rts-btn btn-primary">Place Order</button>
                            @else 
                                <a link="{{route('auth.login')}}" class="rts-btn btn-primary">قم بتسجيل الدخول لاتمام عمليه الشراء</a>
                            
                        @endif
                    </form>
                </div>
                <!-- End Billing -->
            </div>
            <!-- Start Your Order -->
            <div class="order-1 col-lg-4 order-xl-2 order-lg-1 order-md-1 order-sm-1">
                <h3 class="title-checkout">Your Order</h3>
                <div class="right-card-sidebar-checkout">
                    <div class="top-wrapper">
                        <div class="product">Products</div>
                        <div class="price">Price</div>
                    </div>
                    {{--<div class="single-shop-list">
                        <div class="left-area">
                            <a href="#" class="thumbnail">
                                <img src="assets/images/shop/04.png" alt="" />
                            </a>
                            <a href="#" class="title">
                                Foster Farms Breast Nuggets Shaped Chicken
                            </a>
                        </div>
                        <span class="price">$500.00</span>
                    </div>--}}
                    <div class="single-shop-list">
                        <div class="left-area">
                            <span style="font-weight: 600; color: #2c3c28">Total Price:</span>
                        </div>
                        <span class="price" style="color: #629d23">{{$total}}</span>
                    </div>
                </div>
            </div>
            <!-- End Your Order -->
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush