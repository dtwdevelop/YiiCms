<?php
namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\LoginForm;
use app\models\ContactForm;
use app\modules\user\models\Profile;
use app\modules\user\models\User;
use app\models\Auth;
use yii\helpers\Url;
use app\models\Categories;
use app\models\Tags;

class SiteController extends Controller {

    public function behaviors() {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['index', 'contact', 'forgot'],
                'duration' => 1,
                'variations' => [
                    \Yii::$app->language,
                ]],
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

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function onAuthSuccess($client) {
        $attributes = $client->getUserAttributes();

        /** @var Auth $auth */
        $auth = Auth::find()->where([
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ])->one();
       // echo $attributes['email'];
        if (Yii::$app->user->isGuest) {

            if ($auth) { // login
                $user = User::find(['id' => $auth->user_id])->one();

                //$user = $auth->user;
                if (Yii::$app->user->login($user)) {
                    $autht = Yii::$app->authManager;
                    $role = $autht->getRole('user');
                    if (!$autht->getRolesByUser($user->id)) {
                        $autht->assign($role, $auth->user_id);
                    }
                }
                
            } else { // signup
                if (Profile::find()->where(['email' => 'demoss@sample.com'])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        // 'username' => $attributes['login'],
                        'username' => 'Social user',
                        // 'email' => $attributes['email'],
                        'password' => $password,
                    ]);

                    // $user->generateAuthKey();
                    // $user->generatePasswordResetToken();
                    $transaction = $user->getDb()->beginTransaction();
                    if ($user->save()) {
                        $profile = new Profile([
                            'user_id' => $user->id,
                            'name' => $user->username,
                            'email' => 'demo@sample.com',
                            'role' => 'user',
                        ]);
                        $profile->save(false);
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string) $attributes['id'],
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            if (Yii::$app->user->login($user)) {
                                $autht = Yii::$app->authManager;
                                $role = $autht->getRole('user');
                                if (!$autht->getRolesByUser($user->id)) {
                                    $autht->assign($role, $user->id);
                                }
                            }
                        } else {
                            print_r($auth->getErrors());
                        }
                    } else {
                        print_r($user->getErrors());
                    }
                }
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
//                    'user_id' => 1024,
                    'source' => $client->getId(),
                    'source_id' => (string) $attributes['id'],
                ]);
                $auth->save();
            }
        }
    }

    public function actionMenu() {
        $data = Categories::createMenu();
    }

    public function actionIndex() {
        $admin = '';
        if (Yii::$app->user->can('send')) {
            $admin = "go";
        }
        return $this->render('index', ['test' => $admin]);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            //return $this->goHome();
            return $this->redirect('/site/index');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);

            $auth = Yii::$app->authManager;
            $role = $auth->getRole($profile->role);

            if (!$auth->getRolesByUser(Yii::$app->user->id)) {
                $auth->assign($role, Yii::$app->user->id);
            }

            return $this->redirect('/site/profile');
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionRegister() {
        $model = new Profile;
        $model2 = new User;

        if ($model2->load(Yii::$app->request->post()) && $model2->validate() && $model->load(Yii::$app->request->post()) && $model->validate()) {
            $model2->save();
            $model->save(false);
            $url = Url::to([Yii::$app->params['site'] . '/site/active', 'param' => base64_encode($model->profile_id)]);
            $model->contact(Yii::$app->params['adminEmail'], $url);
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->redirect('/site/login.html');
        }

        return $this->render('register', [
                    'model' => $model,
                    'model2' => $model2,
        ]);
    }

    public function actionProfile() {
        if (!Yii::$app->user->isGuest) {
            $name = User::findOne(['id' => Yii::$app->user->id]);
            return $this->render('profile', ['name' => $name->username]);
        } else {
            $this->redirect('/site/index.html');
        }
    }

    public function actionActive() {
        $active = Yii::$app->request->get('param');
        echo base64_decode($active);
        $profile = Profile::findOne(['profile_id' => base64_decode($active)]);
        if ($profile === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        } else {
            $profile->active = 1;
            $profile->save();
            return $this->render('active');
        }
    }

    public function actionForgot() {
        if (Yii::$app->request->post()) {

            $param = trim(Yii::$app->request->post('email'));

            $profile = Profile::findOne(['email' => $param]);

            if ($profile !== null) {
                Yii::$app->session->setFlash('Success');
            } else {
                Yii::$app->session->setFlash('Incorrect');
            }
        }

        return $this->render('forgot');
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionTag() {
        $tag = 'vodka,car,animal, mac';
        $model = new Tags;
        $r = $model->findFrfrequency();
        print_r($r);
        echo "<pre>";
        $model->addTags($tag);
//        $model->deleteTags($tag);
    }

}
