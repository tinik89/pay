<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 11.01.2019
 * Time: 20:58
 */

namespace app\controllers;

use yii\web\Controller;

class PayController extends Controller
{
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
}