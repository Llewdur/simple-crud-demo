var table = $(".data-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: route + "datatable",
    columns: [
        {data: "DT_RowIndex", name: "DT_RowIndex"},
        {data: "name", name: "name"},
        {data: "surname", name: "surname"},
        {data: "email", name: "email"},
        {data: "mobile", name: "mobile"},
        {data: "actions", name: "actions", orderable: false, searchable: false},
    ]
});

$("body").on("click", ".edit", function () {
    var id = $(this).data("id");

    $.get(route + id + "/edit", function (data) {
        $("#editErrorMessages").hide();
        $("#id").val(data.id);
        $("#editName").val(data.name);
        $("#editSurname").val(data.surname);
        $("#editIdnumber").val(data.idnumber);
        $("#editMobile").val(data.mobile);
        $("#editEmail").val(data.email);
        $("#editDob").val(data.dob);
        $('#editLanguage_id option[value="' + data.language_id + '"]').attr('selected', true);

        $('#editInterest_id').prop('selectedIndex',-1);

        $.each(data.user_interests, function(i,e){
            $('#editInterest_id option[value="' + e.id + '"]').attr('selected', true);
        });

        $("#editModal").modal("show");
    })
});
