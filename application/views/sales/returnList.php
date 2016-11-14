<div class="wrapper">
            <div class="container" style="height:699px">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title"><?php echo $title; ?></h4>
                    </div>
                </div>
		<form name="getReport" id="getReport" method="post" action="">
<?php if($usertypeid=="2") { ?>
				<div class="row form-group">
				<div class="col-sm-3"></div>
				<label class="control-label col-sm-1">Showroom</label>
		                <div class="col-sm-3">
		                   <select class="select2 form-control" id="showroomId" name="showroomId"
                                required
                                data-parsley-name="subCategory" <?php if($reportsType=="today") { ?>onchange="getreturnReport(this.value)"<?php } ?> >
                            <option value="">Select Showroom</option>
                            <?php for ($i = 0; $i < count($showRoomList); $i++) { ?>
                                <option
                                    value="<?php echo $showRoomList[$i]['userid']; ?>"><?php echo $showRoomList[$i]['name']; ?></option>
                            <?php } ?>
                        </select>
		                </div>
		            </div>


   	        <!-- Page-Title -->
<?php } ?>
		</form><br>
		<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap example" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>S.NO</th>
					<th>Receipt</th>
					<th>Date</th>
					<th>Customer</th>
					<th>Mobile</th>
					<th>Total</th>
					<th>Discount</th>
					<th>Round Off</th>
					<th>Final Total</th>

				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>

<script>

<?php if($usertypeid!="2") { ?>
getreturnReport(<?php echo $showroomId; ?>);
<?php } ?>

function getreturnReport(showroomid)
{

	$.get( "../reportsajax", { type:"returnReport",showroomid:showroomid } ,function( data ) {
		$("#datatable-responsive tbody").empty();
		$("#datatable-responsive tbody").append(data);
		$('#datatable-responsive').DataTable();
	});
}
</script>

