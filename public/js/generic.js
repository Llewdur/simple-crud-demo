var route = window.location.pathname + "/";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

$("#errorMessages").hide();

$("#add").click(function () {
    $("#modelHeading").html("Add");
    $("#addForm").trigger("reset");
    $("#addModal").modal("show");
    $("#addErrorMessages").hide();
});

$("#addButton").click(function (e) {
    e.preventDefault();

    $.ajax({
        data: $("#addForm").serialize(),
        url: route,
        type: "POST",
        dataType: "json",
        success: function (data) {
            $("#addErrorMessages").hide();
            $("#addForm").trigger("reset");
            $("#addModal").modal("hide");
            table.draw();
        },
        error: function (xhr, errorType, exception) {
            $("#addErrorMessages").show();
            $("#addErrorMessages").html("");
            $("#addButton").html("Retry Add");

            var data = xhr.responseText;
            var jsonResponse = JSON.parse(data);

            Object.values(jsonResponse["errors"]).forEach(val => {
                $("#addErrorMessages").append(val + "<br/>");
            });
        }
    });
});

$("#editButton").click(function (e) {
    e.preventDefault();

    $.ajax({
        data: $("#editForm").serialize(),
        url: route + $("#id").val(),
        type: "PATCH",
        dataType: "json",
        success: function (data) {
            $("#editForm").trigger("reset");
            $("#editModal").modal("hide");
            table.draw();
        },
        error: function (xhr, errorType, exception) {
            $("#editErrorMessages").show();
            $("#editErrorMessages").html("");
            $("#editButton").html("Retry Edit");

            var data = xhr.responseText;
            var jsonResponse = JSON.parse(data);

            Object.values(jsonResponse["errors"]).forEach(val => {
                $("#editErrorMessages").append(val + "<br/>");
            });
        }
    });
});

$("body").on("click", ".delete", function () {
    var id = $(this).data("id");
    confirm("Are you sure want to delete !");

    $.ajax({
        type: "DELETE",
        url: route + id,
        success: function (data) {
            table.draw();
        },
        error: function (data) {
            console.log("Error:", data);
        }
    });
});
