@extends('admin.layouts.app')

@section('photoactive')
class="active"
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="css/bootstrap-tagsinput.css">
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<style>

</style>
@endsection

@section('page-content')
<!-- Upload Form -->
<div class="card" style="height: 855px;">
    <div class="card-header">
        <h4 class="card-title" id="basic-layout-icons">Photo/Media Upload</h4>
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

            <form class="form" id="form" action="add-mrdphoto" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-body">

                        <div class="form-group col-md-3">
                            <label for="MRno">MR No</label>
                            <div class="position-relative has-icon-right">
                                <input id="MRno" name="MRno" type="text" class="form-control" readonly>

                                <div class="form-control-position">
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#large">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="category">Department</label>
                            <div class="position-relative has-icon-left">
                                <select name="category" id="category" class="form-control round"
                                    onchange="Enable(this.value);" required>
                                    <option value="">-- Select Department --</option>
                                    <option value="IPD">IPD</option>
                                    <option value="OPD">OPD</option>
                                    <option value="DayCare">Day Care</option>
                                </select>
                                <div class="form-control-position">
                                    <i class="fa fa-book-medical"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="category">Photo Category</label>
                            <div class="position-relative has-icon-left">
                                <select name="photoCategory" id="photoCategory" class="form-control round" disabled>
                                    <option value=""></option>
                                </select>
                                <div class="form-control-position">
                                    <i class="fa fa-book-medical"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="IpdRegistrationNo">Registration No</label>
                            <div class="position-relative has-icon-left">
                                <select name="RegistrationNo" id="RegistrationNo" class="form-control round" disabled>
                                    <option value=""></option>
                                </select>
                                <input type="hidden" id="RegistrationId" name="RegistrationId">
                                <div class="form-control-position">
                                    <i class="fa fa-book-medical"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="tags">Add Tags</label>
                            <div class="position-relative has-icon-left">
                                <input id="tags" name="tags" type="text" class="form-control round"
                                    data-role="tagsinput">

                            </div>
                        </div>



                        <div class="form-group col-md-12">
                            <label for="photoUpload">Upload Photo/ Media</label>
                            <div class="position-relative has-icon-left">
                                <input type="file" id="photoupload" name="photoupload[]" multiple=""
                                    class="form-control round with-preview">
                                <div class="form-control-position">
                                    <i class="fa fa-file"></i>
                                </div>
                                <div class="images-preview-div"> </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="timesheetinput7">Notes</label>
                            <div class="position-relative has-icon-left">
                                <textarea id="notes" name="notes" rows="5" class="form-control round" name="notes"
                                    placeholder="Notes"></textarea>
                                <div class="form-control-position">
                                    <i class="fa fa-comment"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions right">
                    <button type="button" class="btn btn-warning mr-1">
                        <i class="icon-cross2"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-check2"></i> Save
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Upload Form -->
<!-- Modal -->
<div class="modal fade text-xs-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog my-modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel17">
                    <div class="row">
                        <div class="col-md-2">
                            <i class="fa fa-search"></i> MRD Records
                        </div>
                        <!-- search form of MRD -->
                        <form action="{{ url('searchMRD') }}" id="searchByMRD" method="GET" role="search">
                            <div class="col-md-2">
                                <input type="text" class="form-control round" placeholder="Search by MR No"
                                    id="searchMRNo" name="searchMRNo">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </form>


                        <form action="{{ url('searchPatientName') }}" id="searchByName" method="GET" role="search">
                            <div class="col-md-2">
                                <input type="text" class="form-control round" placeholder="Search by Patient Name"
                                    id="searchPatientName" name="searchPatientName">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </form>


                        <form action="{{ url('searchMobileNo') }}" id="searchByMobile" method="GET" role="search">
                            <div class="col-md-2">
                                <input type="text" class="form-control round" placeholder="Search by Mobile No"
                                    id="searchMobileNo" name="searchMobileNo">
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                        <!-- search form of MRD -->
                    </div>
                </h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive table-hover table-striped">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>MR No</th>
                                <th>MR Date</th>
                                <th>Patient Name</th>
                                <th>DOB</th>
                                <th>Mobile No</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
@endsection

@section('page-script')
<script type="text/javascript" src="js/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="js/enable-input.js"></script>
<script type="text/javascript" src="js/photo-upload.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/jquery.MultiFile.js"></script>
<script>
    $(function () {
        $('#photoupload').MultiFile();

        $('#searchByMRD').on('submit', function (e) {
            getMRDList(e);
        });

        $('#searchByName').on('submit', function (e) {
            getMRDListByName(e);
        });

        $('#searchByMobile').on('submit', function (e) {
            getMRDListByMobile(e);
        });

        $('#RegistrationNo').on('change', function () {
            $('#RegistrationId').val(appendRegId());
        });

        $(document).on('keyup keypress', 'form input[type="text"]', function (e) {
            if (e.which == 13) {
                e.preventDefault();
                return false;
            }
        });


        // Multiple images preview with JavaScript

    });

</script>
@endsection
