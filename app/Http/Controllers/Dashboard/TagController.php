<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\TagDataTable;
use App\Services\Contracts\TagInterface;
use App\Models\Tag;

class TagController extends Controller
{
    public function __construct(protected TagDataTable $tagDataTable, protected TagInterface $tagInterface)
    {
        $this->tagInterface = $tagInterface;
        $this->tagDataTable = $tagDataTable;
    }

    public function index(TagDataTable $tagDataTable)
    {
        return $this->tagInterface->index($this->tagDataTable);
    }

    public function create()
    {
        return $this->tagInterface->create();
    }

    public function store(Request $request)
    {
        return $this->tagInterface->store($request);
    }

    public function edit(Tag $tag)
    {
        return $this->tagInterface->edit($tag);
    }

    public function update(Request $request, Tag $tag)
    {
        return $this->tagInterface->update($request, $tag);
    }

    public function destroy(Tag $tag)
    {
        return $this->tagInterface->destroy($tag);
    }
}
