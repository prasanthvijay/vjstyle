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
