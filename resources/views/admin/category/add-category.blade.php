@extends('admin.layouts.app')

@section('categoryactive')
class="active"
@endsection

@section('page-css')
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
@endsection

@section('page-content')
<!-- PAGE CONTENT START -->
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Photo Categories</h4>
        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-category"><i
                            class="fa fa-plus-circle"></i> Add
                        Category</button></li>
            </ul>
        </div>
    </div>
    <div class="card-body collapse in">
        <div class="card-block card-dashboard">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Department</th>
                            <th>Photo Category</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- PAGE CONTENT END -->

<!-- ADD CATEGORY MODAL -->
<div class="modal fade text-xs-left" id="add-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel1">Add Photo category</h4>
            </div>
            <div class="modal-body">
                <form action="save-category" method="POST" id="save-category">
                    @csrf
                    <label>Department</label>
                    <div class="form-group">
                        <select name="department" id="department" class="form-control round" required>
                            <option value="">-- Select Department --</option>
                            <option value="IPD">IPD</option>
                            <option value="OPD">OPD</option>
                            <option value="DayCare">Day Care</option>
                        </select>
                    </div>

                    <label>Photo Category</label>
                    <div class="form-group">
                        <input type="text" placeholder="Photo Category" class="form-control round" id="photoCategory"
                            name="photoCategory" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- ADD CATEGORY MODAL -->

<!-- EDIT CATEGORY MODAL -->
<div class="modal fade text-xs-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel1">Edit Photo category</h4>
            </div>
            <div class="modal-body">
                <form action="update-category" method="POST" id="update-category">
                    @csrf
                    <label>Department</label>
                    <div class="form-group">
                        <select name="departmentUpdate" id="departmentUpdate" class="form-control round" required>
                            <option value="">-- Select Department --</option>
                            <option value="IPD">IPD</option>
                            <option value="OPD">OPD</option>
                            <option value="DayCare">Day Care</option>
                        </select>
                        <input type="hidden" id="id" name="id">
                    </div>

                    <label>Photo Category</label>
                    <div class="form-group">
                        <input type="text" placeholder="Photo Category" class="form-control round"
                            id="photoCategoryUpdate" name="photoCategoryUpdate" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- EDIT CATEGORY MODAL -->
@endsection

@section('page-script')
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"></script>
<script type="text/javascript" src="js/add-category.js"></script>
<script>
    $(function () {
        getCategory();

        $('#save-category').on('submit', function (e) {
            saveCategory(e);
        });

    });

</script>
@endsection
