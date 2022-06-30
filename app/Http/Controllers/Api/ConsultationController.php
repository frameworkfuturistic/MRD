<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\consultations\EloquentConsultationRepository;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    protected $eloquentConsultation;

    public function __construct(EloquentConsultationRepository $eloquentConsultation)
    {
        $this->EloquentConsultation = $eloquentConsultation;
    }

    public function searchConsultation(Request $request)
    {
        return $this->EloquentConsultation->searchConsultation($request);
    }

    public function patientSummary($id)
    {
        return $this->EloquentConsultation->patientSummary($id);
    }

    public function pastRegistrations($id)
    {
        return $this->EloquentConsultation->pastRegistrations($id);
    }

    public function getInvestigations($id)
    {
        return $this->EloquentConsultation->getInvestigations($id);
    }

    public function getInvestigationsReport($id)
    {
        return $this->EloquentConsultation->getInvestigationsReport($id);
    }

    public function savePrescription(Request $request)
    {
        return $this->EloquentConsultation->savePrescription($request);
    }

    public function updateRemark(Request $request)
    {
        return $this->EloquentConsultation->updateRemark($request);
    }

    public function updateDiscount(Request $request)
    {
        return $this->EloquentConsultation->updateDiscount($request);
    }

}
