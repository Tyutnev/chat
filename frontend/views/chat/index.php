<?php
use yii\widgets\ActiveForm;
?>
<div class="container">
<h3 class=" text-center">Messaging</h3>
<div class="messaging">
    <div class="inbox_msg">
    <div class="inbox_people">
        <div class="headind_srch">
        <div class="recent_heading">
            <h4>Recent</h4>
        </div>
        <div class="srch_bar">
            <div class="stylish-input-group">
            <input type="text" class="search-bar"  placeholder="Search" >
            </div>
        </div>
        </div>
        <div class="inbox_chat">
            
        </div>
    </div>
    <div class="mesgs">
        <div class="msg_history">
        <div class="incoming_msg">
            <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
            <div class="received_msg">
            <div class="received_withd_msg">
                <p>Test which is a new approach to have all
                solutions</p>
                <span class="time_date"> 11:01 AM    |    June 9</span></div>
            </div>
        </div>
        <div class="outgoing_msg">
            <div class="sent_msg">
            <p>Test which is a new approach to have all
                solutions</p>
            <span class="time_date"> 11:01 AM    |    June 9</span> </div>
        </div>
        <div class="incoming_msg">
            <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
            <div class="received_msg">
            <div class="received_withd_msg">
                <p>Test, which is a new approach to have</p>
                <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
            </div>
        </div>
        <div class="outgoing_msg">
            <div class="sent_msg">
            <p>Apollo University, Delhi, India Test</p>
            <span class="time_date"> 11:01 AM    |    Today</span> </div>
        </div>
        <div class="incoming_msg">
            <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
            <div class="received_msg">
            <div class="received_withd_msg">
                <p>We work directly with our designers and suppliers,
                and sell direct to you, which means quality, exclusive
                products, at a price anyone can afford.</p>
                <span class="time_date"> 11:01 AM    |    Today</span></div>
            </div>
        </div>
        </div>
        <div class="type_msg">
        <div class="input_msg_write">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'content')->textInput(['class' => 'write_msg', 'placeholder' => 'Ваше сообщение'])->label(false) ?>
            <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
        <?php ActiveForm::end() ?>
        </div>
        </div>
    </div>
    </div>

</div></div>