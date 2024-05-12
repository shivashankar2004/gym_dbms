<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/jquery-confirm-master/dist/jquery-confirm.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link type="text/css" rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<br><br>
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Member</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="frmCustomer">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Member No</label>
                    <input type="text" class="form-control" id="mno" name="mno" placeholder="Member No">
</div>
<div class="form-group col-md-6">
    <label>NIC No</label>
    <input type="text" class="form-control" id="nic" name="nic" placeholder="NIC NO">
</div>
</div>
<div class="row">
<div class="form-group col-md-6">
    <label>Name of Participant</label>
    <input type="text" class="form-control" id="pname" name="pname" placeholder="Name of Participant">
</div>
<div class="form-group col-md-6">
        <label>Date of Join</label>
        <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth">
</div>
</div>
<div class="form-group col-md-6">
    <label>Relationship</label>
<input type="text" class="form-control" id="Relationship" name="Relationship" placeholder="Relationship">
    </div>
</div>
<div class="row">
<div class="col-sm-3">
    <div class="form-group">
        <label class="form-label">Plan</label>
        <select class="form-control" id="plan" name="plan" placeholder="Plan" required>
            <option value="">Please Select</option>
        </select>
    </div>
</div>
<div class="col-sm-3 ">
    <div class="form-group">
    <label class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Price">
      </div>
</div>
<div class="form-group col-md-6">
      <label>Phone</label>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
  </div>
</div>
<div class="row">
      <div class="form-group col-md-6">
      <label>Emergency Phone Number</label>
        <input type="text" class="form-control" id="ephone" name="ephone" placeholder="Emergency Phone Number">
      </div>
      <div class="col-sm-6">
            <div class="form-group">
                <label class="form-label">Gender</label>
                <select class="form-control" id="gender" name="gender" placeholder="Gender" required>
                    <option value="">Please Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>
</div>
<div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <button type="button" class="btn btn-info" onclick="validate()">Save</button>
                    <button type="submit" class="btn btn-default" onclick="cancel()">Cancel</button> 
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>
<div class="col-sm-12">
    <div class='col s12 m6 offset-m4'>
<div class="panel-body">
            <table id="tbl-projects" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Member No</th>
                    <th>Member Name</th>
                    <th>Amount</th>
                    <th>Month</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<!-- DataTables -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="bower_components/jquery.validate.min.js"></script>

<!-- SlimScroll -->
<script src="bower_components/jquery.validate.min.js"></script>
<script src="bower_components/jquery-confirm-master/dist/jquery-confirm.min.js"></script>
<script>
//product();
var isNew=true;
var version_id=null;
getplan();
function getchoose(){
$.ajax({
    type: "post",
            url: "get_choose.php",
            data: {"plan": $("#plan").val()},
            dataType: "JSON",
            async: false,
            success: function (data) {
                console.log(data[0]);
              // $('#price').val(data. amount);
              $("#price").val(data[0].amount);
            },
            error: function (xhr, status, error) {
alert(xhr.responseText);
//
}});

$('#plan').change(function ()
{
    getchoose();
});
function getplan()
{
    $.ajax({
        type: 'GET',
        url: 'get_plan.php',
        dataType: "JSON",
        success: function (data)
        {
            console.log(data);
            for (var i = 0; i < data.length; i++)
            {
                $('#plan').append($("<option/>",
                {
                    value: data[i].pid,
                    text: data[i].planname
                }));
            }},
            error: function (xhr, status, error)
        {
            alert(xhr.responseText);
        }
    });
}
function validate() {
    if ($("#frmCustomer").valid()) 
    {
        var _url = '';
        var _data = '';
        var _method;
        if (isNew == true) {
            _url = 'add_registation.php';
            _data = $('#frmCustomer').serialize();
            _method = 'POST';
        } else {
            _url = 'update_vendor.php';
            _data = $('#frmProject').serialize() + "&project_id=" + project_id;
            _method = 'POST';
        }
        $.ajax({
    type: _method,
    url: _url,
    dataType: 'JSON',
    data: _data,
    beforeSend: function () {
        $('#save').prop('disabled', true);
    $('#save').html('');
    $('#save').append('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>Saving</i>');
},
success: function (data){
    console.log(data);

$('#tbl-projects').dataTable({

dom: 'Bfrtip',

buttons: [

'excel', 'pdf', 'print'

],

"aaData": data,

" scrollx": true,

"aoColumns": [ {"sTitle": "Member No", "mData": "mno"}, {"sTitle": "Member Name", "mData": "name"}, {"sTitle": "Amount", "mData": "amount"}, { "sTitle": "Month",

"mData": "month",

"render": function (mData, type, row, meta) {

if (mData==1)

{
return 'January';
} else if (mData==2) {
return 'February';
} else if (mData==3) {
return 'March';
} else if (mData==4) {
return 'April';
} else if (mData==5) {
return 'May';
} else if (mData==6) {
return 'June';
} else if (mData==7) {
return 'July';
} else if (mData==8) {
return 'August';
} else if (mData==9) {
return 'September';
} else if (mData==10) {
return 'October';
} else if (mData==11) {
return 'November';
} else if (mData==12) {
return 'December';
} else {
return '';
}
}}]
});
}});
}
</script>
</body>
</html>