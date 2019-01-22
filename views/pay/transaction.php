<?php
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php
$action = Url::to(['/ajax/get-client']);
$implementersArr = array();
foreach ($implementers as $implementer){
    $implementersArr[]=['id' => $implementer['id'],'value' => $implementer['name'],];
}
$implementersJson = json_encode($implementersArr);
$js = <<<js
        var availableTags = $implementersJson;
    console.log(availableTags);
    $( "#transactionform-implementer" ).autocomplete({
        source: availableTags,
        // select: function( event, ui){
        //     console.log(ui);
        // }, 
        change: function( event, ui){
            if (ui.item){
                console.log(ui.item.id);
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
            Добавить <a href="#" class="one-tr-btn">одну транзакцию</a> или <a href="#" class="multi-tr-btn">несколько транзакций</a>
            <?php if ( Yii::$app->session->hasFlash('success')){
                echo '<div class="successAdd">'. Yii::$app->session->getFlash('success').'</div>';
            }
            ?>

        </div>
    </div>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'client_id',
            'project_id',
            //'price',
            'date',
            'type',
            'implementer',
            //'comment',
            //'update_id',
            //'manager_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <!-- add transactions -->
    <div class="add-tr-form white-box" <?php if (empty($errorForm)){ echo 'style="display: none;"';}?> >

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
        <?= $form->field($addForm, 'date')->input('hidden',['value' => time()]) ?>
        <?= $form->field($addForm, 'manager_id')->input('hidden',['value' => '1']) ?>
            <div class="tr-tabs tabs">
                <div class="tr-tab-menu tab-menu-form">
                    <ul>
                        <li class="active"><a href="enrollment">Поступление</a></li>
                        <li><a href="charge">Списание</a></li>
                    </ul>
                </div>
                <div class="tr-tab-item tab-items">

                    <fieldset class="tr-tab-item tab-item" id="tr_tab1" style="display: block;" >
                        <?= $form->field($addForm, 'type')->input('hidden',['value' => 'enrollment']) ?>
                        <div class="tr-form">
                            <div class="group-col">
                                <div class="field value-price">
                                    <?= $form->field($addForm, 'price')->textInput(['placeholder' => 'Сумма']) ?>
                                </div>

                                <div class="field">
                                    <?php
                                    $list=array();
                                    foreach ($clients as $client){
                                        $list[$client['id']] = $client['name'];
                                    }
                                    ?>
                                    <?=$form->field($addForm, 'client_id')->dropDownList($list,
                                        [
                                            'prompt' => 'Выберите клиента',
                                            'placeholder' => 'Выберите клиента'
                                        ]);?>
<!--                                    --><?//= $form->field($addForm, 'client_id')->textInput(['placeholder' => 'Клиент']) ?>
                                </div>

                                <div class="field">
                                    <?=$form->field($addForm, 'project_id')->dropDownList(array(),
                                        [
                                            'prompt' => 'Проект',
                                            'placeholder' => 'Выберите проект'
                                        ]);?>
<!--                                    --><?//= $form->field($addForm, 'project_id')->textInput(['placeholder' => 'Название проекта', 'disabeled' => 'disabeled']) ?>
                                </div>

                                <div class="field implementer" style="display:none;">
                                    <?= $form->field($addForm, 'implementer')->textInput(['placeholder' => 'Сотрудник']) ?>
                                    <?= $form->field($addForm, 'implementer_id')->input('hidden',['value' => '']) ?>
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
                                    <label><input type="radio" class="styler" name="nal" checked />Безнал</label>
                                    <label><input type="radio" class="styler" name="nal" />Наличными</label>
                                </div>
                                <div class="field value-date calendar">
                                    <input type="text" name="date" class="datepicker" value="01/01/2019" />
                                </div>
                                <div class="field value-price">
                                    <input type="text" name="price" value="10000000" />
                                </div>
                                <div class="field value-name">
                                    <input type="text" name="name" placeholder="Название проекта" />
                                </div>
                                <div class="field value-job">
                                    <input type="text" name="job" placeholder="Работа проекта" />
                                </div>
                                <div class="field value-creator">
                                    <input type="text" name="creator" placeholder="Исполнитель" />
                                </div>
                            </div>
                            <div class="group-col">
                                <span class="delete"></span>
                                <div class="radio-field">
                                    <label><input type="radio" class="styler" name="nal_2" checked />Безнал</label>
                                    <label><input type="radio" class="styler" name="nal_2" />Наличными</label>
                                </div>
                                <div class="field value-date calendar">
                                    <input type="text" name="date" class="datepicker" value="01/01/2019" />
                                </div>
                                <div class="field value-price">
                                    <input type="text" name="price" value="10000000" />
                                </div>
                                <div class="field value-name">
                                    <input type="text" name="name" placeholder="Название проекта" />
                                </div>
                                <div class="field value-job">
                                    <input type="text" name="job" placeholder="Работа проекта" />
                                </div>
                                <div class="field value-creator">
                                    <input type="text" name="creator" placeholder="Исполнитель" />
                                </div>
                            </div>
                            <div class="group-col">
                                <span class="delete"></span>
                                <div class="radio-field">
                                    <label><input type="radio" class="styler" name="nal_3" checked />Безнал</label>
                                    <label><input type="radio" class="styler" name="nal_3" />Наличными</label>
                                </div>
                                <div class="field value-date calendar">
                                    <input type="text" name="date" class="datepicker" value="01/01/2019" />
                                </div>
                                <div class="field value-price">
                                    <input type="text" name="price" value="10000000" />
                                </div>
                                <div class="field value-name">
                                    <input type="text" name="name" placeholder="Название проекта" />
                                </div>
                                <div class="field value-job">
                                    <input type="text" name="job" placeholder="Работа проекта" />
                                </div>
                                <div class="field value-creator">
                                    <input type="text" name="creator" placeholder="Исполнитель" />
                                </div>
                            </div>
                            <div class="group-bts">
                                <a href="#" class="add-more-btn">+ Добавить еще платеж</a>
                                <input type="submit" class="submit-btn" value="Сохранить" />
                            </div>
                        </div>
                    </div>

                    <div class="tr-tab-item tab-item" id="tr_multi_tab2" style="display: none;">
                        <div class="tr-form">
                            <div class="group-col">
                                <span class="delete"></span>
                                <div class="radio-field">
                                    <label><input type="radio" class="styler" name="nal_4" checked />Безнал</label>
                                    <label><input type="radio" class="styler" name="nal_4" />Наличными</label>
                                </div>
                                <div class="field value-date calendar">
                                    <input type="text" name="date" class="datepicker" value="01/01/2019" />
                                </div>
                                <div class="field value-price">
                                    <input type="text" name="price" value="10000000" />
                                </div>
                                <div class="field value-name">
                                    <input type="text" name="name" placeholder="Название проекта" />
                                </div>
                                <div class="field value-job">
                                    <input type="text" name="job" placeholder="Работа проекта" />
                                </div>
                                <div class="field value-creator">
                                    <input type="text" name="creator" placeholder="Исполнитель" />
                                </div>
                            </div>
                            <div class="group-col">
                                <span class="delete"></span>
                                <div class="radio-field">
                                    <label><input type="radio" class="styler" name="nal_5" checked />Безнал</label>
                                    <label><input type="radio" class="styler" name="nal_5" />Наличными</label>
                                </div>
                                <div class="field value-date calendar">
                                    <input type="text" name="date" class="datepicker" value="01/01/2019" />
                                </div>
                                <div class="field value-price">
                                    <input type="text" name="price" value="10000000" />
                                </div>
                                <div class="field value-name">
                                    <input type="text" name="name" placeholder="Название проекта" />
                                </div>
                                <div class="field value-job">
                                    <input type="text" name="job" placeholder="Работа проекта" />
                                </div>
                                <div class="field value-creator">
                                    <input type="text" name="creator" placeholder="Исполнитель" />
                                </div>
                            </div>
                            <div class="group-col">
                                <span class="delete"></span>
                                <div class="radio-field">
                                    <label><input type="radio" class="styler" name="nal_6" checked />Безнал</label>
                                    <label><input type="radio" class="styler" name="nal_6" />Наличными</label>
                                </div>
                                <div class="field value-date calendar">
                                    <input type="text" name="date" class="datepicker" value="01/01/2019" />
                                </div>
                                <div class="field value-price">
                                    <input type="text" name="price" value="10000000" />
                                </div>
                                <div class="field value-name">
                                    <input type="text" name="name" placeholder="Название проекта" />
                                </div>
                                <div class="field value-job">
                                    <input type="text" name="job" placeholder="Работа проекта" />
                                </div>
                                <div class="field value-creator">
                                    <input type="text" name="creator" placeholder="Исполнитель" />
                                </div>
                            </div>
                            <div class="group-bts">
                                <a href="#" class="add-more-btn">+ Добавить еще платеж</a>
                                <input type="submit" class="submit-btn" value="Сохранить" />
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
                <input type="text" class="datepicker" placeholder="Дата" />
            </div>

            <div class="field">
                <input type="text" placeholder="Поиск по проектам" />
            </div>

            <div class="field">
                <input type="text" placeholder="Поступления/списания" />
            </div>

            <div class="field">
                <input type="text" placeholder="Поиск по людям" />
            </div>

            <button class="submit-btn">Применить</button>

        </div>

    </div>

    <!-- transactions items -->
    <div class="trans-items">

        <div class="trans-col">
            <div class="title">20 ноября <span>Сегодня</span></div>
            <div class="trans-item">
                <table>
                    <tr>
                        <td>
                            <div class="date">20 ноября <span>Понедельник</span></div>
                        </td>
                        <td>
                            <a href="#" class="name">Династия</a>
                            <div class="category">Разработка сайта</div>
                        </td>
                        <td>
                            <div class="price">+ 50 500 ₽</div>
                        </td>
                        <td>
                            <div class="method">Безналичный</div>
                        </td>
                        <td>
                            <div class="info">Часть оплаты. Еще должны будут в следующем месяце доплатить 19 500 рублей</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="date">20 ноября <span>Понедельник</span></div>
                        </td>
                        <td>
                            <a href="#" class="name">АБС-Сервис</a>
                            <div class="category">Разработка сайта</div>
                        </td>
                        <td>
                            <div class="price">+ 5 500 ₽</div>
                        </td>
                        <td>
                            <div class="method">Наличными</div>
                        </td>
                        <td>
                            <div class="info">*Комментарий отсутствует</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="trans-col">
            <div class="title">19 ноября <span>Воскресенье</span></div>
            <div class="trans-item">
                <table>
                    <tr>
                        <td>
                            <div class="date">19 ноября <span>Воскресенье</span></div>
                        </td>
                        <td>
                            <a href="#" class="name">Ваш доктор</a>
                            <div class="category">Разработка сайта</div>
                        </td>
                        <td>
                            <div class="price">+ 12 000 ₽</div>
                        </td>
                        <td>
                            <div class="method">Безналичный</div>
                        </td>
                        <td>
                            <div class="info">Часть оплаты. Еще должны будут в следующем месяце доплатить 19 500 рублей</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="date">19 ноября <span>Воскресенье</span></div>
                        </td>
                        <td>
                            <a href="#" class="name">АБС-Сервис</a>
                            <div class="category">Маркетинг</div>
                        </td>
                        <td>
                            <div class="price minus">- 1 000 500 ₽</div>
                        </td>
                        <td>
                            <div class="method">Наличными</div>
                        </td>
                        <td>
                            <div class="info">*Комментарий отсутствует</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="date">19 ноября <span>Воскресенье</span></div>
                        </td>
                        <td>
                            <a href="#" class="name">АБС-Сервис</a>
                            <div class="category">Маркетинг</div>
                        </td>
                        <td>
                            <div class="price">+ 70 000 ₽</div>
                        </td>
                        <td>
                            <div class="method">Наличными</div>
                        </td>
                        <td>
                            <div class="info">Какой-то комментарий к платежу (если он есть) Часть оплаты. Еще должны будут в следующем месяце доплатить 19 500 рублей</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="trans-col">
            <div class="title">19 ноября <span>Воскресенье</span></div>
            <div class="trans-item">
                <table>
                    <tr>
                        <td>
                            <div class="date">15 ноября <span>Среда</span></div>
                        </td>
                        <td>
                            <a href="#" class="name">Ваш доктор</a>
                            <div class="category">Разработка сайта</div>
                        </td>
                        <td>
                            <div class="price">+ 12 000 ₽</div>
                        </td>
                        <td>
                            <div class="method">Безналичный</div>
                        </td>
                        <td>
                            <div class="info">Часть оплаты. Еще должны будут в следующем месяце доплатить 19 500 рублей</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="date">19 ноября <span>Воскресенье</span></div>
                        </td>
                        <td>
                            <a href="#" class="name">АБС-Сервис</a>
                            <div class="category">Маркетинг</div>
                        </td>
                        <td>
                            <div class="price minus">- 1 000 500 ₽</div>
                        </td>
                        <td>
                            <div class="method">Наличными</div>
                        </td>
                        <td>
                            <div class="info">*Комментарий отсутствует</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

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
                                        <input type="text" name="price" value="10000000" />
                                    </div>
                                    <div class="field">
                                        <input type="text" name="name" placeholder="Название проекта" />
                                    </div>
                                    <div class="field">
                                        <input type="text" name="work" placeholder="Работа проекта" />
                                    </div>
                                    <div class="radio-field">
                                        <label><input type="radio" class="styler" name="nal" checked />Безнал</label>
                                        <label><input type="radio" class="styler" name="nal" />Наличными</label>
                                    </div>
                                </div>
                                <div class="group-col">
                                    <div class="field">
                                        <textarea name="message" placeholder="Комментарий"></textarea>
                                    </div>
                                </div>
                                <div class="group-bts">
                                    <input type="submit" class="submit-btn" value="Добавить" />
                                    <a href="#" class="cancel-btn">Отмена</a>
                                </div>
                            </div>
                        </div>

                        <div class="tr-tab-item tab-item" id="tr_tab2" style="display: none;">
                            <div class="tr-form">
                                <div class="group-col">
                                    <div class="field value-price">
                                        <input type="text" name="price" value="10000000" />
                                    </div>
                                    <div class="field">
                                        <input type="text" name="name" placeholder="Название проекта" />
                                    </div>
                                    <div class="field">
                                        <input type="text" name="work" placeholder="Работа проекта" />
                                    </div>
                                    <div class="field">
                                        <input type="text" name="emp" placeholder="Сотрудник" />
                                    </div>
                                    <div class="radio-field">
                                        <label><input type="radio" class="styler" name="nal" checked />Безнал</label>
                                        <label><input type="radio" class="styler" name="nal" />Наличными</label>
                                    </div>
                                </div>
                                <div class="group-col">
                                    <div class="field">
                                        <textarea name="message" placeholder="Комментарий"></textarea>
                                    </div>
                                </div>
                                <div class="group-bts">
                                    <input type="submit" class="submit-btn" value="Добавить" />
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