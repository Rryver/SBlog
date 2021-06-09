<?php

/**
 * @var $this \yii\web\View
 * @var $comment \app\models\Comment
 * @var $postId integer
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<div class="conversation">
  <h3 class="conversation__title font-heading-1">Присоединяйтесь к обсуждению</h3>
  <h4 class="conversation__title font-heading-2">Оставьте коментарий</h4>

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'conversation__form-comment form-comment', 'postid' => $postId],
        'action' => ['site/post-comment'],
        'method' => 'post',
    ]) ?>

    <?= $form->field($comment, 'text')
        ->textarea(['class' => 'form-comment__input form-comment__input_textarea', 'rows' => 7]) ?>
    <?= $form->field($comment, 'username')
        ->textInput(['class' => 'form-comment__input', 'placeholder' => 'Имя автора']) ?>

    <?= Html::submitButton("Отправить коментарий", ['class' => 'btn-common form-comment__btn-submit']) ?>
    <?php ActiveForm::end() ?>

</div>

