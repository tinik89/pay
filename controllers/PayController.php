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
use app\models\forms\TransactionForm;
use app\models\forms\TransactionMultiForm;
use app\models\Implementer;
use Yii;
use app\models\Transaction;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\TransactionSearch;
use yii\widgets\ActiveForm;

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

    public function actionTransactions(){
        $this->view->title = 'ТРАНЗАКЦИИ | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);

        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $errorFormMulti = '';
        $errorFormOne = '';
        $addForm = new TransactionForm();
        $addForms = new TransactionMultiForm();

        //var_dump(Yii::$app->request->post());
        $formData = Yii::$app->request->post();

        if (isset($formData['TransactionMultiForm'])) {
            if ($addForms->load(Yii::$app->request->post())) {
                if (empty ($errorFormMulti = ActiveForm::validate($addForms))) {

                    foreach($addForms->schedule as $array){
                        $transaction = new Transaction();

                        $transaction->manager_id = $addForms->manager_id;
                        $transaction->update_id = $addForms->update_id;
                        $transaction->type = $addForms->type;

                        $transaction->client_id = $array['client_id'];
                        $transaction->project_id = $array['project_id'];
                        $transaction->price = $array['price'];
                        $transaction->cash = $array['cash'];
                        $transaction->date = $array['date'];
                        if (!empty($array['implementer_id']) && isset($array['implementer_id'])) {
                            $transaction->implementer = $array['implementer_id'];
                        } elseif (!empty($array['implementer']) && isset($array['implementer']) && $array['implementer'] != '|-') {
                            $newImplementer = new Implementer();
                            $newImplementer->name = $array['implementer'];
                            if ($newImplementer->save()) {// -------------------------------------------обработать случай если не прошел валидацию новый исполнитель
                                $transaction->implementer = $newImplementer->id;
                            }
                        }

                        if ($transaction->save(false)) {
                            Yii::$app->session->setFlash('success', 'Транзакция успешно добавлена.');
                            $project = $transaction->project;
                            if ($transaction->type == 'charge') {//списание
                                $project->debet = $project->debet - $transaction->price;
                               // $project->credit = $project->credit + $transaction->price; списания не должны учитываться в долге
                            } else {//поступление
                                $project->debet = $project->debet + $transaction->price;
                                $project->credit = $project->credit - $transaction->price;
                            }
                            $project->date_update = time();
                            $project->save();
                           // return $this->refresh();
                        }
                    }


                } 
            }
        } else {
            if ($addForm->load(Yii::$app->request->post())) {
                if (empty ($errorFormOne = ActiveForm::validate($addForm))) {

                    $transaction = new Transaction();
                    $transaction->client_id = $addForm->client_id;
                    $transaction->project_id = $addForm->project_id;
                    $transaction->price = $addForm->price;
                    $transaction->cash = $addForm->cash;
                    $transaction->type = $addForm->type;
                    $transaction->date = $addForm->date;
                    $transaction->comment = $addForm->comment;
                    $transaction->manager_id = $addForm->manager_id;
                    $transaction->update_id = $addForm->update_id;
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
                        Yii::$app->session->setFlash('success', 'Транзакция успешно добавлена.');
                        $project = $transaction->project;
                        if ($transaction->type == 'charge') {//списание
                            $project->debet = $project->debet - $transaction->price;
                           // $project->credit = $project->credit + $transaction->price; списания не должны учитываться в долге
                        } else {//поступление
                            $project->debet = $project->debet + $transaction->price;
                            $project->credit = $project->credit - $transaction->price;
                        }
                        $project->date_update = time();
                        $project->save();
                        return $this->refresh();
                    }
                }
            }
        }

//        Yii::$app->db->createCommand()->batchInsert('client', ['name'], [
//            ['Tom'],
//            ['Jane'],
//            ['Linda'],
//        ])->execute();


        $transaction = Transaction::find()->with('project', 'client', 'implementerinfo')->orderBy(['date' => SORT_DESC])->all();

        $deleteForm = new DeleteForm();

        
        return $this->render('transaction', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'addForm' => $addForm,
            'addForms' => $addForms,
            'errorFormMulti' => $errorFormMulti,
            'errorFormOne' => $errorFormOne,
            'clients' => Client::find()->asArray()->all(),
            'implementers' => Implementer::find()->asArray()->all(),
            'transaction' => $transaction,
            'deleteForm' => $deleteForm,
        ]);
        
    }
}