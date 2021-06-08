<?php

/**
 * @var $this \yii\web\View
 * @var $form ActiveForm
 * @var $model \app\models\SignupForm
 */


$this->title = "Signup";

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


<div class="site-signup">
  <section class="signup">
    <div class="container">
      <h1 class="signup__title font-heading-1"><?= $this->title ?></h1>

        <p class="signup__text-info">Please fill out the following fields to signup:</p>

        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>

        <?= Html::submitButton('Signup', ['class' => '']) ?>

        <?php ActiveForm::end() ?>
    </div>
  </section>
</div>


