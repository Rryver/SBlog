<?php

/**
 * @var $this \yii\web\View
 * @var $post \app\models\Post
 */

$isEditMode = isset($post->id) ? true : false;

$postTitle = isset($post->title) ? ' ' . $post->title : '';
$this->title = ($isEditMode) ? 'Редактировать пост' : 'Новый пост';
$this->title = $this->title . $postTitle;

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>


<div class="site-editor">
  <section class="post-editor">
    <div class="container">
      <h2 class="post-editor__title font-heading-1"><?= $this->title ?></h2>
      <div class="split-line"></div>

        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'post-editor__form-post form-post'],
        ]); ?>
      <div class="form-post__inputs-container">
          <?= $form->field($post, 'title')
              ->textInput(['class' => 'form-post__input', 'placeholder' => 'Заголовок статьи'])
              ->label($post->attributeLabels()['title'], ['class' => 'form-post__label']) ?>
        <div class="form-post__textarea">
            <?= $form->field($post, 'content')
                ->textarea(['class' => 'form-post__input form-post__input_textarea', 'rows' => 20]) ?>
        </div>
      </div>

        <?= Html::submitButton("Save", ['class' => 'btn-common form-post__btn-submit']) ?>
        <?php ActiveForm::end(); ?>
    </div>
  </section>
</div>