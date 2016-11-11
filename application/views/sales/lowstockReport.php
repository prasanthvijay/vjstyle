<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
<h4 class="page-title"><?php echo $title; ?></h4>
            </div>
        </div>
        <!-- Page-Title -->

        <div class="card-box">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <p class="text-muted m-b-20 font-13">
                                 View All <?php echo $title; ?>
                            </p>
                            </div>
                    </div>
                </div>
            </div>
<?php if($usertypeid=="2") { ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                       
                           <select class="select2 form-control" id="showroomId" name="showroomId"
				                required
				                data-parsley-name="subCategory" onchange="getLowStockReport(this.value)" >
							<option value="">Select Showroom</option>
							<?php for ($i = 0; $i < count($showRoomList); $i++) { ?>
							<option
							value="<?php echo $showRoomList[$i]['userid']; ?>"><?php echo $showRoomList[$i]['name']; ?></option>
							<?php } ?>
				        	</select>
                            
                       
                    </div>
		
                    </div>
            </div>
<?php  } ?>
	<div id="displayDiv"></div>

    </div>
</div>

<script>
function getLowStockReport(showroomId){

		$.get( "<?php echo base_url().'Sales/getReportInLowStock'?>",{ showroomId : showroomId}, function( data ) {
  			$( "#displayDiv" ).html( data );
                $('#datatable-responsive-new').DataTable();
			});
		
	}

</script>
