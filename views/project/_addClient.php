<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="nonebox add" id="add-project-popup">
    <!-- edit client -->
    <div class="add-tr-form white-box">
        <? $request = Yii::$app->request; ?>
        <?php $form = ActiveForm::begin([
            'id' => 'new-project-form',
            'action' => Url::to(['/ajax/new-project']),
            'fieldConfig' => [
                'template' => "<div class=\"field\">{input}{error}</div>",
            ],
        ]); ?>

        <?= $form->field($projectForm, 'project_id')->input('hidden') ?>
        <h2 class="hidden-edit">Добавить проект</h2>
        <h2 class="show-edit">Редактировать проект</h2>
        <div class="message"></div>
        <div class="tr-form">
            <label for="favorite_team">Любимая команда:</label>
            <div class="group-col">
                <?= $form->field($projectForm, 'name')->textInput(['placeholder' => 'Название проекта']) ?>
            </div>
            <div class="group-col">
                <?php
                $list = array();
                foreach ($tags as $tag) {
                    $list[$tag['id']] = $tag['tag'];
                }
                ?>
                <?= $form->field($projectForm, 'tag')->dropDownList($list,
                    [
                        'prompt' => 'Выберите категорию',
                        'class' => 'styler'
                    ]); ?>
            </div>
            <div class="group-col">
                <?= $form->field($projectForm, 'price')->textInput(['placeholder' => 'Цена']) ?>
            </div>
            <div class="group-col hidden-edit">
                <?= $form->field($projectForm, 'date_start')->textInput(['placeholder' => 'Дата начала', 'class' => 'datepicker']) ?>
            </div>
            <div class="group-col">
                <?= $form->field($projectForm, 'client')->input('hidden', ['value' => $request->get('id')]) ?>
            </div>

            <div class="group-col hidden-edit">
                <?= Html::submitButton('Добавить', ['class' => 'add-submit-btn', 'name' => 'new-project-button']) ?>
            </div>
            <div class="group-col show-edit">
                <?= Html::submitButton('Обновить', ['class' => 'add-submit-btn', 'name' => 'new-project-button']) ?>
            </div>

        </div>
        <div class="clear"></div>
        <?php ActiveForm::end(); ?>
        <span class="close"></span>
    </div>

</div>