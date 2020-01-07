let socket = new WebSocket(`ws://127.0.0.1:8080`);

/**
 * Соединение установлено
 */
socket.onopen = (event) => {
    console.log('Connect');
}

/**
 * Получение данных
 */
socket.onmessage = (event) => {
    let data = JSON.parse(event.data);

    /**
     * Передача идентификатора пользователя после подключения
     */
    if (data.header == 'handshake') {
        let hash;
        $.ajax({
            type: 'POST',
            url: '/site/identity',
            async: false,
            success: (html) => {
                hash = html;
            }
        });
        socket.send(JSON.stringify({
            header: 'handshake',
            resourceId: data.resource,
            hash: hash
        }))
    }

    /**
     * Push-уведомление о заявки добавления в друзья
     */
    if (data.header == 'follow-push') {
        $('.send-follow').click(confirmFollowHanlder);
        $('.container-follow-push').fadeIn(300);
        $('.container-follow-push').attr('data-id', data.id_order);
        $('.container-follow-push').css('display', 'inline-block');
        $('.follow-push-username').html(data.from);
    }

    /**
     * Ответ на заявку в друзья
     */
    if (data.header == 'follow-confirm-push') {
        $('.container-follow-confirm').fadeIn(300);
        $('.container-follow-confirm').css('display', 'inline-block');

        let result = Number(data.accept) ? 'Принял' : 'Отклонил';
        $('.follow-confirm-message').html(`Пользователь ${data.from} ${result} вашу заявку в друзья`);
    }

    /**
     * Соединение закрыто
     */
    socket.close = (event) => {
        console.log('Close');
    }

    /**
     * Отправка заявки в друзья
     */
    $('.btn-follow').click((event) => {
        socket.send(JSON.stringify({
            header: 'follow-push',
            id_user: $('.btn-follow').attr('href')
        }))

        $('.btn-follow').html('Заявка в друзья отправлена');
        $('.btn-follow').toggleClass('btn-follow');
    })
}