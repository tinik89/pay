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
        <div class="m-title">Проекты <?= $clientName ?></div>
        <a href="#" class="add-project-btn">Добавить проект</a>

        <!-- search -->
        <div class="search">
            <input type="text" placeholder="Поиск по проектам" />
            <button class="search-btn">Поиск</button>
        </div>

    </div>
<?php if (!empty($projects)){?>
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
                echo '<div class="checkbox-item"><label><input type="checkbox" class="styler" value="'.$tag['id'].'" checked="checked"/>'.$tag['tag'].'</label></div>';
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
                <?php foreach ($projects as $project):?>

                    <?php echo $this->render('_oneProject', [
                        'project' => $project,
                        'implementers' => array_column($implementers, 'name', 'id')
                    ]); ?>

                <?php endforeach; ?>

            </table>
        </div>

        <!-- projects popup -->
        <div class="projects-overlay"></div>
        <div class="projects-popup">
            <div class="projects-items">

                <div class="projects-col">
                    <div class="projects-item">
                        <div class="title">Династия:</div>
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
<?php
} else {
    echo '<h2>Нет проектов.</h2>';
}
?>

</div>

<!-- Footer -->
<div class="footer">

</div>

<!-- Popups -->
<div class="popups_group">
    <div class="overlay"></div>

    <!-- Edit Client Popup -->
    <?php echo $this->render('_addTransaction', [
        'model' => $addTransactionForm,
        'implementers' => $implementers,
    ]); ?>
    
    
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


    <?php echo $this->render('_delProject', [
        'deleteForm' => $deleteForm,
    ]); ?>



</div>