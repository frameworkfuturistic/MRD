function Enable(value) {
    enableInput(value);
    showRegistrationNo(value);
    photoCategory(value);
}

/*
    ==============================================RETREIVING REGISTRATION NO================================
*/
function showRegistrationNo(category) {
    appendValue(category);
}

function appendValue(category) {
    $('#loaderbody').show();
    var MRNo = document.getElementById("MRno").value;
    if (MRNo == '') {
        alert('MR NO FIELD IS REQUIRED');
        $('#loaderbody').hide();
        return false;
    } else if (category == 'IPD') {
        var mUrl = "/ipd-registrations/" + MRNo
    } else if (category == 'OPD') {
        var mUrl = "/opd-registrations/" + MRNo
    } else {
        var mUrl = "/dc-registrations/" + MRNo
    }

    $.ajax({
        url: mUrl,
        type: "GET",
        cache: false,
        contentType: "application/json;charset=utf-8",
        datatype: 'json',
        success: function (result) {
            if (result == false) {
                alert('Result Not Found To This MR No');
                $select = $('#RegistrationNo');
                $select.find('option').remove();
                $select.append($('<option>').html('-- Select Registration No --'));
                $('#loaderbody').hide();
            } else {
                $select = $('#RegistrationNo');
                $select.find('option').remove();
                $select.append($('<option>').html('-- Select Registration No --'));
                Object.keys(result).forEach(function (key) {
                    console.log(key); // logs keys in myObject
                    console.log(result[key]); // logs values in myObject
                    $a = result[key].RegistrationNo;
                    $b = result[key].RegistrationID;
                    $date = result[key].RegistrationDate;
                    $select.append('<option data-myid=' + $b + ' value=' + $a + '>' + $a +
                        '</option>');
                });
                $('#loaderbody').hide();
            }
        }
    });
}

function appendRegId() {
    var $selection = $('#RegistrationNo').find(':selected');
    var id;
    $selection.each(function () {
        id = $(this).data('myid');
    });
    return id;
}
/*
    ==============================================RETREIVING REGISTRATION NO================================
*/

/* 
    RETRIEVING PHOTOCATEGORY BY DEPARTMENT
*/

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
                $select.find('option').remove();
                $select.append($('<option>').html('-- Select Photo Category --'));
                $('#loaderbody').hide();
            } else {
                $select = $('#photoCategory');
                $select.find('option').remove();
                $select.append($('<option>').html('-- Select Photo Category --'));
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
/*

    RETRIEVING PHOTO CATEGORY BY DEPARTMENT
*/



/*
    =======================================================Searching by PATIENT MRD NO, MOBILE NO, NAME==================
*/
// by MRD NO--------------------------------------------------------------------------------------------
function getMRDList(e) {
    $('#loaderbody').show();
    var MRNo = document.getElementById('searchMRNo').value;

    if (MRNo) {
        var targetform = $('#searchByMRD');
        var mUrl = targetform.attr('action') + '?searchMRNo=' + MRNo;
    } else {
        alert('Please Fill MR No');
    }
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: mUrl,
        contentType: "application/json;",
        success: function (results) {
            showData(results.data);
            $('#loaderbody').hide();
        }
    })
}
// BY MRD NO--------------------------------------------------------------------------------------------

// PATIENT NAME-----------------------------------------------------------------------------------------

function getMRDListByName(e) {
    $('#loaderbody').show();
    var Name = document.getElementById('searchPatientName').value;
    if (Name) {
        var targetform = $('#searchByName');
        var mUrl = targetform.attr('action') + '?searchPatientName=' + Name;
    } else {
        alert('Fill Patient Name');
    }
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: mUrl,
        contentType: "application/json;",
        success: function (results) {
            showData(results.data);
            $('#loaderbody').hide();
        }
    });
}
// PATIENT NAME-----------------------------------------------------------------------------------------

// MOBILE NO--------------------------------------------------------------------------------------------
function getMRDListByMobile(e) {
    $('#loaderbody').show();
    var mobile = document.getElementById('searchMobileNo').value;
    if (mobile) {
        var targetform = $('#searchByMobile');
        var mUrl = targetform.attr('action') + '?searchMobileNo=' + mobile;
    } else {
        alert('Please Fill Mobile No');
    }
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: mUrl,
        contentType: "application/json;",
        success: function (results) {
            showData(results.data);
            $('#loaderbody').hide();
        }
    });
}
// MOBILE NO--------------------------------------------------------------------------------------------

// FUNCTION SHOWING DATA ON MY DATA TABLE LIST
function showData(data) {
    $('#dataTable').DataTable().clear().destroy();

    $('#dataTable').DataTable({
        "data": data,
        "processing": true,
        "method": "GET",
        "columns": [{
                "title": "Action",
                "data": "MRNo",
                "render": function (data) {
                    return "<button class='btn btn-primary btn-sm' data-dismiss='modal' onclick='appendMRD(" + data + ")'><i class='fa fa-pen'></i> Select</button>";
                },
                "orderable": "false",
                "searchable": "false",
                "width": "50px"
            },
            {
                "data": "MRNo"
            },
            {
                "data": "MRDate"
            },
            {
                "data": "PatientName"
            },
            {
                "data": "DOB"
            },
            {
                "data": "MobileNo"
            }
        ],
        "columnDefs": [{
                "width": "20px",
                "targets": 0
            },
            {
                "width": "20px",
                "targets": 1
            },
            {
                "width": "20px",
                "targets": 2
            },
            {
                "width": "20px",
                "targets": 3
            },
            {
                "width": "20px",
                "targets": 4
            },
            {
                "width": "20px",
                "targets": 5
            }
        ]
    });

}
// FUNCTION SHOWING DATA ON MY DATATABLE LIST
/*
    =======================================================Searching by PATIENT MRD NO, MOBILE NO, NAME==================
*/

function appendMRD(MR) {
    $('#MRno').val(MR);
}


// IMAGE PREVIEW

function imagePreview() {
    var previewImages = function (input, imgPreviewPlaceholder) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    $('#photoupload').on('change', function () {
        previewImages(this, 'div.images-preview-div');
    });
}
