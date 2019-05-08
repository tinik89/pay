<!-- wrapper -->
<div class="wrapper">

    <!-- content -->
    <div class="white-box">

        <!-- heading -->
        <div class="heading-group">

            <!-- titles -->
            <div class="m-title align-left">График  <?= Yii::$app->getSecurity()->generatePasswordHash('182129042019');?></div>

            <!-- date select -->
            <div class="date-select">
                <select class="styler">
                    <option>Январь</option>
                    <option>Февраль</option>
                    <option>Март</option>
                    <option>Апрель</option>
                    <option>Май</option>
                    <option>Июнь</option>
                    <option>Июль</option>
                    <option>Август</option>
                    <option>Сентябрь</option>
                    <option>Октябрь</option>
                    <option>Ноябрь</option>
                    <option>Декабрь</option>
                </select>
            </div>

            <!-- date range -->
            <div class="date-range">
                <input type="text" class="from" name="from" value="01/01/2019">
                <span class="sep"></span>
                <input type="text" class="to" name="to" value="01/31/2019">
                <button class="submit-btn">применить</button>
            </div>

        </div>

        <!-- stats -->
        <div class="stats-box">

            <!-- general stats -->
            <div class="general-row">
                <div class="progress" style="height: 100%;">
                    <div class="label">Общая статистика</div>
                    <div class="percentage" style="height: 80%;">
                        80%
                    </div>
                </div>
                <div class="list">
                    <ul>
                        <li>
                            Поступление:
                            <span class="value">10 000 000 ₽</span>
                        </li>
                        <li>
                            Расходы:
                            <span class="value">8 000 000 ₽</span>
                            <span class="percent">(80%)</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- stats row -->
            <div class="stats-row">

                <div class="stats-col">
                    <div class="progress" style="height: 100%;">
                        <div class="label">Маркетинг</div>
                        <div class="percentage" style="height: 78%;">
                            78%
                            <span class="value">79 000 ₽</span>
                        </div>
                        <span class="value">3 000 000 ₽</span>
                    </div>
                </div>

                <div class="stats-col">
                    <div class="progress" style="height: 85%;">
                        <div class="label">Сайты</div>
                        <div class="percentage" style="height: 60%;">
                            60%
                            <span class="value">79 000 ₽</span>
                        </div>
                        <span class="value">3 000 000 ₽</span>
                    </div>
                </div>

                <div class="stats-col">
                    <div class="progress" style="height: 70%;">
                        <div class="label">Контекст</div>
                        <div class="percentage" style="height: 90%;">
                            90%
                            <span class="value">79 000 ₽</span>
                        </div>
                        <span class="value">3 000 000 ₽</span>
                    </div>
                </div>

                <div class="stats-col">
                    <div class="progress" style="height: 55%;">
                        <div class="label">Дизайн</div>
                        <div class="percentage" style="height: 74%;">
                            74%
                            <span class="value">79 000 ₽</span>
                        </div>
                        <span class="value">3 000 000 ₽</span>
                    </div>
                </div>

                <div class="stats-col">
                    <div class="progress" style="height: 40%;">
                        <div class="label">SMM</div>
                        <div class="percentage" style="height: 63%;">
                            63%
                            <span class="value">79 000 ₽</span>
                        </div>
                        <span class="value">3 000 000 ₽</span>
                    </div>
                </div>

                <div class="stats-col">
                    <div class="progress" style="height: 25%;">
                        <div class="label">SEO</div>
                        <div class="percentage" style="height: 53%;">
                            53%
                            <span class="value">79 000 ₽</span>
                        </div>
                        <span class="value">3 000 000 ₽</span>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- content -->
    <div class="white-box">

        <!-- heading -->
        <div class="heading-group">

            <!-- titles -->
            <div class="m-title align-left">Баланс</div>

            <!-- date select -->
            <div class="date-select">
                <select class="styler">
                    <option>2018</option>
                    <option>2017</option>
                    <option>2016</option>
                </select>
            </div>

            <!-- balance -->
            <div class="balance-value">
                Текущий остаток: <strong>1 565 000 ₽</strong>
            </div>

        </div>

        <!-- balance table -->
        <div class="balence-table">
            <div class="scrollbox-x">
                <table>
                    <tr>
                        <th>Месяц</th>
                        <th>Январь</th>
                        <th>Февраль</th>
                        <th>Март</th>
                        <th>Апрель</th>
                        <th>Май</th>
                        <th>Июнь</th>
                        <th>Июль</th>
                        <th>Август</th>
                        <th>Сентябрь</th>
                        <th>Октябрь</th>
                        <th>Ноябрь</th>
                        <th>Декабрь</th>
                    </tr>
                    <tr>
                        <td>Поступления</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                    </tr>
                    <tr class="dropdown">
                        <td><span class="dropdown-label opened">Доход</span></td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                    </tr>
                    <tr>
                        <td colspan="13" class="subtable" style="display: block;">
                            <table>
                                <tr>
                                    <td>Сайты</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                </tr>
                                <tr>
                                    <td>Дизайн</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                </tr>
                                <tr>
                                    <td>Продвижение</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                </tr>
                                <tr>
                                    <td>SMM</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                </tr>
                                <tr>
                                    <td>SEO</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                </tr>
                                <tr>
                                    <td>Контекст</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="dropdown">
                        <td><span class="dropdown-label red">Расход</span></td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                    </tr>
                    <tr>
                        <td colspan="13" class="subtable">
                            <table>
                                <tr>
                                    <td>Сайты</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                </tr>
                                <tr>
                                    <td>Дизайн</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                </tr>
                                <tr>
                                    <td>Продвижение</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                </tr>
                                <tr>
                                    <td>SMM</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                </tr>
                                <tr>
                                    <td>SEO</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                </tr>
                                <tr>
                                    <td>Контекст</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                    <td>1 000 000</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="itog">
                        <td>Расход</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                        <td>1 000 000</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

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