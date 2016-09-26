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
                ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo $retailerName; ?></td>
<!--                    <td>--><?php //echo $barcode; ?><!--</td>-->
                    <td><?php echo $retailerMRP; ?></td>
                    <td><input type="text" name="" id="" placeholder="New MRP" size="8" class="form-control"></td>
                    <td><?php echo $retailerId; ?></td>
                    <td><input type="text" name="" id="" placeholder="Inc Qty" size="8" class="form-control"></td>
                </tr>

            <?php } ?>
            </tbody>
        </table>
    </div>
</div>