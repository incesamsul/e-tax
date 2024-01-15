$(document).ready(function () {



    $("#checkAll").click(function () {
        $(".checkItem").prop("checked", $(this).prop("checked"));
    });

    $('#btnSendEmails').on('click', function () {
        var form = $('#formEmails');
        var checkboxes = $('.checkItem:checked');

        // console.log(checkboxes);
        // Create an array to store the checkbox values
        var checkboxValues = checkboxes.map(function () {
            return $(this).val(); // Use .val() to get the value of each checkbox
        }).get();

        // console.log(checkboxValues);

        let parentEl = $(this);

        // Send the data using AJAX
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: { email: checkboxValues },
            success: function (response) {
                // Handle the success response
                // console.log(response);
                if (response) {
                    alert('email terkirim');
                    document.location.reload();
                }
            },
            error: function (xhr, status, error) {
                // Handle the error
                // console.log(error);
            },
            beforeSend: function () {
                parentEl.html('loading...')
            }
        });

    });
});
