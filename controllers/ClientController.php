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

class ClientController extends Controller
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
        ];
    }

    public function actionAll()
    {
        $this->view->title = 'КЛИЕНТЫ | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);
        return $this->render('all');
    }

    public function actionShow()
    {
        $this->view->title = 'КЛИЕНТ | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);
        return $this->render('show');
    }
}