@extends('admin.layouts.app')

@section('recordsactive')
class="active"
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="css/bootstrap-tagsinput.css">
@endsection

@section('page-content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Update MRD Records</h4>
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
            <!-- FORM -->
            <form action="editMRD" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="form-body">

                        <div class="form-group col-md-3">
                            <label for="MRno">MR No</label>
                            <div class="position-relative has-icon-right">
                                <input id="MRno" name="MRno" type="text" class="form-control" readonly=""
                                    value="{{$mrd->mr_no}}">
                                <input type="hidden" id="id" name="id" value="{{$mrd->id}}">
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="category">Department</label>
                            <div class="position-relative has-icon-left">
                                <select name="category" id="category" class="form-control round" required="" disabled>
                                    <option value="{{$mrd->department}}">{{$mrd->department}}</option>
                                </select>
                                <div class="form-control-position">
                                    <i class="fa fa-book-medical"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="category">Photo Category</label>
                            <div class="position-relative has-icon-left">
                                <select name="photoCategory" id="photoCategory" class="form-control round">
                                    <option value="{{$mrd->photo_category}}">{{$mrd->photo_category}}</option>
                                </select>
                                <div class="form-control-position">
                                    <i class="fa fa-book-medical"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="IpdRegistrationNo">Registration No</label>
                            <div class="position-relative has-icon-left">
                                <select name="RegistrationNo" id="RegistrationNo" class="form-control round"
                                    disabled="">
                                    <option value="{{$mrd->registration_no}}">{{$mrd->registration_no}}</option>
                                </select>
                                <div class="form-control-position">
                                    <i class="fa fa-book-medical"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="tags">Add Tags</label>
                            <div class="position-relative has-icon-left">
                                <input id="tags" name="tags" type="text" class="form-control round"
                                    data-role="tagsinput" value="{{$mrd->tags}}">

                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="photoUpload">Edit Upload Photo/ Media</label>
                            <div class="position-relative has-icon-left">
                                <input type="file" id="photoupload" name="photoupload"
                                    class="form-control round with-preview" value="{{$mrd->photo}}" maxlength="1">
                                <div class="form-control-position">
                                    <i class="fa fa-file"></i>
                                </div>
                                <!-- Getting Image by Loop -->
                                <?php
                                    $images=explode('|',$mrd->photo);
                                ?>
                                @foreach($images as $image)

                                <div class="MultiFile-list" id="photoupload_list">
                                    <div class="MultiFile-label">
                                        <span class="MultiFile-label" title="File selected: uploadImages/{{$image}}">
                                            <span class="MultiFile-title">{{$image}}</span>
                                            <img class="MultiFile-preview" style="max-height:100px; max-width:100px;"
                                                src="uploadImages/{{$image}}">
                                        </span>
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                                <!-- Getting Image by Loop -->
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="timesheetinput7">Notes</label>
                            <div class="position-relative has-icon-left">
                                <textarea id="notes" name="notes" rows="5" class="form-control round" name="notes"
                                    placeholder="Notes">{{$mrd->notes}}</textarea>
                                <div class="form-control-position">
                                    <i class="fa fa-comment"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-actions right">
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-check2"></i> Update
                    </button>
                </div>
            </form>
            <!-- FORM -->
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script type="text/javascript" src="js/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="js/jquery.MultiFile.js"></script>
<script>
    $(function () {
        $('#photoupload').MultiFile();

        $(document).on('keyup keypress', 'form input[type="text"]', function (e) {
            if (e.which == 13) {
                e.preventDefault();
                return false;
            }
        });

        var department = document.getElementById('category').value;
        photoCategory(department);

    });

    function photoCategory(department) {
        $('#loaderbody').show();
        var mUrl = "/category-by-department/" + department

        $.ajax({
            url: mUrl,
            type: "GET",
            cache: false,
            contentType: "application/json;charset=utf-8",
            datatype: 'json',
            success: function (result) {
                if (result == false) {
                    alert('Result Not Found To This MR No');
                    $select = $('#photoCategory');
                    $select.append($('<option>').html('-- Update Photo Category --'));
                    $('#loaderbody').hide();
                } else {
                    $select = $('#photoCategory');
                    $select.append($('<option>').html('-- Update Photo Category --'));
                    Object.keys(result).forEach(function (key) {
                        console.log(key); // logs keys in myObject
                        console.log(result[key]); // logs values in myObject
                        $a = result[key].photo_category;
                        $b = result[key].id;
                        $select.append('<option data-myid=' + $b + ' value=' + $a + '>' + $a +
                            '</option>');
                    });
                    $('#loaderbody').hide();
                }
            }
        });
    }

</script>
@endsection
