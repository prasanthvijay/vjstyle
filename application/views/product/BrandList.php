<?php $deletUrl = base_url()."Product/addProductMaster"; ?>
<?php if ($typeList == 'brandList') { ?>
    <?php $loadAddOrEditModalUrl = base_url()."Product/AddBrand"; ?>
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Brand Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($BrandList); $i++) { ?>
            <tr>
                <?php $brandid = $BrandList[$i]['brandid']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $BrandList[$i]['brandname']; ?></td>
                <td>
                    <button class="btn btn-primary waves-effect waves-light" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $brandid; ?>', '<?php echo $loadAddOrEditModalUrl; ?>')">
                        Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger waves-effect waves-light" type="button" onclick="deleteProductsMaster('brand','submit=brand&actionType=Delete&actionId=<?php echo $brandid; ?>','<?php echo $deletUrl; ?>')">
                        Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>
    <?php $loadAddOrEditModalUrl = base_url()."Product/AddSize"; ?>
<?php if ($typeList == 'sizeList') { ?>

    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Size</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($SizeList); $i++) { ?>
            <tr>
                <?php $sizeid = $SizeList[$i]['sizeid']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $SizeList[$i]['size']; ?></td>
                <td>
                    <button class="btn btn-primary waves-effect waves-light" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $sizeid; ?>', '<?php echo $loadAddOrEditModalUrl; ?>')">
                        Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger waves-effect waves-light" type="button" onclick="deleteProductsMaster('size','submit=size&actionType=Delete&actionId=<?php echo $sizeid; ?>','<?php echo $deletUrl; ?>')">
                        Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>

<?php $AddOrEditMasterContent = base_url()."Product/AddOrEditMasterContent"; ?>
<?php if ($typeList == 'Category Type') { ?>

    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Category Type</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($CategoryTypeList); $i++) { ?>
            <tr>
                <?php $categoryTypeId = $CategoryTypeList[$i]['categorytypeid']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $CategoryTypeList[$i]['categorytype']; ?></td>
                <td>
                    <button class="btn btn-primary waves-effect waves-light" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $categoryTypeId; ?>&masterName=<?php echo $typeList; ?>', '<?php echo $AddOrEditMasterContent; ?>')">
                        Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger waves-effect waves-light" type="button" onclick="deleteProductsMaster('<?php echo $typeList; ?>','submit=<?php echo $typeList; ?>&actionType=Delete&actionId=<?php echo $categoryTypeId; ?>','<?php echo $deletUrl; ?>')">
                        Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>
<?php if ($typeList == 'ProductList') { ?>

    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Product Name</th>
            <?php if($sessionUserTypeId == 1 || $sessionUserTypeId==2) { ?>
            <th>Purchase Rate</th>
            <?php } ?>
            <th>Quantity</th>
            <th>Retailer MRP</th>
            <th>Barcode</th>
            <th>Brand</th>
            <th>Category Type</th>
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
                <?php if($sessionUserTypeId == 1 || $sessionUserTypeId==2) { ?>
                <td><?php echo $ProductList[$i]['productrate']; ?></td>
                <?php } ?>
                <td><?php echo $ProductList[$i]['avalableQty']; ?></td>
                <td><?php echo $ProductList[$i]['retailerMRP']; ?></td>
                <!--                                <td>--><?php //echo $ProductList[$i]['availablequantity']; ?><!--</td>-->
                <td><?php echo $ProductList[$i]['barcode']; ?></td>
                <td>
                    <?php echo $ProductList[$i]['brandname']; ?>
                </td>
                <td>
                    <?php echo $ProductList[$i]['categorytype']; ?>
                </td>
                <td>
                    <?php echo $ProductList[$i]['size']; ?>
                </td>
                <td>
                    <button class="btn btn-primary waves-effect waves-light" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $productId; ?>', '<?php echo $loadAddOrEditModalUrl; ?>')">
                        Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger waves-effect waves-light" type="button" onclick="deleteProductsMaster('product','submit=Product&actionType=Delete&actionId=<?php echo $productId; ?>','<?php echo $deletUrl; ?>')">
                        Delete
                    </button>
                </td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>
