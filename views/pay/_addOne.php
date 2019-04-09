<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php
$implementersArr = array();
foreach ($implementers as $implementer) {
    $implementersArr[] = ['id' => $implementer['id'], 'value' => $implementer['name'],];
}
$implementersJson = json_encode($implementersArr);
$js = <<<js
    var availableTags = $implementersJson;
    $( "#transactionform-implementer" ).autocomplete({
        source: availableTags,
        minLength : 0,
        change: function( event, ui){
            if (ui.item){
                $('#transactionform-implementer_id').val(ui.item.id);
            } else {
                $('#transactionform-implementer_id').val('');
            }
            
        }, 
    });
    
    $('#transactionform-implementer').on('focus', function(){
        $(this).autocomplete( "search", "");
    });   
js;

$this->registerJS($js);
?>
<!-- add transactions -->
<div class="add-tr-form white-box" <?php if (empty($errorForm)) {
    echo 'style="display: none;"';
} ?> >

    <?php $form = ActiveForm::begin([
        'id' => 'tr-form',
        'fieldConfig' => [
            'template' => "{input}{error}",
        ],
        //'enableClientValidation' => false,
    ]); ?>
    <div class="calendar">
        <div id="datepicker_inline"></div>
    </div>
    <?= $form->field($model, 'date')->input('hidden', ['value' => time()]) ?>
    <?= $form->field($model, 'manager_id')->input('hidden', ['value' => Yii::$app->user->id]) ?>
    <div class="tr-tabs tabs">
        <div class="tr-tab-menu tab-menu-form one">
            <ul>
                <li class="active"><a href="enrollment">Поступление</a></li>
                <li><a href="charge">Списание</a></li>
            </ul>
        </div>
        <div class="tr-tab-item tab-items">

            <fieldset class="tr-tab-item tab-item" id="tr_tab1" style="display: block;">
                <?= $form->field($model, 'type')->input('hidden', ['value' => 'enrollment']) ?>
                <div class="tr-form">
                    <div class="group-col">
                        <div class="field value-price">
                            <?= $form->field($model, 'price')->textInput(['placeholder' => 'Сумма']) ?>
                        </div>

                        <div class="field">
                            <?php
                            $list = array();
                            foreach ($clients as $client) {
                                $list[$client['id']] = $client['name'];
                            }
                            ?>
                            <?= $form->field($model, 'client_id')->dropDownList($list,
                                [
                                    'prompt' => 'Выберите клиента',
                                    'placeholder' => 'Выберите клиента'
                                ]); ?>
                        </div>

                        <div class="field">
                            <?= $form->field($model, 'project_id')->dropDownList(array(),
                                [
                                    'prompt' => 'Проект',
                                    'placeholder' => 'Выберите проект'
                                ]); ?>
                        </div>

                        <div class="field implementer" style="display:none;">
                            <?= $form->field($model, 'implementer')->textInput(['placeholder' => 'Сотрудник','value' => '|-']) ?>
                            <?= $form->field($model, 'implementer_id')->input('hidden', ['value' => '']) ?>
                        </div>
                        <div class="radio-field">
                            <?php
                            $model->cash = 0;
                            ?>
                            <?= $form->field($model, 'cash')->radioList(
                                [
                                    0 => 'Безнал',
                                    1 => 'Наличными'
                                ],
                                [
                                    'item' => function ($index, $label, $name, $checked, $value) {
                                        return
                                            '<label>' . Html::radio($name, $checked, ['value' => $value, 'class' => 'styler cash'.$value]) . $label . '</label>';
                                    },
                                ]
                            )->label();
                            ?>
                        </div>
                    </div>
                    <div class="group-col">
                        <div class="field">
                            <?= $form->field($model, 'comment')->textarea(['placeholder' => 'Комментарий']) ?>
                        </div>
                    </div>
                    <div class="group-bts">
                        <?= Html::submitButton('Добавить', ['class' => 'submit-btn']) ?>
                        <a href="#" class="cancel-btn">Отмена</a>
                    </div>
                </div>
            </fieldset>


        </div>
    </div>
    <div class="clear"></div>
    <?php ActiveForm::end(); ?>
</div>