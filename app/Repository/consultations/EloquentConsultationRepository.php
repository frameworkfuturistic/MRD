<?php

namespace App\Repository\consultations;

use App\Models\GenConsultant;
use App\Models\OpdConsultation;
use App\Models\OpdPrescription;
use App\Models\OpdRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EloquentConsultationRepository implements ConsultationRepository
{

    public function index()
    {
        $consultant = GenConsultant::select('ConsultantID', 'ConsultantName', 'ShortName', 'ConsultantType', 'Honour', 'DepartmentID')
            ->get();
        return view('admin.consultation.doctor-consultation', ['consultants' => $consultant]);
    }

    public function searchConsultation(Request $request)
    {
        // $data=OpdConsultation::select('opd_consultations.OPDConsultationID',
        //                                'opd_consultations.ConsultantID',
        //                                 'opd_consultations.RegistrationID',
        //                                 'opd_consultations.ConsultationDate',
        //                                 'opd_consultations.ConsultedAt',
        //                                 'opd_consultations.ShiftID',
        //                                 'opd_consultations.TokenNo',
        //                                 'opd_consultations.Canceled',
        //                                 'opd_consultations.Remarks',
        //                                 'gen_consultants.ConsultantName')

        //                         ->leftJoin("gen_consultants","opd_consultations.ConsultantID","=","gen_consultants.ConsultantID")
        //                         ->where('ConsultationDate','=',$request->consultantDate)
        //                         ->where('opd_consultations.ConsultantID','=',$request->consultant)
        //                         ->get();

        $data = DB::select("select  o.OPDConsultationID,
                                    o.ConsultantID,
                                    o.RegistrationID,
                                    o.ConsultationDate,
                                    o.ConsultedAt,
                                    s.shiftName,
                                    o.TokenNo,
                                    o.Remarks,
                                    g.ConsultantName,
                                    m.PatientName,
                                    m.Sex,
                                    r.Cashless,
                                    o.ShiftID,
                                    r.MRNo,
                                    r.RegistrationNo,
                                    r.RegistrationDate,
                                    o.Remarks,
                                    r.Discount,
                                    r.RegistrationFee,
                                    r.BookFee,
                                    r.Amount,
                                    m.MobileNo,
                                    r.Criticality,
                                    r.Age

                    from opd_consultations o

                    left join gen_consultants g on  o.ConsultantID = g.ConsultantID
                    left join opd_registrations r on o.RegistrationID = r.RegistrationID
                    left join mr_master m on r.MRNo = m.MRNo
                    left join gen_shifts s on o.shiftID = s.shiftID

            where o.ConsultationDate ='$request->consultantDate' and o.ConsultantID = '$request->consultant'");

        return response()->json($data);
    }

    public function patientSummary($id)
    {
        $data = DB::select("select o.RegistrationID,
                            o.RegistrationNo,
                            o.RegistrationDate,
                            o.Age,
                            m.PatientName,
                            m.Sex,
                            m.MobileNo,
                            o.Criticality,
                            m.Address1,
                            m.City,
                            m.State
                            from opd_registrations o
                    left join mr_master m on o.MRNo=m.MRNo
                    where o.RegistrationID='$id'");

        return response()->json($data);
    }

    public function pastRegistrations($id)
    {
        $data = DB::select("SELECT o.RegistrationID,
                                o.RegistrationDate,
                                o.ConsultationDate,
                                o.ReferredBy,
                                o.Weight,
                                o.Age,
                                g.ConsultantName,
                                o.ServiceNo,
                                g.ConsultantName,
                                gc.CorporateName

                        FROM symptoms_care.opd_registrations o
                        left join opd_consultations c on o.RegistrationID=c.RegistrationID
                        left join gen_consultants g on c.ConsultantID=g.ConsultantID
                        left join gen_corporates gc on o.CorporateID=gc.CorporateID
                         where MRNo='$id'");

        return response()->json($data);
    }

    public function getInvestigations($id)
    {
        $data = DB::select("Select  r.opdRegistrationID,
                            t.TranID,
                            t.CollectionDate,
                            t.ReportingDate,
                            g.GroupName

                    From Path_RegistrationDetail d
                    Left Join Path_Tran t on d.TranId=t.TranID
                    Left Join Path_Registration r on d.RegistrationID=r.RegistrationID
                    Left Join Path_TestGroups g on d.TestGroupID=g.TestGroupID
                    Where r.Cancelled=false And r.OpdRegistrationID='$id'");
        return response()->json($data);
    }

    public function getInvestigationsReport($id)
    {

        /* QUERY FOR BACKUP
            select t.TranID,
                            t.PatientName,
                            t.CollectionDate,
                            t.ReportingDate,
                            t.ReferenceNo,
                            t.Age,
                            t.DoctorName,
                            t.Sex,
                            t.Specimen,
                            t.PrintHeading,
                            td.Description,
                            td.TestValue,
                            td.Unit,
                            td.NormalValue
                        from path_tran t
                        left join path_trandetail td on t.TranID=td.TranID
                        where t.TranID='$id' and td.TestValue!=''
        */
        $data = DB::select("select * from (
                            select
                                if(td.GroupType='TH',td.Description,'') as Heading,
                                t.TranID,
                                t.PatientName,
                                t.CollectionDate,
                                t.ReportingDate,
                                t.ReferenceNo,
                                t.Age,
                                t.DoctorName,
                                t.Sex,
                                t.Specimen,
                                t.PrintHeading,
                                td.Description,
                                td.TestValue,
                                td.Unit,
                                td.NormalValue
                            from path_tran t
                            left join path_trandetail td on t.TranID=td.TranID
                            where t.TranID='$id'
                            ) as a
                            where length(a.Heading)>1 or length(a.TestValue)>1");
        return response()->json($data);
    }

    public function savePrescription(Request $request)
    {
        $prescription = OpdPrescription::updateOrCreate(
            ['RegistrationID' => $request->preRegistrationID]);

        if ($request->preRegistrationID) {
            $prescription->RegistrationID = $request->preRegistrationID;
        }
        if ($request->complaint) {
            $prescription->Complaints = $request->complaint;
        }

        if ($request->examinations) {
            $prescription->Examinations = $request->examinations;
        }

        if ($request->investigations) {
            $prescription->Investigations = $request->investigations;
        }

        if ($request->diagnosis) {
            $prescription->Diagnosis = $request->diagnosis;
        }

        if ($request->medicines) {
            $prescription->Medicines = $request->medicines;
        }

        if ($request->others) {
            $prescription->Others = $request->others;
        }

        if ($request->history) {
            $prescription->History = $request->history;
        }

        $prescription->save();
    }

    public function updateRemark(Request $request)
    {
        $data = OpdConsultation::where('OPDConsultationID', '=', $request->rRegistrationID)->firstOrFail();
        if ($request->remarks) {
            $data->Remarks = $request->remarks;
        }
        if ($request->consultedAt) {
            $data->ConsultedAt = $request->consultedAt;
        }
        // $data->Canceled=$request->canceled;    BIT VALUE CAUSING ERROR
        $data->save();
    }

    public function updateDiscount(Request $request)
    {
        // dd($request->all());
        $data = OpdRegistration::where('RegistrationID', '=', $request->dRegistrationID)->firstOrFail();
        $data->Discount = $request->updateDiscount;
        $data->save();
    }
}
