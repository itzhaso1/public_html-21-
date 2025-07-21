<?php

namespace App\Services\Contracts;

use App\DataTables\Dashboard\Admin\TagDataTable;
use Illuminate\Http\Request;
use App\Models\Tag;

interface TagInterface
{
    public function index(TagDataTable $tagDataTable);
    public function create();
    public function store(Request $request);
    public function edit(Tag $type);
    public function update(Request $request, Tag $tag);
    public function destroy(Tag $tag);
}