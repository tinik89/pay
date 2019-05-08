<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 23.01.2019
 * Time: 18:58
 */

namespace app\controllers;


use app\models\Client;
use app\models\forms\DeleteForm;
use yii\base\Controller;
use yii\filters\AccessControl;
use app\models\forms\ClientForm;

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
    
    public function actionIndex (){
        $this->view->title = 'КЛИЕНТЫ | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);

        $clientForm = new ClientForm();
        $deleteForm = new DeleteForm();

        $clients = Client::find()->with('projects')->orderBy('name', SORT_ASC)->all();

        return $this->render('index', [
            'clientForm' => $clientForm,
            'deleteForm' => $deleteForm,
            'clients' => $clients,
        ]);
    }
}