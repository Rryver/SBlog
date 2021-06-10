<?php

/**
 * @var $this \yii\web\View
 * @var $post \app\models\Post
 */

$isEditMode = isset($post->id) ? true : false;
$this->title = ($isEditMode) ? 'Редактирование статьи' : 'Новый пост';

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm; ?>


<div class="site-editor">
  <section class="post-editor">
    <div class="container">
      <h2 class="post-editor__title font-heading-1"><?= $this->title ?></h2>
      <h2 class="post-editor__title font-heading-2"><?= $post->title ?></h2>


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

        <?= Html::submitButton("Сохранить", ['class' => 'btn-common form-post__btn-submit']) ?>
      <a class="post-editor__link btn-common btn-common_danger" href="<?= Url::to(['site/post', 'id' => $post->id]) ?>">Отмена</a>
        <?php ActiveForm::end(); ?>
    </div>
  </section>
</div>