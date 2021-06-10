<?php

/**
 * @var ActiveForm
 * @var $comment \app\models\Comment
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$previousUrl = null;

?>

<div class="comment-editor">

    <?php $form = ActiveForm::begin([
        'options' => 'comment-editor__form',
        'action' => ['site/comment-edit'],
        'method' => 'post'
    ]) ?>

    <?= $form->field($comment, 'text')
        ->textarea(['class' => 'form-comment__input form-comment__input_textarea', 'rows' => 7]) ?>
    <?= $form->field($comment, 'username')
        ->textInput(['class' => 'form-comment__input', 'placeholder' => 'Имя автора']) ?>

    <?= Html::button('Отмена', ['class' => 'btn-common']) ?>
    <?= Html::submitButton('Сохранить', ['class' => 'btn-common']) ?>
    <?php ActiveForm::end() ?>
</div>