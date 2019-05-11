<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\components\DeleteWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<!-- wrapper -->
<div class="wrapper">

    <?php Pjax::begin(); ?>
    <!-- clients titles -->
    <div class="clients-titles">

        <!-- title -->
        <div class="m-title">Клиенты</div>
        <a href="#" class="add-client-btn">Добавить клиента</a>
        <!-- search -->
       
        <?php echo $this->render('_search', [
            'model' => $searchModel,
            'clients' => $clients
        ]); ?>
    </div>
    

    
    <!-- clients items -->
    <div class="clients-items">

        <div class="clients-item">
            <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['tag' => false],
                'itemView' => '_oneClientList',
//                  'itemOptions' => [ ],
                'options' => [

//                        'tag' => 'table',
//                        'class' => 'list-view'
                    'tag' => false

                ],
                'summary' => false,
                'layout' => '<table class="list-view"><tr><th>Клиент</th><th>Баланс</th><th>Долг</th><th></th></tr>{items}</table>{pager}',
//        'viewParams' => [
//            'implementers' => array_column($implementers, 'name', 'id'),
//        ]

            ]);

            ?>

            
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
<!-- Footer -->
<div class="footer">

</div>

<!-- Popups -->
<div class="popups_group">
    <div class="overlay"></div>


    <!-- ADD Client Popup -->
    <div class="nonebox add" id="add-client-popup">
        <!-- edit client -->
        <div class="add-tr-form white-box">
            <?php $form = ActiveForm::begin([
                'id' => 'new-client-form',
                'action' => Url::to(['/ajax/new-client']),
                'fieldConfig' => [
                    'template' => "<div class=\"field\">{input}{error}</div>",
                ],
            ]); ?>
            <h2>Создать клиента</h2>
            <div class="tr-form">
                <div class="group-col">
                    <?= $form->field($clientForm, 'name')->textInput(['placeholder' => 'Клиент']) ?>
                </div>

                <div class="group-col">
                    <?= Html::submitButton('Добавить', ['class' => 'add-submit-btn', 'name' => 'new-client-button']) ?>
                </div>

            </div>
            <div class="clear"></div>
            <?php ActiveForm::end(); ?>
            <span class="close"></span>
        </div>

    </div>

    <!-- Delete alert Popup -->
    <?php
    echo DeleteWidget::widget(['deleteForm' => $deleteForm]);
    ?>

</div>


