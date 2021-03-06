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

    public function actionCommentEdit($id = null, $postId = null)
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        if ($id == null) {
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }

        $comment = Comment::findOne(['id' => $id]);
        //???????? ???????????? ?????????? ?????????????????? ?? ????????????, ???? ?????????????????? ?? ????
        if ($comment->load(Yii::$app->request->post())) {
            if ($comment->save()) {
                Yii::$app->session->setFlash('success', '???????????????????? ??????????????');
            } else {
                Yii::$app->session->setFlash('error', '???? ?????????????? ???????????????? ????????????????????');
            }
            if ($postId != null) {
                return $this->redirect(Url::to(['site/post', 'id' => $_GET['postId']]));
            } else {
                return $this->redirect(['admin/comments']);
            }
        }

        //???????? ???? ???????????? ???????? ???? ???????????????? ????????????, ?????????? ?????????? ID ???????????? ?? ???? ???????????? ?????????????????? ??????????????.
        if (isset($_GET['postId'])) {
            $postId = $_GET['postId'];
        } else {
            $postId = null;
        }
        return $this->render('comment-editor', [
            'comment' => $comment,
            'postId' => $postId,
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
        //???????? ?????????????????????? ???????????????????? ????????????, ???? ?????????????? ??????
        if (isset($comment)) {
            if ($comment->delete()) {
                Yii::$app->session->setFlash('success', '???????????????????? ?????????????? ????????????');
            } else {
                Yii::$app->session->setFlash('error', '???? ?????????????? ?????????????? ????????????????????');
            }
        } else {
            Yii::$app->session->setFlash('error', '???????????????????? ???? ????????????');
        }
//        return $this->redirect(Url::to(['admin/comments']));
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }


    public function actionUsers()
    {
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

    public function actionUserEdit($id = null)
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        if ($id == null) {
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }


        $user = User::findOne(['id' => $id]);
        //???????? ???????????? ?????????? ?????????????????? ?? ????????????, ???? ?????????????????? ?? ????
        if ($user->load(Yii::$app->request->post())) {
            $user->username = $_POST['User']['username'];
            $user->email = $_POST['User']['email'];
            $user->isAdmin = $_POST['User']['isAdmin'];
            if ($user->save()) {
                Yii::$app->session->setFlash('success', '???????????? ???????????????????????? ?????????????? ????????????????');
                return $this->redirect(['admin/users']);
            } else {
                Yii::$app->session->setFlash('error', '???? ?????????????? ???????????????? ???????????? ????????????????????');
                return $this->redirect(['admin/users']);
            }
        }

        return $this->render('user-editor', [
            'user' => $user,
        ]);
    }

    //???????????????????????? ?????????? ???????????????? ???????????? '??????????????????'. ???????????? ?? ???????? ??????????????????
    public function actionUserDelete($id = null)
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin) {
            return $this->goHome();
        }

        if ($id == null) {
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }

        $user = User::findOne(['id' => $id]);
        //???????? ???????????????????????? ???????????? ?? ????
        if (isset($user)) {
            $user->status = User::STATUS_DELETED;
            if ($user->save()) {
                Yii::$app->session->setFlash('success', '???????????????????????? ????????????');
            } else {
                Yii::$app->session->setFlash('success', '???? ?????????????? ?????????????? ????????????????????????');
            }
        }
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }
}