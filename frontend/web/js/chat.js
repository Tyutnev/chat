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

if ($('div').is('.messaging')) {
    getLastMessage();
}