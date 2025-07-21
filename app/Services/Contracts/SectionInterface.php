<?php

namespace App\Services\Contracts;

use App\DataTables\Dashboard\Admin\SectionDataTable;
use Illuminate\Http\Request;
use App\Models\Section;

interface SectionInterface
{
    public function index(SectionDataTable $sectionDataTable);
    public function create();
    public function store(Request $request);
    public function edit(Section $section);
    public function update(Request $request, Section $section);
    public function destroy(Section $section);
}
