<?php

namespace App\Services\Contracts;

use App\DataTables\Dashboard\Admin\SliderDataTable;
use Illuminate\Http\Request;
use App\Models\Slider;
interface SliderInterface
{
    public function index(SliderDataTable $sliderDataTable);
    public function create();
    public function store(Request $request);
    public function edit(Slider $slider);
    public function update(Request $request, Slider $slider);
    public function destroy(Slider $slider);
}
