<div class="sidebar">
    <div class="menu-item">
        <div class="pb-2 menu-content">
            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{ check_guard()->name . ' | ' .
                $settings?->name }}
            </span>
        </div>
    </div>

    <!-- Admins Menu -->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ is_active('admin.admins.*') }}">
        <span class="menu-link {{ is_active('admin.admins.*') }}">
            <span class="menu-icon"><i class="bi bi-person fs-2"></i></span>
            <span class="menu-title">المديرين</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            <div class="menu-item">
                <a class="menu-link {{ is_active('admin.admins.index') }}" href="{{ route('admin.admins.index') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">المديرين</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ is_active('admin.admins.create') }}" href="{{ route('admin.admins.create') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">{{ trans('dashboard/admin.create_admin') }}</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Users Menu -->
    
    <!-- Main Setting Menu -->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ is_active('admin.mainSettings.*') }}">
        <span class="menu-link {{ is_active('admin.mainSettings.*') }}">
            <span class="menu-icon"><i class="bi bi-person fs-2"></i></span>
            <span class="menu-title">الاعدادات العامه</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            <div class="menu-item">
                <a class="menu-link {{ is_active('admin.mainSettings.index') }}"
                    href="{{ route('admin.mainSettings.index') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">الاعدادات العامه</span>
                </a>
                <a class="menu-link {{ is_active('admin.about.create') }}"
                    href="{{ route('admin.about.create') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title"> من نحن</span>
                </a>
                <a class="menu-link {{ is_active('admin.aboutCounters.index') }}" href="{{ route('admin.aboutCounters.index') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">عدادات من نحن</span>
                </a>
                <a class="menu-link {{ is_active('admin.contact.create') }}" href="{{ route('admin.contact.create') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">اتصل بنا</span>
                </a>
                <a class="menu-link {{ is_active('admin.privacy.index') }}" href="{{ route('admin.privacy.index') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">سياسه الخصوصيه</span>
                </a>
            </div>
        </div>
    </div>
    
    
    
    <!-- Sliders -->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ is_active('admin.sliders.*') }}">
        <span class="menu-link {{ is_active('admin.sliders.*') }}">
            <span class="menu-icon"><i class="bi bi-list fs-2"></i></span>
            <span class="menu-title">الصور المتحركه</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            <div class="menu-item">
                <a class="menu-link {{ is_active('admin.sliders.index') }}" href="{{ route('admin.sliders.index') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">الصور المتحركه</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ is_active('admin.sliders.create') }}" href="{{ route('admin.sliders.create') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">إضافة صوره</span>
                </a>
            </div>
        </div>
    </div>
    
    
    
   
   
    

    

   


    <!-- Section Menu -->
<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ is_active('admin.sections.*') }}">
        <span class="menu-link {{ is_active('admin.sections.*') }}">
            <span class="menu-icon"><i class="bi bi-box-seam fs-2"></i></span> <!-- Icon for items -->
            <span class="menu-title">الاقسام</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            <div class="menu-item">
                <a class="menu-link {{ is_active('admin.products.index') }}" href="{{ route('admin.sections.index') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">الاقسام</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ is_active('admin.sections.create') }}"
                    href="{{ route('admin.sections.create') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">اضافه قسم</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Products Menu -->
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ is_active('admin.products.*') }}">
        <span class="menu-link {{ is_active('admin.products.*') }}">
            <span class="menu-icon"><i class="bi bi-box-seam fs-2"></i></span> <!-- Icon for items -->
            <span class="menu-title">{{ trans('dashboard/admin.product.products') }}</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
            <div class="menu-item">
                <a class="menu-link {{ is_active('admin.products.index') }}" href="{{ route('admin.products.index') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">{{ trans('dashboard/admin.product.products') }}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ is_active('admin.products.create') }}" href="{{ route('admin.products.create') }}">
                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                    <span class="menu-title">{{ trans('dashboard/admin.product.create_product') }}</span>
                </a>
            </div>
        </div>
    </div>
    
   
</div>
