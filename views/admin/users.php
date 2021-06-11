<?php

/**
 * @var $this \yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use app\models\User;
use yii\grid\GridView;
use yii\helpers\Html; ?>

<div class="admin-users">
  <div class="container-admin">

    <h2 class="admin-users__title admin-panel__title font-heading-1s">Пользователи</h2>

      <?= \app\widgets\Alert::widget() ?>


      <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'options' => ['class' => 'admin-users__gridview admin-panel__gridview'],
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],
              'id',
              'username',
              'email',
              [
                  'attribute' => 'status',
                  'value' => function ($user) {
                      return User::getUserStatus($user->status);
                  }
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
                  'attribute' => 'isAdmin',
                  'value' => function ($user) {
                      return $user->isAdminAsString();
                  }
              ],
              [
                  'class' => 'yii\grid\ActionColumn',
                  'template' => '{update} {delete}',
                  'buttons' => [
                      'update' => function ($url, $user) {
                          return Html::a(
                              'Редактировать',
                              ['admin/user-edit', 'id' => $user->id],
                              ['class' => 'btn-common admin-gridview__btn']);
                      },
                      'delete' => function ($url, $user) {
                          return Html::a(
                              'Удалить',
                              ['admin/user-delete', 'id' => $user->id],
                              ['class' => 'btn-common_danger admin-gridview__btn']);
                      }
                  ],
                  'contentOptions' => ['style' => 'width: 100px'],
              ]
          ],
      ]) ?>

  </div>
</div>