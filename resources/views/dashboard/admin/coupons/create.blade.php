@extends('dashboard.layouts.master')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endsection

@section('pageTitle')
    {{ $pageTitle }}
@endsection

@section('content')
    @include('dashboard.layouts.common._partial.messages')
    <div id="kt_content_container" class="container-xxl">
        <div class="mb-5 card card-xxl-stretch mb-xl-8">
            <!--begin::Header-->
            <div class="pt-5 border-0 card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="mb-1 card-label fw-bolder fs-3">{{ $pageTitle }}</span>
                    <span class="mt-1 text-muted fw-bold fs-7">{{ $pageTitle }}</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="py-3 card-body">
                <form action="{{ route('admin.coupons.store') }}" method="POST">
                    @csrf
                    <div class="row g-3"> <!-- g-3 adds spacing between columns -->

                        <div class="col-md-4">
                            <label for="name" class="form-label">الكوبون:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label for="type" class="form-label">النوع:</label>
                            <select id="type" name="type" class="form-control" required>
                                <option value="">اختر النوع</option>
                                <option value="percentage">نسبة مئوية %</option>
                                <option value="fixed">سعر ثابت</option>
                            </select>
                        </div>

                        <div class="col-md-4 d-none" id="percentageDiv">
                            <label for="percentage" class="form-label">النسبة:</label>
                            <input type="number" id="percentage" name="percentage" class="form-control" step="0.01" min="0"
                                value="{{ $percentage ?? '' }}">
                            <div id="percentageError" class="mt-1 text-danger d-none">❌ لا يمكن إدخال قيمة سالبة.</div>
                        </div>

                        <div class="col-md-4 d-none" id="fixedDiv">
                            <label for="fixed" class="form-label">السعر الثابت:</label>
                            <input type="number" id="fixed" name="fixed" class="form-control" step="0.01" min="0">
                            <div id="fixedError" class="mt-1 text-danger d-none">❌ لا يمكن إدخال قيمة سالبة.</div>
                        </div>

                        <div class="col-md-4">
                            <label for="from" class="form-label">من:</label>
                            <input type="date" id="from" name="from" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label for="to" class="form-label">إلى:</label>
                            <input type="date" id="to" name="to" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label for="status" class="form-label">الحالة:</label>
                            <select name="status" class="form-control" required>
                                <option value="">اختر الحالة</option>
                                @foreach (\App\Models\Coupon::STATUS as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12" id="submitContainer">
                            <button type="submit" class="mt-3 btn btn-success w-100">💾 حفظ</button>
                        </div>

                    </div>
                </form>
            </div>

            <!--begin::Body-->
        </div>
    @endsection

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                        const typeSelect = document.getElementById('type');
                        const percentageDiv = document.getElementById('percentageDiv');
                        const fixedDiv = document.getElementById('fixedDiv');
                        const percentageInput = document.getElementById('percentage');
                        const fixedInput = document.getElementById('fixed');
                        const percentageError = document.getElementById('percentageError');
                        const fixedError = document.getElementById('fixedError');
                        const submitContainer = document.getElementById('submitContainer');

                        function toggleInputs() {
                            const selectedType = typeSelect.value;
                            percentageDiv.classList.add('d-none');
                            fixedDiv.classList.add('d-none');
                            percentageError.classList.add('d-none');
                            fixedError.classList.add('d-none');
                            submitContainer.classList.remove('d-none');

                            if (selectedType === 'percentage') {
                                percentageDiv.classList.remove('d-none');
                            } else if (selectedType === 'fixed') {
                                fixedDiv.classList.remove('d-none');
                            }
                        }

                        function validateInput(input, errorDiv) {
                            const value = input.value.trim();
                            if (value === "") {
                                errorDiv.classList.add('d-none');
                                input.classList.remove('is-invalid');
                                return true;
                            }

                            const numericValue = parseFloat(value);
                            if (numericValue < 0 || isNaN(numericValue)) {
                                errorDiv.classList.remove('d-none');
                                input.classList.add('is-invalid');
                                return false;
                            } else {
                                errorDiv.classList.add('d-none');
                                input.classList.remove('is-invalid');
                                return true;
                            }
                        }

                        function validateForm() {
                            let isValid = true;

                            if (!percentageDiv.classList.contains('d-none')) {
                                isValid = validateInput(percentageInput, percentageError);
                            }

                            if (!fixedDiv.classList.contains('d-none')) {
                                isValid = validateInput(fixedInput, fixedError);
                            }
                            if (isValid) {
                                submitContainer.classList.remove('d-none');
                            } else {
                                submitContainer.classList.add('d-none');
                            }
                        }

                        typeSelect.addEventListener('change', function () {
                            toggleInputs();
                            validateForm();
                        });

                        percentageInput.addEventListener('input', validateForm);
                        fixedInput.addEventListener('input', validateForm);

                        toggleInputs();
                    });
        </script>
    @endpush
