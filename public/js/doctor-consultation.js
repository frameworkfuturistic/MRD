// INTIAL DATATABLE 
$('#searchConsultation').submit(function (e) {
    $('#loaderbody').show();
    var targetform = $('#searchConsultation');
    var date = document.getElementById('consultantDate').value;
    var consultant = document.getElementById('consultant').value;
    var murl = targetform.attr('action') + '?consultantDate=' + date + '&consultant=' + consultant;
    e.preventDefault();

    $.ajax({
        type: "GET",
        url: murl,
        contentType: "application/json;",
        success: function (results) {
            $('#dataTable').DataTable().destroy();
            showData(results);
            $('#loaderbody').hide();
        }
    })


});

function showData(data) {
    $('#dataTable').DataTable({
        "data": data,
        "processing": true,
        "method": "GET",
        "columns": [{
                "title": "Action",
                "data": "OPDConsultationID",
                "render": function (data, type, row, meta) {
                    return "<button type='button' class='btn btn-success btn-sm dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-pen'></i> View</button><div class='dropdown-menu'><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#large' onclick='appendRegID( " + data + "," + row.RegistrationID + " )' data-myid=" + data + "><i class='fa fa-user-tie'></i> Consultation</button><div class='dropdown-divider'></div><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#summaryModal' data-myid=" + row.RegistrationID + " data-mymr=" + row.MRNo + "><i class='fa fa-clock'></i> Summary</button>  <div class='dropdown-divider'></div><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#investigationsModal' data-myid=" + row.RegistrationID + "><i class='fa fa-flask'></i> Investigations</button><div class='dropdown-divider'></div><button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#prescriptionModal' data-myid=" + row.RegistrationID + "><i class='fa fa-file-medical'></i> Prescription</button></div>"
                },
                "orderable": "false",
                "searchable": "false",
                "width": "50px"
            },
            {
                "data": "TokenNo"
            },
            {
                "data": "PatientName"
            },
            {
                "data": "Sex"
            },
            {
                "data": "Cashless",
                "render": function (data) {
                    if (data == '0') {
                        return 'No';
                    } else {
                        return 'Yes';
                    }
                }
            },
            {
                "data": "shiftName"
            },
            {
                "data": "MRNo"
            },
            {
                "data": "RegistrationNo"
            },
            {
                "data": "RegistrationDate"
            },
            {
                "data": "Remarks"
            },
            {
                "data": "Discount"
            },
            {
                "data": "RegistrationFee"
            },
            {
                "data": "BookFee"
            },
            {
                "data": "Amount"
            },
            {
                "data": "Age"
            },
            {
                "data": "MobileNo"
            },
            {
                "data": "Criticality"
            },
            {
                "data": "ConsultedAt"
            }
        ],

    });
}
// INTIAL DATATABLE 

// Show Summary Modal
$('#summaryModal').on('show.bs.modal', function (e) {
    $('#loaderbody').show();
    var button = $(e.relatedTarget)
    var myid = button.data('myid')
    var mymr = button.data('mymr')
    var mUrl = "/patient-summary/" + myid
    var rUrl = "/past-registrations/" + mymr

    showSummaryModalWithData(mUrl);

    showSummaryTable(rUrl);
})
// Show SummaryModal
// SHOW SUMMARY MODAL WITH DATA
function showSummaryModalWithData(url) {
    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        contentType: "application/json;charset=utf-8",
        datatype: 'json',
        success: function (result) {
            if (result == false) {
                alertify.error('Error! No Records Found');
            } else {
                $('#id').val(result[0].RegistrationID);
                $('#registrationNo').val(result[0].RegistrationNo);
                $('#registrationDate').val(result[0].RegistrationDate);
                $('#age').val(result[0].Age);
                $('#sex').val(result[0].Sex);
                $('#mobile').val(result[0].MobileNo);
                $('#patientName').val(result[0].PatientName);
                $('#address').val(result[0].Address1);
                $('#city').val(result[0].City + ', ' + result[0].State);
                $('#criticality').val(result[0].Criticality);
            }
            $('#loaderbody').hide();
        }
    });
}
// SHOW SUMMARY MODAL WITH DATA

// SHOW SUMMARY PAST REGISTRATIONS AND CONSULTATIONS 
function showSummaryTable(myurl) {
    $('#loaderbody').show();
    $.ajax({
        type: "GET",
        url: myurl,
        contentType: "application/json;",
        success: function (results) {
            $('#summaryTable').DataTable().destroy();
            showPastRegistrations(results);

            $('#consultantTable').DataTable().destroy();
            showConsultations(results);

            $('#loaderbody').hide();
        }
    })
}
// SHOW SUMMARY PAST REGISTRATIONS
function showPastRegistrations(data) {
    $('#summaryTable').DataTable({
        "searching": false,
        "paging": false,
        "bInfo": false,
        "data": data,
        "processing": true,
        "method": "GET",
        "columns": [{
                "data": "RegistrationID"
            },
            {
                "data": "RegistrationDate"
            },
            {
                "data": "ConsultationDate"
            },
            {
                "data": "ReferredBy"
            },
            {
                "data": "Weight"
            },
            {
                "data": "Age"
            },
            {
                "data": "ConsultantName"
            },
            {
                "data": "ServiceNo"
            },
            {
                "data": "ConsultantName"
            },
            {
                "data": "CorporateName"
            }
        ],
    });
}
// SHOW SUMMARY PAST REGISTRTIONS

// SHOW SUMMARY CONSULTATIONS
function showConsultations(data) {
    $('#consultantTable').DataTable({
        "searching": false,
        "paging": false,
        "bInfo": false,
        "data": data,
        "processing": true,
        "method": "GET",
        "columns": [{
                "data": "RegistrationID"
            },
            {
                "data": "ConsultationDate"
            },
            {
                "data": "ConsultantName"
            }
        ],
    });
}
// SHOW SUMMARY CONSULTATIONS

// SHOW SUMMARY PAST REGISTRATIONS AND CONSULTATIONS 

// SHOW INVESTIGATION MODAL
$('#investigationsModal').on('show.bs.modal', function (e) {
    // $('#loaderbody').show();
    clearIds(); // CLEARING ALL REPORT
    showDetails();

    var button = $(e.relatedTarget)
    var myid = button.data('myid')
    var mUrl = "/get-investigations/" + myid

    showInvestigationTable(mUrl);
})

function showInvestigationTable(url) {
    $('#loaderbody').show();
    $.ajax({
        type: "GET",
        url: url,
        contentType: "application/json;",
        success: function (results) {
            $('#investigationsTable').DataTable().destroy();
            showInvestigationsData(results);

            $('#loaderbody').hide();
        }
    })
}

function showInvestigationsData(data) {
    $('#investigationsTable').DataTable({
        "searching": false,
        "paging": false,
        "bInfo": false,
        "data": data,
        "processing": true,
        "method": "GET",
        "columns": [{
                "title": "Action",
                "data": "TranID",
                "render": function (data, type, row, meta) {
                    return "<button type='button' class='btn btn-sm btn-outline-primary' onclick='showDetails(" + data + ");' data-myid=" + data + "><i class='fa fa-eye'></i></button>"
                },
                "orderable": "false",
                "searchable": "false",
                "width": "50px"
            },

            {
                "data": "GroupName"
            },
            {
                "data": "ReportingDate"
            }
        ],
    });
}
// SHOW INVESTIGATION MODAL

// SHOW DATA ON ACCORDIAN
function showDetails(myid) {
    clearIds(); //clearing all previous values of my report
    $('#loaderbody').show();
    var mUrl = "/get-investigations-report/" + myid
    showReportDetails(mUrl);
    showReportTable(mUrl);
}

//   SHOWING DETAILS ON HEADER
function showReportDetails(url) {
    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        contentType: "application/json;charset=utf-8",
        datatype: 'json',
        success: function (result) {
            if (result == false) {

            } else {
                $('#iPatientName').append(result[0].PatientName);
                $('#icollectionDate').append(result[0].CollectionDate);
                $('#ireportingDate').append(result[0].ReportingDate);
                $('#ireferenceNo').append(result[0].ReferenceNo);
                $('#iage').append(result[0].Age);
                $('#idoctorName').append(result[0].DoctorName);
                $('#isex').append(result[0].Sex);
                $('#ispecimen').append(result[0].Specimen);
                $('#iprintHeading').append(result[0].PrintHeading);
            }
            $('#loaderbody').hide();
        }
    });
}
//   SHOWING DETAILS ON HEADER

// SHOWING DETAILS ON REPORT TABLE
function showReportTable(url) {
    $.ajax({
        type: "GET",
        url: url,
        contentType: "application/json;",
        success: function (results) {
            $('#iReportTable').DataTable().destroy();
            showiReportData(results);
            $('#loaderbody').hide();
        }
    })
}

function showiReportData(data) {
    $('#iReportTable').DataTable({
        "aaSorting": [],
        "searching": false,
        "paging": false,
        "bInfo": false,
        "data": data,
        "processing": true,
        "method": "GET",
        "columns": [{
                "data": "Description",
                "render": function (data, type, row, meta) {
                    if (row.TestValue == '') {
                        return "<strong>" + data + "</strong>"
                    } else {
                        return data;
                    }
                },
            },
            {
                "data": "TestValue"
            },
            {
                "data": "Unit"
            },
            {
                "data": "NormalValue"
            }
        ],
    });
}
// SHOWING DETAILS ON REPORT TABLE

//   CLEAR ALL PREVIOUS VALUE ON MY REPORT
function clearIds() {
    $('#iPatientName').empty().append("");
    $('#icollectionDate').empty().append("");
    $('#ireportingDate').empty().append("");
    $('#ireferenceNo').empty().append("");
    $('#iage').empty().empty().append("");
    $('#idoctorName').empty().append("");
    $('#isex').empty().append("");
    $('#ispecimen').empty().append("");
    $('#iprintHeading').empty().append("");
}
// SHOW DATA ON ACCORDIAN

function appendRegID(value, value1) {
    $('#preRegistrationID').val("");
    $('#preRegistrationID').val(value);

    $('#rRegistrationID').val("");
    $('#rRegistrationID').val(value);

    $('#dRegistrationID').val("");
    $('#dRegistrationID').val(value1);

}

// SAVING PRESCRIPTION USING AJAX
$('#savePrescription').submit(function (e) {
    var targetform = $('#savePrescription');
    var murl = targetform.attr('action');
    var mdata = $("#savePrescription").serialize();
    e.preventDefault();

    $.ajax({
        url: murl,
        type: "post",
        data: mdata,
        datatype: "json",
        success: function (mdata) {
            swal({
                title: "Good job!",
                text: "You Saved the Prescription!",
                icon: "success",
                button: "Ok!",
            });
        },
        error: function (error) {
            alert(error);
        },
    });
});
// SAVING PRESCRIPTION USING AJAX METHOD

// UPDATE REMARKS
$('#remarkUpdate').submit(function (e) {
    var targetform = $('#remarkUpdate');
    var murl = targetform.attr('action');
    var mdata = $("#remarkUpdate").serialize();
    e.preventDefault();

    $.ajax({
        url: murl,
        type: "post",
        data: mdata,
        datatype: "json",
        success: function (mdata) {
            swal({
                title: "Good job!",
                text: "You Updated the Data!",
                icon: "success",
                button: "Ok!",
            });
        },
        error: function (error) {
            alert(error);
        },
    });
});
// UPDATE REMARKS

// UPDATE DISCOUNT
$('#discountUpdate').submit(function (e) {
    var targetform = $('#discountUpdate');
    var murl = targetform.attr('action');
    var mdata = $("#discountUpdate").serialize();
    e.preventDefault();

    $.ajax({
        url: murl,
        type: "post",
        data: mdata,
        datatype: "json",
        success: function (mdata) {
            swal({
                title: "Good job!",
                text: "You Updated the Discount!",
                icon: "success",
                button: "Ok!",
            });
        },
        error: function (error) {
            alert(error);
        },
    });
});
// UPDATE DISCOUNT
