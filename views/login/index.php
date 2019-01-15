<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>
<div class="container">
    <div class="latest-tr-filter">
        <!-- title -->


        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "<div class=\"field\">{input}{error}</div>",
                'options' => [
                    'tag' => false
                ]
            ],
        ]); ?>
        <h1 class="m-title">Авторизация</h1>
        <div class="tr-filter-group">
            <?= $form->field($model, 'username')->textInput(['placeholder' => 'Логин', 'autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"remember\">{input} {label}</div>",
                'class' => "styler",
            ])->label('Запомнить меня.') ?>



            <!--div class="checkbox-items">
                <div class="checkbox-item">
                    <label><input type="checkbox" class="styler" />Маркетинг</label>
                </div>
            </div-->

            <?= Html::submitButton('Войти', ['class' => 'submit-btn', 'name' => 'login-button']) ?>


        </div>
        <?php ActiveForm::end(); ?>


    </div>
</div>
