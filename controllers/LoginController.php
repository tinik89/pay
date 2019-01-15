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
use app\models\forms\LoginForm;

class LoginController extends Controller
{



    public function actionIndex()
    {
        $this->view->title = 'ВХОД | Платежка';
        $this->view->registerMetaTag(['name'=>'description', 'content'=>'']);
        $this-> layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('index', [
            'model' => $model,
        ]);
        
    }
}