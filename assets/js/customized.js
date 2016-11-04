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

function loadMastersList(postData) {

    $.ajax({
        url: "BrandList",
        type: "GET",
        data: postData,
        success: function (data) {

            $("#usersListDiv").html(data);
            $('#datatable-responsive').DataTable();
        }
    });

}
function deleteProductsMaster(masterType, postData, postUrl) {
    var isdelete = confirm("Are you sure to delete!");
    if(isdelete){
        $.ajax({
            url: postUrl,
            type: "GET",
            data: postData,
            success: function (data) {
                if(masterType == "brand"){
                    var postData = "type=brandList";
                    loadMastersList(postData);
                }
                if(masterType == "size"){
                    var postData = "type=sizeList";
                    loadMastersList(postData);
                }
                if(masterType == "Category Type"){
                    var postData = "type=Category Type";
                    loadMastersList(postData);
                }
                // if(masterType == "product"){
                //     var sizeList = "sizeList";
                //     loadMastersList(sizeList);
                // }
            }
        });
    }
}

function getAddOrEditModalContent(postBrandData, loadAddOrEditModalUrl) {
    $.ajax({
        url: loadAddOrEditModalUrl,
        type: "get",
        data : postBrandData,
        success: function (responseFromSite) {

            $("#modalContentArea").html(responseFromSite);
            $("#addOrEditUserDetailsForm").parsley();
            $("#panel-modal").modal('show');

            $("#brandname").select2();
            $("#size").select2();
            $("#categorytypeid").select2();
            $("#subcategoryid").select2();
        }
    });
}

function gotoPage(url) {
    window.location.href = url;

}
