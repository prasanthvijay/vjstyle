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


<?php if ($typeList == 'ExpensesList') { ?>
  
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Reason</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($ExpensesList); $i++) { ?>
            <tr>

                <td><?php echo $i + 1; ?></td>
                <td><?php echo $ExpensesList[$i]['Reasons']; ?></td>
                <td><?php echo $ExpensesList[$i]['Amount']; ?></td>
                
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

<?php $AddOrEditSubCategory = base_url()."Product/AddOrEditSubCategory"; ?>
<?php if ($typeList == 'Sub Category') { ?>

    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap example"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Sub Category</th>
            <th>Category Type</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($SubCategoryList); $i++) { ?>
            <tr>
                <?php $subcategoryid = $SubCategoryList[$i]['subcategoryid']; ?>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo $SubCategoryList[$i]['subcategory']; ?></td>
                <td><?php echo $SubCategoryList[$i]['categorytype']; ?></td>
                <td>
                    <button class="btn btn-primary waves-effect waves-light" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $subcategoryid; ?>&masterName=<?php echo $typeList; ?>', '<?php echo $AddOrEditSubCategory; ?>')">
                        Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger waves-effect waves-light" type="button" onclick="deleteProductsMaster('<?php echo $typeList; ?>','submit=<?php echo $typeList; ?>&actionType=Delete&actionId=<?php echo $subcategoryid; ?>','<?php echo $deletUrl; ?>')">
                        Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>

<?php  if ($typeList == 'subCategoryJson') { ?>
    <select class="select2 form-control" id="subcategoryid" name="subcategoryid"
            required
            data-parsley-name="subCategory">
        <option value="">Select Sub Category</option>
        <?php for ($i = 0; $i < count($SubCategoryList); $i++) { ?>
            <option
                value="<?php echo $SubCategoryList[$i]['subcategoryid']; ?>"><?php echo $SubCategoryList[$i]['subcategory']; ?></option>
        <?php } ?>
    </select>
<?php }?>

<?php if ($typeList == 'ProductList') { ?>

    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
           cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Sno</th>
            <th>Barcode</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Retailer MRP</th>

            <th>Brand</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Size</th>
            <?php if($sessionUserTypeId == 1 || $sessionUserTypeId==2) { ?>
                <th>Purchase Rate</th>
            <?php } ?>
 	    <th>BarCode Text</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php $deletUrl = base_url()."Product/addProductMaster"; ?>
        <?php $loadAddOrEditModalUrl = base_url()."Product/EditProduct"; ?>
        <?php $viewCostUrl = base_url()."Product/ViewRetailerCostDetails"; ?>
        <?php for ($i = 0; $i < count($ProductList); $i++) { ?>
            <tr>

                <td><?php echo $i + 1; $productId = $ProductList[$i]['productid']; ?></td>
                <td><?php echo $ProductList[$i]['barcode']; ?></td>
                <td><?php echo $ProductList[$i]['productname']; ?></td>
                <td><?php echo $ProductList[$i]['avalableQty']; ?></td>
                <td>
                    <?php if($sessionUserTypeId != 1 && $sessionUserTypeId!=2) {
                        echo $ProductList[$i]['retailerMRP'];
                    } else { ?>

                        <a href='javascript:void(0)' onclick="getCostDetailsForRetailer('actionType=Edit&productId=<?php echo $productId; ?>', '<?php echo $viewCostUrl; ?>')">View Cost</a>
                     <?php } ?>
                </td>
                <!--                                <td>--><?php //echo $ProductList[$i]['availablequantity']; ?><!--</td>-->

                <td>
                    <?php echo $ProductList[$i]['brandname']; ?>
                </td>
                <td>
                    <?php echo $ProductList[$i]['categorytype']; ?>
                </td>
                <td>
                    <?php echo $ProductList[$i]['subcategoryid']; ?>
                </td>
                <td>                    <?php echo $ProductList[$i]['size']; ?>                </td>
                <?php if($sessionUserTypeId == 1 || $sessionUserTypeId==2) { ?>
                    <td><?php echo $ProductList[$i]['productrate']; ?></td>
                <?php } ?>

		<td><?php echo $ProductList[$i]['brandname']."&nbsp;".$ProductList[$i]['productname']."&nbsp;".$ProductList[$i]['size']; ?></td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="getAddOrEditModalContent('actionType=Edit&actionId=<?php echo $productId; ?>', '<?php echo $loadAddOrEditModalUrl; ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteProductsMaster('product','submit=Product&actionType=Delete&actionId=<?php echo $productId; ?>','<?php echo $deletUrl; ?>')">   <i class="fa fa-remove"></i>                 </button>
                </td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="form-control">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 text-center">

            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
<?php } ?>
