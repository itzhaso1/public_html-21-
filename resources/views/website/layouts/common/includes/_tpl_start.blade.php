<!DOCTYPE html>
@if (app()->getLocale() == 'ar')
    <html direction="rtl" dir="rtl">
@else
    <html lang="en">
@endif

<head>
    <meta charset="UTF-8">
    <meta name="description"
        content="{{ $settings?->description }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="{{ $settings?->description }}">
    <title>{{ $settings?->name }} | @yield('pageTitle')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ $favicon ?? asset('dashboard/assets/media/logos/logo-demo13-compact.svg') }}">
    <!-- plugins css -->


    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet preload" href="{{asset('assets/css/plugins.css')}}" as="style">
        <link rel="stylesheet preload" href="{{asset('assets/css/style.css')}}" as="style">
    @else
        <link rel="stylesheet preload" href="{{asset('assets/css/plugins_ltr.css')}}" as="style">
        <link rel="stylesheet preload" href="{{asset('assets/css/style_ltr.css')}}" as="style">
    @endif
    @stack('css')
</head>

<body class="shop-main-h">
