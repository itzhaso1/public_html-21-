<!--begin::User Menu-->
@php
    $user = get_user_data();
    $userImage = asset('dashboard/assets/media/avatars/150-2.jpg'); // يفضل وضع صورة المستخدم الحقيقية هنا إذا توفرت
    // $userImage = $user->image ? asset($user->image) : asset('dashboard/assets/media/avatars/default.jpg');
@endphp
 
<div class="d-flex align-items-stretch" id="kt_header_user_menu_toggle">
 
    <!--begin::Trigger-->
    <div class="topbar-item d-flex align-items-center cursor-pointer px-3 px-lg-4"
        data-kt-menu-trigger="click"
        data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-end"
        data-kt-menu-flip="bottom">
        
        <div class="symbol symbol-35px symbol-md-40px border border-2 border-white shadow-sm hover-scale overflow-hidden">
            <img src="{{ $userImage }}" alt="{{ $user?->name }}" style="object-fit: cover;" />
        </div>
    </div>
    <!--end::Trigger-->
 
    <!--begin::Dropdown-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
         data-kt-menu="true">
        
        <!--begin::Header-->
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <!-- Avatar -->
                <div class="symbol symbol-50px me-5">
                    <img alt="{{ $user?->name }}" src="{{ $userImage }}" class="rounded-circle" style="object-fit: cover;"/>
                </div>
                
                <!-- Info -->
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-5">
                        {{ Str::limit($user?->name, 15) }}
                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                            {{ $user?->type }}
                        </span>
                    </div>
                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7 text-truncate" style="max-width: 150px;">
                        {{ $user?->email }}
                    </a>
                </div>
            </div>
        </div>
        <!--end::Header-->
 
        <div class="separator my-2"></div>
 
        <!--begin::Language-->
        <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="{{ leftStartDirectionClass() }}">
            <a href="#" class="menu-link px-5">
                <span class="menu-title position-relative">
                    <span class="d-flex align-items-center">
                        <i class="ki-duotone ki-global fs-2 me-2"><span class="path1"></span><span class="path2"></span></i>
                        اللغة
                    </span>
                    <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                        {{ LaravelLocalization::getCurrentLocaleNative() }}
                        @if (App::getLocale() == 'ar')
                            <img class="w-15px h-15px rounded-1 ms-2" src="{{ asset('dashboard/assets/media/flags/egypt.svg') }}" />
                        @else
                            <img class="w-15px h-15px rounded-1 ms-2" src="{{ asset('dashboard/assets/media/flags/united-states.svg') }}" />
                        @endif
                    </span>
                </span>
            </a>
 
            <!--begin::Language Sub-->
            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="menu-item px-3">
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="menu-link d-flex px-5 @if(App::getLocale() == $localeCode) active @endif">
                            <span class="symbol symbol-20px me-4">
                                <img class="rounded-1" src="{{ asset('dashboard/assets/media/flags/' . ($properties['native'] == 'العربية' ? 'egypt.svg' : 'united-states.svg')) }}" />
                            </span>
                            {{ $properties['native'] }}
                        </a>
                    </div>
                @endforeach
            </div>
            <!--end::Language Sub-->
        </div>
        <!--end::Language-->
 
        <div class="separator my-2"></div>
 
        <!--begin::Logout-->
        <div class="menu-item px-5">
            @php
                $logoutRoute = admin_guard()->check() ? 'admin.logout' : (manager_guard()->check() ? 'manager.logout' : null);
            @endphp
 
            @if ($logoutRoute)
                <form method="POST" action="{{ route($logoutRoute) }}" id="logout-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="menu-link px-5 text-danger hover-bg-light-danger">
                       <i class="ki-duotone ki-exit-right fs-2 me-2 text-danger"><span class="path1"></span><span class="path2"></span></i>
                       تسجيل الخروج
                    </a>
                </form>
            @endif
        </div>
        <!--end::Logout-->
    </div>
    <!--end::Dropdown-->
</div>
<!--end::User Menu-->
 
<style>
    /* تحسينات بصرية إضافية */
    .hover-scale {
        transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .hover-scale:hover {
        transform: scale(1.1);
    }
    
    /* تحسين القائمة المنسدلة */
    .menu-sub-dropdown {
        box-shadow: 0 0 50px 0 rgba(82, 63, 105, 0.15) !important;
        border: 1px solid rgba(239, 242, 245, 1);
    }
 
    /* تحسينات للهاتف */
    @media (max-width: 768px) {
        .menu-sub-dropdown {
            width: calc(100vw - 40px) !important; /* عرض مناسب للهاتف مع هوامش */
            max-width: 300px;
        }
    }
    
    /* تأثير خفيف عند المرور على زر الخروج */
    .hover-bg-light-danger:hover {
        background-color: #fff5f8 !important; /* لون خلفية أحمر فاتح جداً */
    }
</style>