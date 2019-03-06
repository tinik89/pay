<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 11.01.2019
 * Time: 20:58
 */

namespace app\controllers;

use app\models\Client;
use app\models\forms\DeleteForm;
use app\models\Project;
use app\models\Tag;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\forms\ClientForm;
use app\models\forms\ProjectForm;
use app\models\forms\TransactionForm;
use app\models\Implementer;

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

        $projectForm = new ProjectForm();

        $projects = Project::find()->with('transactions', 'clientinfo', 'taginfo')->orderBy('date_update DESC')->all();


        $projectsOpen = Project::find()->where('status=1')->count();
        $summTags = Project::find()->with('taginfo')->select('tag, SUM(price) as sumPrice, SUM(debet) as sumDebet')->groupBy('tag')->all();

        $deleteForm = new DeleteForm();

        $addTransactionForm = new TransactionForm();
        
        return $this->render('index', [
            'projectForm'=>$projectForm,
            'clientForm' => $clientForm,
            'projects' => $projects,
            'tags' => Tag::find()->asArray()->all(),
            'deleteForm' => $deleteForm,
            'implementers' => Implementer::find()->asArray()->all(),
            'addTransactionForm' => $addTransactionForm,
            'projectsOpen' => $projectsOpen,
            'summTags' => $summTags,
        ]);
    }

    public function actionShow()
    {
        $clientID = Yii::$app->request->get('id');
        $client = Client::findOne($clientID);
        $clientName = $client->name;
        $this->view->title = 'ПРОЕКТЫ '.$clientName.' | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);

        $projectForm = new ProjectForm();

        $projects = Project::find()->with('transactions', 'clientinfo', 'taginfo')->where('client='.$clientID)->orderBy('date_update DESC')->all();

        
        $projectsOpen = Project::find()->where('client='.$clientID.' AND status=1')->count();
        $summTags = Project::find()->with('taginfo')->select('tag, SUM(price) as sumPrice, SUM(debet) as sumDebet')->where('client='.$clientID)->groupBy('tag')->all();

        
        $deleteForm = new DeleteForm();

        $addTransactionForm = new TransactionForm();
        
        return $this->render('show', [
            'projectForm'=>$projectForm,
            'clientName' => $clientName,
            'projects' => $projects,
            'tags' => Tag::find()->asArray()->all(),
            'deleteForm' => $deleteForm,
            'implementers' => Implementer::find()->asArray()->all(),
            'addTransactionForm' => $addTransactionForm,
            'projectsOpen' => $projectsOpen,
            'summTags' => $summTags,
        ]);
    }
}