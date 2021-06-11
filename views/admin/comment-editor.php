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
  <div class="container">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'comment-editor__form'],
        'action' => ['admin/comment-edit', 'id' => $comment->id, 'postId' => $postId],
    ]) ?>

    <?= $form->field($comment, 'text')
        ->textarea(['class' => 'form-comment__input form-comment__input_textarea', 'rows' => 7]) ?>
    <?= $form->field($comment, 'username')
        ->textInput(['class' => 'form-comment__input', 'placeholder' => 'Имя автора']) ?>

    <?= Html::submitButton('Сохранить', ['class' => 'btn-common']) ?>
    <?= Html::a('Отмена', ['admin/comments'], ['class' => 'btn-common_danger']) ?>
    <?php ActiveForm::end() ?>


    <?= var_dump($postId) ?>
  </div>
</div>