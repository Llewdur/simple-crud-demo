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