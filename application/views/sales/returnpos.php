<!-- =======================
     ===== START PAGE ======
     ======================= -->


<style>
    .register .register-box {
        background-color: #FFFFFF;
        border-width: 1px;
        border-color: #e8ebf1;
        border-style: solid;
        border-radius: 6px;
        background-color: #ffffff;
        margin-top: 5px;
        box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.05);
    }

    .register .paper-cut:after {
        content: " ";
        display: block;
        position: relative;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 36px;
        background: -webkit-linear-gradient(#FFFFFF 0%, transparent 0%), -webkit-linear-gradient(135deg, #e8ebf1 33.33%, transparent 33.33%) 0 0%, #e8ebf1 -webkit-linear-gradient(45deg, #e8ebf1 33.33%, #FFFFFF 33.33%) 0 0%;
        background: -o-linear-gradient(#FFFFFF 0%, transparent 0%), -o-linear-gradient(135deg, #e8ebf1 33.33%, transparent 33.33%) 0 0%, #e8ebf1 -o-linear-gradient(45deg, #e8ebf1 33.33%, #FFFFFF 33.33%) 0 0%;
        background: -moz-linear-gradient(#FFFFFF 0%, transparent 0%), -moz-linear-gradient(135deg, #e8ebf1 33.33%, transparent 33.33%) 0 0%, #e8ebf1 -moz-linear-gradient(45deg, #e8ebf1 33.33%, #FFFFFF 33.33%) 0 0%;
        background-repeat: repeat-x;
        background-size: 0px 100%, 14px 27px, 14px 27px;
    }

    .register .register-items .register-items-holder {
        padding-top: 5px;
    }

    .register-items-header {
        min-height: 52px;
        line-height: 52px;
        background-color: #F9FBFC;
        border: 1px solid #E9ECF2;
        border-bottom: 1px solid #E9ECF2;
        color: #67676C;
        font-size: 14px;
        font-weight: 300;
        text-align: center;
    }

    .register .register-items .register-items-holder .register-item-content {
        min-height: 52px;
        border-bottom: 1px dotted #D7DCE5;
        padding-top: 10px;
    }

    .editable-click, input.editable-click, input.editable-click:hover {
        text-decoration: none;
        border: dashed 1px #0088cc;
    }


</style>


<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"><?php echo $title; ?></h4>
            </div>
        </div>
        <!-- Page-Title -->
        <!-- Custom Modals -->
        <div class="row">
            <div class="col-md-12">
                <div class="card-box table-responsive">
                    <p class="text-muted m-b-20 font-13">
                        Return Point Of Sales

<div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6"><?php print_r($succesMsg); ?></div>
                        </div>
                    <form action="" method="POST" data-parsley-validate novalidate>
                        <div class="row">
                            <div class="col-lg-8">

                                <div class="row col-lg-12">
                                    <div class="card-box">

                                        <select class="form-control select2" name="receiptId"
                                                onchange="getReceiptProduct(this.value)">
                                            <option value="">Select Bill No</option>
                                            <?php for ($i = 0; $i < count($receiptList); $i++) { ?>
                                                <option
                                                    value="<?php echo $receiptList[$i]['id']; ?>">Bill no- <?php echo $receiptList[$i]['billNo']; ?></option>
                                            <?php } ?>
                                        </select>

                                        <div id="recceiptDetails"></div>

                                    </div>

                                </div>

                                <div class="row col-lg-12">
                                    <div class="card-box">
                                        <input type="text" class="form-control" onblur="getProduct(this.value);">
                                        <!-- <select class="form-control select2" onchange="getProduct(this.value);">
											<option value="">Select</option>
											<?php for ($i = 0; $i < count($productList); $i++) { ?>
												<option value="<?php echo $productList[$i]['productid']; ?>"><?php echo $productList[$i]['productname']; ?></option>
											<?php } ?>
										    </select>-->
                                        <input type="hidden" id="selectedProduct" name="selectedProduct">
                                    </div>
                                </div>
                                <div class="row col-sm-12 register">
                                    <div class="register-box register-items paper-cut">
                                        <div class="register-items-holder">

                                            <table id="salesTable" class="table table-hover">

                                                <thead>
                                                <tr class="register-items-header">
                                                    <th></th>
                                                    <th class="item_name_heading">Item Name</th>
                                                    <th class="sales_price">Price</th>
                                                    <th class="sales_quantity">Qty.</th>
                                                    <th class="sales_discount">Disc %</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>

                                                <tbody class="register-item-content">
                                                <tr class="cart_content_area_empty">
                                                    <td colspan="6">
                                                        <div class="text-center text-warning"><h3>There are no items in
                                                                the cart<span class="flatGreenc"> [Sales]</span></h3>
                                                        </div>
                                                    </td>

                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row form-group">
                                    <div class="col-sm-3">Total</div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="total" id="total" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-3">Discount</div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="totdiscount" id="totdiscount"
                                               value="0" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-3">Round Off</div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="roundoff" id="roundoff"
                                               onblur="calculateTotal()">
                                    </div>
                                </div>
 				<div class="row form-group">
                                    <div class="col-sm-3">Return Amount</div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="returnamount" id="returnamount" value="0" readonly>
                                        <input type="hidden" class="form-control" name="returnamountnew" id="returnamountnew" value="0" readonly>
                                    </div>
                                </div>
	
                                <div class="row form-group">
                                    <div class="col-sm-3">Final</div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="finaltotal" id="finaltotal"
                                               disabled>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-3">Customer</div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="Customer" id="Customer" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-3">Mobile</div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="mobile" id="mobile" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <input type="submit" name="submit" value="submit" class="btn btn-primary ">
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>
            </div>
        </div>


    </div>

    </form>
    </p>

</div>
</div>
</div>
<!-- End row -->

</div> <!-- end container -->
</div>
<!-- End wrapper -->


<script>
   /* function getProduct(barcode) {
        $.get("posajax", {barcode: barcode}, function (data) {
            var product = JSON.parse(data);
            $(".cart_content_area_empty").remove();

            var selectedProduct = $("#selectedProduct").val().split('|');
            var productId = product[0]['productid'];

            if ($.inArray(productId, selectedProduct) == -1) {

                var j = parseInt(selectedProduct.length);
                var productdata = '<tr class="register-item-details" id="rowId' + productId + '"><td class="text-center"> <input type="button" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="removeProduct(' + productId + ');" value="X"> </td><td>' + product[0]['productname'] + " (" + product[0]['barcode'] + ')<input type="hidden" name="product_' + productId + '" value=' + product[0]['productid'] + '></td><td class="text-center"><input name="price_' + productId + '" id="price_' + productId + '" class="form-control editable editable-click" value="' + product[0]['price'] + '" onblur="calculateTotal()"></td><td class="text-center"><input name="qty_' + productId + '" id="qty_' + productId + '" class="form-control editable editable-click" value="1" onblur="calculateTotal()"><input type="hidden" name="available_' + productId + '" id="available_' + productId + '" value="' + product[0]['availablequantity'] + '"></td><td class="text-center"><input name="disc_' + productId + '" id="disc_' + productId + '" class="form-control editable editable-click" value="0" onblur="calculateTotal()"></td><td class="text-center" id="TDproduct_' + productId + '">' + product[0]['price'] + '</td></tr>';

                $('#salesTable tr:last').after(productdata);
                var alreadyExist = $("#selectedProduct").val();
                document.getElementById("selectedProduct").value = alreadyExist + productId + "|";
                var newqty = $('#qty_' + product[0]['productid']).val();
                calculateTotal(newqty);
            }
            else {
                var aval = $('#available_' + productId).val();
                var qty = $('#qty_' + product[0]['productid']).val();
                if (aval > qty) {
                    $('#qty_' + productId).val(parseInt(qty) + 1);
                    calculateTotal(qty);
                } else {
                    $.Notification.notify('warning', 'top right', 'Available Product Quantity is ' + $('#available_' + productId).val());
                }

            }


        });
    }


    function calculateTotal(qty) {
        var selectedProduct = $("#selectedProduct").val().split('|');
        var str = selectedProduct.slice(0, -1);
        var aval = parseInt($('#available_' + str).val()) + 1;


        if (aval > qty) {

            var j = 0, productTotal = 0, FinalTotal = 0, beforeTotal = 0;

            for (var i = 0; i < (parseInt(selectedProduct.length) - 1); i++) {
                j = parseInt(i) + 1;
                beforeTotal = parseFloat($("#price_" + selectedProduct[i]).val()) * parseFloat($("#qty_" + selectedProduct[i]).val());
                productTotal = (parseFloat(beforeTotal) - (parseFloat(beforeTotal) * (parseFloat($("#disc_" + selectedProduct[i]).val()) / 100)));

                FinalTotal = parseFloat(FinalTotal) + parseFloat(productTotal);

                document.getElementById("TDproduct_" + selectedProduct[i]).innerHTML = productTotal;

            }

            document.getElementById("total").value = FinalTotal;


            if ($("#roundoff").val() == "") {
                document.getElementById("roundoff").value = "0";
            }


            document.getElementById("finaltotal").value = parseFloat(FinalTotal) - parseFloat($("#roundoff").val()) - parseFloat($("#totdiscount").val());

        }
        else {
            $.Notification.notify('warning', 'top right', 'Available Product Quantity is ' + $('#available_' + str).val());

        }
    }

    function removeProduct(productId) {
        var alreadyExist = $("#selectedProduct").val();
        document.getElementById("selectedProduct").value = alreadyExist.replace(productId + "|", "");
        $("#rowId" + productId).remove();
        calculateTotal();
    }
*/

function getProduct(barcode) {

        $.get("posajax", {barcode: barcode}, function (data) {

            var product = JSON.parse(data);
            var productid = product[0]['productid'];
            if (productid != null) {
                $(".cart_content_area_empty").remove();

                var selectedProduct = $("#selectedProduct").val().split('|');
                var qty = parseInt(product[0]['quantity']) - parseInt(product[0]['qty']);

                if ($.inArray(product[0]['productid'], selectedProduct) == -1) {

                    var j = parseInt(selectedProduct.length);
                    var productdata = '<tr class="register-item-details" id="rowId' + product[0]['productid'] + '"><td class="text-center"> <input type="button" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="removeProduct(' + product[0]['productid'] + ');" value="X"> </td><td>' + product[0]['productname'] + " (" + product[0]['barcode'] + ')<input type="hidden" name="product_' + product[0]['productid'] + '" value=' + product[0]['productid'] + '></td><td class="text-center" ><input name="price_' + product[0]['productid'] + '" id="price_' + product[0]['productid'] + '" class="form-control editable editable-click" value="' + product[0]['price'] + '" onblur="calculateTotal()"></td><td class="text-center"><input name="qty_' + product[0]['productid'] + '" id="qty_' + product[0]['productid'] + '" class="form-control editable editable-click" value="1" onblur="QtyCheck(this.value)"><input type="hidden" name="available_' + product[0]['productid'] + '" id="available_' + product[0]['productid'] + '" value="' + qty + '"></td><td class="text-center"><input name="disc_' + product[0]['productid'] + '" id="disc_' + product[0]['productid'] + '" class="form-control editable editable-click" value="0" onblur="calculateTotal()"></td><td class="text-center" id="TDproduct_' + product[0]['productid'] + '">' + product[0]['price'] + '</td></tr>';

                    $('#salesTable tr:last').after(productdata);
                    var alreadyExist = $("#selectedProduct").val();
                    document.getElementById("selectedProduct").value = alreadyExist + product[0]['productid'] + "|";
                    var newqty = $('#qty_' + product[0]['productid']).val();
                    calculateTotal();
                }
                else {

                    var aval = $('#available_' + product[0]['productid']).val();
                    var qty = $('#qty_' + product[0]['productid']).val();

                    if (aval > qty) {
                        $('#qty_' + product[0]['productid']).val(parseInt(qty) + 1);
                        calculateTotal();
                    } else {
                        $.Notification.notify('warning', 'top right', 'Available Product Quantity is ' + $('#available_' + product[0]['productid']).val());
                    }

                }
            } else {
                $.Notification.notify('warning', 'top right', 'Invalid Product');
            }
        });

    }


    function calculateTotal() {

        var selectedProduct = $("#selectedProduct").val().split('|');
        var str = selectedProduct.slice(0, -1);
        var aval = parseInt($('#available_' + str).val()) + 1;

        var j = 0, productTotal = 0, FinalTotal = 0, beforeTotal = 0;

        for (var i = 0; i < (parseInt(selectedProduct.length) - 1); i++) {
            j = parseInt(i) + 1;
            beforeTotal = parseFloat($("#price_" + selectedProduct[i]).val()) * parseFloat($("#qty_" + selectedProduct[i]).val());
            productTotal = (parseFloat(beforeTotal) - (parseFloat(beforeTotal) * (parseFloat($("#disc_" + selectedProduct[i]).val()) / 100)));

            FinalTotal = parseFloat(FinalTotal) + parseFloat(productTotal);

            document.getElementById("TDproduct_" + selectedProduct[i]).innerHTML = productTotal;

        }

        document.getElementById("total").value = FinalTotal;

        if ($("#totdiscount").val() == "") {
            document.getElementById("totdiscount").value = "0";
        }
        if ($("#roundoff").val() == "") {
            document.getElementById("roundoff").value = "0";
        }
	if ($("#returnamount").val() != "") {
            var returnamount = document.getElementById("returnamount").value;
        }
        var finaltotal = parseFloat(FinalTotal) - parseFloat($("#roundoff").val()) - (parseFloat(FinalTotal) * (parseFloat($("#totdiscount").val()) / 100));

        document.getElementById("finaltotal").value = finaltotal.toFixed(2)-parseFloat(returnamount);


    }
    function removeProduct(productId) {
        var alreadyExist = $("#selectedProduct").val();
        document.getElementById("selectedProduct").value = alreadyExist.replace(productId + "|", "");
        $("#rowId" + productId).remove();
        calculateTotal();

    }
 function QtyCheck(qty) {

        var selectedProduct = $("#selectedProduct").val().split('|');
        var str = selectedProduct.slice(0, -1);
        var aval = parseInt($('#available_' + str).val()) + 1;


        if (aval > qty) {
            calculateTotal();
        }
        else {
            $.Notification.notify('warning', 'top right', 'Available Product Quantity is ' + $('#available_' + str).val());

        }
    }

    function getReceiptProduct(receiptId) {
        $.get("returnposajax", {receiptId: receiptId, type: "getReceipt"}, function (data) {
            var receipt = JSON.parse(data);
          document.getElementById("Customer").value = receipt['customer'][0]['name'];
            document.getElementById("mobile").value = receipt['customer'][0]['mobileno'];
            var beforeTotal = 0, productTotal = 0;

		var tableData = "<table class='table table-hover'><tr><td>Name</td><td>Price</td><td>QTY</td><td>Discount</td><td>Total</td></tr>";
            for (var i = 0; i < receipt['productDetails'].length; i++) {

                beforeTotal = parseFloat(receipt["productDetails"][i]["price"]) * parseFloat(receipt["productDetails"][i]["qty"]);
                productTotal = (parseFloat(beforeTotal) - (parseFloat(beforeTotal) * (parseFloat(receipt["productDetails"][i]["discount"]) / 100)));

                tableData += '<tr><td>' + receipt["product"][i]["productname"] + '</td><td class="text-center"><input name="billprice_' + i + '" id="billprice_' + i + '" class="form-control editable editable-click" value="' + receipt["productDetails"][i]["price"] + '" disabled></td><td class="text-center"><input name="billqty_' + i + '" id="billqty_' + i + '" class="form-control editable editable-click" value="' + receipt["productDetails"][i]["qty"] + '" onblur="billDiscount(' + i + ')"></td><td class="text-center"><input name="billdisc_' + i + '" id="billdisc_' + i + '" class="form-control editable editable-click" value="' + receipt["productDetails"][i]["discount"] + '" disabled></td><td class="text-center"><input name="billtotal_' + i + '" id="billtotal_' + i + '" class="form-control editable editable-click" value="' + productTotal + '" disabled></td><input type="hidden" name="existBillQuantity_' + i + '" id="existBillQuantity_' + i + '" value="' + receipt["productDetails"][i]["qty"] + '"><input type="hidden" name="existBillproduct_' + i + '" id="existBillproduct_' + i + '" value="' + receipt["productDetails"][i]["productId"] + '"></tr>';
            }
			tableData +="</table>";
            $("#recceiptDetails").html(tableData);
        });

    }
    function billDiscount(rowId) {

        if (parseInt($("#billqty_" + rowId).val()) <= parseInt($("#existBillQuantity_" + rowId).val())) {
            var beforeTotal = 0, productTotal = 0;
            beforeTotal = parseFloat($("#billprice_" + rowId).val()) * parseFloat($("#billqty_" + rowId).val());
            productTotal = (parseFloat(beforeTotal) - (parseFloat(beforeTotal) * (parseFloat($("#billdisc_" + rowId).val()) / 100)));
            document.getElementById("billtotal_" + rowId).value = parseFloat(productTotal);


            originalbeforeTotal = parseFloat($("#billprice_" + rowId).val()) * parseFloat($("#existBillQuantity_" + rowId).val());
            originalproductTotal = (parseFloat(originalbeforeTotal) - (parseFloat(originalbeforeTotal) * (parseFloat($("#billdisc_" + rowId).val()) / 100)));
		
		document.getElementById("returnamountnew").value=originalproductTotal+parseFloat($('#returnamount').val());

            document.getElementById("returnamount").value =  (parseFloat($('#returnamountnew').val()) - parseFloat(productTotal));

        }
        else {
            $.Notification.notify('warning', 'top right', 'Product Qunatity Only decrease', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae orci ut dolor scelerisque aliquam.');
            document.getElementById("billqty_" + rowId).value = $("#existBillQuantity_" + rowId).val();
        }
		
    }
</script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(window).scannerDetection();
        $(window).bind('scannerDetectionComplete', function (e, data) {
                var barcode = data.string;
                if (barcode != "success") {
//                    alert('complete '+data.string);
                    getProduct(barcode);
                }
            })
            .bind('scannerDetectionError', function (e, data) {
                console.log('detection error ' + data.string);
            })
            .bind('scannerDetectionReceive', function (e, data) {
                console.log(data);
            })

        $(window).scannerDetection('success');

    });
</script>


