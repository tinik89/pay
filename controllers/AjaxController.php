<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 16.01.2019
 * Time: 22:45
 */

namespace app\controllers;

use app\models\forms\DeleteForm;
use app\models\Transaction;
use Yii;
use yii\base\Controller;
use app\models\Client;
use app\models\forms\ClientForm;
use app\models\Project;
use app\models\forms\ProjectForm;
use yii\widgets\ActiveForm;


class AjaxController extends Controller
{
    public $layout = 'ajax';

    public function actionNewClient () {
        $clientForm = new ClientForm();
        if (Yii::$app->request->isAjax && $clientForm->load(Yii::$app->request->post())) {
            if (!empty ($errorForm = ActiveForm::validate($clientForm))) {
                return json_encode(['error'=>$errorForm["clientform-name"][0]]);
            } else {
                if (Client::find()->where(['name' => $clientForm->name])->exists()){
                    return json_encode(['error'=>'Клиент с таким именем уже существует']);
                } else {
                    $client = new Client();
                    $client->name = $clientForm->name;
                    $client->save(false);
                    return json_encode(['add' => $client -> id]);
                }
            }
        }
        return false;

    }
    
    public function actionGetProject () {
        if (Yii::$app->request->isAjax) {
            $request = Yii::$app->request;
            $projects = Project::find()->where(['client' => $request->post('client')])->asArray()->all();

            return json_encode($projects);
        }
        return false;

    }

    public function actionNewProject () {
        $projectForm = new ProjectForm();
        if (Yii::$app->request->isAjax && $projectForm->load(Yii::$app->request->post())) {
            if (!empty ($errorForm = ActiveForm::validate($projectForm))) {
                return json_encode(['error'=>$errorForm["projectform-name"][0]]);
            } else {
                if (Project::find()->where(['name' => $projectForm->name])->exists()){
                    return json_encode(['error'=>'Проект с таким названием уже существует']);
                } else {
                    $project = new Project();
                    $project->name = $projectForm->name;
                    $project->tag = $projectForm->tag;
                    $project->price = $projectForm->price;
                    $project->date_start = strtotime($projectForm->date_start);
                    $project->date_update = time();
                    $project->client = $projectForm->client;
                    $project->debet = 0;
                    $project->status = 1;
                    $project->credit = $projectForm->price;
                    $project->save(false);
                    return json_encode(['add' => 'Проект добавлен', 'id' =>  $project->id]);
                }
            }
        }
        return false;
    }

    public function actionRemoveForm () {
        $deleteForm = new DeleteForm();
        if (Yii::$app->request->isAjax && $deleteForm->load(Yii::$app->request->post())) {
            if (empty ($errorForm = ActiveForm::validate($deleteForm))) {
                switch ($deleteForm->object){
                    case 'client':
                        $modelDel = Client::findOne($deleteForm->id);
                        break;
                    case 'project':
                        $modelDel = Project::findOne($deleteForm->id);
                        break;
                    case 'transaction':
                        $modelDel = Transaction::findOne($deleteForm->id);
                        break;
                }
                
                if ($modelDel){
                    $modelDel->delete();
                    return true;
                }
                
            }
        }
        return false;

    }

    public function actionRemoveProject () {
        $deleteForm = new DeleteForm();
        if (Yii::$app->request->isAjax && $deleteForm->load(Yii::$app->request->post())) {
            if (empty ($errorForm = ActiveForm::validate($deleteForm))) {
                $project = Project::findOne($deleteForm->id);
                if ($project){
                    $project->delete();
                    return true;
                }

            }
        }
        return false;

    }
}