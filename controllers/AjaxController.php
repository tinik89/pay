<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 16.01.2019
 * Time: 22:45
 */

namespace app\controllers;

use app\models\forms\DeleteForm;
use app\models\Implementer;
use app\models\Transaction;
use Yii;
use yii\base\Controller;
use app\models\Client;
use app\models\forms\ClientForm;
use app\models\Project;
use app\models\forms\ProjectForm;
use yii\widgets\ActiveForm;
use app\models\forms\TransactionForm;


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
                    $client->status = 0;
                    $client->save(false);
                    return json_encode(['add' => $client -> id]);
                }
            }
        }
        return false;

    }
    
    public function actionGetProject () {// получение проектов в выпадающие списки
        if (Yii::$app->request->isAjax) {
            $request = Yii::$app->request;
            $projects = Project::find()->where(['client' => $request->post('client'), 'status' => '1'])->asArray()->all();

            return json_encode($projects);
        }
        return false;

    }

    public function actionNewProject () {
        $projectForm = new ProjectForm();
        if (Yii::$app->request->isAjax && $projectForm->load(Yii::$app->request->post())) {
            if (!empty ($errorForm = ActiveForm::validate($projectForm))) {
                //return json_encode(['error'=>$errorForm["projectform-name"][0]]);
                return json_encode(['error'=>$errorForm]);
            } else {
                if(isset($projectForm->project_id) && !empty($projectForm->project_id)){
                    $project = Project::findOne($projectForm->project_id);
                    $project->credit = $project->credit - ($project->price - $projectForm->price);
                    $successArr = ['edit' => 'Проект обнавлен'];
                } elseif(Project::find()->where(['name' => $projectForm->name,'client' => $projectForm->client])->exists()){
                    return json_encode(['error'=>'У данного клиента уже существует, проект с таким названием ']);
                } else {
                    $project = new Project();
                    $project->debet = 0;
                    $project->status = 1;
                    $project->credit = $projectForm->price;
                    $successArr = ['add' => 'Проект добавлен'];
                }

                $dateArr = explode('/', $projectForm->date_start);
                $project->date_start = strtotime($dateArr[1].'/'.$dateArr[0].'/'.$dateArr[2]);
                $project->name = $projectForm->name;
                $project->tag = $projectForm->tag;
                $project->price = $projectForm->price;
                $project->date_update = time();
                $project->client = $projectForm->client;

                if ($project->save(false)){
                    $client = Client::findOne($project -> client);
                    if( $client ->status != 1){
                        $client ->status = 1;
                        $client -> save();
                    }
                }
                return json_encode($successArr);
                
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
                        $project = Project::findOne($modelDel->project_id);
                        if ($modelDel->type == 'charge') {//списание
                            $project->debet = $project->debet + $modelDel->price;
                            //$project->credit = $project->credit - $modelDel->price; списания не должны учитываться в долге
                        } else {//поступление
                            $project->debet = $project->debet - $modelDel->price;
                            $project->credit = $project->credit + $modelDel->price;
                        }
                        $project->date_update = time();
                        $project->save();
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



    public function actionAddTransaction () {

        $addForm = new TransactionForm();
        if (Yii::$app->request->isAjax && $addForm->load(Yii::$app->request->post())) {
            if (empty ($errorForm = ActiveForm::validate($addForm))) {

                    if (isset($addForm->transaction_id) && !empty($addForm->transaction_id)){
                        $transaction = Transaction::findOne($addForm->transaction_id);
                        $successArr = ['edit' => 'Транзакция обнавлена'];
                        $oldPrice = $transaction->price;
                        $oldType = $transaction->type;
                    } else {
                        $transaction = new Transaction();
                        $successArr = ['add' => 'Транзакция добавлена'];
                    }

                    $transaction->client_id = $addForm->client_id;
                    $transaction->project_id = $addForm->project_id;
                    $transaction->price = $addForm->price;
                    $transaction->cash = $addForm->cash;
                    $transaction->type = $addForm->type;
                    $transaction->date = $addForm->date;
                    $transaction->comment = $addForm->comment;
                    $transaction->manager_id = $addForm->manager_id;
                    //$transaction->update_id = $addForm->update_id;
                    if (!empty($addForm->implementer_id) && isset($addForm->implementer_id)) {
                        $transaction->implementer = $addForm->implementer_id;
                    } elseif (!empty($addForm->implementer) && isset($addForm->implementer) && $addForm->implementer != '|-') {
                        $newImplementer = new Implementer();
                        $newImplementer->name = $addForm->implementer;
                        if ($newImplementer->save()) {// -------------------------------------------обработать случай если не прошел валидацию новый исполнитель
                            $transaction->implementer = $newImplementer->id;
                        }
                    }



                    if ($transaction->save(false)) {
                        $project = $transaction->project;
                        if (isset($addForm->transaction_id) && !empty($addForm->transaction_id)){ // если транзакция обнавляется - откатываем старую
                            if ($oldType == 'charge') {
                                $project->debet = $project->debet + $oldPrice;
                                //$project->credit = $project->credit + $transaction->price; списания не должны учитываться в долге
                            } else {//поступление
                                $project->debet = $project->debet - $oldPrice;
                                $project->credit = $project->credit + $oldPrice;
                            }
                        }
                        if ($transaction->type == 'charge') {//списание
                            $project->debet = $project->debet - $transaction->price;
                            //$project->credit = $project->credit + $transaction->price; списания не должны учитываться в долге
                        } else {//поступление
                            $project->debet = $project->debet + $transaction->price;
                            $project->credit = $project->credit - $transaction->price;
                        }

                        $project->date_update = time();
                        $project->save();
                        return json_encode($successArr);
                    }


            } else {
                return json_encode($errorForm);
            }
        }
        return false;

    }

    public function actionInfoProject(){
        if (Yii::$app->request->isAjax) {
            $request = Yii::$app->request;
            $projects = Project::find()->where(['id' => $request->post('project')])->asArray()->all();
            return json_encode($projects);
        }
        return false;
    }

    public function actionStatusProject(){
        $outputArr['edit'] = -1; 
        if (Yii::$app->request->isAjax) {
            $request = Yii::$app->request;
            $project = Project::findOne($request->post('project'));
            if ( $project -> status != $request->post('status')){
                $project -> status = $request->post('status');
                if($project -> save()){
                    $outputArr['edit'] = 1;
                } else {
                    $outputArr['edit'] = -1;
                }
                
            } else {
                $outputArr['edit'] = 0;
            }

            $client = Client::findOne($project -> client);

            if ($project -> status == 1){
                $outputArr['msg']='Закрыть';
                if ($client->status != 1) {
                    $client->status = 1;
                    $client->save();
                }
            } else {
                $outputArr['msg']='Открыть';
                $projectsClient = Project::find()->where(['client' => $project -> client, 'status' => 1])->asArray()->all();
                if (empty($projectsClient)){
                    $client->status = 0;
                    $client -> save();
                }
            }

        }
        return json_encode($outputArr);
    }

//    public function actionRemoveProject () {
//        $deleteForm = new DeleteForm();
//        if (Yii::$app->request->isAjax && $deleteForm->load(Yii::$app->request->post())) {
//            if (empty ($errorForm = ActiveForm::validate($deleteForm))) {
//                $project = Project::findOne($deleteForm->id);
//                if ($project){
//                    $project->delete();
//                    return true;
//                }
//
//            }
//        }
//        return false;
//
//    }
}