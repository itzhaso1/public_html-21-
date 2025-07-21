@extends('dashboard.layouts.master')

@section('pageTitle')
    {{$pageTitle}}
@endsection
@section('css')
@endsection
@section('content')
    <div id="kt_content_container" class="container-xxl">
        <div class="mb-5 card card-xxl-stretch mb-xl-8">
            <!--begin::Header-->
            <div class="pt-5 border-0 card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="mb-1 card-label fw-bolder fs-3">{{$pageTitle}}</span>
                </h3>
            </div>
            <!--end::Header-->

            <!--begin::Form-->
            <div class="py-3 card-body">
                {{--<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name" class="form-label">الاسم:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="loyalty_points" class="form-label">نقاط الولاء</label>
                            <input type="text" id="loyalty_points" name="loyalty_points" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="phone" class="form-label">السعر:</label>
                            <input type="text" step="0.01" id="price" name="price" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="categories" class="form-label">التصنيفات:</label>
                            <select id="categories" name="categories[]" class="form-control select2" multiple required>
                                @foreach($data['categories'] as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="types" class="form-label">الأنواع:</label>
                            <select id="types" name="types[]" class="form-control select2" multiple>
                                @foreach($data['types'] as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="extras" class="form-label">الاضافات و الصوصات:</label>
                            <select id="extras" name="extras[]" class="form-control select2" multiple required>
                                @foreach($data['extras'] as $extra)
                                    <option value="{{ $extra->id }}">
                                        {{ ' (' . ($extra->type == 'addon' ? 'إضافة' : 'صوص') . ') - ' . $extra->name . ' - ' . $extra->price . ' ' . $settings->currency }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <!-- Start Description & Short Description -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="description" class="form-label">الوصف:</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="short_description" class="form-label">الوصف المختصر:</label>
                            <textarea name="short_description" id="short_description" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <!-- End Description & Short Description -->
                    <!-- Start Size Form Repeater -->
                    <div class="form-group">
                        <label>الأحجام</label>
                        <div id="size-repeater">
                            <div data-repeater-list="sizes">
                                <div data-repeater-item class="row">
                                    <div class="col-md-5">
                                        <select name="size_id" class="form-control">
                                            <option value="">اختر الحجم</option>
                                            @foreach($data['sizes'] as $size)
                                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" name="price" class="form-control price-input" placeholder="السعر">
                                        <small class="text-danger price-error d-none">يجب أن يكون السعر أكبر من 0</small>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger" data-repeater-delete>حذف</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mt-2" data-repeater-create>إضافة حجم</button>
                        </div>
                    </div>
                    <!-- End Size Form Repeater -->
                    <br>
                    <!-- Start Image and Preview -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-3 mb-3 text-center border rounded">
                                <label for="image" class="form-label fw-bold">الصوره</label>
                                <input class="form-control" type="file" name="product" id="productInput" accept="image/*">
                                <div class="mt-2">
                                        <img id="productPreview" src="" alt="" width="100" style="cursor: pointer;" onclick="openImageModal(this.src, 'الصوره')">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">عرض الصورة</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="text-center modal-body">
                                    <img id="popupImage" src="" class="rounded img-fluid" style="max-width: 100%; max-height: 80vh;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Image And Preiview -->
                    <hr>
                    <button type="submit" class="btn btn-success w-100">حفظ</button>
                </form>--}}
                @php
                $isEdit = isset($product);
                @endphp

                <form action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($isEdit) @method('PUT') @endif

                    {{-- اللغات --}}
                    @foreach (config('translatable.locales') as $locale)
                    <div class="form-group mb-3">
                        <label>اسم المنتج ({{ strtoupper($locale) }})</label>
                        <input type="text" name="{{ $locale }}[name]" class="form-control"
                            value="{{ old($locale . '.name', $product?->translateOrNew($locale)->name ?? '') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>الوصف المختصر ({{ strtoupper($locale) }})</label>
                        <textarea name="{{ $locale }}[short_description]"
                            class="form-control">{{ old($locale . '.short_description', $product?->translateOrNew($locale)->short_description ?? '') }}</textarea>
                    </div>
                    @endforeach

                    {{-- بيانات عامة --}}
                    <div class="form-group mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $product?->slug ?? '') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>التصنيف</label>
                        <select name="category_id" class="form-control">
                            @foreach($data['categories'] as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $product?->category_id ?? '') ==
                                $category->id)>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>العلامة التجارية</label>
                        <select name="brand_id" class="form-control">
                            <option value="">بدون</option>
                            @foreach($data['brands'] as $brand)
                            <option value="{{ $brand->id }}" @selected(old('brand_id', $product?->brand_id ?? '') == $brand->id)>
                                {{ $brand->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>النوع</label>
                        <select name="type_id" class="form-control">
                            <option value="">اختر النوع</option>
                            @foreach($data['types'] as $type)
                            <option value="{{ $type->id }}" @selected(old('type_id', $product?->type_id ?? '') == $type->id)>
                                {{ $type->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>الوسوم (Tags)</label>
                        <select name="tags[]" class="form-control">
                            @foreach($data['tags'] as $tag)
                            <option value="{{ $tag->id }}" @if(isset($product) && $product?->tags->pluck('id')->contains($tag->id)) selected
                                @endif>
                                {{ $tag->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>السعر قبل الخصم</label>
                        <input type="number" step="0.01" name="price_before_discount" class="form-control"
                            value="{{ old('price_before_discount', $product->price_before_discount ?? '') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>السعر</label>
                        <input type="number" step="0.01" name="price" class="form-control"
                            value="{{ old('price', $product->price ?? '') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>الكمية المتاحة</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? '') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>SKU</label>
                        <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku ?? '') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label>الحالة</label>
                        <select name="status" class="form-control">
                            <option value="draft" @selected(old('status', $product->status ?? '') == 'draft')>مسودة</option>
                            <option value="published" @selected(old('status', $product->status ?? '') == 'published')>منشور</option>
                            <option value="archived" @selected(old('status', $product->status ?? '') == 'archived')>مؤرشف</option>
                        </select>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="featured" value="1" class="form-check-input" id="featured" {{ old('featured',
                            $product->featured ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="featured">مميز؟</label>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-3 mb-3 text-center border rounded">
                                <label for="productInput" class="form-label fw-bold">الصورة</label>

                                <input class="form-control" type="file" name="product" id="productInput" accept="image/*">

                                <div class="mt-2">
                                    <img id="productPreview"
                                        src="{{ isset($product) && $product->getMediaUrl('product', $product, null, 'media', 'product', true) ? $product->getMediaUrl('product', $product, null, 'media', 'product', true) : asset('assets/images/no-image.png') }}"
                                        alt="صورة المنتج" width="100" style="cursor: pointer;" onclick="openImageModal(this.src, 'الصورة')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">عرض الصورة</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="text-center modal-body">
                                    <img id="popupImage" src="" class="rounded img-fluid" style="max-width: 100%; max-height: 80vh;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">{{ $isEdit ? 'تحديث' : 'حفظ' }}</button>
                </form>
            </div>
            <!--end::Form-->
        </div>
    </div>
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
<script>
    function previewImage(inputId, previewId) {
    let input = document.getElementById(inputId);
    let preview = document.getElementById(previewId);

    input.addEventListener("change", function () {
        let file = input.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = "block";
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            preview.style.display = "none";
        }
    });
}
function openImageModal(src, title) {
    if (src) {
        let popupImage = document.getElementById("popupImage");
        let modalTitle = document.getElementById("imageModalLabel");
        popupImage.src = src;
        modalTitle.innerText = title;
        let imageModal = new bootstrap.Modal(document.getElementById("imageModal"));
        imageModal.show();
    }
}
previewImage("productInput", "productPreview");
</script>
@endpush
@endsection
