/**
 * Обработчик события подтверждения заявки в друзья
 */
const confirmFollowHandler = (event) => {
    let button = $(event.target);
    let container = button;

    while (!container.attr('data-id')) {
        container = container.parent();
    }

    socket.send(JSON.stringify({
        header: 'follow-confirm',
        id_follow: container.attr('data-id'),
        accept: button.attr('data-action')
    }));

    $('.item-follow').fadeOut(300);
    $('.container-follow-push').fadeOut(300);
};

$('.list-order').click((event) => {
    $('.container-profile').empty();
    $('.container-list-follow').html(`
        <h3>Заявки в друзья</h3>
        <div class="list-follow">
        </div>
    `)

    $.ajax({
        type: 'POST',
        url: '/profile/follow-order',
        async: false,
        success: (html) => {
            html = JSON.parse(html);

            html.filter((item) => {
                $('.list-follow').append(`
                    <div class="item-follow" data-id=${item.id}>
                    <h2>${item.username}</h2>
                    <div>
                        <button class="btn btn-success send-follow" data-action="1">Принять</button>
                        <button class="btn btn-danger send-follow" data-action="0">Отклонить</button>
                    </div>
                    </div>
                `);

                $('.send-follow').click(confirmFollowHandler);
            })
        }
    })
    return false;
});