<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Member List</title>
<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Include DataTables CSS -->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<!-- Include DataTables Bootstrap CSS -->
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
</head>
<body>
<?php include("header.php"); ?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Member List</div>
        <div class="panel-body">
            <table id="tbl-members" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>Member Number</th>
                        <th>Member Name</th>
                        <th>NIC</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Join Date</th>
                        <th>Relationship</th>
                        <th>Relationship No</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Include Bootstrap JavaScript -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Include DataTables JavaScript -->
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    loadMembers();
});

function loadMembers() {
    $('#tbl-members').dataTable().fnDestroy();
    $.ajax({
        url: "all_member.php",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            console.log(data);
            $('#tbl-members').dataTable({
                "data": data,
                "columns": [
                    { "data": "mno" },
                    { "data": "name" },
                    { "data": "nic" },
                    { "data": "gender" },
                    { "data": "phone" },
                    { "data": "joindate" },
                    { "data": "relationship" },
                    { "data": "epno" }
                ]
            });
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            var text = $($.parseHTML(xhr.responseText)).filter('.trace-message').text();
            console.log(text);
        }
    });
}
</script>
</body>
</html>
