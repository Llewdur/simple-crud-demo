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

@include('languages/includes/dataTable')
@include('languages/includes/addModal')
@include('languages/includes/editModal')

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
        ajax: "languages-ajax/",
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
            url: 'languages-ajax/',
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#addForm').trigger("reset");
                $('#addModal').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
  
    $('#editButton').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
            data: $('#editForm').serialize(),
            url: 'languages-ajax/' + $('#id').val(),
            type: "PATCH",
            dataType: 'json',
            success: function (data) {
                $('#editForm').trigger("reset");
                $('#editModal').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
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