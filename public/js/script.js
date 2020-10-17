$(function () {
    $('.videos .video a').on('click', function () {
        let link = $(this).attr('href');

        $('.modal .modal-body iframe').attr('src', link);
    })
});
