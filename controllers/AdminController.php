<?php


namespace app\controllers;


use app\models\Comment;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;

class AdminController extends Controller
{
    public function actionPosts()
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        return $this->render('posts');
    }

    public function actionComments()
    {
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

    public function actionCommentDelete($id = null)
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        if ($id == null) {
            return $this->redirect(Url::to(['admin/comments']));
        }

        $comment = Comment::findOne(['id' => $id]);
        if (isset($comment)) {
            if ($comment->delete()) {
                Yii::$app->session->setFlash('success', 'Коментарий успешно удален');
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось удалить коментарий');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Коментарий не найден');
        }
//        return $this->redirect(Url::to(['admin/comments']));
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }


    public function actionUsers() {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        return $this->render('users')
    }

    public function actionUserEdit() {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        return $this->redirect()
    }

    //Пользователю будет присвоен параметр удаленный. Запись в базе останется
    public function actionUserDelete() {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }


    }
}