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

<style>
h6 { 
    display: block;
    font-size: .57em;
    font-weight: bold;
}
h5 { 
    display: block;
    font-size: .83em;
    font-weight: bold;
}

table, th, td {
  padding: 1px !important;
}

</style>
  
    <div class="container">
                           
                                <h4 class="text-center"><i class="md md-equalizer "></i> Retail Invoice</h4>
                                <div class="text-center">
                                    <p><h5><?php echo $showRoomName; ?><br>
                                    <?php echo $showRoomAddress; //echo str_replace(",", ",<br>", $showRoomAddress); ?>
                                    <?php echo $showRoomMobile." , ".$showRoomEmail; ?><br>
                                    <?php /*if($showRoomCin!="" && $showRoomCin!=null){
                                        echo "CIN : ".$showRoomCin."<br>";
                                    }
                                    if($showRoomTin!="" && $showRoomTin!=null){
                                        echo "TIN : ".$showRoomTin."<br>";
                                    }*/
                                    ?></h5>
                                    </p>
                           </div>
                                       
                             <p> <strong>Bill No. : <?php echo $billNo; ?></strong>&nbsp; <h6>Bill Date : <?php echo date_format(new DateTime($cusomerReceiptArray[0]['date']), "d-m-Y H:i:s"); ?></h6></p>
                               
                                      
                          <table class="table m-t-25">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $total = 0;
                                        $reducetotal = 0;
                                        $discountTOT = 0;
                                        for ($i = 0; $i < count($receiptDetails['productDetails']); $i++) { ?>
                                            <tr>
                                                <td><h5><?php echo $i + 1; ?></h5></td>
                                                <td><h5><?php echo $receiptDetails['product'][$i]['barcode']; ?></h5></td>
                                                <td><h5><?php echo $price = $receiptDetails['productDetails'][$i]['price']; ?></h5></td>
                                                <!--<td><h6><?php echo $qty = $receiptDetails['productDetails'][$i]['qty']; ?></h6></td>
                                                <td><h6><?php echo $discount = $receiptDetails['productDetails'][$i]['discount']; ?></h6></td>
                                                <td><h6><?php echo $tdtotal = ($price - ($price * $discount / 100)) * $qty;
                                                    $total += ($price - ($price * $discount / 100)) * $qty; ?></h6></td>-->
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
                                                    <td><h5><?php echo $k + 1; ?></h5></td>
                                                    <td><h5><?php echo $receiptDetails['returnDetails']['barcode'][$k]; ?></h5></td>
                                                    <td><h5><?php echo $price = $receiptDetails['returnDetails']['price'][$k]; ?></h5></td>
                                                    <!--<td><?php echo $qty = $receiptDetails['returnDetails']['reduceCount'][$k]; ?></td>
                                                    <td><?php echo $discount = $receiptDetails['returnDetails']['discount'][$k]; ?></td>
                                                    <td><?php echo $tdtotal = ($price - ($price * $discount / 100)) * $qty;
                                                        $reducetotal += ($price - ($price * $discount / 100)) * $qty; ?></td>-->
                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                              
                            <p class="text-right"><b>Sub-total:</b> <?php echo $total = $total - $reducetotal; ?></p>
                             <?php if (count($receiptDetails['returnDetails']) == 0) { ?>
                                       <p class="text-right" style="font-size: .83em;">Discount: <?php echo $discountTOT = $receiptDetails['customerreceipt'][0]['discount']; ?></p>
                                <?php } ?>
                               <p class="text-right" style="font-size: .83em;"> Round Off: <?php echo $roundoff = $receiptDetails['customerreceipt'][0]['roundoff']; ?></p>
                                <!--<p class="text-right">VAT: 12.9%</p>-->
                              
                                <h4 class="text-center">
                                    <b>Net Value Rs.<?php echo $total - ($total * $discountTOT / 100) - $roundoff; ?></b></h4>
                                                
                        <hr>
                        <h6 class="text-center">Important: kindly keep a Photo/Photo copy of the Bill for Future Use</h6>
                        <h6 class="text-center">** Thank You for Shooping at showroom**</h6>
                   </div>
                        <div class="hidden-print">
                            <div class="pull-right">
                                <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i
                                        class="fa fa-print"></i></a>
                            </div>
                        </div>
                       
    </div> <!-- end container -->

<!-- End wrapper -->
<?php } ?>
