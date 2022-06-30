<?php

namespace App\Repository\MRD;

use Illuminate\Http\Request;

interface MrdRepository
{

    public function photoMediaUpload();
    public function mrdRecords();
    public function store(Request $request);

}
