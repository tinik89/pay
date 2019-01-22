<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 11.01.2019
 * Time: 20:58
 */

namespace app\controllers;

use app\models\Project;
use app\models\Tag;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\forms\ClientForm;
use app\models\forms\ProjectForm;

class ProjectController extends Controller
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

    public function actionAll()//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!не используется
    {
        $this->view->title = 'ПРОЕКТЫ | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);
        
        $clientForm = new ClientForm();

        $projects = Project::find()->with('transactions', 'clientinfo', 'taginfo')->all();
        
        return $this->render('all', [
            'clientForm' => $clientForm,
            'projects' => $projects,
            'tags' => Tag::find()->asArray()->all(),
        ]);
    }
    
    public function actionIndex()
    {
        $this->view->title = 'ПРОЕКТЫ | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);
        
        $clientForm = new ClientForm();

        $projects = Project::find()->with('transactions', 'clientinfo', 'taginfo')->all();
        
        return $this->render('index', [
            'clientForm' => $clientForm,
            'projects' => $projects,
            'tags' => Tag::find()->asArray()->all(),
        ]);
    }

    public function actionShow()
    {
        $this->view->title = 'ПРОЕКТЫ | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);

        $projectForm = new ProjectForm();

        $projects = Project::find()->with('transactions', 'clientinfo', 'taginfo')->where('client='.Yii::$app->request->get('id'))->all();
        
        return $this->render('show', [
            'projectForm'=>$projectForm,
            'projects' => $projects,
            'tags' => Tag::find()->asArray()->all(),
        ]);
    }
}