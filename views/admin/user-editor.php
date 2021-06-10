<?php

/**
 * @var $this \yii\web\View
 * @var $user User
 */

use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="admin-user-editor">
  <div class="user-editor">
    <div class="container">
      <h2 class="user-editor__title admin-panel__title font-heading-1s">Редактирование пользователя</h2>

        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'user-editor__form'],
            'action' => ['admin/user-edit', 'id' => $user->id],
        ]) ?>

        <?= $form->field($user, 'username')->textInput(['class' => 'form-edit__input']) ?>
        <?= $form->field($user, 'email')->textInput(['class' => 'form-edit__input']) ?>
        <?= $form->field($user, 'status')->dropDownList(User::getUserStatus(), ['class' => 'form-edit__input']) ?>
        <?= $form->field($user, 'isAdmin')->dropDownList(User::getisAdminAsMap(), ['class' => 'form-edit__input']) ?>

        <?= Html::submitButton('Сохранить', ['class' => 'btn-common']) ?>
        <?= Html::a('Отмена', ['admin/users'], ['class' => 'btn-common btn-common_danger']) ?>
        <?php ActiveForm::end() ?>

    </div>
  </div>
</div>


