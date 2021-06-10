<?php

/**
 * @var $this \yii\web\View
 * @var $comments \app\models\Comment[]
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use app\models\Post;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>


<div class="admin-comments">
  <section class="view-comments">
    <div class="container-admin">

      <h2 class="view-comments__title font-heading-1s">Коментарии</h2>

        <?= \app\widgets\Alert::widget() ?>

        <?php Pjax::begin() ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'view-comments__gridview'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'username',
                'text',
                [
                    'label' => 'Статья',
                    'attribute' => 'post_id',
                    'value' => function ($comment) {
                        return Html::a(
                            Post::getPostTitleById($comment->post_id),
                            Url::to(['site/post', 'id' => $comment->post_id]),
                            [
                                'target' => '_blank',
                            ]
                        );
                    },
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'created_at',
                    'contentOptions' => ['style' => 'width: 130px; text-align: center'],
                ],
                [
                    'attribute' => 'updated_at',
                    'contentOptions' => ['style' => 'width: 130px; text-align: center'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $comment) {
                            return Html::a(
                                'Удалить',
                                ['admin/comment-delete', 'id' => $comment->id],
                                [
                                    'class' => 'view-comments__btn view-comments__btn_delete btn-common_danger',
                                ]);
                        },
                        'delete' => function ($url, $comment) {
                            return Html::a(
                                'Редактировать',
                                ['admin/comment-edit', 'id' => $comment->id],
                                ['class' => ' view-comments__btn view-comments__btn_edit btn-common']);
                        },
                    ],
                    'contentOptions' => ['style' => 'width: 100px'],
                ],
            ],
        ])

        ?>
        <?php Pjax::end() ?>
    </div>
  </section>
</div>