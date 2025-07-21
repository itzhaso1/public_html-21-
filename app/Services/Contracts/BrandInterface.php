<?php

namespace App\Services\Contracts;

use App\DataTables\Dashboard\Admin\BrandDataTable;
use Illuminate\Http\Request;
use App\Models\Brand;

interface BrandInterface
{
    public function index(BrandDataTable $brandDataTable);
    public function create();
    public function store(Request $request);
    public function edit(Brand $brand);
    public function update(Request $request, Brand $brand);
    public function destroy(Brand $brand);
}
