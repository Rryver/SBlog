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


            <?php $form = ActiveForm::begin([
                'options' => 'user-editor__form',
                'action' => ['admin/user-edit'],
            ]) ?>

            <?= $form->field($user, 'username')->textInput(['class' => 'form-edit__input']) ?>
            <?= $form->field($user, 'email')->textInput(['class' => 'form-edit__input']) ?>
            <?= $form->field($user, 'status')->dropDownList(User::getAllUserStatus(), ['class' => 'form-edit__input']) ?>
            <?= $form->field($user, 'isAdmin')->dropDownList(['true' => 1, 'false' => 0]) ?>

            <?= Html::submitButton('Сохранить', ['btn-common']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>


