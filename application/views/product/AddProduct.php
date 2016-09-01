<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
<!--        <div class="row">-->
<!--            <div class="col-sm-12">-->
<!--                <h4 class="page-title">--><?php //echo $title; ?><!--</h4>-->
<!--            </div>-->
<!--        </div>-->
        <!-- Page-Title -->

        <div class="card-box">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <p class="text-muted m-b-20 font-13">
                                <?php echo $title; ?>
                                <?php $loadProductListUrl = base_url()."Product/ProductList"; ?>
                                <button class="btn btn-primary waves-effect waves-light m-t-10 pull-right" onclick="gotoPage('<?php echo $loadProductListUrl; ?>')">Product List</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <form class="form-horizontal group-border-dashed" action="<?php echo $addProductMasterUrl; ?>"
                              method="POST">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Category Type</label>
                                <div class="col-sm-6">
                                    <select class="select2 form-control" id="categorytypeid" name="categorytypeid"
                                            required
                                            data-parsley-name="CategoryType">
                                        <option value="">Select Category Type</option>
                                        <?php for ($i = 0; $i < count($CategoryTypeArray); $i++) { ?>
                                            <option
                                                value="<?php echo $CategoryTypeArray[$i]['categorytypeid']; ?>"><?php echo $CategoryTypeArray[$i]['categorytype']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Product Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="productname" name="productname" required
                                           data-parsley-name="name" placeholder="Product Name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Brand Name</label>
                                <div class="col-sm-6">
                                    <select class="select2 form-control" id="brandname" name="brandname">
                                        <option value="">Select Brand</option>
                                        <?php for ($i = 0; $i < count($BrandArray); $i++) { ?>
                                            <option
                                                value="<?php echo $BrandArray[$i]['brandid']; ?>"><?php echo $BrandArray[$i]['brandname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Bar Code</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="barcode" name="barcode" required
                                           data-parsley-length="[5,10]"
                                           placeholder="Bar code between 5 - 10 chars length"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Size</label>
                                <div class="col-sm-6">
                                    <select class="select2 form-control" id="size" name="size">
                                        <option value="">Select Size</option>
                                        <?php for ($j = 0; $j < count($SizeArray); $j++) { ?>
                                            <option
                                                value="<?php echo $SizeArray[$j]['sizeid']; ?>"><?php echo $SizeArray[$j]['size']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!--                        <div class="form-group">-->
                            <!--                            <label class="col-sm-3 control-label">Product Quantity</label>-->
                            <!--                            <div class="col-sm-6">-->
                            <!--                                <input type="text" id="quantity" name="quantity" class="form-control" required-->
                            <!--                                       placeholder="Product Quantity"/>-->
                            <!--                            </div>-->
                            <!--                        </div>-->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Price</label>
                                <div class="col-sm-6">
                                    <input type="text" id="price" name="price" class="form-control" required
                                           placeholder="Product Price"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Select Showroom</label>
                                <div class="col-sm-2">
                                    <select class="select2 form-control" id="ShowroomId[]" name="ShowroomId[]">
                                        <option value="">Select ShowRoom</option>
                                        <?php for ($i = 0; $i < count($showroomArray); $i++) { ?>
                                            <option
                                                value="<?php echo $showroomArray[$i]['userid']; ?>"><?php echo $showroomArray[$i]['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" id="mappedprice[]" name="mappedprice[]" class="form-control"
                                           required
                                           placeholder="Product Price"/>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" id="mappedqyt[]" name="mappedqyt[]" class="form-control" required
                                           placeholder="Product quntity"/>
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" id="mapProduct" name="mapProduct"
                                            class="btn btn-primary waves-effect waves-light mapProduct">
                                        Add
                                    </button>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" id="removeRow" name="removeRow"
                                            class="btn btn-warning waves-effect waves-light">
                                        Remove
                                    </button>
                                </div>
                            </div>
                            <div id="ajaxDiv"></div>
                            <div id="qytDiv1"></div>
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                                    <button type="submit" value="product" id="submit" name="submit"
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
        </div>
        <input type="hidden" id="count" name="count" value="1">
        <script>

            $("#mapProduct").click(function () {
                var count = $('#count').val();
                $.get("getContent", {count: count, type: "productQyt"}, function (data) {
                    $("#ajaxDiv").append(data);
                    $("#ShowroomId"+count).select2();
                });
                $('#count').val(parseInt(count) + 1);

            });

            $("#removeRow").click(function () {
                var count = $('#count').val();
                if(count>1){
                    var dec = parseInt(count) - 1
                    $("#ajaxDivInner"+dec).remove();
                    $('#count').val(dec);
                }
            });


        </script>




