<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
       width="100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>LastLogin</th>
        <th>Address</th>
        <th>DOJ</th>
        <th>Created At</th>
        <th>DOB</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($k = 0; $k < count($userArray); $k++) { ?>
        <tr>
            <td><?php echo $userArray[$k]['name']; ?></td>
            <td><?php echo $userArray[$k]['email']; ?></td>
            <td><?php echo $userArray[$k]['mobile']; ?></td>
            <td><?php echo $userArray[$k]['lastlogin']; ?></td>
            <td><?php echo $userArray[$k]['address']; ?></td>
            <td><?php echo $userArray[$k]['doj']; ?></td>
            <td><?php echo $userArray[$k]['createdat']; ?></td>
            <td><?php echo $userArray[$k]['dob']; ?></td>
            <td><input type="button" value="Edit" class="btn btn-info btn-sm"></td>
            <td><input type="button" value="Delete" class="btn btn-danger btn-sm"></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
