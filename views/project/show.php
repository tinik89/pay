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
        <div class="m-title">Проекты <?= $clientName ?></div>
        <a href="#" class="add-project-btn">Добавить проект</a>

        <!-- search -->
        <div class="search">
            <input type="text" placeholder="Поиск по проектам"/>
            <button class="search-btn">Поиск</button>
        </div>

    </div>
    <?php if (!empty($projects)) { ?>
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
                foreach ($tags as $tag) {
                    echo '<div class="checkbox-item"><label><input type="checkbox" class="styler" value="' . $tag['id'] . '" checked="checked"/>' . $tag['tag'] . '</label></div>';
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

            <a href="#" class="clients-menu active"></a>

            <div class="clients-item">
                <table>
                    <tr>
                        <th>Название проекта</th>
                        <th>Общие цифры</th>
                        <th>Оплатили</th>
                        <th>Расходы</th>
                        <th></th>
                    </tr>
                    <?php
                    $clientCredit = 0;
                    $clientDebet = 0;
                    $clientPrice = 0;
                    ?>
                    <?php foreach ($projects as $project): ?>
                        <?php
                        $clientCredit += $project->credit;
                        $clientDebet += $project->debet;
                        $clientPrice += $project->price;
                        ?>
                        <?php echo $this->render('_oneProject', [
                            'project' => $project,
                            'implementers' => array_column($implementers, 'name', 'id')
                        ]); ?>

                    <?php endforeach; ?>

                </table>
            </div>


            <?php echo $this->render('_statistik', [
                'clientCredit' => $clientCredit,
                'clientDebet' => $clientDebet,
                'clientPrice' => $clientPrice,
                'clientName' => $clientName,
                'projectsOpen' => $projectsOpen,
                'projectsCount' => count($projects),
                'summTags' => $summTags,
            ]); ?>
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
    <?php echo $this->render('_addClient', [
        'projectForm' => $projectForm,
        'tags' => $tags,
    ]); ?>
    


    <?php
    echo DeleteWidget::widget(['deleteForm' => $deleteForm]);
    ?>


</div>