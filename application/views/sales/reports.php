<div class="wrapper">
            <div class="container" style="height:699px">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Reports</h4>
                    </div>
                </div>
		<form name="getReport" id="getReport" method="post" action="">
<?php if($usertypeid=="2") { ?>
<div class="row form-group">
				<div class="col-sm-3"></div>
				<label class="control-label col-sm-1">Showroom</label>
		                <div class="col-sm-3">
		                   <select class="select2 form-control" id="subcategoryid" name="subcategoryid"
                                required
                                data-parsley-name="subCategory">
                            <option value="">Select Showroom</option>
                            <?php for ($i = 0; $i < count($showRoomList); $i++) { ?>
                                <option
                                    value="<?php echo $showRoomList[$i]['userid']; ?>"><?php echo $showRoomList[$i]['name']; ?></option>
                            <?php } ?>
                        </select>
		                </div>
		            </div>


   	        <!-- Page-Title -->
<?php } if($reportsType=="report") { ?>

			<div class="row form-group">
				<div class="col-sm-3"></div>
		                <label class="control-label col-sm-1">Date Range</label>
		                <div class="col-sm-3">
		                    <div class="input-daterange input-group" id="date-range">
		                        <input type="text" class="form-control" name="start" id="fromDate" />
		                        <span class="input-group-addon bg-primary b-0 text-white">to</span>
		                        <input type="text" class="form-control" name="end" id="toDate" />
		                    </div>
		                </div>
		            </div>
			<div class="row form-group">
				<div class="col-sm-5"></div>

		                <div class="col-sm-3">
		                   <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light m-t-10" onclick="getSalesReport();">Submit</a>
		                </div>
		            </div>

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
<?php if($reportsType=="today") { ?>
getSalesReport();
<?php } ?>

function getSalesReport()
{
<?php if($reportsType=="report") { ?>
var fromDate=$("#fromDate").val();
var toDate=$("#toDate").val();

<?php } else { ?>
var today = new Date();
var fromDate=today.getDate()+"-"+(today.getMonth()+1)+"-"+today.getFullYear();
var toDate=today.getDate()+"-"+(today.getMonth()+1)+"-"+today.getFullYear();

<?php } ?>
	$.get( "../reportsajax", { fromDate:fromDate,toDate:toDate } ,function( data ) {
		$("#datatable-responsive tbody").empty();
		$("#datatable-responsive tbody").append(data);
		$('#datatable-responsive').DataTable();
	});
}
</script>

