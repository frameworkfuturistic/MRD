<?php

namespace App\Http\Controllers;

use App\Repository\category\EloquentCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhotoCategoryController extends Controller
{
    //
    protected $eloquentCategory;

    public function __construct(EloquentCategoryRepository $eloquentCategory)
    {
        $this->eloquentCategory = $eloquentCategory;
    }

    public function addCategory()
    {
        return $this->eloquentCategory->addCategory();
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'department' => 'required|max:255',
            'photoCategory' => 'required',
        ]);

        return $this->eloquentCategory->store($request);
    }

    public function getCategory()
    {
        return $this->eloquentCategory->getCategory();
    }

    public function getCategoryById($id)
    {
        return $this->eloquentCategory->getCategoryById($id);
    }

    public function update(Request $request)
    {
        return $this->eloquentCategory->update($request);
    }

    public function categoryByDepartment($id)
    {
        // return $this->categoryByDepartment($id);
        return $this->eloquentCategory->categoryByDepartment($id);
    }

}
