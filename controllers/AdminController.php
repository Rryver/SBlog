<?php


namespace app\controllers;


use app\models\Comment;
use Yii;
use yii\base\View;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use app\models\User;


class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


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

    public function actionCommentEdit($id = null) {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        if ($id == null) {
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }

        $comment = Comment::findOne(['id' => $id]);
        //if save changes
        if ($comment->load(Yii::$app->request->post())) {
            if ($comment->save()) {
                Yii::$app->session->setFlash('success', 'Коментарий изменен');
                return $this->redirect($_SERVER['HTTP_REFERER']);
//                return $this->redirect(['admin/comments']);
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось изменить коментарий');
                return $this->redirect($_SERVER['HTTP_REFERER']);
//                return $this->redirect(['admin/comments']);
            }
        }

        return $this->render('comment-editor', [
            'comment' => $comment,
        ]);
    }

    public function actionCommentDelete($id = null)
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        if ($id == null) {
            return $this->redirect($_SERVER['HTTP_REFERER']);
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

        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('users', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUserEdit($id = null) {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        if ($id == null) {
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }

        $user = User::findOne(['id' => $id]);
        //if save changes
        if ($user->load(Yii::$app->request->post())) {
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Данные пользователя успешно изменены');
                return $this->redirect($_SERVER['HTTP_REFERER']);
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось изменить данные пользоваля');
                return $this->redirect($_SERVER['HTTP_REFERER']);
            }
        }

        return $this->render('user-editor', [
            'user' => $user,
        ]);
    }

    //Пользователю будет присвоен параметр удаленный. Запись в базе останется
    public function actionUserDelete($id = null) {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        if ($id == null) {
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }

        $user = User::findOne(['id' => $id]);
        if (isset($user)) {
            $user->status = User::STATUS_DELETED;
            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Пользователь удален');
            } else {
                Yii::$app->session->setFlash('success', 'Не удалось удалить пользователя');
            }
        }
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }
}