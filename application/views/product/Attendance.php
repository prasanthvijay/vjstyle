


        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title"><?php echo $title; ?> </h4>
                    </div>
                </div>
                <!-- Page-Title -->


           
                        <?php if($type=="Attendance"){  ?>    
                <div class="row">
                    <div class="col-lg-12">
				<div class="card-box">

					 <form class="form-horizontal group-border-dashed" action="" method="POST" name="addOrEditUserDetailsForm" id="addOrEditUserDetailsForm" data-parsley-validate novalidate>
					<div class="form-group">
					<label class="col-sm-3 control-label"> Sales Man</label>
					<div class="col-sm-6">
					<select multiple="multiple" class="multi-select" id="salesManarray" name="salesManarray[]" data-plugin="multiselect">
					<?php for($i=0;$i<count($salesmanList);$i++){ ?>
					<option value="<?php echo $salesmanList[$i]['userid'] ?>"><?php echo $salesmanList[$i]['name'] ?></option>
					<?php } ?>
					</select>
					</div>
					</div>
					<div class="form-group">
					 <label class="col-sm-3 control-label">Date</label>
                            		<div class="col-sm-4"><div class="input-group">
					<input type="text" class="form-control datepicker-autoclose" value="" placeholder="DD-MM-YYYY" name="Attedate" id="Attedate"><span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span></div>
					</div>
					</div>
				
					<div class="form-group m-b-0">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                    <button type="submit" id="submit" value = "Submit" name="submit"
                            class="btn btn-warning waves-effect waves-light">
                        Submit
                    </button>
                    
                </div>
            </div>
 					</form> 
				</div>


                     </div>
                </div>
                           <?php } if($type=="Update"){  ?>    
                <div class="row">
                    <div class="col-lg-12">
				<div class="card-box">

					 <form class="form-horizontal group-border-dashed" action="" method="POST" name="addOrEditUserDetailsForm" id="addOrEditUserDetailsForm" data-parsley-validate novalidate>
					<div class="form-group">
					<label class="col-sm-3 control-label"> Bar Code</label>
					<div class="col-sm-4">
					<input type="text" class="form-control" value="" name="barcode" id="barcode">
					</div>
					<div class="col-sm-4">
					<button type="button" id="submit" value = "Submit" name="submit" onclick="getQuantity()" 
					class="btn btn-warning waves-effect waves-light">
					Submit
					</button>
					</div>
					</div><input type="hidden" class="form-control" value="" name="salesCount" id="salesCount">
						<div id='statusDiv'> </div>		
					
 					</form> 

					
				</div>


                     </div>
                </div>
                       
			<?php } ?>
            </div> <!-- end container -->
        </div>
        <!-- End wrapper -->
<script>
function getQuantity()
{
	var barcode = $('#barcode').val();
	$('#statusDiv').html('<div align= "center"><img src="<?php echo base_url(); ?>assets/images/loader1.gif"></div>');
	$.get( "../getContent", { barcode:barcode,type:'getBarcode' } ,function( data ) {
		var response = JSON.parse(data);
		$('#salesCount').val(response[0]['salescount']);
		$('#statusDiv').html('<div class="form-group"><label class="col-sm-3 control-label"> Status:</label><div class="col-sm-4">'+response[0]['active']+'</div><div class="col-sm-4"><button type="button" id="status" value = "status" name="status" onclick="updateproduct(this.value)" class="btn btn-warning waves-effect waves-light">Update</button></div></div><div class="form-group"><label class="col-sm-3 control-label"> salesCount:</label><div class="col-sm-4">'+response[0]['salescount']+' && '+response[0]['date']+'</div><div class="col-sm-4"></div></div><div class="form-group"><label class="col-sm-3 control-label"> Batch Product:</label><div class="col-sm-2">'+response[0]['quantity']+' and totoalCount '+response[0]['totalcount']+'</div><div class="col-sm-2"><input type="text" class="form-control" value="" name="currentqty" id="currentqty"><input type="hidden" class="form-control" value="'+response[0]['id']+'" name="batchId" id="batchId"></div><div class="col-sm-4"><button type="button" id="qty" value = "qty" name="qty" onclick="updateproduct(this.value)" class="btn btn-warning waves-effect waves-light">Update</button><button type="button" id="delete" value = "delete" name="delete" onclick="updateproduct(this.value)" class="btn btn-warning waves-effect waves-light">Delete</button></div></div>');
	});
}
function updateproduct(type)
{
	var batchId = $('#batchId').val();
	var currentqty = parseInt($('#currentqty').val())+ parseInt($('#salesCount').val());
	if(type=='status'){
	var batchId = $('#barcode').val();
	}
	$.get( "../getContent", { batchId:batchId,operationtype:type,type:'batchUpdate',qty:currentqty } ,function( data ) {
		
	});
getQuantity();
}
</script>





