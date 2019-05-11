<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\components\DeleteWidget;
use yii\widgets\ListView;
use yii\widgets\Pjax;
?>

<?php //Pjax::begin(); ?>
<!-- wrapper -->
<div class="wrapper">




    <?php echo $this->render('_search', ['model' => $searchModel, 'dataProvider'=>$dataProvider, 'tags'=>$tags, 'clientName'=>$clientName, 'showAddProject'=> false]); ?>
    <!-- clients items -->
    <div class="clients-items">

        <a href="#" class="clients-menu active"></a>

        <div class="clients-item">

          
                <?php
                echo  ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'item', 'tag' => 'tr'],
                    'itemView' => '_oneProjectList',
                    'pager' => ['class' => \kop\y2sp\ScrollPager::className(),
                        'item' => 'tr',
                        'triggerTemplate' => '<tr class="ias-trigger"><td colspan="100%" style="text-align: center"><a href="#">{text}</a></td></tr>',
                        'noneLeftTemplate' => '<tr class="ias-trigger"><td colspan="100%" style="text-align: center">{text}</td></tr>'
                    ],
//                  'itemOptions' => [ ],
                    'options' => [

//                        'tag' => 'table',
//                        'class' => 'list-view'
                        'tag' => false

                    ],
                    'summary' => false,
                    'layout' => '<table class="list-view"><tr><th>Название проекта</th><th>Общие цифры</th><th>Оплатили</th><th>Расходы</th> <th></th></tr>{items} </table>{pager}',
                    'viewParams' => [
                        'implementers' => array_column($implementers, 'name', 'id'),
                    ]

                ]);

                ?>


        </div>

        <!-- projects popup -->
        <?php
        $clientCredit = 0;
        $clientDebet = 0;
        $clientPrice = 0;
        foreach ($projects as $project) {

            $clientCredit += $project->credit;
            $clientDebet += $project->debet;
            $clientPrice += $project->price;
        }
        echo $this->render('_statistik', [
            'clientCredit' => $clientCredit,
            'clientDebet' => $clientDebet,
            'clientPrice' => $clientPrice,
            'clientName' => 'Все проекты',
            'projectsOpen' => $projectsOpen,
            'projectsCount' => count($projects),
            'summTags' => $summTags,
        ]); ?>

    </div>

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

<?php //Pjax::end(); ?>