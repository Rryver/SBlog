<?php

namespace app\controllers;

use app\models\Comment;
use app\models\Post;
use app\models\SignupForm;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Post::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5]);
        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            //->orderBy(['updated_at' => SORT_DESC])
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'posts' => $posts,
            'pages' => $pages,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Now you can start writing your own posts.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionPost($id = null)
    {
        if ($id !== null) {
            $post = Post::getPostById($id);
            if (isset($post)) {
                $comment = new Comment();
                $comments = Comment::getCommentsByPostId($post->id);
                return $this->render('post', [
                    'post' => $post,
                    'comment' => $comment,
                    'comments' => $comments,
                ]);
            }
        }

        return $this->goHome();
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            $this->goHome();
        }

        $post = new Post();

        if ($post->load(Yii::$app->request->post())) {
            $post->user_id = Yii::$app->user->id;
            if ($post->save()) {
//                return $this->render('post', [
//                    'post' => $post,
//                ]);
                return $this->redirect(Url::to(['site/post', 'id' => $post->id]));
            }
        }

        return $this->render('post-edit', [
            'post' => $post,
        ]);
    }

    public function actionPostEdit($id = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/');
        }

        $post = Post::getPostById($id);
        if ($post == null) {
            $this->redirect('/');
        }

        // if save changes
        if ($post->load(Yii::$app->request->post()) && $post->save()) {
//            return $this->render('post-editor', [
//                'post' => $post,
//            ]);
            return $this->redirect(Url::to(['site/post', 'id' => $post->id]));
        }

        if ($post->user_id == Yii::$app->user->id) {
            return $this->render('post-edit', [
                'post' => $post,
            ]);
        }

        return $this->redirect(Url::to(['site/post', 'id' => $id]));
    }

    public function actionPostDelete($id = null)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/');
        }

        $post = Post::getPostById($id);
        if ($post == null) {
            $this->redirect('/');
        }

        $this->redirect('/');
    }

    public function actionPostComment()
    {
        $comment = new Comment();
        if ($comment->load(Yii::$app->request->post())) {
            $comment->post_id =
            if ($comment->save())
        }
    }
}
