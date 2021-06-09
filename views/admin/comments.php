<?php

/**
 * @var $this \yii\web\View
 * @var $comments \app\models\Comment[]
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\grid\GridView;
use yii\widgets\Pjax;

?>


<div class="admin-comments">
    <section class="view-comments">
        <div class="container-admin">

            <h2 class="view-comments__title font-heading-1s">Коментарии</h2>

            <?php Pjax::begin() ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'title',
                    ],
                    [
                        'attribute' => 'user_id',
                        'value' => function () {

                        }
                    ],
                ],
            ])

            ?>
            <?php Pjax::end() ?>
        </div>
    </section>
</div>