<div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Invoice</h4>
                    </div>
                </div>
                <!-- Page-Title -->



                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">
                                <h4>Invoice</h4>
                            </div> -->
                            <div class="panel-body">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h1 class="text-right"><i class="md md-equalizer text-pink"></i> Minton</h1>
                                    </div>
                                    <div class="pull-right">
                                        <h4>Invoice # <br>
                                            <strong><?php $newDate = date("d-m-Y", strtotime($receiptDetails['customerreceipt'][0]['date']));
			echo $newDate."-".$receiptDetails['customerreceipt'][0]['id']; ?></strong>
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="pull-left m-t-30">
                                            <address>
                                              <strong><?php echo $receiptDetails['customer'][0]['name']; ?></strong><br>
                                             <!-- 795 Folsom Ave, Suite 600<br>
                                              San Francisco, CA 94107<br>-->
                                              <abbr title="Phone">P:</abbr> <?php echo $receiptDetails['customer'][0]['mobileno']; ?>
                                              </address>
                                        </div>
                                        <div class="pull-right m-t-30">
                                            <p><strong>Order Date: </strong> Jun 15, 2015</p>
                                            <p class="m-t-10"><strong>Order Status: </strong> <span class="label label-pink">Pending</span></p>
                                            <p class="m-t-10"><strong>Order ID: </strong> #123456</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-h-50"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table m-t-30">
                                                <thead>
                                                    <tr><th>#</th>
                                                    <th>Item</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                </tr></thead>
                                                <tbody>
					<?php $total=0; for($i=0;$i<count($receiptDetails['productDetails']);$i++) { ?>
                                                    <tr>
                                                        <td><?php echo $i+1; ?></td>
                                                        <td><?php echo $receiptDetails['product'][$i]['productname']."(".$receiptDetails['product'][$i]['barcode'].")"; ?></td>
							<td><?php echo $price=$receiptDetails['productDetails'][$i]['price']; ?></td>
                                                        <td><?php echo $qty=$receiptDetails['productDetails'][$i]['qty']; ?></td>
                                                        <td><?php echo $discount=$receiptDetails['productDetails'][$i]['discount']; ?></td>
                                                        <td><?php echo $total+=($price-($price*$discount/100))*$qty; ?></td>
                                                    </tr>
                                        <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="clearfix m-t-40">
                                            <h5 class="small text-inverse">PAYMENT TERMS AND POLICIES</h5>

                                            <small>
                                                All accounts are to be paid within 7 days from receipt of
                                                invoice. To be paid by cheque or credit card or direct payment
                                                online. If account is not paid within 7 days the credits details
                                                supplied as confirmation of work undertaken will be charged the
                                                agreed quoted fee noted above.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-md-offset-3 col-xs-6">
                                        <p class="text-right"><b>Sub-total:</b> <?php echo $total; ?></p>
                                        <p class="text-right">Discount: <?php echo $discount=$receiptDetails['customerreceipt'][0]['discount']; ?></p>
					<p class="text-right">Round Off: <?php echo $roundoff=$receiptDetails['customerreceipt'][0]['roundoff']; ?></p>
                                        <!--<p class="text-right">VAT: 12.9%</p>-->
                                        <hr>
                                        <h3 class="text-right">INR <?php echo $total-($total*$discount/100)-$roundoff; ?></h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="hidden-print">
                                    <div class="pull-right">
                                        <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>



                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                2016 © Minton.
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div> <!-- end container -->
        </div>
        <!-- End wrapper -->
