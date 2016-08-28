function loadUsersListDetails(postUrl, postData, displayDiv) {
    $.ajax({
        url: postUrl,
        type: "POST",
        data: postData,
        success: function (responseFromSite) {
            $("#" + displayDiv).html(responseFromSite);
            $('#datatable-responsive').DataTable();
        }

    });
}

function loadAddOrEditContentWithModal(postUrl, postData, displayDiv) {
    $.ajax({
        url: postUrl,
        type: "get",
        data: postData,
        success: function (responseFromSite) {
            $("#" + displayDiv).html(responseFromSite);
            $("#panel-modal").modal('show');
            $("#addOrEditUserDetailsForm").parsley();
            jQuery('.datepicker-autoclose').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                todayHighlight: true
            });
        }

    });
    /*$.ajax({
     url : postUrl,
     type : "POST",
     data : postData,
     success : function (responseFromSite) {
     // $("#"+displayDiv).html(responseFromSite);
     alert("successs")
     }

     });*/
}

function loadbrandlist(typelist) {

    $.ajax({
        url: "BrandList",
        type: "GET",
        data: {type: typelist},
        success: function (data) {

            $("#usersListDiv").html(data);
            $('#datatable-responsive').DataTable();
        }
    });

}
function deleteBrandMaster(postData, postUrl) {
    var isdelete = confirm("Are you sure to delete!");
    if(isdelete){
        $.ajax({
            url: postUrl,
            type: "GET",
            data: postData,
            success: function (data) {
                loadbrandlist(brandList);
            }
        });
    }
}