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

function loadUsersEditDetails(postUrl, postData, displayDiv){
    $.ajax({
        url : postUrl,
        type : "POST",
        data : postData,
        success : function (responseFromSite) {
            // $("#"+displayDiv).html(responseFromSite);
            alert("successs")
        }

    });
}