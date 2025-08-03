<?php

namespace App\Services\Contracts;

use App\DataTables\Dashboard\Admin\AboutCounterDataTable;
use Illuminate\Http\Request;
use App\Models\AboutCounter;

interface AboutCounterInterface
{
    public function index(AboutCounterDataTable $sliderDataTable);
    public function create();
    public function store(Request $request);
    public function edit(AboutCounter $aboutCounter);
    public function update(Request $request, AboutCounter $aboutCounter);
    public function destroy(AboutCounter $aboutCounter);
}