<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\SectionDataTable;
use App\Services\Contracts\SectionInterface;
use App\Models\Section;
class SectionController extends Controller
{
    public function __construct(protected SectionDataTable $sectionDataTable, protected SectionInterface $sectionInterface)
    {
        $this->sectionInterface = $sectionInterface;
        $this->sectionDataTable = $sectionDataTable;
    }

    public function index(SectionDataTable $sectionDataTable)
    {
        return $this->sectionInterface->index($this->sectionDataTable);
    }

    public function create()
    {
        return $this->sectionInterface->create();
    }

    public function store(Request $request)
    {
        return $this->sectionInterface->store($request);
    }

    public function edit(Section $section)
    {
        return $this->sectionInterface->edit($section);
    }

    public function update(Request $request, Section $section)
    {
        return $this->sectionInterface->update($request, $section);
    }

    public function destroy(Section $section)
    {
        return $this->sectionInterface->destroy($section);
    }
}