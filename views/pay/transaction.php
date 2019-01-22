<?php
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

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
        change: function( event, ui){
            if (ui.item){
                $('#transactionform-implementer_id').val(ui.item.id);
            } else {
                $('#transactionform-implementer_id').val('');
            }
            
        }, 
    });
    
       
js;

$this->registerJS($js);
?>
<!-- wrapper -->
<div class="wrapper">

    <!-- content add transactions -->
    <div class="white-box add-tr-box">
        <div class="add-tr-group">
            Добавить <a href="#" class="one-tr-btn">одну транзакцию</a> или <a href="#" class="multi-tr-btn">несколько
                транзакций</a>
            <?php if (Yii::$app->session->hasFlash('success')) {
                echo '<div class="successAdd">' . Yii::$app->session->getFlash('success') . '</div>';
            }
            ?>

        </div>
    </div>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>


<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            //'id',
//            //'client_id',
//            'project_id',
//            //'price',
//            'date',
//            'type',
//            'implementer',
//            //'comment',
//            //'update_id',
//            //'manager_id',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>
    <!-- add transactions -->
    <div class="add-tr-form white-box" <?php if (empty($errorForm)) {
        echo 'style="display: none;"';
    } ?> >

        <?php $form = ActiveForm::begin([
            'id' => 'tr-form',
            'fieldConfig' => [
                'template' => "{input}{error}",
            ],
            'enableClientValidation' => false,
        ]); ?>
        <div class="calendar">
            <div id="datepicker_inline"></div>
        </div>
        <?= $form->field($addForm, 'date')->input('hidden', ['value' => time()]) ?>
        <?= $form->field($addForm, 'manager_id')->input('hidden', ['value' => Yii::$app->user->id]) ?>
        <div class="tr-tabs tabs">
            <div class="tr-tab-menu tab-menu-form">
                <ul>
                    <li class="active"><a href="enrollment">Поступление</a></li>
                    <li><a href="charge">Списание</a></li>
                </ul>
            </div>
            <div class="tr-tab-item tab-items">

                <fieldset class="tr-tab-item tab-item" id="tr_tab1" style="display: block;">
                    <?= $form->field($addForm, 'type')->input('hidden', ['value' => 'enrollment']) ?>
                    <div class="tr-form">
                        <div class="group-col">
                            <div class="field value-price">
                                <?= $form->field($addForm, 'price')->textInput(['placeholder' => 'Сумма']) ?>
                            </div>

                            <div class="field">
                                <?php
                                $list = array();
                                foreach ($clients as $client) {
                                    $list[$client['id']] = $client['name'];
                                }
                                ?>
                                <?= $form->field($addForm, 'client_id')->dropDownList($list,
                                    [
                                        'prompt' => 'Выберите клиента',
                                        'placeholder' => 'Выберите клиента'
                                    ]); ?>
                            </div>

                            <div class="field">
                                <?= $form->field($addForm, 'project_id')->dropDownList(array(),
                                    [
                                        'prompt' => 'Проект',
                                        'placeholder' => 'Выберите проект'
                                    ]); ?>
                            </div>

                            <div class="field implementer" style="display:none;">
                                <?= $form->field($addForm, 'implementer')->textInput(['placeholder' => 'Сотрудник']) ?>
                                <?= $form->field($addForm, 'implementer_id')->input('hidden', ['value' => '']) ?>
                            </div>
                            <div class="radio-field">
                                <?php
                                $addForm->cash = 1;
                                ?>
                                <?= $form->field($addForm, 'cash')->radioList(
                                    [
                                        0 => 'Безнал',
                                        1 => 'Наличными'
                                    ],
                                    [
                                        'item' => function ($index, $label, $name, $checked, $value) {
                                            return
                                                '<label>' . Html::radio($name, $checked, ['value' => $value, 'class' => 'styler']) . $label . '</label>';
                                        },
                                    ]
                                )->label();
                                ?>
                            </div>
                        </div>
                        <div class="group-col">
                            <div class="field">
                                <?= $form->field($addForm, 'comment')->textarea(['placeholder' => 'Комментарий']) ?>
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

    <!-- add multi transactions -->
    <div class="add-multi-tr-form white-box" style="display: none;">
        <form id="multi-tr-form" method="post">
            <div class="tr-tabs tabs">
                <div class="tr-tab-menu tab-menu">
                    <ul>
                        <li class="active"><a href="#tr_multi_tab1">Поступление</a></li>
                        <li><a href="#tr_multi_tab2">Списание</a></li>
                    </ul>
                </div>
                <div class="tr-tab-item tab-items">

                    <div class="tr-tab-item tab-item" id="tr_multi_tab1" style="display: block;">
                        <div class="tr-form">
                            <div class="group-col">
                                <span class="delete"></span>
                                <div class="radio-field">
                                    <label><input type="radio" class="styler" name="nal" checked/>Безнал</label>
                                    <label><input type="radio" class="styler" name="nal"/>Наличными</label>
                                </div>
                                <div class="field value-date calendar">
                                    <input type="text" name="date" class="datepicker" value="01/01/2019"/>
                                </div>
                                <div class="field value-price">
                                    <input type="text" name="price" value="10000000"/>
                                </div>
                                <div class="field value-name">
                                    <input type="text" name="name" placeholder="Название проекта"/>
                                </div>
                                <div class="field value-job">
                                    <input type="text" name="job" placeholder="Работа проекта"/>
                                </div>
                                <div class="field value-creator">
                                    <input type="text" name="creator" placeholder="Исполнитель"/>
                                </div>
                            </div>
                            <div class="group-col">
                                <span class="delete"></span>
                                <div class="radio-field">
                                    <label><input type="radio" class="styler" name="nal_2" checked/>Безнал</label>
                                    <label><input type="radio" class="styler" name="nal_2"/>Наличными</label>
                                </div>
                                <div class="field value-date calendar">
                                    <input type="text" name="date" class="datepicker" value="01/01/2019"/>
                                </div>
                                <div class="field value-price">
                                    <input type="text" name="price" value="10000000"/>
                                </div>
                                <div class="field value-name">
                                    <input type="text" name="name" placeholder="Название проекта"/>
                                </div>
                                <div class="field value-job">
                                    <input type="text" name="job" placeholder="Работа проекта"/>
                                </div>
                                <div class="field value-creator">
                                    <input type="text" name="creator" placeholder="Исполнитель"/>
                                </div>
                            </div>
                            <div class="group-col">
                                <span class="delete"></span>
                                <div class="radio-field">
                                    <label><input type="radio" class="styler" name="nal_3" checked/>Безнал</label>
                                    <label><input type="radio" class="styler" name="nal_3"/>Наличными</label>
                                </div>
                                <div class="field value-date calendar">
                                    <input type="text" name="date" class="datepicker" value="01/01/2019"/>
                                </div>
                                <div class="field value-price">
                                    <input type="text" name="price" value="10000000"/>
                                </div>
                                <div class="field value-name">
                                    <input type="text" name="name" placeholder="Название проекта"/>
                                </div>
                                <div class="field value-job">
                                    <input type="text" name="job" placeholder="Работа проекта"/>
                                </div>
                                <div class="field value-creator">
                                    <input type="text" name="creator" placeholder="Исполнитель"/>
                                </div>
                            </div>
                            <div class="group-bts">
                                <a href="#" class="add-more-btn">+ Добавить еще платеж</a>
                                <input type="submit" class="submit-btn" value="Сохранить"/>
                            </div>
                        </div>
                    </div>

                    <div class="tr-tab-item tab-item" id="tr_multi_tab2" style="display: none;">
                        <div class="tr-form">
                            <div class="group-col">
                                <span class="delete"></span>
                                <div class="radio-field">
                                    <label><input type="radio" class="styler" name="nal_4" checked/>Безнал</label>
                                    <label><input type="radio" class="styler" name="nal_4"/>Наличными</label>
                                </div>
                                <div class="field value-date calendar">
                                    <input type="text" name="date" class="datepicker" value="01/01/2019"/>
                                </div>
                                <div class="field value-price">
                                    <input type="text" name="price" value="10000000"/>
                                </div>
                                <div class="field value-name">
                                    <input type="text" name="name" placeholder="Название проекта"/>
                                </div>
                                <div class="field value-job">
                                    <input type="text" name="job" placeholder="Работа проекта"/>
                                </div>
                                <div class="field value-creator">
                                    <input type="text" name="creator" placeholder="Исполнитель"/>
                                </div>
                            </div>
                            <div class="group-col">
                                <span class="delete"></span>
                                <div class="radio-field">
                                    <label><input type="radio" class="styler" name="nal_5" checked/>Безнал</label>
                                    <label><input type="radio" class="styler" name="nal_5"/>Наличными</label>
                                </div>
                                <div class="field value-date calendar">
                                    <input type="text" name="date" class="datepicker" value="01/01/2019"/>
                                </div>
                                <div class="field value-price">
                                    <input type="text" name="price" value="10000000"/>
                                </div>
                                <div class="field value-name">
                                    <input type="text" name="name" placeholder="Название проекта"/>
                                </div>
                                <div class="field value-job">
                                    <input type="text" name="job" placeholder="Работа проекта"/>
                                </div>
                                <div class="field value-creator">
                                    <input type="text" name="creator" placeholder="Исполнитель"/>
                                </div>
                            </div>
                            <div class="group-col">
                                <span class="delete"></span>
                                <div class="radio-field">
                                    <label><input type="radio" class="styler" name="nal_6" checked/>Безнал</label>
                                    <label><input type="radio" class="styler" name="nal_6"/>Наличными</label>
                                </div>
                                <div class="field value-date calendar">
                                    <input type="text" name="date" class="datepicker" value="01/01/2019"/>
                                </div>
                                <div class="field value-price">
                                    <input type="text" name="price" value="10000000"/>
                                </div>
                                <div class="field value-name">
                                    <input type="text" name="name" placeholder="Название проекта"/>
                                </div>
                                <div class="field value-job">
                                    <input type="text" name="job" placeholder="Работа проекта"/>
                                </div>
                                <div class="field value-creator">
                                    <input type="text" name="creator" placeholder="Исполнитель"/>
                                </div>
                            </div>
                            <div class="group-bts">
                                <a href="#" class="add-more-btn">+ Добавить еще платеж</a>
                                <input type="submit" class="submit-btn" value="Сохранить"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="clear"></div>
        </form>
    </div>

    <!-- latest transactions filter -->
    <div class="latest-tr-filter">

        <!-- title -->
        <div class="m-title">Последние транзакции</div>

        <!-- transactions group -->
        <div class="tr-filter-group">

            <div class="field">
                <input type="text" class="datepicker" placeholder="Дата"/>
            </div>

            <div class="field">
                <input type="text" placeholder="Поиск по проектам"/>
            </div>

            <div class="field">
                <input type="text" placeholder="Поступления/списания"/>
            </div>

            <div class="field">
                <input type="text" placeholder="Поиск по людям"/>
            </div>

            <button class="submit-btn">Применить</button>

        </div>

    </div>

    <!-- transactions items -->
    <div class="trans-items">
        <?php
        $beginOfDay = 0;

        foreach ($transaction as $transaction):

            $curDate = Yii::$app->formatter->asDate($transaction->date, 'd MMMM');
            $curDay = Yii::$app->formatter->asDate($transaction->date, 'EEEE');
            if ($beginOfDay == 0) {
                $beginOfDay = strtotime("midnight", $transaction->date);
                $beginTable = '<div class="trans-col"><div class="title">' . $curDate . '<span>' . $curDay . '</span></div><div class="trans-item"> <table>';
            } else if ($transaction->date < $beginOfDay) {
                $beginOfDay = strtotime("midnight", $transaction->date);
                $beginTable = '</table></div></div><div class="trans-col"><div class="title">' . $curDate . '<span>' . $curDay . '</span></div><div class="trans-item"> <table>';

            } else {
                $beginTable = '';
            } ?>

            <?= $beginTable ?>

            <tr>
                <td>
                    <div class="date"><?= $curDate ?><span><?= $curDay ?></span></div>
                </td>
                <td>
                    <a href="<?= Url::to(['project/show', 'id' => $transaction->client_id]) ?>"
                       class="name"><?= $transaction->client->name ?></a>
                    <div class="category"><?= $transaction->project->name ?></div>
                </td>
                <td>
                    <div class="price"><?php if ($transaction->type == 'enrollment') {
                            echo '+';
                        } else {
                            echo '-';
                        } ?> <?= $transaction->price ?> ₽
                    </div>
                </td>
                <td>
                    <div class="method"><?php if ($transaction->cash == 1) {
                            echo 'Наличный';
                        } else {
                            echo 'Безналичный';
                        } ?></div>
                </td>
                <td>
                    <div class="info"><?= $transaction->comment ?></div>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php $endTable = '</table></div> </div>'; ?>
        <?= $endTable ?>


    </div>

</div>

<!-- Footer -->
<div class="footer">

</div>

<!-- Popups -->
<div class="popups_group">
    <div class="overlay"></div>

    <!-- Edit Client Popup -->
    <div class="nonebox" id="edit-client-popup">
        <!-- edit client -->
        <div class="add-tr-form white-box">
            <form id="tr-form" method="post">
                <div class="calendar">
                    <div id="datepicker_inline"></div>
                </div>
                <div class="tr-tabs tabs">
                    <div class="tr-tab-menu tab-menu">
                        <ul>
                            <li class="active"><a href="#tr_tab1">Поступление</a></li>
                            <li><a href="#tr_tab2">Списание</a></li>
                        </ul>
                    </div>
                    <div class="tr-tab-item tab-items">

                        <div class="tr-tab-item tab-item" id="tr_tab1" style="display: block;">
                            <div class="tr-form">
                                <div class="group-col">
                                    <div class="field value-price">
                                        <input type="text" name="price" value="10000000"/>
                                    </div>
                                    <div class="field">
                                        <input type="text" name="name" placeholder="Название проекта"/>
                                    </div>
                                    <div class="field">
                                        <input type="text" name="work" placeholder="Работа проекта"/>
                                    </div>
                                    <div class="radio-field">
                                        <label><input type="radio" class="styler" name="nal" checked/>Безнал</label>
                                        <label><input type="radio" class="styler" name="nal"/>Наличными</label>
                                    </div>
                                </div>
                                <div class="group-col">
                                    <div class="field">
                                        <textarea name="message" placeholder="Комментарий"></textarea>
                                    </div>
                                </div>
                                <div class="group-bts">
                                    <input type="submit" class="submit-btn" value="Добавить"/>
                                    <a href="#" class="cancel-btn">Отмена</a>
                                </div>
                            </div>
                        </div>

                        <div class="tr-tab-item tab-item" id="tr_tab2" style="display: none;">
                            <div class="tr-form">
                                <div class="group-col">
                                    <div class="field value-price">
                                        <input type="text" name="price" value="10000000"/>
                                    </div>
                                    <div class="field">
                                        <input type="text" name="name" placeholder="Название проекта"/>
                                    </div>
                                    <div class="field">
                                        <input type="text" name="work" placeholder="Работа проекта"/>
                                    </div>
                                    <div class="field">
                                        <input type="text" name="emp" placeholder="Сотрудник"/>
                                    </div>
                                    <div class="radio-field">
                                        <label><input type="radio" class="styler" name="nal" checked/>Безнал</label>
                                        <label><input type="radio" class="styler" name="nal"/>Наличными</label>
                                    </div>
                                </div>
                                <div class="group-col">
                                    <div class="field">
                                        <textarea name="message" placeholder="Комментарий"></textarea>
                                    </div>
                                </div>
                                <div class="group-bts">
                                    <input type="submit" class="submit-btn" value="Добавить"/>
                                    <a href="#" class="cancel-btn">Отмена</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="clear"></div>
            </form>
            <span class="close"></span>
        </div>
    </div>

</div>