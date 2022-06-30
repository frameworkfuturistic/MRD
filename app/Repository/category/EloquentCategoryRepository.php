<?php

namespace App\Repository\category;

use App\Models\PhotoCategory;
use Illuminate\Http\Request;

class EloquentCategoryRepository implements CategoryRepository
{
    public function addCategory()
    {
        return view('admin.category.add-category');
    }

    public function store(Request $request)
    {
        $category = new PhotoCategory;
        $category->department = $request->department;
        $category->photo_category = $request->photoCategory;
        $category->save();
    }

    public function getCategory()
    {
        $category = PhotoCategory::select('id', 'department', 'photo_category')
            ->orderBy('id', 'desc')
            ->get();
        return response()->json($category);
    }

    public function getCategoryById($id)
    {
        $category = PhotoCategory::find($id);
        return response()->json($category);
    }

    public function update(Request $request)
    {
        $category = PhotoCategory::find($request->id);
        $category->department = $request->departmentUpdate;
        $category->photo_category = $request->photoCategoryUpdate;
        $category->save();
    }

    public function categoryByDepartment($id)
    {
        $category = PhotoCategory::where('department', $id)->get();
        return response()->json($category);
    }

}
