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
<div class="clients-filter project-search">
    <?php $form = ActiveForm::begin([
        'action' => '?',
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
            'id' => 'filtering-project-form-id'
        ],
        'fieldConfig' => [
            'template' => "{input}{error}",
            'options' => [
                'tag' => false,
            ],
        ]
    ]); ?>
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
        $inputListBox = [];
        foreach ($tags as $tag) {
            $inputListBox[$tag['id']]=$tag['tag'];
        }
        //echo '<div class="checkbox-item"><label>' . $form->field($model, 'tag[]')->checkboxlist($inputListBox).'</label></div>';
        ?>


        <?= $form->field($model, 'tag')->checkboxList($inputListBox, [
            'item' => function($index, $label, $name, $checked, $value) {
                if($checked == 1){
                    $checked = 'checked="$checked"';
                }
                return "<div class='checkbox-item' checked='{$checked}'><label ><input type='checkbox' class='styler' {$checked} name='{$name}' value='{$value}'>{$label}</label></div>";
            },
            'tag' => false
        ]); ?>
        <?= Html::submitButton('Фильтр', ['class' => 'search-btn']) ?>
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

    <?= Html::input('hidden', 'sort', $request->get('sort'), [
        'id' => 'project-sort-id'
    ]) ?>


    <?php echo $form->field($model, 'status')->input('hidden', ['value'=>$status]); ?>


    <?php ActiveForm::end(); ?>
</div>
