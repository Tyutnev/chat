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
                    <?= $model->username ?>
                </div>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->
            <div>
                <?php if($model->isOnline()): ?>
                    <span>Онлайн</span>
                <?php else: ?>
                    <span>Был в сети <?= Yii::$app->formatter->asDate($model->getExitDate(), 'long') ?></span>
                <?php endif; ?>
            </div>
            <div class="profile-userbuttons">
                <!--
                <?php //if($follow = $model->isFriend(Yii::$app->user->getId())): ?>
                    <button type="button" class="btn btn-success btn-sm"><?php //$follow->getStatus() ?></button>
                <?php //elseif($model->canFollow()): ?>
                    <button type="button" class="btn btn-success btn-sm btn-follow" href="<?php //$model->id ?>">Follow</button>
                <?php //endif; ?>
                <button type="button" class="btn btn-danger btn-sm btn-chat" href="<?php //$model->id ?>">Message</button>
                -->

                <?php if($model->canFollow() && ($follow = $model->getFollow())): ?>
                    <button type="button" class="btn btn-success btn-sm"><?= $follow->getStatus() ?></button>
                <?php endif; ?>
                <button type="button" class="btn btn-danger btn-sm btn-chat" href="<?= $model->id ?>">Message</button>
            </div>
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
                        <a href="/exit">
                        <i class="glyphicon glyphicon-ok"></i>
                        Выход </a>
                    </li>
                </ul>
            </div>
            <!-- END MENU -->
            

</div>
</div>