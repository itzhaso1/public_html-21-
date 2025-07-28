<div class="search-header-area-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="logo-search-category-wrapper">
                    <a href="index.html" class="logo-area">
                        <img src="{{$logo}}" alt="logo-main" class="logo" style="max-width: 100px; height: auto;">
                    </a>
                    <div class="category-search-wrapper">
                        <div class="category-btn category-hover-header">
                            <img class="parent" src="{{asset('assets/images/icons/bar-1.svg')}}" alt="icons">
                            <span>{{ trans('site/site.categories') }}</span>
                            <ul class="category-sub-menu" id="category-active-four">
                                @foreach($categories as $category)
                                <li>
                                    <a href="#" class="menu-item">
                                        <img src="{{ $category->getMediaUrl('category', $category, null, 'media', 'category') ?? asset('assets/images/icons/default.svg') }}" style="max-width: 25px; max-height: 25px; object-fit: cover; border-radius: 5px;" alt="{{$category->name}}">
                                        <span>{{ $category->name }}</span>
                                        @if($category->children->isNotEmpty())
                                        <i class="fa-regular fa-plus"></i>
                                        @endif
                                    </a>
                                    @if($category->children->isNotEmpty())
                                    <ul class="submenu mm-collapse">
                                        @foreach($category->children as $sub)
                                        <li><a class="mobile-menu-link" href="{{ route('shop.index', ['category_id' => $category->id]) }}">{{ $sub->name }}</a></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <form action="#" class="search-header">
                            <input type="text" placeholder="{{ trans('site/site.search_placeholder') }}" required>
                            <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                <div class="btn-text">
                                    {{ trans('site/site.search') }}
                                </div>
                                <div class="arrow-icon">
                                    <i class="fa-light fa-magnifying-glass"></i>
                                </div>
                                <div class="arrow-icon">
                                    <i class="fa-light fa-magnifying-glass"></i>
                                </div>
                            </a>
                        </form>
                    </div>
                    <div class="actions-area">
                        <div class="search-btn" id="searchs">
                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.75 14.7188L11.5625 10.5312C12.4688 9.4375 12.9688 8.03125 12.9688 6.5C12.9688 2.9375 10.0312 0 6.46875 0C2.875 0 0 2.9375 0 6.5C0 10.0938 2.90625 13 6.46875 13C7.96875 13 9.375 12.5 10.5 11.5938L14.6875 15.7812C14.8438 15.9375 15.0312 16 15.25 16C15.4375 16 15.625 15.9375 15.75 15.7812C16.0625 15.5 16.0625 15.0312 15.75 14.7188ZM1.5 6.5C1.5 3.75 3.71875 1.5 6.5 1.5C9.25 1.5 11.5 3.75 11.5 6.5C11.5 9.28125 9.25 11.5 6.5 11.5C3.71875 11.5 1.5 9.28125 1.5 6.5Z"
                                    fill="#1F1F25"></path>
                            </svg>
                        </div>
                        <div class="menu-btn" id="menu-btn">
                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect y="14" width="20" height="2" fill="#1F1F25"></rect>
                                <rect y="7" width="20" height="2" fill="#1F1F25"></rect>
                                <rect width="20" height="2" fill="#1F1F25"></rect>
                            </svg>
                        </div>
                    </div>
                    <div class="accont-wishlist-cart-area-header">
                        {{--<a href="account.html" class="btn-border-only account">
                            <i class="fa-light fa-user"></i>
                            <span>{{ trans('site/site.my_account') }}</span>
                        </a>--}}
                        @auth
                        <a href="{{-- route('account.dashboard') --}}" class="btn-border-only account">
                            <i class="fa-light fa-user"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <form action="{{ route('auth.logout') }}" method="POST" class="btn-border-only">
                            @csrf
                            <button type="submit" class="btn-border-only" style="background: none; border: none;">
                                <i class="fa-light fa-arrow-right-from-bracket"></i>
                                <span>{{ trans('site/site.logout') }}</span>
                            </button>
                        </form>
                        @else
                            <a href="{{ route('auth.login') }}" class="btn-border-only account">
                                <i class="fa-light fa-user"></i>
                                <span>{{ trans('site/site.my_account') }}</span>
                            </a>
                        @endauth
                        <x-cart-menu />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
