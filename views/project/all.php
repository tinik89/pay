<?php
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!не используется
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
            <input type="text" placeholder="Поиск по проектам" />
            <button class="search-btn">Поиск</button>
        </div>

    </div>

    <!-- clients filter -->
    <div class="clients-filter">

        <!-- status bts -->
        <div class="status-bts">
            <a href="#" class="status-btn active"><span>Активные</span></a>
            <a href="#" class="status-btn"><span>Закрытые</span></a>
        </div>

        <!-- check items -->
        <div class="checkbox-items">
            <div class="checkbox-item">
                <label><input type="checkbox" class="styler" />Маркетинг</label>
            </div>
            <div class="checkbox-item">
                <label><input type="checkbox" class="styler" />Сайты</label>
            </div>
            <div class="checkbox-item active">
                <label><input type="checkbox" class="styler" checked />Контекст</label>
            </div>
            <div class="checkbox-item">
                <label><input type="checkbox" class="styler" />Дизайн</label>
            </div>
            <div class="checkbox-item active">
                <label><input type="checkbox" class="styler" checked />SMM</label>
            </div>
            <div class="checkbox-item">
                <label><input type="checkbox" class="styler" />SEO</label>
            </div>
        </div>

        <!-- date select -->
        <div class="date-select">
            <div class="label">Сортировать:</div>
            <select class="styler">
                <option>По дате</option>
                <option>По цене</option>
                <option>По названию</option>
            </select>
        </div>

    </div>

    <!-- clients items -->
    <div class="clients-items">

        <a href="#" class="clients-menu"></a>

        <div class="clients-item">
            <table>
                <tr>
                    <th>Название проекта</th>
                    <th>Общие цифры</th>
                    <th>Оплатили</th>
                    <th>Расходы</th>
                    <th></th>
                </tr>
                <?php foreach ($projects as $project):?>


                <tr>
                    <td>
                        <div class="service"><?=$project->name?></div>
                        <a href="<?= Url::to(['client/show', 'id' => $project -> client])?>" class="name"><?= $project -> clientinfo -> name ?></a>
                        <div class="category"><?= $project -> taginfo -> tag ?></div>
                    </td>
                    <td>
                        <div class="price"> <?= $project -> price ?> </div>
                        <div class="price minus"><span>Долг:</span> <?= $project -> credit ?> ₽</div>
                        <div class="price plus"><span>Текущий баланс:</span> <?= $project -> debet ?> ₽ (<?= round($project -> debet / $project -> price *100); ?>%)</div>
                    </td>
                    <?php
                    $debetAll = 0;
                    $debetString = '';
                    $creditAll = 0;
                    $creditString = '';
                    foreach ($project -> transactions as $transaction):
                        if ($transaction->type == 'enrollment'){
                            $debetAll += $transaction->price;
                            $debetString .= '<div class="price-detail-item"><span class="value">+'. $transaction->price .' ₽</span> <span class="date">'.date('d.m.Y', $transaction->date).'</span><span class="info" transactionid="' . $transaction->id . '"><span class="icon"></span><span class="content">' . $transaction->comment . '</span></span></div>';
                        } else {
                            $creditAll += $transaction->price;
                            $creditString .= '<div class="price-detail-item"><span class="value">-'. $transaction->price .' ₽</span> <span class="date">'.date('d.m.Y', $transaction->date).'</span><span class="info" transactionid="' . $transaction->id . '"><span class="icon"></span><span class="content">' . $transaction->comment . '</span></span></div>';
                        }
                    endforeach;
                    ?>
                    <td>
                        <div class="price plus"><?= $debetAll ?> ₽</div>
                        <div class="price-detail-items"> <?= $debetString ?></div>
                        <a href="#" class="add-price-btn plus">+ Поступление</a>
                    </td>
                    <td>
                        <div class="price minus"><?= $creditAll ?> ₽</div>
                        <div class="price-detail-items"><?= $creditString ?></div>
                        <a href="#" class="add-price-btn minus">- Расход</a>
                    </td>
                    <td>
                        <div class="clients-bts">
                            <a href="#" class="clients-btn close">Закрыть</a>
                            <a href="#" class="clients-btn edit">Изменить</a>
                            <a href="#" class="clients-btn delete">Удалить</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>

        <!-- projects popup -->
        <div class="projects-overlay"></div>
        <div class="projects-popup">
            <div class="projects-items">

                <div class="projects-col">
                    <div class="projects-item">
                        <div class="title">Всего проектов:</div>
                        <div class="count">125 <span>(7 долгов)</span></div>
                        <div class="all-price minus"><span>Общий долг:</span> - 700 000 ₽</div>
                        <div class="all-price plus"><span>Общий баланс:</span> + 7 000 000 ₽</div>
                        <div class="list">
                            <ul>
                                <li>
                                    <strong>Маркетинг:</strong>
                                    <span class="value">1 000 000 ₽ <span class="percent">(100%)</span></span>
                                </li>
                                <li>
                                    <strong>Контекст:</strong>
                                    <span class="value">500 000 ₽ <span class="percent">(100%)</span></span>
                                </li>
                                <li>
                                    <strong>Дизайн:</strong>
                                    <span class="value">1 000 ₽ <span class="percent">(100%)</span></span>
                                </li>
                                <li>
                                    <strong>Сайт:</strong>
                                    <span class="value">1 000 000 ₽ <span class="percent">(100%)</span></span>
                                </li>
                                <li>
                                    <strong>SMM:</strong>
                                    <span class="value">1 000 000 ₽ <span class="percent">(100%)</span></span>
                                </li>
                                <li>
                                    <strong>SEO:</strong>
                                    <span class="value">1 000 ₽ <span class="percent">(100%)</span></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                

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
<!-- ADD Client Popup -->
    <div class="nonebox add" id="add-client-popup">
        <!-- edit client -->
        <div class="add-tr-form white-box">
            <?php $form = ActiveForm::begin([
                'id' => 'new-client-form',
                'action'=> Url::to(['/ajax/new-client']),
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

</div>