$(function() {
    // Get the form
    var form = $(".form-filters");

    // Get the messages div.
    var formMessages = $("#form-messages");

    // Get the fields
    var formUsers = $(".users");
    var formLocations = $(".locations");
    var formCategories = $(".categories");
    var formFirstDate = $("#firstdate");
    var formLastDAte = $("#lastdate");
    
    $(form).submit(function(event) {
        event.preventDefault();

        // Serialize form data
        var formData = $(form).serialize();
        // Submit form with ajax
        $.ajax({
            type: "POST",
            url: "/gallery",
            data: formData
        })
            .done(function(response) {
                // Make sure that the formMessages div has the 'success' class.
                $(formMessages).removeClass("error");
                $(formMessages).addClass("success");

                // Set the message text.
                $(formMessages).text(response);

                // Clear the form.
                $(".users").val("");
                $(".locations").val("");
                $(".categories").val("");
                $("#firstdate").val("");
                $("#lastdate").val("");
            })
            .fail(function(data) {
                // Make sure that the formMessages div has the 'error' class.
                $(formMessages).removeClass("success");
                $(formMessages).addClass("error");

                // Set the message text.
                if (data.responseText !== "") {
                    $(formMessages).text(data.responseText);
                } else {
                    $(formMessages).text("Oops! An error occured");
                }
            });
    });
});
