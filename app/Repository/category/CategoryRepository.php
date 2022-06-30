<?php

namespace App\Repository\category;

use Illuminate\Http\Request;

interface CategoryRepository
{

    public function addCategory();
    public function store(Request $request);

}
