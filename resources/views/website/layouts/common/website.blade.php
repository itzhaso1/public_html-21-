@include('website.layouts.common.includes._tpl_start')
@include('website.layouts.common.includes._header')
@if (!request()->is(app()->getLocale()))
    @include('website.layouts.common.includes._breadcrumb', ['pageTitle' => $pageTitle ?? ''])
@endif
@yield('content')
@include('website.layouts.common.includes._partials.message')
@include('website.layouts.common.includes._footer')
@include('website.layouts.common.includes._tpl_end')
