<div class="container">
<div class="row profile">
    <div class="col-md-3">
        <div class="profile-sidebar">
            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
                <img src="https://gravatar.com/avatar/31b64e4876d603ce78e04102c67d6144?s=80&d=https://codepen.io/assets/avatars/user-avatar-80x80-bdcd44a3bfb9a5fd01eb8b86f9e033fa1a9897c3a15b33adfc2649a002dab1b6.png" class="img-responsive" alt="">
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                    <?= Yii::$app->user->getIdentity()->username ?>
                </div>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->
            <!-- END SIDEBAR BUTTONS -->
            <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">
                <ul class="nav">
                    <li class="active">
                        <a href="/profile">
                        <i class="glyphicon glyphicon-home"></i>
                        Профиль </a>
                    </li>
                    <li>
                        <a href="/chat">
                        <i class="glyphicon glyphicon-user"></i>
                        Чат </a>
                    </li>
                    <li>
                        <a href="/follow-order" class="list-order">
                        <i class="glyphicon glyphicon-user"></i>
                        Заявки в друзья </a>
                    </li>
                    <li>
                        <a href="/exit">
                        <i class="glyphicon glyphicon-ok"></i>
                        Выход </a>
                    </li>
                </ul>
            </div>
            <!-- END MENU -->
</div>
</div>

<div class="container-profile container-list-follow">

</div>