<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"><?php echo $title; ?></h4>


            </div>
        </div>
        <!-- Page-Title -->


        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <form class="form-horizontal group-border-dashed" action="<?php echo base_url().'Product/assignMapProduct'; ?>" method="POST">
                        <?php if($showroomId>0){ ?>
                            <input type="hidden" id="showroomId" name="showroomId" value="<?php echo $showroomId; ?>">
                        <?php } else { ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Showroom</label>
                                <div class="col-sm-6">
                                    <select class="select2 form-control" id="showroomId" name="showroomId"
                                            onchange="getProduct(this.value)">
                                        <option value="">Select Showroom</option>
                                        <?php for ($i = 0; $i < count($showroomArray); $i++) { ?>
                                            <option
                                                value="<?php echo $showroomArray[$i]['userid'] ?>"><?php echo $showroomArray[$i]['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>

                        <div id="productDiv">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Select Product</label>
                                <div class="col-sm-6">
                                    <select class="select2 form-control" id="productid" name="productid">
                                        <option value="">Select Product</option>

                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div id="qytDiv">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Avalable Quantity</label>
                                <div class="col-sm-6">

                                    <input type="text" id="quantity" name="quantity" class="form-control" required
                                           readonly placeholder="Avalable Quantity"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Increment Quantity</label>
                                <div class="col-sm-6">
                                    <input type="text" id="Incquantity" name="Incquantity" readonly class="form-control"
                                           required placeholder="Increment Quantity"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Avalable Price</label>
                                <div class="col-sm-6">
                                    <input type="text" id="price" name="price" class="form-control" readonly placeholder="Avalable Price"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Update Price</label>
                            <div class="col-sm-1">
                                <input type="checkbox" id="price" name="price" class="form-control" onclick="ShowHideDiv(this)"/>
                            </div>
                            <div class="col-sm-5"><div id="updatePriceDiv" style="display: none">
     							<input type="text" id="newPrice" class="form-control"  name="newPrice" placeholder="New Price"/>
				</div></div>
                       
              

            <div class="form-group m-b-0">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                    <button type="submit" value="MapProduct" id="submit" name="submit"
                            class="btn btn-primary waves-effect waves-light">
                        Submit
                    </button>
                    <button type="reset" class="btn btn-default waves-effect m-l-5">
                        Cancel
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    function getProduct(val) {

        $.get("getContent", {showroomId: val, type: "product"}, function (data) {
            $('#productDiv').html(data);
            $("#productid").select2();
        });
    }
    function productQtyandPrice(val) {
        var showroomId = $('#showroomId').val();
        $.get("getContent", {showroomId: showroomId, productId: val, type: "productQtyandPrice"}, function (data) {
            $('#qytDiv').html(data);
        });
    }


</script>

<script type="text/javascript">
    function ShowHideDiv(price) {
        var updatePriceDiv = document.getElementById("updatePriceDiv");
        updatePriceDiv.style.display = price.checked ? "block" : "none";
    }
</script>

        <?php if($showroomId>0){ ?>

        <script>
            getProduct($("#showroomId").val());
        </script>


        <?php } ?>