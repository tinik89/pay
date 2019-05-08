<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$request = Yii::$app->request;

?>
<!-- clients titles -->
<div class="clients-titles">

    <!-- title -->
    <div class="m-title">Проекты <?= $clientName ?></div>
    <?php 
    if ($showAddProject) echo '<a href="#" class="add-project-btn">Добавить проект</a>';
    ?>
    <!-- search -->
    <div class="search">
        <input type="text" placeholder="Поиск по проектам"/>
        <button class="search-btn">Поиск</button>
    </div>

</div>

<!-- clients filter -->
<div class="clients-filter">

    <!-- status bts -->
    <div class="status-bts project">
        <?php
        $closeClass  = '';
        $openClass = '';
        $filterData = $request->get('ProjectSearch');
        if (isset($filterData['status']) && $filterData['status'] == 0){
            $closeClass = 'active';
            $status=0;
        } else {
            $openClass = 'active';
            $status=1;
        }
        ?>
        <a href="#" class="status-btn <?=$openClass?>" status="1"><span>Активные</span></a>
        <a href="#" class="status-btn <?=$closeClass?>" status="0"><span>Закрытые</span></a>
    </div>

    <!-- check items -->
    <div class="checkbox-items">
        <?php
        foreach ($tags as $tag) {
            echo '<div class="checkbox-item"><label><input type="checkbox" class="styler" value="' . $tag['id'] . '" checked="checked"/>' . $tag['tag'] . '</label></div>';
        }
        ?>
    </div>

    <!-- date select -->
    <div class="date-select">
        <div class="label">Сортировать:</div>
        <?php
        $checkedDate='';
        $checkedCredit='';
        if($request->get('sort') == '-credit'){
            $checkedCredit = 'selected="selected"';
        } else {
            $checkedDate = 'selected="selected"';
        }
        ?>
        <select class="styler" id="select-sort-id">
            <option value="-date_update" <?=$checkedDate?>>По дате</option>
            <option value="-credit" <?=$checkedCredit?>>По цене</option>
        </select>
    </div>


</div>
<div class="project-search" style="display:none">

    <?php $form = ActiveForm::begin([
        //'action' => ['index'],
        //'action' => yii\helpers\Url::current([], true),
        'method' => 'get',
        'options' => [
            'id' => 'filtering-project-form-id'
        ],
        'fieldConfig' => [
            'template' => "{input}{error}",
        ]
    ]); ?>

    <!--    --><? //= $form->field($model, 'id') ?>
    <!---->
    <?= Html::input('hidden', 'sort', $request->get('sort'), [
        'id' => 'project-sort-id'
    ]) ?>
    <!---->
    <?= $form->field($model, 'tag') ?>
    <!---->
    <!--    --><? //= $form->field($model, 'price') ?>
    <!---->
    <!--    --><? //= $form->field($model, 'date_start') ?>

    <?php // echo $form->field($model, 'client') ?>

    <?php // echo $form->field($model, 'debet') ?>

    <?php // echo $form->field($model, 'credit') ?>

    <?php // echo $form->field($model, 'date_update') ?>
    <?php echo $form->field($model, 'status')->input('hidden', ['value'=>$status]); ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
