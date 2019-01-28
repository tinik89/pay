<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<!-- add multi transactions -->
<div class="add-multi-tr-form white-box" style="display: none;">


    <?php $form = ActiveForm::begin([
        'id' => 'multi-tr-form',
        'fieldConfig' => [
            'template' => "{input}{error}",
        ],
        //'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($models, 'date')->input('hidden', ['value' => time()]) ?>
    <?= $form->field($models, 'manager_id')->input('hidden', ['value' => Yii::$app->user->id]) ?>
    <?= $form->field($models, 'type')->input('hidden', ['value' => 'enrollment']) ?>


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
                    <div class="group-bts">
                        <a href="#" class="add-more-btn">+ Добавить еще платеж</a>
                        <input type="submit" class="submit-btn" value="Сохранить"/>
                    </div>

                </div>
            </div>
        </div>


    </div>
    <?php ActiveForm::end(); ?>


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
