


        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title"><?php echo $title; ?> </h4>
                    </div>
                </div>
                <!-- Page-Title -->


           
                            
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
                       

            </div> <!-- end container -->
        </div>
        <!-- End wrapper -->





