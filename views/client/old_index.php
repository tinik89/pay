<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\components\DeleteWidget;

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

        <div class="status-bts client">

            <a href="#" class="status-btn <?=$openClass?>" status="1"><span>Активные</span></a>
            <a href="#" class="status-btn <?=$closeClass?>" status="0"><span>Закрытые</span></a>
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
                            <div class="price plus"><?= number_format($debetAll, 0, ',', ' ') ?> ₽</div>
                        </td>
                        <td>
                            <div class="price minus"><?= number_format($creditAll, 0, ',', ' ') ?> ₽</div>
                        </td>
                        <td><a href="#" class="clients-btn delete"  object-type="client">Удалить</a></td>
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
    <?php
    echo DeleteWidget::widget(['deleteForm' => $deleteForm]);
    ?>

</div>