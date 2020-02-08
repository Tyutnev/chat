$('.message a').click(function() {
    $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
});

$('.ajax-form').on('beforeSubmit', (event) => {
    $('.form-message').html('');

    let data = $('.ajax-form');

    $.ajax({
        type: data.attr('method'),
        url: $('.ajax-form:visible').attr('action'),
        data: data.serialize(),
        success: (html) => {
            html = JSON.parse(html);

            if (html.status != 'error') {
                window.location.href = '/profile';
                return;
            }

            $('.form-message').html(html.errors[Object.keys(html.errors)[0]]);
        }
    });

    return false;
});