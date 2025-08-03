@extends('website.layouts.common.website')
@section('css')

@endsection

@section('pageTitle')
{{$pageTitle}}
@endsection

@section('content')
    <!-- Start Slider -->
    <div class="background-light-gray-color rts-section-gap bg_light-1 pt_sm--20">
        <!-- rts banner area start -->
        <div class="rts-banner-area-one mb--30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="category-area-main-wrapper-one">
                            <div class="swiper mySwiper-category-1 swiper-data" data-swiper='{
                                    "spaceBetween":1,
                                    "slidesPerView":1,
                                    "loop": true,
                                    "speed": 2000,
                                    "dir": "rtl",
                                    "autoplay":{
                                        "delay":"4000"
                                    },
                                    "navigation":{
                                        "nextEl":".swiper-button-next",
                                        "prevEl":".swiper-button-prev"
                                    },
                                    "breakpoints":{
                                    "0":{
                                        "slidesPerView":1,
                                        "spaceBetween": 0},
                                    "320":{
                                        "slidesPerView":1,
                                        "spaceBetween":0},
                                    "480":{
                                        "slidesPerView":1,
                                        "spaceBetween":0},
                                    "640":{
                                        "slidesPerView":1,
                                        "spaceBetween":0},
                                    "840":{
                                        "slidesPerView":1,
                                        "spaceBetween":0},
                                    "1140":{
                                        "slidesPerView":1,
                                        "spaceBetween":0}
                                    }
                                }'>
                                <div class="swiper-wrapper">
                                    @forelse ($sliders as $slider)
                                    <div class="swiper-slide">
                                        <div class="banner-bg-image bg_image bg_one-banner ptb--120 ptb_md--80 ptb_sm--60"
                                            style="background-image: url('{{ $slider->getMediaUrl('slider', $slider, null, 'media', 'slider') }}'); background-size: cover; background-position: center;">
                                            <div class="banner-one-inner-content">
                                                <span class="pre">{{ $slider->description ?? ' ' }}
                                                    }}</span>
                                                <h1 class="title">
                                                    {{ $slider->name ?? ' ' }} <br>
                                                </h1>
                                                {{--<a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        {{ __('Shop Now') }}
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa-light fa-arrow-right"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa-light fa-arrow-right"></i>
                                                    </div>
                                                </a>--}}
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="swiper-slide">
                                        <div class="banner-bg-image bg_image ptb--120 ptb_md--80 ptb_sm--60"
                                            style="background-color: #f3f3f3; display: flex; align-items: center; justify-content: center;">
                                            <h4 class="text-muted">{{ __('لا توجد سلايدر حالياً') }}</h4>
                                        </div>
                                    </div>
                                    @endforelse
                                </div>
                                <button class="swiper-button-next"><i class="fa-regular fa-arrow-right"></i></button>
                                <button class="swiper-button-prev"><i class="fa-regular fa-arrow-left"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- rts banner area end -->
        <!-- rts category area start -->
        <div class="rts-caregory-area-one">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @php
                            $categoryCount = $categories->count();
                            $slidesPerView = $categoryCount < 10 ? $categoryCount : 10; $swiperOptions=[ 'spaceBetween'=> 12,
                                'slidesPerView' => $slidesPerView,
                                'loop' => true,
                                'speed' => 1000,
                                'breakpoints' => [
                                '0' => ['slidesPerView' => 2, 'spaceBetween' => 12],
                                '320' => ['slidesPerView' => 2, 'spaceBetween' => 12],
                                '480' => ['slidesPerView' => 3, 'spaceBetween' => 12],
                                '640' => ['slidesPerView' => 4, 'spaceBetween' => 12],
                                '840' => ['slidesPerView' => 4, 'spaceBetween' => 12],
                                '1140' => ['slidesPerView' => $slidesPerView, 'spaceBetween' => 12],
                                ]
                                ];
                        @endphp
                        <div class="category-area-main-wrapper-one">
                            <div class="swiper mySwiper-category-1 swiper-data" data-swiper='@json($swiperOptions)'>
                                <div class="swiper-wrapper">
                                    @forelse($categories as $category)
                                    <div class="swiper-slide">
                                        <a href="{{ route('shop.index', ['category_id' => $category->id]) }}" class="single-category-one">
                                            <img src="{{ $category->getMediaUrl('category', $category, null, 'media', 'category') }}"
                                                alt="{{ $category->name }}">
                                            <p>{{ $category->name }}</p>
                                        </a>
                                    </div>
                                    @empty
                                    <div class="swiper-slide">
                                        <p class="text-center text-muted">لا توجد فئات مميزة حالياً</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- rts category area end -->
    </div>
    <!-- End Slider -->

    <!-- Start Featured Category -->
    <div class="rts-feature-area rts-section-gap">
        <div class="container">
        </div>
    </div>
    <!-- End Featured Category -->

    <!-- rts grocery feature area start -->


    <!-- rts grocery feature area start -->
    @foreach($sections as $index => $section)
        @if($section->design_type == 'layout1')
            @include('website.sections.layouts._layout_1', ['section' => $section, 'index' => $index])
        @elseif($section->design_type == 'layout2')
            @include('website.sections.layouts._layout_2', ['section' => $section, 'index' => $index])
        @elseif($section->design_type == 'layout3')
            @include('website.sections.layouts._layout_3', ['section' => $section, 'index' => $index])
        @elseif($section->design_type == 'layout4')
            @include('website.sections.layouts._layout_4', ['section' => $section, 'index' => $index])
        @endif
    @endforeach
    <!-- rts grocery feature area end -->
@endsection

@push('js')

@endpush
