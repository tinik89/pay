<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\MultipleInputColumn;

?>
<?php
$implementersArr = array();
foreach ($implementers as $implementer) {
    $implementersArr[] = ['id' => $implementer['id'], 'value' => $implementer['name'],];
}
$implementersJson = json_encode($implementersArr);
$js = <<<js
function implementersCombo (inputCombo) {
   var availableTags = $implementersJson;
    inputCombo.autocomplete({
        source: availableTags,
        change: function( event, ui){
            if (ui.item){
                $(this).parent(".value-creator").siblings(".id-creator").val(ui.item.id);
            } else {
                $(this).parent(".value-creator").siblings(".id-creator").val('');
            }
            $(this).attr('value', $(this).val());
        }, 
    });
}

implementersCombo($( ".value-creator input" ));    
       
js;

$this->registerJS($js);
?>
    <!-- add multi transactions -->
    <div class="add-multi-tr-form white-box" style="display: none;">


        <?php $form = ActiveForm::begin([
            'id' => 'multi-tr-form',
            'options' => [
                'class' => 'charge'
            ],
            'fieldConfig' => [
                'template' => "{input}{error}",
            ],
            //'enableClientValidation' => false,
            //'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'validateOnChange' => false,
            'validateOnSubmit' => true,
            'validateOnBlur' => false,
        ]);

        //
        ?>
        <?php
        $list = array();
        foreach ($clients as $client) {
            $list[$client['id']] = $client['name'];
        }
        ?>

        <?= $form->field($models, 'update_id')->input('hidden', ['value' => time()]) ?>
        <?= $form->field($models, 'manager_id')->input('hidden', ['value' => Yii::$app->user->id]) ?>
        <?= $form->field($models, 'type')->input('hidden', ['value' => 'charge']) ?>


        <div class="tr-tabs tabs">
            <div class="tr-tab-menu tab-menu-form multi">
                <ul>
                    <li ><a href="enrollment">Поступление</a></li>
                    <li class="active"><a href="charge">Списание</a></li>
                </ul>
            </div>
            <?= $form->field($models, 'schedule')->widget(MultipleInput::className(), [
                'max' => 4,
                'rendererClass' => 'unclead\multipleinput\renderers\CustomRenderer',
                'removeButtonOptions' => [
                    'class' => 'delete'
                ],
                'columns' => [
                    [
                        'name' => 'cash',
                        'title' => 'cash',
                        'type' => MultipleInputColumn::TYPE_RADIO_LIST,
                        'columnOptions' => [
                            'class' => 'radio-field'
                        ],
                        'defaultValue' => 1,
                        'items' => [
                            0 => 'Безнал',
                            1 => 'Наличными'
                        ],
                        'options' => [
                            'class' => 'styler ',
                        ]

                    ],
                    [
                        'name' => 'date',
                        'title' => 'date',
                        'type' => MultipleInputColumn::TYPE_HIDDEN_INPUT,
                    ],
                    [
                        'name' => 'datevisible',
                        'title' => 'datevisible',
                        'columnOptions' => [
                            'class' => 'field value-date calendar'
                        ],
                        'options' => [
                            'class' => 'datepicker',
                            'placeholder' => 'Дата'
                        ]
                    ],
                    [
                        'name' => 'price',
                        'title' => 'price',
                        'columnOptions' => [
                            'class' => 'field value-price minus'
                        ],
                        'options' => [
                            'placeholder' => 'Сумма'
                        ]
                    ],
                    [
                        'name' => 'client_id',
                        'title' => 'client_id',
                        'type' => MultipleInputColumn::TYPE_DROPDOWN,
                        'columnOptions' => [
                            'class' => 'field value-name'
                        ],
                        'items' => $list,
                        'options' => [
                            'class' => 'client-combobox-multi',
                            'prompt' => 'Выберите клиента',
                            'placeholder' => 'Выберите клиента'
                        ]
                    ],
                    [
                        'name' => 'project_id',
                        'title' => 'project_id',
                        'type' => MultipleInputColumn::TYPE_DROPDOWN,
                        'columnOptions' => [
                            'class' => 'field value-job'
                        ],
                        'items' => array(),
                        'options' => [
                            'class' => 'project-combobox-multi',
                            'prompt' => 'Выберите проект',
                            'placeholder' => 'Выберите проект'
                        ]
                    ],
                    [
                        'name' => 'implementer',
                        'title' => 'implementer',
                        'options' => [
                            'prompt' => 'Исполнитель',
                            'placeholder' => 'Исполнитель'
                        ],
                        'columnOptions' => [
                            'class' => 'field value-creator'
                        ],
                    ],
                    [
                        'name' => 'implementer_id',
                        'title' => 'implementer_id',
                        'type' => MultipleInputColumn::TYPE_HIDDEN_INPUT,
                        'options' => [
                            'class' => 'field id-creator'
                        ],
                    ],
                ]
            ]);
            ?>


            <div class="tr-tab-item tab-items">

                <div class="tr-tab-item tab-item" id="tr_multi_tab1" style="display: block;">
                    <div class="tr-form">

                        <div class="group-bts">
                            <a href="#" class="add-more-btn">+ Добавить еще платеж</a>
                            <?= Html::submitButton('Сохранить', ['class' => 'submit-btn']); ?>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <?php ActiveForm::end(); ?>


    </div>
<?php
$js = <<< JS
        $('#multi-tr-form').on('afterInit', function(){
            //console.log('calls on after initialization event');
        }).on('beforeAddRow', function(e) {
            //console.log('calls on before add row event');
           // return confirm('Are you sure you want to add row?')
        }).on('afterAddRow', function(e, row) {
            row.find('.project-combobox-multi').combobox();
            row.find(".client-combobox-multi").combobox({
                select: function (event, ui) {
                    getProjectCombobox(ui.item.value, $(this).closest('.value-name').siblings('.value-job').children('select'));
                },
            });
            multiDataPicker();
            $('input.styler, select.styler, .styler input').styler();
            implementersCombo(row.find(".value-creator").children("input"));
        }).on('beforeDeleteRow', function(e, item){
            //console.log(item);
            //console.log('calls on before remove row event');
            //return confirm('Are you sure you want to delete row?')
        }).on('afterDeleteRow', function(e, item){       
            //console.log('calls on after remove row event');
           // console.log('User_id:' + item.find('.list-cell__user_id').find('select').first().val());
        }).on('afterDropRow', function(e, item){       
            //console.log('calls on after drop row', item);
        });
JS;

$this->registerJs($js);