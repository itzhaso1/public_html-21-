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
                        <img class="mb--10" src="{{$logo}}" alt="logo">
                    </div>
                    <h3 class="title">Register New Account</h3>
                    <form action="{{ route('auth.register.submit') }}" method="POST" class="registration-form">
                        @csrf
                        <div class="input-wrapper">
                            <label for="name">Name*</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="input-wrapper">
                            <label for="email">Email*</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="input-wrapper">
                            <label for="phone">Phone*</label>
                            <input type="text" id="phone" name="phone" required>
                        </div>
                        <div class="input-wrapper">
                            <label for="password">Password*</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <button class="rts-btn btn-primary">Register Account</button>
                        <div class="another-way-to-registration">
                            <p>Already Have Account? <a href="{{ route('auth.login') }}">Login</a></p>
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
