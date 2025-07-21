@extends('website.layouts.common.website')
@section('css')

@endsection

@section('pageTitle')
{{$pageTitle}}
@endsection

@section('content')
    <div class="rts-register-area rts-section-gap bg_light-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="registration-wrapper-1">
                        <div class="logo-area mb--0">
                            <img class="mb--10" src="{{ asset('assets/images/logo/fav.png') }}" alt="logo">
                        </div>
                        <h3 class="title">Login Into Your Account</h3>
                        <form action="{{ route('auth.login.submit') }}" method="POST" class="registration-form">
                            @csrf
                            <div class="input-wrapper">
                                <label for="email">Email*</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="input-wrapper">
                                <label for="password">Password*</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <button class="rts-btn btn-primary">Login Account</button>
                            <div class="another-way-to-registration">
                                <p>Don’t Have Account? <a href="{{ route('auth.register') }}">Register New Account</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
