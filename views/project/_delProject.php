<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<!-- Delete alert Popup -->
<div class="nonebox add" id="del-client-popup">
    <!-- edit client -->
    <div class="add-tr-form white-box">
        <?php $form = ActiveForm::begin([
            'id' => 'del-form',
            'action' => Url::to(['/ajax/remove-form']),
            'fieldConfig' => [
                'template' => "<div class=\"field\">{input}{error}</div>",
            ],
        ]); ?>
        <h2>Удалить проект <span></span>?</h2>
        <div class="tr-form">
            <?= $form->field($deleteForm, 'object')->input('hidden', ['value' => 'project']) ?>
            <?= $form->field($deleteForm, 'id')->input('hidden', ['id' => 'id-del-object']) ?>

            <div class="group-col">
                <?= Html::submitButton('Удалить', ['class' => 'add-submit-btn', 'name' => 'del-client-button']) ?>
                <?= Html::button('Отмена', ['class' => 'cancel-submit-btn', 'name' => 'cancel-client-button']) ?>
            </div>

        </div>
        <div class="clear"></div>
        <?php ActiveForm::end(); ?>
        <span class="close"></span>
    </div>

</div>