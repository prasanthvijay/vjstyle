<!-- =======================
     ===== START PAGE ======
     ======================= -->

<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"><?php echo $title; ?> Master</h4>
            </div>
        </div>
        <!-- Page-Title -->
        <!-- Custom Modals -->
        <div class="card-box">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                           
                           <form action="" method="POST" name="addOrEditUserDetailsForm"
              enctype="multipart/form-data" id="addOrEditUserDetailsForm" data-parsley-validate novalidate>
						<?php if($msg!=""){ ?>
 				<div class="form-group ">
					<div class="alert alert-info alert-dismissable col-sm-6 col-sm-offset-3">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						Successfull Inserted...!     </div> </div>
				<?php } ?>

            <div class="form-group ">
                <label class="col-sm-offset-3 col-sm-2 control-label">Paid by</label>
                <div class="col-sm-4">
                    <select id="Paidby" name="Paidby"  class="form-control" >
			<option> Select salesHead</option>
			<?php print_r($salesmanList); for($i=0;$i<count($salesmanList);$i++) { ?>
				<option value="<?php echo $salesmanList[$i]['userid']?>"><?php echo $salesmanList[$i]['name']?></option>
			<?php } ?>
			</select>
                </div>
            </div>
		<div class="row"></div><br>
		<div class="form-group ">
                <label class="col-sm-offset-3 col-sm-2 control-label">Description</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="Description" name="Description" required  value="Throw by Bank"/>
                </div>
            </div>

            <div class="row"></div>

<br> <div class="form-group ">
                <label class="col-sm-offset-3 col-sm-2 control-label">Amount</label>
                <div class="col-sm-4">
                    
                    <input type="text" class="form-control" id="Amount" name="Amount"  required placeholder="Enter Amount" value=""/>
                </div>
            </div>
<div class="row"></div><br>
 <div class="form-group ">
                <label class="col-sm-offset-3 col-sm-2 control-label">Paid Date</label>
                <div class="col-sm-4">
                   <div class="input-group">
                                <input type="text" class="form-control datepicker-autoclose" value="" placeholder="DD-MM-YYYY" name="Date" id="Date">
                                <span class="input-group-addon bg-primary b-0 text-white">
                                    <i class="ion-calendar"></i>
                                </span>
                            </div>
                </div>
            </div>
            <div class="form-group m-b-0">
                <div class="col-sm-offset-5 col-sm-6 m-t-15">
                    <button type="submit" value="Submit" id="submit" name="submit"
                            class="btn btn-primary waves-effect waves-light">
                        Submit
                    </button>
                                  </div>
            </div>
        </form>
                        </div>
                    </div>
                </div>
            </div>
          
          
        </div>
          </div> <!-- end container -->
</div>
<!-- End wrapper -->


