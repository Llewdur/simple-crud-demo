var table = $(".data-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: route + "datatable",
    columns: [
        {data: "DT_RowIndex", name: "DT_RowIndex"},
        {data: "name", name: "name"},
        {data: "actions", name: "actions", orderable: false, searchable: false},
    ]
});

$("body").on("click", ".edit", function () {
    var id = $(this).data("id");

    $.get(route + id + "/edit", function (data) {
        $("#editErrorMessages").hide();
        $("#id").val(data.id);
        $("#editName").val(data.name);
        $("#editModal").modal("show");
    })
});
