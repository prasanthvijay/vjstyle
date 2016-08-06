function loadUsersListDetails(postUrl, postData, displayDiv){
    $.ajax({
        url : postUrl,
        type : "POST",
        data : postData,
        success : function (responseFromSite) {
            $("#"+displayDiv).html(responseFromSite);
            $('#datatable-responsive').DataTable();
        }

    });
}

function loadAddOrEditContentWithModal(postUrl, postData, displayDiv){
        $.ajax({
        url : postUrl,
        type : "POST",
        data : postData,
        success : function (responseFromSite) {
            $("#"+displayDiv).html(responseFromSite);
            $("#panel-modal").modal('show');
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