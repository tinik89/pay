<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 11.01.2019
 * Time: 20:58
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class PayController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = 'ОБЗОР | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->view->title = 'ВХОД | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);
        $this-> layout = 'login';
        return $this->render('login');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionTransaction(){
        $this->view->title = 'ТРАНЗАКЦИИ | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);
        return $this->render('transaction');
    }
}