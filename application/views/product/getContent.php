<?php if($type=='productQyt') {?>

   <div class="form-group">
                                            <label class="col-sm-3 control-label">Product Quantity</label>
                                            <div class="col-sm-6">
					
                                               <input type="text"  id="quantity" name="quantity" class="form-control" value="<?php echo $Quantity[0]['availablequantity']; ?>" required readonly placeholder="Product Quantity" />

                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Actual Price</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="price" name="price" class="form-control" required  value="<?php echo $Quantity[0]['productrate']; ?>" readonly placeholder="Product Price" />
                                            </div>
                                        </div>
<?php } ?>
