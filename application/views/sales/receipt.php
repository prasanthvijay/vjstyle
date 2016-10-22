<?php
//print_r($receiptDetails);
    $cusomerReceiptArray = $receiptDetails['customerreceipt'];
    $showroomdetails = $receiptDetails['showroomdetails'];
    if(count($cusomerReceiptArray)>0){
        $billNo = $cusomerReceiptArray[0]['billNo'];
        $showRoomName = "";
        $showRoomEmail = "";
        $showRoomMobile = "";
        $showRoomAddress = "";
        $showRoomCin = "";
        $showRoomTin = "";
        
        if(count($showroomdetails)>0){
            $showRoomName = $showroomdetails[0]['name'];
            $showRoomEmail = $showroomdetails[0]['email'];
            $showRoomMobile = $showroomdetails[0]['mobile'];
            $showRoomAddress = $showroomdetails[0]['address'];
            $showRoomCin = $showroomdetails[0]['cinnumber'];
            $showRoomTin = $showroomdetails[0]['tinnumber'];
        }
?>
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="clearfix">
                                <h3 class="text-center"><i class="md md-equalizer text-primary"></i> Retail Invoice</h3>
                                <div class="text-center">
                                    <p><?php echo $showRoomName; ?><br>
                                    <?php echo $showRoomAddress; //echo str_replace(",", ",<br>", $showRoomAddress); ?><br>
                                    <?php echo $showRoomMobile." , ".$showRoomEmail; ?><br>
                                    <?php if($showRoomCin!="" && $showRoomCin!=null){
                                        echo "CIN : ".$showRoomCin."<br>";
                                    }
                                    if($showRoomTin!="" && $showRoomTin!=null){
                                        echo "TIN : ".$showRoomTin."<br>";
                                    }
                                    ?>
                                    </p>

                                </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">
                                        <strong>Bill No. : <?php echo $billNo; ?></strong><br>
                                        <p>Bill Date : <?php echo date_format(new DateTime($cusomerReceiptArray[0]['date']), "d-m-Y H:i:s"); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <table class="table m-t-30">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $total = 0;
                                        $reducetotal = 0;
                                        $discountTOT = 0;
                                        for ($i = 0; $i < count($receiptDetails['productDetails']); $i++) { ?>
                                            <tr>
                                                <td><?php echo $i + 1; ?></td>
                                                <td><?php echo $receiptDetails['product'][$i]['productname'] . "(" . $receiptDetails['product'][$i]['barcode'] . ")"; ?></td>
                                                <td><?php echo $price = $receiptDetails['productDetails'][$i]['price']; ?></td>
                                                <td><?php echo $qty = $receiptDetails['productDetails'][$i]['qty']; ?></td>
                                                <td><?php echo $discount = $receiptDetails['productDetails'][$i]['discount']; ?></td>
                                                <td><?php echo $tdtotal = ($price - ($price * $discount / 100)) * $qty;
                                                    $total += ($price - ($price * $discount / 100)) * $qty; ?></td>
                                            </tr>
                                        <?php } ?>

                                        <?php if (count($receiptDetails['returnDetails']) > 0) { ?>
                                            <tr>
                                                <td colspan="6">
                                                    <b><?php if ($receiptDetails['returnDetails']['newReceipt'] == $receiptDetails['customerreceipt'][0]['id']) echo "Discount Details: BillNo - " . $receiptDetails['returnDetails']['oldReceipt']; else echo "Return Details :BillNo - " . $receiptDetails['returnDetails']['newReceipt']; ?></b>
                                                </td>
                                            </tr>

                                            <?php for ($k = 0; $k < count($receiptDetails['returnDetails']['name']); $k++) { ?>

                                                <tr>
                                                    <td><?php echo $k + 1; ?></td>
                                                    <td><?php echo $receiptDetails['returnDetails']['name'][$k] . "(" . $receiptDetails['returnDetails']['barcode'][$k] . ")"; ?></td>
                                                    <td><?php echo $price = $receiptDetails['returnDetails']['price'][$k]; ?></td>
                                                    <td><?php echo $qty = $receiptDetails['returnDetails']['reduceCount'][$k]; ?></td>
                                                    <td><?php echo $discount = $receiptDetails['returnDetails']['discount'][$k]; ?></td>
                                                    <td><?php echo $tdtotal = ($price - ($price * $discount / 100)) * $qty;
                                                        $reducetotal += ($price - ($price * $discount / 100)) * $qty; ?></td>
                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="clearfix m-t-40">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-md-offset-3 col-xs-6">
                                <p class="text-right"><b>Sub-total:</b> <?php echo $total = $total - $reducetotal; ?>
                                </p>
                                <?php if (count($receiptDetails['returnDetails']) == 0) { ?>

                                    <p class="text-right">
                                        Discount: <?php echo $discountTOT = $receiptDetails['customerreceipt'][0]['discount']; ?></p>
                                <?php } ?>
                                <p class="text-right">Round
                                    Off: <?php echo $roundoff = $receiptDetails['customerreceipt'][0]['roundoff']; ?></p>
                                <!--<p class="text-right">VAT: 12.9%</p>-->
                                <hr>
                                <h4 class="text-right">
                                    Net Value&nbsp;&nbsp;&nbsp; Rs.<?php echo $total - ($total * $discountTOT / 100) - $roundoff; ?></h4>
                            </div>
                        </div>
                        <hr>
                        <p class="text-center">Important: kindly keep a Photo/Photo copy of the Bill for Future Use</p>
                        <p class="text-center">** Thank You for Shooping at showroom**</p>
                        <div class="hidden-print">
                            <div class="pull-right">
                                <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i
                                        class="fa fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</div>
<!-- End wrapper -->
<?php } ?>