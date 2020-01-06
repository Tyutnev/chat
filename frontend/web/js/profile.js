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
                    <div class="item-follow">
                    <h2>${item.username}</h2>
                    <div>
                        <button class="btn btn-success">Принять</button>
                        <button class="btn btn-danger">Отклонить</button>
                    </div>
                    </div>
                `);
            })
        }
    })
    return false;
});