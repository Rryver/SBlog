<?php

/* @var $this yii\web\View
 * @var $posts Post[]
 */

use app\models\Post;
use app\widgets\Alert;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\helpers\Url;

?>


<div class="site-index">
  <section class="posts">
    <div class="container">
        <?= Alert::widget() ?>

        <?php Pjax::begin() ?>
      <ul class="posts__list">
          <?php foreach ($posts as $post) { ?>
            <li class="posts__item">
              <div class="posts__card-post card-post">
                <a class="card-post__link" href="<?= Url::to(['site/post', 'id' => $post->id]) ?>">
                  <h4 class="card-post__title font-heading-2"><?= $post->title ?></h4>
                </a>
                <span class="card-post__date"><?= $post->created_at ?></span>
                <p class="card-post__text"><?= $post->getShortTextOfContent() ?></p>
              </div>
            </li>

          <?php } ?>
      </ul>
      <div class="posts__pagination-widget pagination-widget">
          <?= LinkPager::widget([
              'options' => ['class' => 'pagination-widget__list'],
              'pagination' => $pages,
              'pageCssClass' => 'pagination-widget__item',
              'prevPageCssClass' => 'pagination-widget__item pagination-widget_item-prev',
              'nextPageCssClass' => 'pagination-widget__item pagination-widget_item-next',
              'activePageCssClass' => 'pagination-widget__item_active',
              'linkOptions' => ['class' => 'pagination-widget__link'],
          ]) ?>
      </div>
        <?php Pjax::end() ?>

        <?php if (!Yii::$app->user->isGuest) { ?>
          <a class="posts__btn-new-post btn-link btn-common" href="<?= Url::to(['site/create']) ?>">Create new post</a>
        <?php } ?>
    </div>
  </section>

</div>