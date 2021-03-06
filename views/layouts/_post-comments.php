<?php

/**
 * @var $comments \app\models\Comment[]
 */

use app\widgets\Alert;
use yii\helpers\Url;

if (Yii::$app->user->isGuest) {
    $isAdmin = 0;
} else {
    $isAdmin = Yii::$app->user->identity->isAdmin;
}
?>


<div class="comments">

  <div class="comments__alert">
      <?= Alert::widget() ?>
  </div>

  <h4 class="comments__title font-heading-2">Коментарии</h4>
  <ul class="comments__list">
      <?php foreach ($comments as $item) { ?>
        <li class="comments__item"">
        <div class="comments__card-comment card-comment">
          <div class="card-comment__header">
            <span class="card-comment__author font-body-2"><?= $item->username ?></span>
            <span class="card-comment__date font-label"><?= isset($item->created_at) ? $item->created_at : 'y-m-d' ?></span>
          </div>
          <div class="card-comment__content">
            <p class="card-comment__text"><?= $item->text ?></p>
          </div>
        </div>
          <?php if ($isAdmin) { ?>
          <div class="comments__comment-edit comment-edit" commentid="<?= $item->id ?>">
            <button class="comment-edit__btn comment-edit__btn_delete btn-common_danger"
                    action="<?= Url::to(['site/comment-delete']) ?>">Удалить</button>
            <a class="comment-edit__btn comment-edit__btn_edit btn-common"
               href="<?= Url::to(['admin/comment-edit', 'id' => $item->id, 'postId' => $item->post_id]) ?>">Редактировать</a>
          </div>
          <?php } ?>
        </li>
      <?php } ?>
  </ul>
