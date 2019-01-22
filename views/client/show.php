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
        <a href="#" class="add-project-btn">Добавить проект</a>

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
            <?php
            foreach ($tags as $tag){
                echo '<div class="checkbox-item"><label><input type="checkbox" class="styler" value="'.$tag->id.'" checked="checked"/>'.$tag->tag.'</label></div>';
            }
            ?>
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
                <tr>
                    <td>
                        <div class="service">Разработка сайта</div>
                        <a href="#" class="name">Ваш доктор</a>
                        <div class="category">Маркетинг</div>
                    </td>
                    <td>
                        <div class="price">5 000 000 ₽</div>
                        <div class="price minus"><span>Долг:</span> 4 774 000 ₽</div>
                        <div class="price plus"><span>Текущий баланс:</span> 435 000 ₽ (11%)</div>
                    </td>
                    <td>
                        <div class="price plus">100 500 ₽</div>
                        <div class="price-detail-items">
                            <div class="price-detail-item">
                                <span class="value">+700 000 ₽</span>
                                <span class="date">07.06.2019</span>
											<span class="info">
												<span class="icon"></span>
												<span class="content">
													Часть оплаты. Еще должны будут в следующем месяце доплатить 19 500 рублей
												</span>
											</span>
                            </div>
                            <div class="price-detail-item">
                                <span class="value">+55 500 ₽</span>
                                <span class="date">07.06.2019</span>
											<span class="info">
												<span class="icon"></span>
												<span class="content">
													Часть оплаты. Еще должны будут в следующем месяце доплатить 19 500 рублей
												</span>
											</span>
                            </div>
                            <div class="price-detail-item">
                                <span class="value">+55 500 ₽</span>
                                <span class="date">07.06.2019</span>
											<span class="info">
												<span class="icon"></span>
												<span class="content">
													Часть оплаты. Еще должны будут в следующем месяце доплатить 19 500 рублей
												</span>
											</span>
                            </div>
                        </div>
                        <a href="#" class="add-price-btn plus">+ Поступление</a>
                    </td>
                    <td>
                        <div class="price minus">77 000 ₽</div>
                        <div class="price-detail-items">
                            <div class="price-detail-item">
                                <span class="value">+700 000 ₽</span>
                                <span class="date">07.06.2019</span>
											<span class="info">
												<span class="icon"></span>
												<span class="content">
													Часть оплаты. Еще должны будут в следующем месяце доплатить 19 500 рублей
												</span>
											</span>
                            </div>
                            <div class="price-detail-item">
                                <span class="value">+55 500 ₽</span>
                                <span class="date">07.06.2019</span>
											<span class="info">
												<span class="icon"></span>
												<span class="content">
													Часть оплаты. Еще должны будут в следующем месяце доплатить 19 500 рублей
												</span>
											</span>
                            </div>
                            <div class="price-detail-item">
                                <span class="value">+55 500 ₽</span>
                                <span class="date">07.06.2019</span>
											<span class="info">
												<span class="icon"></span>
												<span class="content">
													Часть оплаты. Еще должны будут в следующем месяце доплатить 19 500 рублей
												</span>
											</span>
                            </div>
                        </div>
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

                <div class="projects-col">
                    <div class="projects-item">
                        <div class="title">Династия</div>
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
    <!-- ADD Project Popup -->
    <div class="nonebox add" id="add-project-popup">
        <!-- edit client -->
        <div class="add-tr-form white-box">
            <?$request = Yii::$app->request;?>
            <?php $form = ActiveForm::begin([
                'id' => 'new-project-form',
                'action'=> Url::to(['/ajax/new-project']),
                'fieldConfig' => [
                    'template' => "<div class=\"field\">{input}{error}</div>",
                ],
            ]); ?>
            <h2>Добавить проект</h2>
            <div class="message"></div>
            <div class="tr-form">
                <label for="favorite_team">Любимая команда:</label>
                <div class="group-col">
                    <?= $form->field($projectForm, 'name')->textInput(['placeholder' => 'Название проекта']) ?>
                </div>
                <div class="group-col">
                    <?php
                    $list=array();
                    foreach ($tags as $tag){
                        $list[$tag['id']] = $tag['tag'];
                    }
                    ?>
                    <?=$form->field($projectForm, 'tag')->dropDownList($list,
                        [
                        'prompt' => 'Выберите категорию',
                        'class' => 'styler'
                        ]);?>
                </div>
                <div class="group-col">
                    <?= $form->field($projectForm, 'price')->textInput(['placeholder' => 'Цена']) ?>
                </div>
                <div class="group-col">
                    <?= $form->field($projectForm, 'date_start')->textInput(['placeholder' => 'Дата начала','class' => 'datepicker']) ?>
                </div>
                <div class="group-col">
                    <?= $form->field($projectForm, 'client')->input('hidden',['value' => $request->get('id')]) ?>
                </div>

                <div class="group-col">
                    <?= Html::submitButton('Добавить', ['class' => 'add-submit-btn', 'name' => 'new-project-button']) ?>
                </div>

            </div>
            <div class="clear"></div>
            <?php ActiveForm::end(); ?>
            <span class="close"></span>
        </div>

    </div>
</div>