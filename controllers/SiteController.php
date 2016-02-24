<?php
namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;

use app\models\Products;
use app\models\Categories;
use app\models\CategoyLevels;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\helpers\ArrayHelper;



/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
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
     * @inheritdoc
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
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['products/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return $this->redirect(['products/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
   
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
    
    public function actionJson() {
        
        $this->layout = false;
       
        $request = Yii::$app->request->get();        
        $data = array();
                
        $where = '';
        
        $limit = Yii::$app->request->get('limit', '');
        $tag =  Yii::$app->request->get('tag', '');
        $color =  Yii::$app->request->get('color', '');
       
        $condition = '';
        if( $tag != '' ){
            $condition .= " tag LIKE '".$tag."%' AND ";
        }
        if ( $color != '' ){
            $condition .= " color LIKE '#".$color."%' AND ";
        }
        if ($condition != '' ){            
            $where .= substr(trim($condition), 0, -3);
            $where = ' WHERE '.$where.' ';
        }     
        
        if( $limit != '' ){
            $limit = "limit $limit";
        }
        
        $query = "SELECT * FROM products $where $limit" ;
        $products = Yii::$app->db->createCommand($query)->queryAll();
        
        $data = array();
        
        foreach ($products as $key => $product) {            
            $data[$key]['images'] = explode(",", $product['img_url']);
            $data[$key]['source'] = $product['source_url'];
            $data[$key]['id'] = $product['id'];
            $data[$key]['title'] = $product['title'];
            $data[$key]['color'] = $product['color'];
            $data[$key]['tags'] = explode(",", $product['tag']);
        }
        
       
        $data = \yii\helpers\Json::encode($data);
        
        return $this->render('jsonData',[
            'jsonData' => $data
        ]);
        
    }
}
