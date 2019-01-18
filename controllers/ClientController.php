<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 11.01.2019
 * Time: 20:58
 */

namespace app\controllers;

use app\models\Tag;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\forms\ClientForm;
use app\models\forms\ProjectForm;

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
        
        $clientForm = new ClientForm();
        
        return $this->render('all', [
            'clientForm'=>$clientForm,
        ]);
    }

    public function actionShow()
    {
        $this->view->title = 'КЛИЕНТ | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);

        $projectForm = new ProjectForm();
        
        return $this->render('show', [
            'projectForm'=>$projectForm,
            'tags' => Tag::find()->all(),
        ]);
    }
}