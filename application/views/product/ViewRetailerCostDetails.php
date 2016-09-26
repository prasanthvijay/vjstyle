<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jonam
 * Date: 26/9/16
 * Time: 10:35 AM
 */
?>

<div class="panel panel-color panel-primary">
    <div class="panel-heading">
        <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="panel-title"><?php echo $title; ?></h3>
    </div>
    <div class="panel-body">
        <?php
            if(count($RetailerProductList)>0){
                $categorytypeOfProduct = $RetailerProductList[0]['categorytype'];
                $nameOfProduct = $RetailerProductList[0]['productname'];
                $brandOfProduct = $RetailerProductList[0]['brandname'];

                $barcodeOfProduct = $RetailerProductList[0]['barcode'];



                $sizeOfProduct = $RetailerProductList[0]['size'];


                ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Category Type</label><?php echo " : ".$categorytypeOfProduct; ?>
                        </div>
                        <div class="col-md-4">
                            <label for="">Barcode</label><?php echo " : ".$barcodeOfProduct; ?>
                        </div>
                        <div class="col-md-4">
                            <label for="">Size</label><?php echo " : ".$sizeOfProduct; ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Product Name</label><?php echo " : ".$nameOfProduct; ?>
                        </div>
                        <div class="col-md-4">
                            <label for="">Brand</label><?php echo " : ".$brandOfProduct; ?>
                        </div>
                    </div>
                </div>
        <?php } ?>
        <form name="mapRetailerProductCostForm" id="mapRetailerProductCostForm">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <table id="datatable-responsive-new" class="table table-striped table-bordered dt-responsive"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Retailer Name</th>
                                <!--                <th>Barcode</th>-->
                                <th>MRP</th>
                                <th>New MRP</th>
                                <th>Qty</th>
                                <th>Inc Qty</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php for ($i = 0; $i < count($RetailerProductList); $i++) {
                                $retailerName = $RetailerProductList[$i]['name'];
                                $retailerId = $RetailerProductList[$i]['retailerShowroomId'];
//                $barcode = $RetailerProductList[$i]['barcode'];
                                $retailerMRP = $RetailerProductList[$i]['retailerMRP'];
                                $avalableQty = $RetailerProductList[$i]['avalableQty'];
                                ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td><?php echo $retailerName; ?></td>
                                    <!--                    <td>--><?php //echo $barcode; ?><!--</td>-->
                                    <td><?php echo $retailerMRP; ?></td>
                                    <td><input type="text" name="newMrp[]" placeholder="New MRP" size="6"
                                               class="form-control"></td>
                                    <td><?php echo $avalableQty; ?></td>
                                    <td>
                                        <input type="text" name="incQty[]" placeholder="Inc Qty" size="6"
                                               class="form-control">
                                        <input type="text" name="retailerId[]" class="form-control" size="6"
                                               value="<?php echo $retailerId; ?>">
                                    </td>

                                </tr>

                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="productId" id="productId" value="<?php echo $productId; ?>">
                        <input type="text" name="viewCostUrl" id="viewCostUrl" value="<?php echo $viewCostUrl; ?>">
                        <input type="text" name="mapRetailerProductCostAndQuantityUrl" id="mapRetailerProductCostAndQuantityUrl" value="<?php echo $mapRetailerProductCostAndQuantityUrl; ?>">
                        <input type="button" value="Map Product" class="btn btn-info waves-effect waves-light m-t-10"
                               onclick="mapRetailerProductCostAndQuantity()">
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>