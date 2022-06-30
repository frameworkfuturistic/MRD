@extends('admin.layouts.app')

@section('recordsactive')
class="active"
@endsection

@section('page-css')
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<style>

</style>
@endsection

@section('page-content')
<!-- MRD RECORDS TABLE -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">MRD Records</h4>
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
                <table class="table table-hover table-striped mb-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Mobile No</th>
                            <th>MR No</th>
                            <th>Department</th>
                            <th>Registration No</th>
                            <th>Tags</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mrd as $mrd)
                        <th scope="row">
                            <button onclick="window.location.replace('view-mrd-details/{{$mrd->id}}');"
                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                        </th>
                        <td>{{$mrd->PatientName}}</td>
                        <td>{{$mrd->MobileNo}}</td>
                        <td>{{$mrd->mr_no}}</td>
                        <td>{{$mrd->department}}</td>
                        <td>{{$mrd->registration_no}}</td>
                        <td>{{$mrd->tags}}</td>
                        <td><img src="uploadImages/{{$mrd->photo}}" alt="" class="dataTableImage"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- DataTable -->
        </div>
    </div>
</div>
<!-- MRD RECORD TABLE   -->
@endsection

@section('page-script')
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script>
    $(function () {
        $('#dataTable').DataTable();
    });

</script>
@endsection
