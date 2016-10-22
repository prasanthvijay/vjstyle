<div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Reports</h4>
                    </div>
                </div>
   	        <!-- Page-Title -->
<?php if($reportsType=="report") { ?>
		<form name="getReport" id="getReport" method="post" action="">
			<div class="row form-group">
				<div class="col-sm-3"></div>
		                <label class="control-label col-sm-2">Date Range</label>
		                <div class="col-sm-4">
		                    <div class="input-daterange input-group" id="date-range">
		                        <input type="text" class="form-control" name="start" id="fromDate" />
		                        <span class="input-group-addon bg-primary b-0 text-white">to</span>
		                        <input type="text" class="form-control" name="end" id="toDate" />
		                    </div>
		                </div>
		            </div>
			<div class="row form-group">
				<div class="col-sm-5"></div>

		                <div class="col-sm-4">
		                   <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light m-t-10" onclick="getSalesReport();">Submit</a>
		                </div>
		            </div>
		</form>
<?php } ?>

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

