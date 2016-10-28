<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"><?php echo $title; ?> Master</h4>
            </div>
        </div>
        <!-- Page-Title -->

        <div class="card-box">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <p class="text-muted m-b-20 font-13">
                                Add, Edit and Delete Product
                            </p>
                            <?php $loadAddOrEditModalUrl = base_url() . "Product/AddOrEditMasterContent"; ?>
                            <?php if($sessionUserTypeId == 1 || $sessionUserTypeId==2) { ?>
                            <button class="btn btn-primary waves-effect waves-light m-t-10"
                                    onclick="getAddOrEditModalContent('actionType=Add&actionId=0&masterName=<?php echo $title; ?>', '<?php echo $loadAddOrEditModalUrl; ?>')">
                                Add <?php echo $title; ?></button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox" name="loadSearchDiv" id="loadSearchDiv" onclick="loadSearchFunction()">
                            <label for="checkbox-signup">
                                Product Search
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div id="msgDiv"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div name="productSearchDiv" id="productSearchDiv"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div id="usersListDiv"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content p-0 b-0" id="modalContentArea">

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <?php include_once "innerFooter.php"; ?>
    </div>
</div>

<input type="hidden" id="count" name="count" value="1">
<input type="hidden" id="generateBarcdeExcelUrl" name="generateBarcdeExcelUrl" value="generateBarcdeExcel">
<input type="hidden" name="ajaxPostUrl" id="ajaxPostUrl" value="<?php echo base_url().'Product/productSearch'?>">
<script>
    var postData = "type=ProductList";

    loadMastersList(postData);
    
    function loadSearchFunction() {
        var loadSearchDiv = $("#checkbox-signup").is(":checked");
        if(loadSearchDiv){
            var ajaxPostData = "";
            var ajaxPostUrl = $("#ajaxPostUrl").val();
            $.ajax({
                url : ajaxPostUrl,
                type : "get",
                data : ajaxPostData,
                success : function (response) {
                    $("#productSearchDiv").html(response);

                    $("#categorytypeid").select2();
                    $("#subcategoryid").select2();
                    $("#brandid").select2();
                    $("#sizeid").select2();
                    $("#showroomId").select2();
                    $("#barcode").select2();
                }

            });
        } else {
            $("#productSearchDiv").html("");
        }
    }
    
    function searchProductList() {
        var newSearchPostData = $("#productSearchForm").serialize() + "&"+postData ;
        loadMastersList(newSearchPostData);
    }

    function generateProductList() {
        var postData = "type=generateBarCode";
        var newSearchPostData = $("#productSearchForm").serialize() + "&"+postData ;
        var generateBarcdeExcelUrl = $("#generateBarcdeExcelUrl").val();

        var formname = document.getElementById('productSearchForm');
        formname.method = "post";
        formname.action = generateBarcdeExcelUrl;
        formname.submit();
    }
    
    function loadAllProducts() {
        loadMastersList(postData);
    }
    
    function getCostDetailsForRetailer(postFormData, url) {

        $.ajax({
            url: url,
            type: "get",
            data : postFormData,
            success: function (responseFromSite) {
                $("#modalContentArea").html(responseFromSite);
                var options = {
                    "show" : true,
                    "backdrop" : "static",
                    "keyboard" : false
                }
                $("#panel-modal").modal(options);
                $('#datatable-responsive-new').DataTable();

            }
        });
        
    }
    
    function  mapRetailerProductCostAndQuantity() {
        var formDataPost = $("#mapRetailerProductCostForm").serialize();
        var viewCostUrl = $("#viewCostUrl").val();
        var productId = $("#productId").val();
        var mapRetailerProductCostAndQuantityUrl = $("#mapRetailerProductCostAndQuantityUrl").val();

        $.ajax({
            url : mapRetailerProductCostAndQuantityUrl,
            type : "get",
            data : formDataPost,
            success : function (responseFromSite) {
                getCostDetailsForRetailer("productId="+productId+"&responseFromSite=1", viewCostUrl);
            }
        });
    }

    function getSubCategoryList() {
        var formData = "type=subCategoryJson&categorytypeid="+$("#categorytypeid").val();
        $.ajax({
            url : "BrandList",
            type : "get",
            data : formData,
            success : function (responseFromSite) {
                $("#subcategorydiv").html(responseFromSite);
                $("#subcategoryid").select2();            }
        });
    }
</script>
