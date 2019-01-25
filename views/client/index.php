<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>


<!-- wrapper -->
<div class="wrapper">

    <!-- clients titles -->
    <div class="clients-titles">

        <!-- title -->
        <div class="m-title">Клиенты</div>
        <a href="#" class="add-client-btn">Добавить клиента</a>
        <!-- search -->
        <div class="search">
            <input type="text" placeholder="Поиск по клиентам"/>
            <button class="search-btn">Поиск</button>
        </div>

    </div>


    <!-- clients items -->
    <div class="clients-items">

        <div class="clients-item">
            <table>
                <tr>
                    <th>Клиент</th>
                    <th>Баланс</th>
                    <th>Долг</th>
                    <th></th>
                </tr>
                <?php foreach ($clients as $client): ?>


                    <tr id="tr-id-<?= $client->id ?>">
                        <td>
                            <a href="<?= Url::to(['project/show', 'id' => $client->id]) ?>" class="name del-name"
                               object-id="<?= $client->id ?>"><?= $client->name ?></a>
                        </td>
                        <?php
                        $debetAll = 0;
                        $creditAll = 0;
                        foreach ($client->projects as $project):
                            $debetAll += $project->debet;
                            $creditAll += $project->credit;
                        endforeach;
                        ?>
                        <td>
                            <div class="price plus"><?= $debetAll ?> ₽</div>
                        </td>
                        <td>
                            <div class="price minus"><?= $creditAll ?> ₽</div>
                        </td>
                        <td><a href="#" class="clients-btn delete">Удалить</a></td>
                    </tr>
                <?php endforeach; ?>

            </table>
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
            <h2>Удалить клиента <span></span>?</h2>
            <div class="tr-form">
                <?= $form->field($deleteForm, 'object')->input('hidden', ['value' => 'client']) ?>
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

</div>