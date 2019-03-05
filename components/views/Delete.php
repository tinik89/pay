<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 04.03.2019
 * Time: 20:00
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
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
<h2 class="title client">Удалить клиента <span></span>?</h2>
<h2 class="title project">Удалить проект <span></span>?</h2>
<h2 class="title transaction">Удалить транзакцию <span></span>?</h2>
<div class="tr-form">
    <?= $form->field($deleteForm, 'object')->input('hidden', ['id' => 'type-del-object']) ?>
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