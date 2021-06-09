<?php


namespace app\controllers;


use app\models\Comment;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class AdminController extends Controller
{
    public function actionPosts() {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        return $this->render('posts');
    }

    public function actionComments() {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Comment::find(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('comments', [
            'dataProvider' => $dataProvider,
        ]);
    }
}