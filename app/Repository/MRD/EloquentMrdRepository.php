<?php

namespace App\Repository\MRD;

use App\Models\DcRegistration;
use App\Models\IpdRegistration;
use App\Models\Mrd;
use App\Models\MrMaster;
use App\Models\OpdRegistration;
use Illuminate\Http\Request;

class EloquentMrdRepository implements MrdRepository
{

    public function photoMediaUpload()
    {
        $mrd = mrMaster::select('MRNo', 'MRDate', 'PatientName', 'Sex', 'DOB', 'City', 'State', 'MobileNo', 'AadharNo')
            ->orderByDesc('MRNo')
            ->paginate(100);
        return view('admin.MRD.upload', ['mrds' => $mrd]);
    }

    public function mrdRecords()
    {
        $mrd = Mrd::select(
            'mrd_uploads.id',
            'mrd_uploads.registration_no',
            'mrd_uploads.mr_no',
            'mrd_uploads.department',
            'mrd_uploads.photo_category',
            'mrd_uploads.tags',
            'mrd_uploads.ipd_registration_id',
            'mrd_uploads.opd_registration_id',
            'mrd_uploads.daycare_registration_id',
            'mrd_uploads.photo',
            'mr_master.PatientName',
            'mr_master.MobileNo'
        )
            ->leftJoin("mr_master", "mr_master.MRNo", "=", "mrd_uploads.mr_no")
            ->orderByDesc('mrd_uploads.id')
            ->get();
        return view('admin.MRD.records', ['mrd' => $mrd]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // MULTIPLE IMAGES UPLOAD
        if ($files = $request->file('photoupload')) {
            foreach ($files as $file) {
                $mrd = new Mrd();
                $mrd->mr_no = $request->MRno;
                $mrd->department = $request->category;
                $mrd->photo_category = $request->photoCategory;
                $mrd->tags = $request->tags;

                $png_url = time() . '.' . $file->getClientOriginalName();
                $file->move('uploadImages', $png_url);
                $mrd->photo = $png_url;

                $mrd->notes = $request->notes;
                $mrd->registration_no = $request->RegistrationNo;
                if ($request->category == 'IPD') {
                    $mrd->ipd_registration_id = $request->RegistrationId;
                }

                if ($request->category == 'OPD') {
                    $mrd->opd_registration_id = $request->RegistrationId;
                }

                if ($request->category == 'DayCare') {
                    $mrd->daycare_registration_id = $request->RegistrationId;
                }
                $mrd->save();
            }
        }
        // MULTIPLES IMAGES UPLOAD
        return back()->with('status', 'Successfully Saved The Record');
    }

    public function ipdRegistrations($id)
    {
        $data = IpdRegistration::select('RegistrationID', 'MRNo', 'RegistrationNo', 'RegistrationDate')
            ->where('MRNo', '=', $id)->get();
        return response()->json($data);
    }

    public function opdRegistrations($id)
    {
        $data = OpdRegistration::select('RegistrationID', 'MRNo', 'RegistrationNo', 'RegistrationDate')
            ->where('MRNo', '=', $id)->get();
        return response()->json($data);
    }

    public function dcRegistrations($id)
    {
        $data = DcRegistration::select('RegistrationID', 'MRNo', 'RegistrationNo', 'RegistrationDate')
            ->where('MRNo', '=', $id)->get();
        return response()->json($data);
    }

    // SEARCH BY MR NO
    public function searchMrd(Request $request)
    {
        if ($request->searchMRNo) {
            $search = $request->searchMRNo;
            $data = mrMaster::select('MRNo', 'MRDate', 'PatientName', 'Sex', 'DOB', 'City', 'State', 'MobileNo', 'AadharNo')
                ->where('MRNo', 'like', '%' . $search . '%')
                ->paginate(15);
        }
        return response()->json($data);
    }

    // SEARCH BY PATIENT NAME
    public function searchPatientName(Request $request)
    {
        if ($request->searchPatientName) {
            $search = $request->searchPatientName;
            $data = mrMaster::select('MRNo', 'MRDate', 'PatientName', 'Sex', 'DOB', 'City', 'State', 'MobileNo', 'AadharNo')
                ->where('PatientName', 'like', '%' . $search . '%')
                ->paginate(15);
            return response()->json($data);
        }
    }

    // SEARCH BY MOBILE NO
    public function searchMobileNo(Request $request)
    {
        if ($request->searchMobileNo) {
            $search = $request->searchMobileNo;
            $data = mrMaster::select('MRNo', 'MRDate', 'PatientName', 'Sex', 'DOB', 'City', 'State', 'MobileNo', 'AadharNo')
                ->where('MobileNo', 'like', '%' . $search . '%')
                ->paginate(15);
            return response()->json($data);
        }
    }

    public function viewMRDDetails($id)
    {
        $mrd = Mrd::find($id);
        return view('admin.MRD.view-MRDDetails', ['mrd' => $mrd]);
    }

    public function editMRD(Request $request)
    {
        // dd($request->all());

        $mrd = Mrd::find($request->id);
        $mrd->tags = $request->tags;

        $mrd->photo_category = $request->photoCategory;
        $file = $request->file('photoupload');
        if ($file) {
            $png_url = time() . '.' . $file->getClientOriginalName();
            $file->move('uploadImages', $png_url);
            $mrd->photo = $png_url;
        }

        $mrd->notes = $request->notes;
        $mrd->save();
        return back()->with('status', 'Successfully Updated The Record');
    }

}
