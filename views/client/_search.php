<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClientSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$clientsArr = array();
foreach ($clients as $client) {
    $clientsArr[] = ['id' => $client['id'], 'value' => $client['name'],];
}
$clientsJson = json_encode($clientsArr);
$js = <<<js
    var availableTags = $clientsJson;
    $( "#clientsearch-name" ).autocomplete({
        source: availableTags,
        minLength : 0,
        change: function( event, ui){
            // if (ui.item){
            //     $('#transactionform-implementer_id').val(ui.item.id);
            // } else {
            //     $('#transactionform-implementer_id').val('');
            // }
            
        }, 
    });
    
    $('#clientsearch-name').on('focus', function(){
        $(this).autocomplete( "search", "");
    });   
js;

$this->registerJS($js);
?>

<?php
$request = Yii::$app->request;

$closeClass = '';
$openClass = '';
$filterData = $request->get('ClientSearch');
if (isset($filterData['status']) && $filterData['status'] == 0) {
    $closeClass = 'active';
    $status = 0;
} else {
    $openClass = 'active';
    $status = 1;
}
?>
<div class="search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'fieldConfig' => [
            'template' => "{input}",
            'options' => ['tag' => false]
        ],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'id' => 'filtering-client-form-id'
        ],
    ]); ?>

    <?= $form->field($model, 'id')->input('hidden') ?>
    <?= $form->field($model, 'status')->input('hidden', ['value'=>$status]) ?>
    <?= $form->field($model, 'name') ?>

    <?= Html::submitButton('Поиск', ['class' => 'search-btn']) ?>
    <?php ActiveForm::end(); ?>
</div>

<div class="status-bts client">
    <a href="#" class="status-btn <?= $openClass ?>" status="1"><span>Активные</span></a>
    <a href="#" class="status-btn <?= $closeClass ?>" status="0"><span>Закрытые</span></a>
</div>

