<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    
<div class="container">
    <a class="btn btn-success" href="javascript:void(0)" id="add"> Add New Language</a>
    <br>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Name</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
    <tbody>
    </tbody>
    </table>
</div>

<div class="modal fade" id="addModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="addForm" name="addForm" class="form-horizontal">
                    <!-- @csrf -->
                    @method('POST')
                   <div class="form-group">
                        <label class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter Code" value="" maxlength="10" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="required">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="addButton" value="create">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade" id="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
                <form id="editForm" name="editForm" class="form-horizontal">
                    <!-- @csrf -->
                    @method('PATCH')
                   <input type="hidden" name="id" id="id">
                   <div class="form-group">
                        <label class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="editCode" name="code" placeholder="Enter Code" value="" maxlength="10" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="editName" name="name" placeholder="Enter Name" value="" maxlength="50" required="required">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="editButton">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

</body>

<!-- <script type="text/javascript" src="http://0.0.0.0/js/languages.js"></script> -->

<script type="text/javascript">
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('languages.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#add').click(function () {
        $('#modelHeading').html("Add");
        $('#addForm').trigger("reset");
        $('#addModal').modal('show');
    });
 
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');

        $.get('languages-ajax/' + id + '/edit', function (data) {
            $('#id').val(data.id);
            $('#editCode').val(data.code);
            $('#editName').val(data.name);
            $('#editModal').modal('show');
        })
    });

    $('#addButton').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
            data: $('#addForm').serialize(),
            url: $('#url').val(),
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#addForm').trigger("reset");
                $('#addModal').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                // $('#saveBtn').html('Save Changes');
            }
        });
    });
  
    $('#editButton').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
            data: $('#editForm').serialize(),
            type: "PATCH",
            dataType: 'json',
            success: function (data) {
                $('#editForm').trigger("reset");
                $('#editModal').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                // $('#saveBtn').html('Save Changes');
            }
        });
    });

    $('body').on('click', '.delete', function () {
        var id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "languages-ajax/" + id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
</script>


</html>