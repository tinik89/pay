<?php
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\DeleteWidget;
use yii\widgets\ListView;
use kop\y2sp\ScrollPager;

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

    <?php
    $clientList = array();
    foreach ($clients as $client) {
        $clientList[$client['id']] = $client['name'];
    }
    $implementerList = array();
    foreach ($implementers as $implementer) {
        $implementerList[$implementer['id']] = $implementer['name'];
    }
    ?>

    <?php echo $this->render('_addOne', [
        'model' => $addForm,
        'errorForm' => $errorFormOne,
        'clientList' => $clientList,
        'implementers' => $implementers,
    ]); ?>

    <?php echo $this->render('_addMulti', [
        'models' => $addForms,
        'errorForm' => $errorFormMulti,
        'clientList' => $clientList,
        'implementers' => $implementers,
    ]); ?>



    <!-- latest transactions filter -->
    <div class="latest-tr-filter">

        <!-- title -->
        <div class="m-title">Последние транзакции</div>
        <?php echo $this->render('_search', ['model' => $searchModel,'implementerList' => $implementerList,'clientList'=>$clientList]); ?>
        <!-- transactions group -->
        

    </div>

    <!-- transactions items -->
    <div class="trans-items">


        <?php
        $outputTransactionArr = array();
       $wrapList =  ListView::widget([
        'dataProvider' => $dataProvider,
//            'itemView' => '_item_view'
            'itemView' => function ($model, $key, $index, $widget) use (&$outputTransactionArr){
                $outputTransactionArr[]=$model;
//                var_dump($dataProvider->pagination->pagesize);
             //echo '<p>$model->id'.$model->client->name.'<br/><p>$key'.$key.'<br/><p>$index'.$index.'<br/><hr></p>';
            },
           'itemOptions' => [

               'tag' => false

           ],
           'options' => [


               'tag' => false

           ],
           'summary' => false,
//     'itemOptions' => ['class' => 'item'],
    // 'pager' => ['class' => \kop\y2sp\ScrollPager::className()]
        ]);
//        var_dump(count($outputTransactionArr));
        ?>

        <?php
        $beginOfDay = 0;

       // foreach ($transaction as $transaction):
//        foreach ($dataProvider->getModels() as $transaction):
        foreach ($outputTransactionArr as $transaction):

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

            <tr id="tr-id-<?=$transaction -> id?>">
                <td>
                    <div class="date"><?= $curDate ?><span><?= $curDay ?></span></div>
                </td>
                <td>
                    <a href="<?= Url::to(['project/show', 'id' => $transaction->client_id]) ?>"
                       class="name"><?= $transaction->client->name ?></a>
                    <div class="category"><?= $transaction->project->name ?></div>
                </td>
                <td>
                    <?php if ($transaction->type == 'enrollment') {
                        echo '<div class="price del-name" object-id="' . $transaction->id . '">+'. number_format($transaction->price, 0, ',', ' ') .'₽ </div>';
                    } else {
                        $implementer = (isset($transaction->implementerinfo))?$transaction->implementerinfo->name:'';
                        echo '<div class="price minus del-name" object-id="' . $transaction->id . '">-'.number_format($transaction->price, 0, ',', ' ') .'₽ <p>'. $implementer .'</p></div>';
                    } ?>
                </td>
                <td>
                    <div class="method"><?php if ($transaction->cash == 1) {
                            echo 'Наличный';
                        } else {
                            echo 'Безналичный';
                        } ?></div>
                </td>
                <td>
                    <div class="info"><?php
                        if (!empty($transaction->comment)){
                            echo $transaction->comment;
                        } ?>
                    </div>
                </td>

                <td><a href="#" class="clients-btn delete" object-type="transaction">Удалить</a></td>
            </tr>
        <?php endforeach; ?>
        <?php $endTable = '</table></div> </div>'; ?>
        <?= $endTable ?>

<?= $wrapList;?>
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

    <!-- Delete alert Popup -->
    <?php
    echo DeleteWidget::widget(['deleteForm' => $deleteForm]);
    ?>
</div>