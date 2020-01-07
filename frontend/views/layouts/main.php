<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\assets\ProfileAsset;

/**
 * TODO: Переделать данное решение
 */
if($this->context->id == 'profile')
{
    ProfileAsset::register($this);
}
else
{
    AppAsset::register($this);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?= $content ?>
    <div class="container-follow-push panel panel-default item-follow">
        <span>Новая заявка в друзья</span>
        <div class="inner-follow-push">
            <h4><span class="follow-push-username"></span> хочет добавиться в друзья</h4>
            <div>
                <button class="btn btn-success send-follow" data-action="1">Принять</button>
                <button class="btn btn-danger send-follow" data-action="2">Отклонить</button>
            </div>
        </div>
    </div>

    <div class="container-follow-confirm panel panel-default">
        <span>Пользователь ответил на ваше предложение о дружбе</span>
        <div class="inner-follow-push">
            <h4 class="follow-confirm-message"></h4>
        </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
