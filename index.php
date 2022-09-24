
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <title>Blog Cuisine</title>
</head>


<body>
<div class="container contact">
    <h2>Example: Datatables Add Edit Delete with Ajax, PHP & MySQL</h2>
    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-10">
                    <h3 class="panel-title"></h3>
                </div>
                <div class="col-md-2" align="right">
                    <button type="button" name="add" id="addEmployee" class="btn btn-success btn-xs">Add Employee</button>
                </div>
            </div>
        </div>
        <table id="employeeList" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Skills</th>
                <th>Address</th>
                <th>Designation</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
        </table>
    </div>
    <div id="employeeModal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="employeeForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> Edit User</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group"
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="empName" name="empName" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="age" class="control-label">Age</label>
                        <input type="number" class="form-control" id="empAge" name="empAge" placeholder="Age">
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="control-label">Skills</label>
                        <input type="text" class="form-control"  id="empSkills" name="empSkills" placeholder="Skills" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Address</label>
                        <textarea class="form-control" rows="5" id="address" name="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="control-label">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="empId" id="empId" />
                    <input type="hidden" name="action" id="action" value="" />
                    <input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#employeeModal" data-whatever="@mdo">Open modal for @mdo</button>

<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="employeeForm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-plus"></i> Edit User</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group"
                            <label for="name" class="control-label">Name</label>
                            <input type="text" class="form-control" id="empName" name="empName" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="age" class="control-label">Age</label>
                            <input type="number" class="form-control" id="empAge" name="empAge" placeholder="Age">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="control-label">Skills</label>
                            <input type="text" class="form-control"  id="empSkills" name="empSkills" placeholder="Skills" required>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label">Address</label>
                            <textarea class="form-control" rows="5" id="address" name="address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="control-label">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="empId" id="empId" />
                        <input type="hidden" name="action" id="action" value="" />
                        <input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
            </div>
            </form>
            </div>

        </div>
    </div>
</div>








<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript"  src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<!--<script type="text/javascript"  src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/data.js"></script>




</body>
</html>
