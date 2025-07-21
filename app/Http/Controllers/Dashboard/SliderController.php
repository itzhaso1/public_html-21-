<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\SliderDataTable;
use App\Services\Contracts\SliderInterface;
use App\Models\Slider;
class SliderController extends Controller {
    public function __construct(protected SliderDataTable $sliderDataTable, protected SliderInterface $sliderInterface)
    {
        $this->sliderInterface = $sliderInterface;
        $this->sliderDataTable = $sliderDataTable;
    }

    public function index(SliderDataTable $sliderDataTable)
    {
        return $this->sliderInterface->index($this->sliderDataTable);
    }

    public function create()
    {
        return $this->sliderInterface->create();
    }

    public function store(Request $request)
    {
        return $this->sliderInterface->store($request);
    }

    public function edit(Slider $slider) {
        return $this->sliderInterface->edit($slider);
    }

    public function update(Request $request, Slider $slider)
    {
        return $this->sliderInterface->update($request, $slider);
    }

    public function destroy(Slider $slider)
    {
        return $this->sliderInterface->destroy($slider);
    }
}