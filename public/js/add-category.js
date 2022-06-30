 /*
        FETCHING DATA ON DATATABLE
    */
 function getCategory() {
     $('#loaderbody').show();
     $.ajax({
         type: "GET",
         url: "/get-category",
         contentType: "application/json;",
         success: function (results) {
             showData(results);
         }
     })
 }

 function showData(data) {
     $('#dataTable').DataTable({
         "data": data,
         "processing": true,
         "method": "GET",
         "columns": [{
                 "title": "Action",
                 "data": "id",
                 "render": function (data) {
                     return "<button class='btn btn-success btn-sm' data-toggle='modal' data-target='#edit' data-myid=" + data + "><i class='fa fa-pen'></i> Edit</button>";
                 },
                 "orderable": "false",
                 "searchable": "false",
                 "width": "50px"
             },
             {
                 "data": "department"
             },
             {
                 "data": "photo_category"
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
             }
         ]
     });
     $('#loaderbody').hide();
 }

 /*
     FETCHING DATA ON DATATABLE 
 */
 /*
     Save Category Javascript using ajax
 */
 function saveCategory(e) {
     var targetform = $('#save-category');
     var murl = targetform.attr('action');
     var mdata = $("#save-category").serialize();
     e.preventDefault();

     $.ajax({
         url: murl,
         type: "post",
         data: mdata,
         datatype: "json",
         success: function (mdata) {
             swal({
                 title: "Good job!",
                 text: "You Updated the Price List!",
                 icon: "success",
                 button: "Ok!",
             });
             $('#dataTable').DataTable().destroy();
             getCategory();
         },

         error: function (error) {
             alert(error);
         },
     });

 }
 /*
     Save Category Javascript using ajax
 */

 /*
     GETTING DATA ON SHOW MODAL
 */

 $('#edit').on('show.bs.modal', function (e) {
     var button = $(e.relatedTarget)
     var myid = button.data('myid')
     var mUrl = "/get-category/" + myid

     showModalWithData(mUrl);
 })

 // Show Modal With Data
 function showModalWithData(url) {

     $('#loaderbody').show();
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
                 $('#id').val(result.id);
                 $('#departmentUpdate').val(result.department);
                 $('#photoCategoryUpdate').val(result.photo_category);
             }
         }
     });
     $('#loaderbody').hide();
 }
 // Show Modal With Data

 /* 
     GETTING DATA ON SHOW MODAL
 */

 /*
     UPDATING CATEGORY BY AJAX
 */
 // Edit Data Through ajax
 $('#update-category').submit(function (e) {
     var targetform = $('#update-category');
     var murl = targetform.attr('action');
     var mdata = $("#update-category").serialize();
     e.preventDefault();

     $.ajax({
         url: murl,
         type: "post",
         data: mdata,
         datatype: "json",
         success: function (mdata) {
             swal({
                 title: "Good job!",
                 text: "You Updated the Category!",
                 icon: "success",
                 button: "Ok!",
             });
             $('#dataTable').DataTable().destroy();
             getCategory();
         },
         error: function (error) {
             alert(error);
         },
     });
 });
 // Edit Data Through ajax
 /*  
 UPDATING CATEGORY BY AJAX
 */
