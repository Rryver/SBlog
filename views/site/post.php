<?php

/**
 * @var $this \yii\base\View
 * @var $post \app\models\Post
 * @var $comment \app\models\Comment
 * @var $comments \app\models\Comment[]
 */

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

          <?php if ($post->user_id == Yii::$app->user->id || Yii::$app->user->identity->isAdmin) { ?>
            <a class="post__btn btn-link btn-common" href="<?= Url::to(['site/post-edit', 'id' => $post->id]) ?>">Edit
              post</a>
              <?= Html::a(
                  "Delete post",
                  Url::to(['site/post-delete', 'id' => $post->id]),
                  [
                      'class' => 'post__btn post__btn_pull-right btn-link btn-common btn-common_danger',
                      'data' => ['confirm' => 'Вы уверены, что хотите удалить статью?'],
                  ]) ?>
          <?php } ?>

        <div class="post__conversation">
            <?= $this->render('../layouts/_form-comment', [
                'comment' => $comment,
                'postId' => $post->id,
            ]) ?>
        </div>

        <div class="post__comments">
            <?= $this->render('../layouts/_post-comments', [
                'comments' => $comments,
            ]) ?>
        </div>


      </div>
    </div>
  </section>
</div>
