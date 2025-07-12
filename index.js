$(document).ready(function () {
    $(".user").hide();
    getData();

    $("#createNew").click(function () {
        $(".user").show();
        $("form[name='myForm']")[0].reset();
        $("#sno").val("");
    });

    $("#cancel").click(function (e) {
        e.preventDefault();
        $(".user").hide();
        $("form[name='myForm']")[0].reset();
    });

    //CREATE / UPDATE
    $(".submit").click(function (e) {
        e.preventDefault();
        const formData = $("form[name='myForm']").serialize();
        const sno = $("#sno").val();
        const url = sno ? "indexUpdate.php" : "indexCreate.php";

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $(".user").hide();
                    $("form[name='myForm']")[0].reset();
                    getData();
                } else {
                    alert("Operation failed: " + (response.message || "Unknown error"));
                }
            },
            error: function () {
                alert("Error performing operation");
            }
        });
    });

    //READ
    function getData() {
        $.ajax({
            url: "indexRead.php",
            method: "GET",
            dataType: "json",
            success: function (data) {
                $("#getData").html(data.html);
            },
            error: function () {
                console.error("Read Error:");
            },
        });
    }
    getData();

    //UPDATE (Get Value By ID)
    $(document).on("click", ".editBtn", function () {
        const id = $(this).data("id");
        $.ajax({
            url: "indexUpdate.php",
            method: "GET",
            data: { sno: id },
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $(".user").show();
                    const user = data.user;
                    $("#sno").val(user.sno);
                    $("#name").val(user.name);
                    $("#email").val(user.email);
                    $("#age").val(user.age);
                    $("#position").val(user.position);
                    $("#company").val(user.company);
                } else {
                    alert('User not found');
                }
            },
            error: function () {
                console.error("Update Error");
            }
        });
    });

    //DELETE
    $(document).on("click", ".deleteBtn", function () {
        const id = $(this).data("id");
        // console.log("Delete clicked for sno:", id);
        $.ajax({
            url: "indexDelete.php",
            method: "POST",
            data: { sno: id },
            success: function () {
                $("form[name='myForm']")[0].reset();
                getData();
            },
            error: function () {
                alert("Error deleting");
            },
        });
    });
});
