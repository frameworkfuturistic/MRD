<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\MRD\EloquentMrdRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/*
 *Controller created for viewing, saving, fetching and editing
 */

class MrdController extends Controller
{
    protected $eloquentMrd;

    public function __construct(EloquentMrdRepository $eloquentMrd)
    {
        $this->EloquentMrd = $eloquentMrd;
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'MRNo' => 'required|max:255',
            'photo' => 'required',
            'photo.*' => 'mimes:jpg,png,jpeg,gif,svg',
        ]);

        return $this->EloquentMrd->store($request);
    }

    public function ipdRegistrations($id)
    {
        return $this->EloquentMrd->ipdRegistrations($id);
    }

    public function opdRegistrations($id)
    {
        return $this->EloquentMrd->opdRegistrations($id);
    }

    public function dcRegistrations($id)
    {
        return $this->EloquentMrd->dcRegistrations($id);
    }

    public function searchMRD(Request $request)
    {
        return $this->EloquentMrd->searchMRD($request);
    }

    public function searchPatientName(Request $request)
    {
        return $this->EloquentMrd->searchPatientName($request);
    }

    public function searchMobileNo(Request $request)
    {
        return $this->EloquentMrd->searchMobileNo($request);
    }

    public function editMRD(Request $request)
    {
        return $this->EloquentMrd->editMRD($request);
    }

}
