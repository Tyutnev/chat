<?php
use yii\bootstrap\ActiveForm;
?>
<div class="login-page">
  <div class="form">
    <?php $form = ActiveForm::begin(['method' => 'POST', 'action' => '/site/registration', 'options' => ['class' => 'ajax-form register-form']]) ?>
      <?= $form->field($registrationForm, 'login')->textInput(['placeholder' => 'Login'])->label(false) ?>
      <?= $form->field($registrationForm, 'username')->textInput(['placeholder' => 'Login'])->label(false) ?>
      <?= $form->field($registrationForm, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
      <?= $form->field($registrationForm, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>
      <button>Create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    <?php ActiveForm::end() ?>
    <?php $form = ActiveForm::begin(['method' => 'POST', 'action' => '/login', 'options' => ['class' => 'ajax-form login-form']]) ?>
      <?= $form->field($loginForm, 'login')->textInput(['placeholder' => 'Login'])->label(false) ?>
      <?= $form->field($loginForm, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
      <button>Login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    <?php ActiveForm::end() ?>
    <div class="form-message"></div>
  </div>
</div>