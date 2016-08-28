<?php if ($typeList == 'brandList') { ?>
    <?php $deletUrl = base_url()."Product/addProductMaster"; ?>
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
                    <button class="btn btn-primary waves-effect waves-light" type="button" onclick="loadAddOrEditModal('actionType=Edit&actionId=<?php echo $brandid; ?>')">
                        Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger waves-effect waves-light" type="button" onclick="deleteBrandMaster('submit=brand&actionType=Delete&actionId=<?php echo $brandid; ?>','<?php echo $deletUrl; ?>')">
                        Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>

<?php if ($typeList == 'sizeList') { ?>

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
        <?php for ($i = 0; $i < count($SizeList); $i++) { ?>
            <tr>

                <td><?php echo $i + 1; ?></td>
                <td><?php echo $SizeList[$i]['size']; ?></td>
                <td>
                    <button class="btn btn-primary waves-effect waves-light" type="button">
                        Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger waves-effect waves-light" type="button">
                        Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>
