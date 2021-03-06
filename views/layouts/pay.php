<?php
use app\assets\AppAsset;
use app\assets\IeAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Menu;

AppAsset::register($this);
IeAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>"" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?= Html::csrfMetaTags() ?>


        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo Yii::$app->getHomeUrl();?>web/images/favicon.ico?v=2" type="image/x-icon">
        <link rel="icon" href="<?php echo Yii::$app->getHomeUrl();?>web/images/favicon.ico?v=2" type="image/x-icon">

        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody() ?>
    <div class="bg">

        <!-- Preloader -->
        <div class="preloader">
            <div class="centrize full-width">
                <div class="vertical-center">
                    <div class="spinner"></div>
                </div>
            </div>
        </div>

        <!-- Container -->
        <div class="container">

            <!-- Header -->
            <header class="header">

                <!-- top menu -->
                <div class="top-menu">
                    <?php
                    echo Nav::widget([
                        'activateParents' => true,
                        'options' => ['class' => ''],
                        'items' => [
                            ['label' => 'Обзор', 'url' => ['/pay/index']],
                            ['label' => 'Транзакции', 'url' => ['/pay/transactions']],
                            ['label' => 'Клиенты', 'url' => ['/client/index']],
                            ['label' => 'Проекты', 'url' => ['/project/index'], 'active' => ($this->context->route == 'project/show' || $this->context->route == 'project/index')],
                            Yii::$app->user->isGuest ?(
                                ['label' => 'Login', 'url' => ['/login/index']]
                            ):(
                                ['label' => 'ВЫХОД', 'url' => ['/pay/logout']]
                            )

                        ],
                    ]);

                    ?>
                </div>

                <div class="clear"></div>
            </header>

            <!-- wrapper -->

            <?= $content ?>
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>