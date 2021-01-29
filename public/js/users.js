$(function () {
    var route = window.location.pathname + '/';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#errorMessages').hide();

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: route,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'surname', name: 'surname'},
            {data: 'email', name: 'email'},
            {data: 'mobile', name: 'mobile'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#add').click(function () {
        $('#modelHeading').html("Add");
        $('#addForm').trigger("reset");
        $('#addModal').modal('show');
        $('#addErrorMessages').hide();
    });

    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');

        $.get(route + id + '/edit', function (data) {
            $('#editErrorMessages').hide();
            $('#id').val(data.id);
            $('#editName').val(data.name);
            $('#editSurname').val(data.surname);
            $('#editIdnumber').val(data.idnumber);
            $('#editMobile').val(data.mobile);
            $('#editEmail').val(data.email);
            $('#editDob').val(data.dob);
            $('#editModal').modal('show');
        })
    });

    $('#addButton').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
            data: $('#addForm').serialize(),
            url: route,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#addErrorMessages').hide();
                $('#addForm').trigger("reset");
                $('#addModal').modal('hide');
                table.draw();
            },
            error: function (xhr, errorType, exception) {
                $('#addErrorMessages').show();
                $('#addErrorMessages').html('');
                $('#addButton').html('Retry Add');

                var data = xhr.responseText;
                var jsonResponse = JSON.parse(data);

                Object.values(jsonResponse["errors"]).forEach(val => {
                    $('#addErrorMessages').append(val + '<br/>');
                });
            }
        });
    });
  
    $('#editButton').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
            data: $('#editForm').serialize(),
            url: route + $('#id').val(),
            type: "PATCH",
            dataType: 'json',
            success: function (data) {
                $('#editForm').trigger("reset");
                $('#editModal').modal('hide');
                table.draw();
            },
            error: function (xhr, errorType, exception) {
                $('#editErrorMessages').show();
                $('#editErrorMessages').html('');
                $('#editButton').html('Retry Edit');

                var data = xhr.responseText;
                var jsonResponse = JSON.parse(data);

                Object.values(jsonResponse["errors"]).forEach(val => {
                    $('#editErrorMessages').append(val + '<br/>');
                });
            }
        });
    });

    $('body').on('click', '.delete', function () {
        var id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: route + id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});