<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\BrandDataTable;
use App\Services\Contracts\BrandInterface;
use App\Models\Brand;

class BrandController extends Controller
{
    public function __construct(protected BrandDataTable $brandDataTable, protected BrandInterface $brandInterface)
    {
        $this->brandInterface = $brandInterface;
        $this->brandDataTable = $brandDataTable;
    }

    public function index(BrandDataTable $brandDataTable)
    {
        return $this->brandInterface->index($this->brandDataTable);
    }

    public function create()
    {
        return $this->brandInterface->create();
    }

    public function store(Request $request)
    {
        return $this->brandInterface->store($request);
    }

    public function edit(Brand $brand)
    {
        return $this->brandInterface->edit($brand);
    }

    public function update(Request $request, Brand $brand)
    {
        return $this->brandInterface->update($request, $brand);
    }

    public function destroy(Brand $brand)
    {
        return $this->brandInterface->destroy($brand);
    }
}