@extends('admin.layouts.app')

@section('consultationActive')
active
@endsection

@section('page-css')
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/ekko-lightbox.css" />
<style>

</style>
@endsection

@section('page-content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title" id="basic-layout-icons">
            <!-- INPUT FORM -->
            <div class="row">
                <form action="search-consultation" method="GET" role="search" id="searchConsultation">
                    <div class="col-md-2">
                        <input type="date" class="form-control round" id="consultantDate" name="consultantDate">
                    </div>
                    <div class="col-md-3">
                        <select name="consultant" id="consultant" class="form-control round">
                            <option value="">-- Select Consultant --</option>
                            @foreach($consultants as $consultant)
                            <option value="{{$consultant->ConsultantID}}">{{$consultant->ConsultantName}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Sync</button>
                    </div>
                </form>
            </div>
            <!-- INPUT FORM -->
        </h4>
        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <!-- DataTable -->
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Token</th>
                            <th>PatientName</th>
                            <th>Sex</th>
                            <th>Cashless</th>
                            <th>ShiftName</th>
                            <th>MRNo</th>
                            <th>RegistrationNo</th>
                            <th>RegistrationDate</th>
                            <th>Remarks</th>
                            <th>Discount</th>
                            <th>RegistrationFee</th>
                            <th>BookFee</th>
                            <th>Amount</th>
                            <th>Age</th>
                            <th>MobileNo</th>
                            <th>Criticality</th>
                            <th>ConsultedAt</th>
                        </tr>
                    </thead>

                </table>
            </div>
            <!-- DataTable -->
        </div>
    </div>
</div>
<!-- ============================================================================================================ -->
<!-- MODAL CONSULTAIONS -->
<div class="modal fade text-xs-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="my-modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel17">
                    <!-- TAB SELECTIONS -->
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link my-nav-link active" id="active-pill" data-toggle="pill" href="#active"
                                aria-expanded="true">Consultation</a>
                    </ul>
                    <!-- TAB SELECTIONS -->
                </h4>
            </div>
            <div class="modal-body my-modal-body">
                <!-- TAB-CONTENT -->
                <div class="tab-content px-1 pt-1">

                    <!-- =======================================================TAB1 STARTS======================================= -->
                    <div role="tabpanel" class="tab-pane active" id="active" aria-labelledby="active-pill"
                        aria-expanded="true">
                        <!-- INPUT FORMS -->
                        <div class="row">
                            <!-- buttons -->
                            <div class="col-md-4">
                                <select name="" id="" class="form-control round">
                                    <option value="">-- Select Prescription --</option>
                                    <option value="Gen-Format-For-All">Gen-Format-For-All</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-outline-primary"><i class="fa fa-print"></i>
                                    Print</button>
                            </div>
                            <!-- Save Prescription form -->

                            <div class="col-md-2 offset-md-5">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-success"><i class="fa fa-eye"></i>
                                        Preview</button>
                                </div>
                            </div>
                            <!-- buttons -->
                            <!-- TEXTAREA WITH COMPLAINTS EXAMINES -->
                            <!-- ============================================================================================================== -->
                            <form action="save-prescription" method="POST" id="savePrescription">
                                @csrf
                                <input type="hidden" id="preRegistrationID" name="preRegistrationID">
                                <!-- COMPLAINT/ INVESTIGATIONS/ MEDICINES REPORT -->
                                <div class="col-md-6">
                                    <form class="form">
                                        <hr>
                                        <div class="form-body">
                                            <div class="card text-white bg-grey mb-3">
                                                <!-- ==========================================COMPLAINT ======================================================== -->
                                                <div class="card-header my-card-header">
                                                    <div class="col-md-10">
                                                        <select name="" id="" class="form-control round my-select">
                                                            <option value="">-- Select Complaint --</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-outline-info btn-sm"><i
                                                                class="fa fa-circle-plus"></i> Add</button>
                                                    </div>
                                                </div>
                                                <div class="card-body card-pad">
                                                    <textarea id="complaint" rows="2" class="form-control square"
                                                        name="complaint" placeholder="Complaint"></textarea>
                                                </div>
                                                <!-- ========================================== COMPLAINT END===================================================== -->
                                                <!-- ===========================================INVESTIGATION SECTION============================================= -->
                                                <div class="card-header my-card-header">
                                                    <div class="col-md-10">
                                                        <select name="" id="" class="form-control round my-select">
                                                            <option value="">-- Select Investigations --</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-outline-info btn-sm"><i
                                                                class="fa fa-circle-plus"></i> Add</button>
                                                    </div>
                                                </div>

                                                <div class="card-body card-pad">
                                                    <textarea id="investigations" rows="2" class="form-control square"
                                                        name="investigations" placeholder="Investigations"></textarea>
                                                </div>
                                                <!-- ===========================================INVESTIGATION SECTION ENDS======================================== -->
                                                <!-- ========================================== MEDICINES SECTION======================================================== -->
                                                <div class="card-header my-card-header">
                                                    <div class="col-md-10">
                                                        <select name="" id="" class="form-control round my-select">
                                                            <option value="">-- Select Medicines --</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-outline-info btn-sm"><i
                                                                class="fa fa-circle-plus"></i> Add</button>
                                                    </div>
                                                </div>

                                                <div class="card-body card-pad">
                                                    <textarea id="medicines" rows="2" class="form-control square"
                                                        name="medicines" placeholder="Medicines"></textarea>
                                                </div>
                                                <!-- ========================================== MEDICINES SECTION ENDS ======================================================= -->
                                                <!-- ========================================== HISTORY ================================================================== -->
                                                <div class="card-header my-card-header">
                                                    <div class="col-md-10">
                                                        <select name="" id="" class="form-control round my-select">
                                                            <option value="">-- History --</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-outline-info btn-sm"><i
                                                                class="fa fa-circle-plus"></i> Add</button>
                                                    </div>
                                                </div>
                                                <div class="card-body card-pad">
                                                    <textarea id="history" rows="2" class="form-control square"
                                                        name="history" placeholder="History"></textarea>
                                                </div>
                                                <!-- ========================================== HISTORY END===================================================== -->
                                            </div>
                                        </div>
                                </div>
                                <!-- COMPLAINT/ INVESTIGATIONS/ MEDICINES REPORT -->

                                <!-- ============================================================================================================== -->
                                <!-- EXAMINATIONS/ DIAGNOSIS / OTHERS REPORT -->
                                <div class="col-md-6">
                                    <hr>
                                    <div class="form-body">
                                        <div class="card text-white bg-grey mb-3">
                                            <!-- ==========================================EXAMINATIONS ======================================================== -->
                                            <div class="card-header my-card-header">
                                                <div class="col-md-10">
                                                    <select name="" id="" class="form-control round my-select">
                                                        <option value="">-- Select Examinations --</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-outline-info btn-sm"><i
                                                            class="fa fa-circle-plus"></i> Add</button>
                                                </div>
                                            </div>
                                            <div class="card-body card-pad">
                                                <textarea id="examinations" rows="2" class="form-control square"
                                                    name="examinations" placeholder="Examinations"></textarea>
                                            </div>
                                            <!-- ========================================== EXAMINATIONS END===================================================== -->
                                            <!-- ===========================================DIAGNOSIS SECTION============================================= -->
                                            <div class="card-header my-card-header">
                                                <div class="col-md-10">
                                                    <select name="" id="" class="form-control round my-select">
                                                        <option value="">-- Select Diagnosis --</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-outline-info btn-sm"><i
                                                            class="fa fa-circle-plus"></i> Add</button>
                                                </div>
                                            </div>

                                            <div class="card-body card-pad">
                                                <textarea id="diagnosis" rows="2" class="form-control square"
                                                    name="diagnosis" placeholder="Diagnosis"></textarea>
                                            </div>
                                            <!-- ===========================================DIANOSIS SECTION ENDS======================================== -->
                                            <!-- ========================================== OTHERS SECTION======================================================== -->
                                            <div class="card-header my-card-header">
                                                <div class="col-md-10">
                                                    <select name="" id="" class="form-control round my-select">
                                                        <option value="">-- Others --</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-outline-info btn-sm"><i
                                                            class="fa fa-circle-plus"></i> Add</button>
                                                </div>
                                            </div>

                                            <div class="card-body card-pad">
                                                <textarea id="others" rows="2" class="form-control square" name="others"
                                                    placeholder="Others"></textarea>
                                            </div>

                                            <!-- SAVE PRESCRIPTION FORM END -->
                                            <!-- ========================================== OTHERS SECTION ENDS ======================================================= -->
                                        </div>
                                    </div>
                                    <!-- EXAMINATIONS/ DIAGNOSIS/ OTHERS -->
                                    <button type="submit" class="btn btn-outline-info"><i class="fa fa-file"></i> Save
                                        Prescription</button>
                                </div>
                            </form>
                            <!-- ============================================================================================================== -->
                        </div>
                        <!-- INPUT FORMS -->
                        <!-- ============================================================================ -->
                        <div class="row mb-10 bd-top">
                            <div class="col-md-9">
                                <form action="update-remark" method="POST" id="remarkUpdate">
                                    @csrf
                                    <input type="hidden" id="rRegistrationID" name="rRegistrationID">
                                    <div class="col-md-4">
                                        <label for="consultedAt">Consulted At</label>
                                        <input type="datetime-local" class="form-control round" id="consultedAt"
                                            name="consultedAt">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="remarks">Remarks</label>
                                        <input type="text" class="form-control round" id="remarks" name="remarks">
                                    </div>
                                    <div class="col-md-1 mt-10">
                                        <input type="checkbox" class="form-control round" id="manualTime"
                                            name="manualTime" value="1">
                                        <label for="manualTime">Manual Time</label>
                                    </div>
                                    <div class="col-md-1 mt-10">
                                        <input type="checkbox" class="form-control round" id="canceled" name="canceled"
                                            value="1">
                                        <label for="canceled">Canceled</label>
                                    </div>
                                    <div class="col-md-1 mt-30">
                                        <button type="submit" class="btn btn-outline-success btn-sm">Commit</button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-3">
                                <form action="update-discount" method="POST" id="discountUpdate">
                                    @csrf
                                    <div class="col-md-9 bd-left">
                                        <input type="hidden" id="dRegistrationID" name="dRegistrationID">
                                        <label for="updateDiscount">Discount</label>
                                        <input type="text" class="form-control round" id="updateDiscount"
                                            name="updateDiscount" required>
                                    </div>
                                    <div class="col-md-3 mt-30">
                                        <button class="btn btn-primary btn-sm">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- ============================================================================ -->
                    </div>
                </div>
                <!-- TAB-CONTENT -->
            </div>
        </div>
    </div>
</div>
</div>
<!-- MODAL CONSULTATIONS -->
<!-- ============================================================================================================ -->
<!-- ==============================MODAL SUMMARY ================================================================ -->
<div class="modal fade text-xs-left" id="summaryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="my-modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel17">
                    <!-- TAB SELECTIONS -->
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link my-nav-link active" id="active-pill" data-toggle="pill" href="#active"
                                aria-expanded="true">Summary</a>
                    </ul>
                    <!-- TAB SELECTIONS -->
                </h4>
            </div>
            <div class="modal-body my-modal-body">
                <!-- TAB-CONTENT -->
                <div class="tab-content px-1 pt-1">

                    <!-- =======================================================TAB1 STARTS======================================= -->
                    <div role="tabpanel" class="tab-pane active" id="active" aria-labelledby="active-pill"
                        aria-expanded="true">
                        <!-- INPUT FORMS -->
                        <div class="row">
                            <form class="form">
                                <div class="form-body">

                                    <div class="form-group mb-5 col-md-3">
                                        <label for="registrationNo">Registration No</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="registrationNo" class="form-control my-select"
                                                placeholder="" name="registrationNo">
                                            <div class="form-control-position mt--2">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-5 col-md-3">
                                        <label for="registrationDate">Registration Date</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="date" id="registrationDate" class="form-control my-select"
                                                placeholder="" name="registrationDate">
                                            <div class="form-control-position mt--2">
                                                <i class="fa fa-clock"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-5 col-md-1">
                                        <label for="age">Age</label>
                                        <input type="text" id="age" class="form-control my-select" placeholder=""
                                            name="age">
                                    </div>

                                    <div class="form-group mb-5 col-md-2">
                                        <label for="sex">Sex</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="sex" class="form-control my-select" placeholder=""
                                                name="sex">
                                            <div class="form-control-position mt--2">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-5 col-md-3">
                                        <label for="mobile">Mobile No</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="mobile" class="form-control my-select" placeholder=""
                                                name="mobile">
                                            <div class="form-control-position mt--2">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-5 col-md-6">
                                        <label for="patientName">Patient Name</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="patientName" class="form-control my-select"
                                                placeholder="" name="patientName">
                                            <div class="form-control-position mt--2">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-5 col-md-3">
                                        <label for="city">City</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="city" class="form-control my-select" placeholder=""
                                                name="city">
                                            <div class="form-control-position mt--2">
                                                <i class="fa fa-city"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-5 col-md-3">
                                        <label for="criticality">Criticality</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="criticality" class="form-control my-select"
                                                placeholder="" name="criticality">
                                            <div class="form-control-position mt--2">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group mb-5 col-md-12">
                                        <label for="address">Address</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="text" id="address" class="form-control my-select"
                                                placeholder="" name="address">
                                            <div class="form-control-position mt--2">
                                                <i class="fa fa-address-book"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!-- INPUT FORMS -->
                        <!-- PILLS -->
                        <ul class="nav nav-pills mt-10">
                            <li class="nav-item">
                                <a class="nav-link my-nav-link active" id="base-pill1" data-toggle="pill" href="#pill1"
                                    aria-expanded="true">Past Registrations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link my-nav-link" id="base-pill2" data-toggle="pill" href="#pill2"
                                    aria-expanded="false">Consultations</a>
                            </li>
                        </ul>
                        <!--   TAB-CONTENTS -->
                        <div class="tab-content px-1 pt-1">
                            <div role="tabpanel" class="tab-pane active" id="pill1" aria-expanded="true"
                                aria-labelledby="base-pill1">
                                <!-- table data -->
                                <div class="table-responsive">
                                    <table class="table my-table table-hover table-striped" id="summaryTable">
                                        <thead>
                                            <tr>
                                                <th>RegistrationID</th>
                                                <th>RegistrationDate</th>
                                                <th>ConsultationDate</th>
                                                <th>ReferredBy</th>
                                                <th>Weight</th>
                                                <th>Age</th>
                                                <th>ConsultantName</th>
                                                <th>ServiceNo</th>
                                                <th>ConsultantName1</th>
                                                <th>CorporateName</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- table data -->
                            </div>
                            <div class="tab-pane" id="pill2" aria-labelledby="base-pill2" aria-expanded="false">
                                <!-- table data -->
                                <div class="table-responsive">
                                    <table class="table my-table table-hover table-striped wd-100" id="consultantTable">
                                        <thead>
                                            <tr>
                                                <th>RegistrationID</th>
                                                <th>Consultant Name</th>
                                                <th>Consultation Date</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- table data -->
                            </div>
                            <!--   TAB CONTENTS -->
                            <!-- PILLS -->
                        </div>
                    </div>
                    <!-- TAB-CONTENT -->
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ==============================MODAL SUMMARY ================================================================ -->

<!-- ==============================================INVESTIGATIONS MODAL ======================================= -->
<div class="modal fade text-xs-left" id="investigationsModal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="my-modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel17">
                    <!-- TAB SELECTIONS -->
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link my-nav-link active" id="active-pill" data-toggle="pill" href="#active"
                                aria-expanded="true">Investigations</a>
                    </ul>
                    <!-- TAB SELECTIONS -->
                </h4>
            </div>
            <div class="modal-body my-modal-body">
                <!-- TAB-CONTENT -->
                <div class="tab-content px-1 pt-1">

                    <!-- =======================================================TAB1 STARTS======================================= -->
                    <div role="tabpanel" class="tab-pane active" id="active" aria-labelledby="active-pill"
                        aria-expanded="true">
                        <div class="row">
                            <!-- TABLE -->
                            <div class="col-md-5">
                                <div class="table-responsive table-hover">
                                    <table class="table table-sm" id="investigationsTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Investigation</th>
                                                <th>ReportingDate</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- TABLE -->
                            <!-- DOCUMENT -->
                            <div class="col-md-7">
                                <div class="card mt-10">

                                    <div class="card-body" id="iReport">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for=""><strong>Patient Name:</strong> <span
                                                            id="iPatientName"></span></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for=""><strong>Collected On:</strong> <span
                                                            id="icollectionDate"></span></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for=""><strong>Reported On:</strong> <span
                                                            id="ireportingDate"></span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <label for=""><strong>Reg. No.:</strong> <span
                                                            id="ireferenceNo"></span></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for=""><strong>Age:</strong> <span id="iage"></span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <label for=""><strong>Ref. By:</strong> <span
                                                            id="idoctorName"></span></label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for=""><strong>Sex:</strong> <span id="isex"></span></label>
                                                </div>
                                                <div class="col-md-8">
                                                    <label for=""><strong>Location:</strong> <span class=""></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for=""><strong>Specimen:</strong> <span
                                                            id="ispecimen"></span></label>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table" id="iReportTable">
                                                        <div class="card-header">
                                                            <div class="card-title center-txt" id="iprintHeading"></div>
                                                        </div>
                                                        <thead>
                                                            <th>Test Done</th>
                                                            <th>Test Result</th>
                                                            <th>Unit</th>
                                                            <th>Normal Value(s)</th>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- DOCUMENT -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ==============================================INVESTIGATIONS MODAL ======================================= -->
<!-- ==============================================PRESCRIPTION MODAL========================================== -->
<div class="modal fade text-xs-left" id="prescriptionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="my-modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel17">
                    <!-- TAB SELECTIONS -->
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link my-nav-link active" id="active-pill" data-toggle="pill" href="#active"
                                aria-expanded="true">Prescriptions</a>
                    </ul>
                    <!-- TAB SELECTIONS -->
                </h4>
            </div>
            <div class="modal-body my-modal-body">
                <!-- TAB-CONTENT -->
                <div class="tab-content px-1 pt-1">

                    <!-- =======================================================TAB1 STARTS======================================= -->
                    <div role="tabpanel" class="tab-pane active" id="active" aria-labelledby="active-pill"
                        aria-expanded="true">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header my-card-header">
                                        <div class="card-title">Tags</div>
                                    </div>
                                    <div class="card-body">
                                        <a href="https://i.pinimg.com/originals/34/23/8b/34238bac87190c4ee62c315752d455bd.jpg"
                                            data-toggle="lightbox">
                                            <img class="img-prescription"
                                                src="https://i.pinimg.com/originals/34/23/8b/34238bac87190c4ee62c315752d455bd.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- DOCUMENT -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header my-card-header">
                                        <div class="card-title">Tags</div>
                                    </div>
                                    <div class="card-body">
                                        <a href="https://3.bp.blogspot.com/-xw97Cn5F2N0/W8XPj8_WaRI/AAAAAAAAAiI/dDzkgkqSSL4yjBKuSiyNJq6kJNzwTcYWwCLcBGAs/s1600/BLANK%2BAADHAR%2BCARD.jpg"
                                            data-toggle="lightbox">
                                            <img class="img-prescription"
                                                src="https://3.bp.blogspot.com/-xw97Cn5F2N0/W8XPj8_WaRI/AAAAAAAAAiI/dDzkgkqSSL4yjBKuSiyNJq6kJNzwTcYWwCLcBGAs/s1600/BLANK%2BAADHAR%2BCARD.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header my-card-header">
                                        <div class="card-title">Tags</div>
                                    </div>
                                    <div class="card-body">
                                        <a href="https://i.pinimg.com/originals/34/23/8b/34238bac87190c4ee62c315752d455bd.jpg"
                                            data-toggle="lightbox">
                                            <img class="img-prescription"
                                                src="https://i.pinimg.com/originals/34/23/8b/34238bac87190c4ee62c315752d455bd.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- DOCUMENT -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================== PRESCRIPTION MODAL========================================= -->
@endsection

@section('page-script')
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/ekko-lightbox.min.js"></script>
<script type="text/javascript" src="js/doctor-consultation.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"></script>

<script>
    $(function () {

        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    });

</script>
@endsection
