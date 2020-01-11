const getUserId = () => {
    let idUser;

    $.ajax({
        type: 'GET',
        url: 'site/identity',
        data: {
            id: 'true'
        },
        async: false,
        success: (html) => {
            idUser = html;
        }
    });

    return idUser;
};

const getPivot = () => {
    return $($('[data-id]')[$('[data-id]').length - 1]).attr('data-id');
}

const getLastMessage = (event) => {
    $.ajax({
        type: 'GET',
        url: 'chat/last-message',
        data: {
            pivot: getPivot()
        },
        success: (html) => {
            html = JSON.parse(html);

            html.filter((item) => {
                $('.inbox_chat').append(`
                    <div class="chat_list active_chat" data-id="${item.id}" data-hash="${item.user.message_hash}">
                    <div class="chat_people">
                    <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                    <div class="chat_ib">
                        <h5>${item.user.username} <span class="chat_date">Dec 25</span></h5>
                        <p>${item.content}</p>
                    </div>
                    </div>
                    </div>
                `);
            });
        }
    })
}

const getMessages = (hash, pivot) => {
    $.ajax({
        type: 'GET',
        url: '/chat/message',
        data: {
            hash: hash,
            pivot: pivot
        },
        success: (html) => {
            html = JSON.parse(html);
            idUser = getUserId();

            html.filter((item) => {
                if (idUser == item.id_sender) {
                    $('.msg_history').append(`
                        <div class="outgoing_msg">
                        <div class="sent_msg">
                        <p>${item.content}</p>
                        <span class="time_date"> 11:01 AM    |    June 9</span> </div>
                        </div>
                    `);
                } else {
                    $('.msg_history').append(`
                        <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                        <div class="received_withd_msg">
                            <p>${item.content}</p>
                            <span class="time_date"> 11:01 AM    |    June 9</span></div>
                        </div>
                        </div>`);
                }
            })
        }
    });
};

if ($('div').is('.messaging')) {
    getLastMessage();
}

$('.inbox_chat').click((event) => {
    let element = $(event.target);
    let hash;
    if (hash = element.attr('data-hash')) {
        $('.msg_history').empty();
        getMessages(hash);
    }

});