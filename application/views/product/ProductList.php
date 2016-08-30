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
                <div class="card-box table-responsive">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Product Name</th>
                            <th>Product Rate</th>
<!--                            <th>Quantity</th>-->
                            <th>Barcode</th>
                            <th>Product Size</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $deletUrl = base_url()."Product/addProductMaster"; ?>
                        <?php $loadAddOrEditModalUrl = base_url()."Product/EditProduct"; ?>
                        <?php for ($i = 0; $i < count($ProductList); $i++) { ?>
                            <tr>

                                <td><?php echo $i + 1; $productId = $ProductList[$i]['productid']; ?></td>
                                <td><?php echo $ProductList[$i]['productname']; ?></td>
                                <td><?php echo $ProductList[$i]['productrate']; ?></td>
<!--                                <td>--><?php //echo $ProductList[$i]['availablequantity']; ?><!--</td>-->
                                <td><?php echo $ProductList[$i]['barcode']; ?></td>
                                <td><?php echo $ProductList[$i]['productsize']; ?></td>
                                <td>
                                    <button class="btn btn-primary waves-effect waves-light" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $productId; ?>', '<?php echo $loadAddOrEditModalUrl; ?>')">
                                        Edit
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger waves-effect waves-light" type="button" onclick="deleteProductsMaster('product','submit=product&actionType=Delete&actionId=<?php echo $productId; ?>','<?php echo $deletUrl; ?>')">
                                        Delete
                                    </button>
                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
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

    </div>
</div>
