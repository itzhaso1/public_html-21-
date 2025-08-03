<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CategoryImport implements ToCollection {
    public function collection(Collection $rows) {
        //dd($rows->toArray());

        /*foreach ($rows as $row) {
            $parent = null;
            if (!empty($row['القسم التابع'])) {
                $parent = Category::whereTranslation('name', $row['القسم التابع'])->first();
            }
            $category = Category::create([
                'parent_id' => $parent?->id,
                'status' => 'active',
            ]);
            $category->translateOrNew('ar')->name = $row['اسم التصنيف بالعربى'];
            $category->translateOrNew('en')->name = $row['اسم التصنيف بالانجليزى'];
            $category->save();
        }*/
        $rows->shift();
        foreach ($rows as $row) {
            $parent = null;
            if (!empty($row[2])) {
                $parent = Category::whereTranslation('name', $row[2])->first();
            }

            $category = Category::create([
                'parent_id' => $parent?->id,
                'status' => 'active',
            ]);
            $category->translateOrNew('ar')->name = $row[0];
            $category->translateOrNew('en')->name = $row[1];

            $category->save();
        }
    }
}
