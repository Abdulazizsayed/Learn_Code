$(function () {
    $('.videos .video a').on('click', function () {
        let link = $(this).attr('href');

        $('.modal .modal-body iframe').attr('src', link);
    });

    $('.upload-btn').on('click', function (e) {
        e.preventDefault();
        if ($(this).attr('class') != 'btn btn-success save-img') {
            $("#upload-form input").trigger('click');
        } else {
            // form submit
            $('#upload-form').submit();
        }
    });

    $('#upload-form input').on('change', function () {
        let img_value = $(this).val()

        $('.upload-btn').html('<i class="fas fa-cloud-upload-alt"></i>  Save');
        $('.upload-btn').attr('class', 'btn btn-success save-img');
    });

    // from submit ajax
    $('#upload-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "/profile",
            type: "POST",
            data: new FormData(this),
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,

            success: function (data) {
                console.log(data);

                $("#message").text(data.message);
                $("#message").attr('class', 'alert alert-success');
                $("#uploaded-image").html(data.uploaded_image);
            }
        });
    });
});
