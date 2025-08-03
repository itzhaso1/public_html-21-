<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\AboutCounterDataTable;
use App\Services\Contracts\AboutCounterInterface;
use App\Models\AboutCounter;

class AboutCounterController extends Controller
{
    public function __construct(protected AboutCounterDataTable $aboutCounterDataTable, protected AboutCounterInterface $aboutCounterInterface)
    {
        $this->aboutCounterInterface = $aboutCounterInterface;
        $this->aboutCounterDataTable = $aboutCounterDataTable;
    }

    public function index(AboutCounterDataTable $aboutCounterDataTable)
    {
        return $this->aboutCounterInterface->index($this->aboutCounterDataTable);
    }

    public function create()
    {
        return $this->aboutCounterInterface->create();
    }

    public function store(Request $request)
    {
        return $this->aboutCounterInterface->store($request);
    }

    public function edit(AboutCounter $aboutCounter)
    {
        return $this->aboutCounterInterface->edit($aboutCounter);
    }

    public function update(Request $request, AboutCounter $aboutCounter)
    {
        return $this->aboutCounterInterface->update($request, $aboutCounter);
    }

    public function destroy(AboutCounter $aboutCounter)
    {
        return $this->aboutCounterInterface->destroy($aboutCounter);
    }
}