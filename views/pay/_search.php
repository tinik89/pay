<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TransactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="transaction-search tr-filter-group" <!--style="display:block;"-->>

<?php $form = ActiveForm::begin([
    'action' => ['transactions'],
    'method' => 'get',
    'fieldConfig' => [
        'template' => "{input}",
        'options' => [
            'class' => 'field'
        ]
    ],
]); ?>
<div class="field">
<?//= Html::input('text', 'date_from_visible', '', ['placeholder' => 'дата от', 'class' => 'datepicker_filter'])?>
<?= Html::activeTextInput($model, 'date_from_visible', ['type' => 'text', 'tag' => false,'placeholder' => 'дата от', 'class' => 'datepicker_filter']); ?>
<?= Html::activeTextInput($model, 'date_from', ['type' => 'hidden', 'tag' => false]); ?>
</div>


<div class="field">
<!--    --><?//= Html::input('text', 'date_to_visible', '', ['placeholder' => 'дата до', 'class' => 'datepicker_filter'])?>
    <?= Html::activeTextInput($model, 'date_to_visible', ['type' => 'text', 'tag' => false, 'placeholder' => 'дата до', 'class' => 'datepicker_filter to']); ?>
    <?= Html::activeTextInput($model, 'date_to', ['type' => 'hidden', 'tag' => false]); ?>
</div>


<?= $form->field($model, 'client_id')->dropDownList($clientList,
    [
        'prompt' => 'Выберите клиента',
        'placeholder' => 'Выберите клиента',
    ]); ?>

<?= $form->field($model, 'implementer')->dropDownList($implementerList,
    [
        'prompt' => 'Выберите исполнителя',
        'placeholder' => 'Выберите исполнителя',
    ]); ?>



<?= $form->field($model, 'type')->dropDownList([
    'enrollment' => 'Поступления',
    'charge' => 'Cписания',
],
    [
        'prompt' => 'Пост./Спис.',
        'placeholder' => 'Пост./Спис.',
        'class' => 'styler'
    ]); ?>

    <?= Html::submitButton('Применить', ['class' => 'submit-btn']) ?>


<?php ActiveForm::end(); ?>

</div>
