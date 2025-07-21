<div class="header-mid-one-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-mid-wrapper-between">
                    <div class="nav-sm-left">
                        <ul class="nav-h_top">
                            <li><a href="about.html">{{ trans('site/site.about_us') }}</a></li>
                            <li><a href="account.html">{{ trans('site/site.my_account') }}</a></li>
                            <li><a href="wishlist.html">{{ trans('site/site.wishlist') }}</a></li>
                        </ul>
                        <p class="para">{{ trans('site/site.we_delivery_to_your_everyday_from') }} 7:00 {{ trans('site/site.we_delivery_to_your_everyday_to') }} 22:00</p>
                    </div>
                    <div class="nav-sm-left">
                        <ul class="nav-h_top language">
                            {{--<li class="category-hover-header language-hover">
                                <a href="#">English</a>
                                <ul class="category-sub-menu">
                                    <li>
                                        <a href="#" class="menu-item">
                                            <span>Italian</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="menu-item">
                                            <span>Russian</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="menu-item">
                                            <span>Chinian</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>--}}
                            <li class="category-hover-header language-hover">
                                <a href="#">{{ LaravelLocalization::getCurrentLocaleNative() }}</a>
                                <ul class="category-sub-menu">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    @if(app()->getLocale() !== $localeCode)
                                    <li>
                                        <a class="menu-item" rel="alternate" hreflang="{{ $localeCode }}"
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            <span>{{ $properties['native'] }}</span>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                            {{--<li class="category-hover-header language-hover">
                                <a href="#">
                                    USD
                                </a>
                                <ul class="category-sub-menu">
                                    <li>
                                        <a href="#" class="menu-item">
                                            <span>Rubol</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="menu-item">
                                            <span>Rupi</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="menu-item">
                                            <span>Euro</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>--}}
                            <li><a href="trackorder.html">Track Order</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
