<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TransactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-search" style="display:none;">

    <?php $form = ActiveForm::begin([
        'action' => ['transactions'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'date') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
