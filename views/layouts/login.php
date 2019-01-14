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
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

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
    <div class="container">
        <div class="latest-tr-filter" >
            <!-- title -->
            <form style="text-align: center" method="post" action="/">
                <h1 class="m-title">Авторизация</h1>

                <!-- transactions group -->
                <div class="tr-filter-group">

                    <div class="field">
                        <input type="text" name="name" placeholder="Логин">
                    </div>
                    <div class="field">
                        <input type="text" name="work" placeholder="Пароль">
                    </div>

                    <button class="submit-btn" type="submit">Войти</button>
                </div>
            </form>
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>