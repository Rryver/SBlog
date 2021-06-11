<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Menu;
use app\models\User;



$isGuest = Yii::$app->user->isGuest;
if ($isGuest) {
  $isAdmin = 0;
} else {
    $isAdmin = Yii::$app->user->identity->isAdmin;
}


$linkTemplate = '<a class="menu__link" href="{url}">{label}</a>';
?>


<header class="header">
  <div class="header__container">
    <nav class="header__menu">
        <?php
//        if ($isAdmin) {
            echo Menu::widget([
                'options' => [
                    'class' => 'menu__list menu__list_pull-left',
                ],
                'itemOptions' => [
                    'class' => 'menu__item',
                ],
                'linkTemplate' => $linkTemplate,
                'items' => [
                    ['label' => 'Главная', 'url' => ['site/index']],
                    ['label' => 'Коментарии', 'url' => ['admin/comments'], 'visible' => $isAdmin],
                    ['label' => 'Пользователи', 'url' => ['admin/users'], 'visible' => $isAdmin],
                ],
                'activeCssClass' => 'menu__item_active',
            ]);
//        }
        ?>
    </nav>

    <a class="header__logo" href="<?= Url::to('site/index') ?>">SBlog</a>

      <?php
      echo Menu::widget([
          'options' => [
              'class' => 'menu__list menu__list_pull-right',
          ],
          'itemOptions' => [
              'class' => 'menu__item',
          ],
          'linkTemplate' => $linkTemplate,
          'items' => [
              ['label' => 'Зарегистрироваться', 'url' => ['site/signup'], 'visible' => $isGuest],
              $isGuest ? (
                  ['label' => 'Войти', 'url' => ['site/login']]
              ) : ['label' => 'logout',
                  'url' => ['site/logout'],
                  'template' => '<a class="menu__link" href="{url}" data-method="post">{label}</a>'
              ],
          ],
          'activeCssClass' => 'menu__item_active',
      ]);
      ?>

    <!--  --><?php
      /*      NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ? ([
                        ['label' => 'signup', 'url' => ['/site/signup']],
                        ['label' => 'Login', 'url' => ['/site/login']]
                    ]
                    ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                    )
                ],
            ]);
            NavBar::end();
            */ ?>
  </div>
</header>