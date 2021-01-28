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
            $('#errorMessages').hide();
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
            error: function (xhr, errorType, exception) {
                $('#errorMessages').show();
                $('#errorMessages').html('');

                var data = xhr.responseText;
                var jsonResponse = JSON.parse(data);

                Object.values(jsonResponse["errors"]).forEach(val => {
                    $('#errorMessages').append(val + '<br/>');
                });
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