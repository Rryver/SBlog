<?php

/**
 * @var $this \yii\base\View
 * @var $post \app\models\Post
 * @var $comment \app\models\Comment
 * @var $comments \app\models\Comment[]
 */


$postTitle = "Hello World";

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>


<div class="site-post">
  <section class="post">
    <div class="container">
      <div class="post__header">
        <h2 class="post__title font-heading-1"><?= $post->title ?></h2>
        <div class="post__info">
          <!--          <a class="post__link-author" href="#">-->
          <span class="post__author-name font-heading-2">
            <span class="post__small-caption font-body">Автор:</span>
              <?= User::getUsernameById($post->user_id) ?>
          </span>
          <!--          </a>-->
          <span class="post__date font-label">
            <span class="post__small-caption">Обновлено:</span>
              <?= empty($post->updated_at) ? 'd-m-y' : $post->updated_at ?>
          </span>
        </div>
      </div>

      <div class="post__content">
        <div class="post__text">
          <p class="post__p">
              <?= $post->content ?>
          </p>
        </div>

          <?php if ($post->user_id == Yii::$app->user->id) { ?>
            <a class="post__btn btn-link btn-common" href="<?= Url::to(['site/post-edit', 'id' => $post->id]) ?>">Edit
              post</a>
              <?= Html::a("Delete post",
                  Url::to(['site/post-delete', 'id' => $post->id]),
                  [
                      'class' => 'post__btn post__btn_pull-right btn-link btn-common btn-common_danger',
                      'data' => ['confirm' => 'Вы уверены, что хотите удалить статью?'],
                  ]) ?>
          <?php } ?>

        <div class="post__conversation conversation">
          <h3 class="conversation__title font-heading-1">Присоединяйтесь к обсуждению</h3>
          <h4 class="form-comment__title font-heading-2">Оставьте коментарий</h4>
            <?php Pjax::begin() ?>
            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'conversation__form-comment form-comment'],
                'action' => ['site/post-comment'],
            ]) ?>

            <?= $form->field($comment, 'text')
                ->textarea(['class' => 'form-comment__input form-comment__input_textarea', 'rows' => 7]) ?>
            <?= $form->field($comment, 'username')
                ->textInput(['class' => 'form-comment__input', 'placeholder' => 'Имя автора']) ?>

            <?= Html::submitButton("Отправить коментарий", ['class' => 'btn-common form-comment__btn-submit']) ?>
            <?php ActiveForm::end() ?>
            <?php Pjax::end() ?>
        </div>

        <div class="post__comments comments">
          <h4 class="comments__title font-heading-2">Коментарии</h4>
          <ul class="comments__list">


              <?php foreach ($comments as $item) { ?>
                <li class="comments__item">
                  <div class="comments__card-comment card-comment">
                    <div class="card-comment__header">
                      <span class="card-comment__author font-body-2"><?= $item->username ?></span>
                      <span class="card-comment__date font-label"><?= isset($item->created_at) ? $item->created_at : 'y-m-d' ?> </span>
                    </div>
                    <div class="card-comment__content">
                      <p class="card-comment__text"><?= $item->text ?></p>
                    </div>
                  </div>
                </li>
              <?php } ?>
          </ul>


        </div>
      </div>
  </section>

</div>
