<!-- rts header area start -->
<!-- rts header area start -->
<div class="rts-header-one-area-one">
    @include('website.layouts.common.includes.headers._top_area')
    @include('website.layouts.common.includes.headers._mid_area')
    @include('website.layouts.common.includes.headers._search_area')
    @include('website.layouts.common.includes.headers._top_menu')
</div>
<!-- rts header area end -->

<!-- rts header area start -->
<!-- header style two -->
<div id="side-bar" class="side-bar header-two">
    <button class="close-icon-menu"><i class="far fa-times"></i></button>


    

    {{--<div class="mobile-menu-nav-area tab-nav-btn mt--20">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Menu</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Category</button>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                tabindex="0">
                <!-- mobile menu area start -->
                <div class="mobile-menu-main">
                    <nav class="nav-main mainmenu-nav mt--30">
                        <ul class="mainmenu metismenu" id="mobile-menu-active">
                            <li class="has-droupdown">
                                <a href="#" class="main">Home</a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="index.html">Home One</a></li>
                                    <li><a class="mobile-menu-link" href="index-two.html">Home Two</a></li>
                                    <li><a class="mobile-menu-link" href="index-three.html">Home Three</a></li>
                                    <li><a class="mobile-menu-link" href="index-four.html">Home Four</a></li>
                                    <li><a class="mobile-menu-link" href="index-five.html"> Home Five</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="about.html" class="main">About</a>
                            </li>
                            <li class="has-droupdown">
                                <a href="#" class="main">Pages</a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="about.html">About</a></li>
                                    <li><a class="mobile-menu-link" href="faq.html">Faq's</a></li>
                                    <li><a class="mobile-menu-link" href="invoice.html">Invoice</a></li>
                                    <li><a class="mobile-menu-link" href="contact.html">Contact</a></li>
                                    <li><a class="mobile-menu-link" href="register.html">Register</a></li>
                                    <li><a class="mobile-menu-link" href="login.html">Login</a></li>
                                    <li><a class="mobile-menu-link" href="privacy-policy.html">Privacy Policy</a>
                                    </li>
                                    <li><a class="mobile-menu-link" href="cookies-policy.html">Cookies Policy</a>
                                    </li>
                                    <li><a class="mobile-menu-link" href="terms-condition.html">Terms Condition</a>
                                    </li>
                                    <li><a class="mobile-menu-link" href="404.html">Error Page</a></li>
                                </ul>
                            </li>
                            <li class="has-droupdown">
                                <a href="#" class="main">Shop</a>
                                <ul class="submenu mm-collapse">
                                    <li class="has-droupdown third-lvl">
                                        <a class="main" href="#">Shop Layout</a>
                                        <ul class="submenu-third-lvl mm-collapse">
                                            <li><a href="shop-grid-sidebar.html"></a>Shop Grid Sidebar</li>
                                            <li><a href="shop-list-sidebar.html"></a>Shop List Sidebar</li>
                                            <li><a href="shop-grid-top-filter.html"></a>Shop Grid Top Filter</li>
                                            <li><a href="shop-list-top-filter.html"></a>Shop List Top Filter</li>
                                        </ul>
                                    </li>
                                    <li class="has-droupdown third-lvl">
                                        <a class="main" href="#">Shop Details</a>
                                        <ul class="submenu-third-lvl mm-collapse">
                                            <li><a href="shop-details.html"></a>Shop Details</li>
                                            <li><a href="shop-details-2.html"></a>Shop Details 2</li>
                                            <li><a href="shop-grid-top-filter.html"></a>Shop Grid Top Filter</li>
                                            <li><a href="shop-list-top-filter.html"></a>Shop List Top Filter</li>
                                        </ul>
                                    </li>
                                    <li class="has-droupdown third-lvl">
                                        <a class="main" href="#">Product Feature</a>
                                        <ul class="submenu-third-lvl mm-collapse">
                                            <li><a href="shop-details-variable.html"></a>Shop Details Variable</li>
                                            <li><a href="shop-details-affiliats.html"></a>Shop Details Affiliats
                                            </li>
                                            <li><a href="shop-details-group.html"></a>Shop Details Group</li>
                                            <li><a href="shop-compare.html"></a>Shop Compare</li>
                                        </ul>
                                    </li>
                                    <li class="has-droupdown third-lvl">
                                        <a class="main" href="#">Shop Others</a>
                                        <ul class="submenu-third-lvl mm-collapse">
                                            <li><a href="cart.html"></a>Cart</li>
                                            <li><a href="checkout.html"></a>Checkout</li>
                                            <li><a href="trackorder.html"></a>Trackorder</li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-droupdown">
                                <a href="#" class="main">Blog</a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="blog.html">Blog</a></li>
                                    <li><a class="mobile-menu-link" href="blog-list-left-sidebar.html">Blog Left
                                            Sidebar</a></li>
                                    <li><a class="mobile-menu-link" href="blog-list-right-sidebar.html">Blog List
                                            Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="contact.html" class="main">Contact Us</a>
                            </li>
                        </ul>
                    </nav>

                </div>
                <!-- mobile menu area end -->
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <div class="category-btn category-hover-header menu-category">
                    <ul class="category-sub-menu" id="category-active-menu">
                        <li>
                            <a href="#" class="menu-item">
                                <img src="assets/images/icons/01.svg" alt="icons">
                                <span>Breakfast &amp; Dairy</span>
                                <i class="fa-regular fa-plus"></i>
                            </a>
                            <ul class="submenu mm-collapse">
                                <li><a class="mobile-menu-link" href="#">Breakfast</a></li>
                                <li><a class="mobile-menu-link" href="#">Dinner</a></li>
                                <li><a class="mobile-menu-link" href="#"> Pumking</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="menu-item">
                                <img src="assets/images/icons/02.svg" alt="icons">
                                <span>Meats &amp; Seafood</span>
                                <i class="fa-regular fa-plus"></i>
                            </a>
                            <ul class="submenu mm-collapse">
                                <li><a class="mobile-menu-link" href="#">Breakfast</a></li>
                                <li><a class="mobile-menu-link" href="#">Dinner</a></li>
                                <li><a class="mobile-menu-link" href="#"> Pumking</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="menu-item">
                                <img src="assets/images/icons/03.svg" alt="icons">
                                <span>Breads &amp; Bakery</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu-item">
                                <img src="assets/images/icons/04.svg" alt="icons">
                                <span>Chips &amp; Snacks</span>
                                <i class="fa-regular fa-plus"></i>
                            </a>
                            <ul class="submenu mm-collapse">
                                <li><a class="mobile-menu-link" href="#">Breakfast</a></li>
                                <li><a class="mobile-menu-link" href="#">Dinner</a></li>
                                <li><a class="mobile-menu-link" href="#"> Pumking</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="menu-item">
                                <img src="assets/images/icons/05.svg" alt="icons">
                                <span>Medical Healthcare</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu-item">
                                <img src="assets/images/icons/06.svg" alt="icons">
                                <span>Breads &amp; Bakery</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu-item">
                                <img src="assets/images/icons/07.svg" alt="icons">
                                <span>Biscuits &amp; Snacks</span>
                                <i class="fa-regular fa-plus"></i>
                            </a>
                            <ul class="submenu mm-collapse">
                                <li><a class="mobile-menu-link" href="#">Breakfast</a></li>
                                <li><a class="mobile-menu-link" href="#">Dinner</a></li>
                                <li><a class="mobile-menu-link" href="#"> Pumking</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="menu-item">
                                <img src="assets/images/icons/08.svg" alt="icons">
                                <span>Frozen Foods</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu-item">
                                <img src="assets/images/icons/09.svg" alt="icons">
                                <span>Grocery &amp; Staples</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="menu-item">
                                <img src="assets/images/icons/10.svg" alt="icons">
                                <span>Other Items</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>--}}
    <div class="mobile-menu-nav-area tab-nav-btn mt--20">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">القائمه</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">الفئات</button>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                tabindex="0">
                <!-- mobile menu area start -->
                <div class="mobile-menu-main">
                    <nav class="nav-main mainmenu-nav mt--30">
                        <ul class="mainmenu metismenu" id="mobile-menu-active">
                            <li>
                                <a class="main" href="{{route('home')}}">{{trans('site/site.home_page_title')}}</a>
                            </li>
                            <li>
                                <a href="{{route('about')}}">{{trans('site/site.about_us')}}</a>
                            </li>
                            <li>
                                <a href="{{route('shop.index')}}" class="main">{{trans('site/site.shop')}}</a>
                            </li>
                            <li>
                                <a href="{{route('contact')}}" class="main">{{trans('site/site.contact_us')}}</a>
                            </li>
                        </ul>
                    </nav>

                </div>
                <!-- mobile menu area end -->
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <div class="category-btn category-hover-header menu-category">
                    <ul class="category-sub-menu" id="category-active-menu">
                        @foreach($categories as $category)
                        <li>
                            <a href="#" class="menu-item">
                                <img src="{{ $category->getMediaUrl('category', $category, null, 'media', 'category') ?? asset('assets/images/icons/default.svg') }}"
                                    style="max-width: 25px; max-height: 25px; object-fit: cover; border-radius: 5px;" alt="{{$category->name}}">
                                <span>{{ $category->name }}</span>
                                @if($category->children->isNotEmpty())
                                <i class="fa-regular fa-plus"></i>
                                @endif
                            </a>
                            @if($category->children->isNotEmpty())
                            <ul class="submenu mm-collapse">
                                @foreach($category->children as $sub)
                                <li><a class="mobile-menu-link" href="{{ route('shop.index', ['category_id' => $category->id]) }}">{{ $sub->name
                                        }}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="button-area-main-wrapper-menuy-sidebar mt--50">
        <div class="contact-area">
            <div class="phone">
                <i class="fa-light fa-headset"></i>
                <a href="#">{{--$settings?->phone--}}</a>
            </div>
        </div>
        <div class="buton-area-bottom">
            <a href="{{route('auth.login')}}" class="rts-btn btn-primary">تسجيل الدخول</a>
            <a href="{{route('auth.register')}}" class="rts-btn btn-primary">مستخدم جديد</a>
        </div>
    </div>

</div>
<!-- header style two End -->
<!-- rts header area end -->
<!-- rts header area end -->
