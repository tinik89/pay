<?php
use app\assets\AppAsset;
use app\assets\IeAsset;

AppAsset::register($this);
IeAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="ru" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Платежка - Pushkin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">


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
    </div>

    <?= $content ?>
    
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>