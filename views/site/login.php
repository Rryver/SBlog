<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
  <div class="container">
    <h1 class="site-login__title"><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'options' => ['class' => 'login-form'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-8 col-lg-offset-1\">{input}</div>\n<div class=\"col-lg-offset-2 col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-2 col-lg-4\">{input} {label}</div>\n<div class=\"col-lg-offset-2 col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn-common', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-2" style="color:#999;">
        Вы можете войти <strong>admin/123456</strong> - администратор. Так же добавлены обычные пользователи <br>
      <strong>user/123456</strong> или <strong>qwerty/123456</strong>.
    </div>
  </div>
</div>
