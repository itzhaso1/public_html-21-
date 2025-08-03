@extends('website.layouts.common.website')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<style>
    .pagination {
        justify-content: center !important;
    }

    .pagination .page-item.active .page-link {
        background-color: #027D9D;
        border-color: #027D9D;
        color: #fff;
    }

    .pagination .page-link {
        color: #027D9D;
    }

    .pagination .page-link:hover {
        background-color: #e6f2f4;
    }
</style>

@endsection

@section('pageTitle')
{{ $data['pageTitle'] }}
@endsection

@section('content')
<div class="account-tab-area-start rts-section-gap">
    <div class="container-2">
        <div class="row">
            {{-- Sidebar Tabs --}}
            <div class="col-lg-3">
                <div class="nav accout-dashborard-nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                        aria-selected="true">
                        <i class="fa-regular fa-chart-line"></i>Dashboard
                    </button>
                    <button class="nav-link" id="v-pills-order-track-tab" data-bs-toggle="pill" data-bs-target="#v-pills-order-track" type="button"
                        role="tab" aria-controls="v-pills-order-track" aria-selected="true">
                        <i class="fa-regular fa-tractor"></i>Order Track
                    </button>
                </div>
            </div>

            {{-- Dashboard Content --}}
            <div class="col-lg-9 pl--50 pl_md--10 pl_sm--10 pt_md--30 pt_sm--30">
                <div class="tab-content" id="v-pills-tabContent">
                    {{-- Dashboard Tab --}}
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab" tabindex="0">
                        <div class="dashboard-account-area">
                            <h2 class="title">{{ __("site/site.hello") . ' ' . $user->name }} 👋</h2>
                            <p class="disc">
                                {{ __("site/site.dashboard_intro") }}
                            </p>
                        </div>

                        {{-- Orders Summary --}}
                        <div class="mt-4">
                            @php
                            $statusColors = [
                            'total' => 'text-secondary',
                            'pending' => 'text-warning',
                            'processing' => 'text-primary',
                            'delivering' => 'text-info',
                            'completed' => 'text-success',
                            ];

                            $filteredData = collect($data)->except(['pageTitle', 'canceled', 'refunded']);
                            $items = $filteredData->all();
                            $firstThree = array_slice($items, 0, 3, true);
                            $lastTwo = array_slice($items, 3, 2, true);
                            @endphp

                            <div class="row">
                                @foreach ($firstThree as $status => $count)
                                <div class="mb-3 col-md-4">
                                    <a href="#" class="text-decoration-none order-status-card" data-status="{{ $status }}">
                                        <div class="border-0 shadow-sm card h-100">
                                            <div class="text-center card-body">
                                                <h5 class="{{ $statusColors[$status] ?? 'text-muted' }} text-capitalize">
                                                    {{ __("site/site.order_status_{$status}") }}
                                                </h5>
                                                <h2 class="{{ $statusColors[$status] ?? 'text-muted' }}">{{ $count }}</h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>

                            <div class="row">
                                @foreach ($lastTwo as $status => $count)
                                <div class="mb-3 col-md-6">
                                    <a href="#" class="text-decoration-none order-status-card" data-status="{{ $status }}">
                                        <div class="border-0 shadow-sm card h-100">
                                            <div class="text-center card-body">
                                                <h5 class="{{ $statusColors[$status] ?? 'text-muted' }} text-capitalize">
                                                    {{ __("site/site.order_status_{$status}") }}
                                                </h5>
                                                <h2 class="{{ $statusColors[$status] ?? 'text-muted' }}">{{ $count }}</h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="ordersTableContainer" class="mt-4" style="display: none;">
                            <div class="card shadow border-0">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0 text-center">
                                        <i class="fa fa-list-alt text-primary me-2"></i>
                                        {{ __('site/site.orders_list') }}
                                    </h5>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered align-middle mb-0" id="ordersTable">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th scope="col">{{ __('site/site.number') }}</th>
                                                <th scope="col">{{ __('site/site.coupon') }}</th>
                                                <th scope="col">{{ __('site/site.payment_type') }}</th>
                                                <th scope="col">{{ __('site/site.total_price') }}</th>
                                                <th scope="col">{{ __('site/site.processes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <!-- سيتم تعبئته بالـ AJAX -->
                                        </tbody>
                                    </table>
                                </div>
                                <div id="paginationLinks" class="mt-3 text-center"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




@push('js')
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        const paymentTypes = {
            cash_on_delivery: "{{ __('site/site.payment_methods.cash_on_delivery') }}",
            payment_method: "{{ __('site/site.payment_methods.payment_method') }}"
        };
        $(document).ready(function () {
            function loadOrders(status, page = 1) {
                $.ajax({
                    url: "{{ route('customer.orders_by_status') }}",
                    method: "GET",
                    data: { status: status, page: page },
                    success: function (response) {
                        let rows = '';
                        if (response.data.length > 0) {
                            response.data.forEach(order => {
                                const paymentType = paymentTypes[order.payment_type] || order.payment_type;
                                const couponCode = order.coupon ? order.coupon.code : '—';
                                rows += `<tr>
                                            <td>${order.number}</td>
                                            <td>${couponCode}</td>
                                            <td>${paymentType}</td>
                                            <td>${order.total_price}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary me-1 show-order-details" data-id="${order.id}" title="عرض الطلب">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <a href="#" class="btn btn-sm btn-success download-order" data-id="${order.id}" title="تحميل الطلب">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </td>
                                        </tr>`;
                            });
                        } else {
                            rows = `<tr><td colspan="3" class="text-center">لا توجد طلبات</td></tr>`;
                        }

                        $('#ordersTable tbody').html(rows);
                        $('#ordersTableContainer').slideDown();
                        $('#paginationLinks').html(response.links);
                    },
                    error: function (xhr) {
                        alert('حدث خطأ أثناء تحميل البيانات');
                    }
                });
            }
            let currentStatus = null;
            $(document).on('click', '.order-status-card', function (e) {
                e.preventDefault();
                currentStatus = $(this).data('status');
                loadOrders(currentStatus);
            });
            $(document).on('click', '#paginationLinks a', function (e) {
                e.preventDefault();
                let url = new URL($(this).attr('href'));
                let page = url.searchParams.get("page");
                loadOrders(currentStatus, page);
            });
        });
        $(document).on('click', '.show-order-details', function (e) {
            e.preventDefault();
            const orderId = $(this).data('id');
            $.ajax({
                url: `/customer/orders/show/${orderId}`,
                method: "GET",
                success: function (response) {
                            console.log(response.html);
                    if (!$('#v-pills-order-details-tab').length) {
                        $('.accout-dashborard-nav').append(`
                            <button class="nav-link" id="v-pills-order-details-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-order-details" type="button" role="tab"
                                aria-controls="v-pills-order-details" aria-selected="false">
                                <i class="fa fa-file-alt me-2"></i>تفاصيل الطلب
                            </button>
                        `);
                    }

                    // 2. لو الـ tab-pane مش موجودة نضيفها
                    if (!$('#v-pills-order-details').length) {
                        $('#v-pills-tabContent').append(`
                            <div class="tab-pane fade" id="v-pills-order-details" role="tabpanel"
                                aria-labelledby="v-pills-order-details-tab" tabindex="0">
                                ${response.html}
                            </div>
                        `);
                    } else {
                        // لو موجودة غيّر محتواها فقط
                        $('#v-pills-order-details').html(response.html);
                    }

                    // 3. تفعيل التبويب
                    $('#v-pills-order-details-tab').removeClass('d-none');
                    $('#v-pills-order-details-tab').tab('show');
                },
                error: function (xhr) {
                    console.error(xhr);
                    alert('حدث خطأ أثناء تحميل تفاصيل الطلب');
                }
            });
        });

    </script>
@endpush

