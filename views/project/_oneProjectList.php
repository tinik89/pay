<?php
use yii\helpers\Url;
?>

<!--<tr id="tr-id---><?//=$model -> id?><!--">-->

    <td>
        <div class="project-open-date" date-start="<?=date('d/m/Y', $model->date_start)?>"><?php if (!empty($model->date_start)) echo date('d.m.Y', $model->date_start);?></div>
        <div class="service del-name" object-id="<?= $model->id ?>"><?=$model->name?></div>
        <a href="<?= Url::to(['project/show', 'id' => $model -> client])?>" class="name" client-id="<?=$model -> client?>"><?= $model -> clientinfo -> name ?></a>
        <div class="category" tag-id="<?=$model -> tag?>">
            <?php
            if (isset($model -> taginfo)){
                echo $model -> taginfo -> tag;
            } else {
                echo 'расходы фирмы';
            } ?></div>
    </td>
    <td>
        <div class="price" price-val="<?=$model -> price?>"> <?= number_format($model -> price, 0, ',', ' ') ?> ₽</div>
        <div class="price minus"><span>Долг:</span> <?= number_format($model -> credit, 0, ',', ' ') ?> ₽</div>
        <?php
        if ($model -> price != 0){
            $proc = round($model -> debet / $model -> price *100, 1);
        } else {
            $proc = 0;
        }?>
        <div class="price plus"><span>Текущий баланс:</span> <?= number_format($model -> debet, 0, ',', ' ') ?> ₽ (<?= $proc ?>%)</div>
    </td>
    <?php
    $debetAll = 0;
    $debetString = '';
    $creditAll = 0;
    $creditString = '';
    foreach ($model -> transactions as $transaction):
        if ($transaction->type == 'enrollment'){
            $debetAll += $transaction->price;
            $debetString .= '<div class="price-detail-item">'.
                '<span class="value" price="'. $transaction->price .'">+'. number_format($transaction->price, 0, ',', ' ') .' ₽</span>'.
                '<span class="date" date="'. $transaction->date .'">'.date('d.m.Y', $transaction->date).'</span>'.
                '<span class="info" transactionid="' . $transaction->id . '" >'.
                    '<span class="icon"></span>'.
                    '<span class="content">' . $transaction->comment . '</span>'.
                '</span></div>';
        } else {
            $creditAll += $transaction->price;
            if (isset($transaction->implementer) && !empty($transaction->implementer)){
                $transactionImplementerId = $transaction->implementer;
                $transactionImplementerName = $implementers[$transaction->implementer];
            } else {
                $transactionImplementerId = '';
                $transactionImplementerName = '';
            }
            $creditString .= '<div class="price-detail-item">'.
                '<span class="value" price="'. $transaction->price .'">-'. number_format($transaction->price, 0, ',', ' ') .' ₽</span>'.
                '<span class="date" date="'. $transaction->date .'">'.date('d.m.Y', $transaction->date).'</span>'.
                '<span class="info" transactionid="' . $transaction->id . '" implementerid="'. $transactionImplementerId .'" implementername="'. $transactionImplementerName .'">'.
                    '<span class="icon"></span>'.
                    '<span class="content">' . $transaction->comment . '</span>'.
                '</span>'.
                '<span class="mplementer-name">'.$transactionImplementerName.'</span>'.
                '</div>';
        }
    endforeach;
    ?>
    <td>
        <div class="price plus"><?= number_format($debetAll, 0, ',', ' ') ?> ₽</div>
        <div class="price-detail-items"> <?= $debetString ?></div>
        <a href="#" class="add-price-btn plus">+ Поступление</a>
    </td>
    <td>
        <div class="price minus"><?= number_format($creditAll, 0, ',', ' ') ?> ₽</div>
        <div class="price-detail-items"><?= $creditString ?></div>
        <a href="#" class="add-price-btn minus">- Расход</a>
    </td>
    <td>
        <div class="clients-bts">
            <?php
            if ($model -> status == 1){
                echo '<a href="#" class="clients-btn close">Закрыть</a>';
            } else{
                echo '<a href="#" class="clients-btn close open">Открыть</a>';
            }
            ?>
            <a href="#" class="clients-btn edit">Изменить</a>
            <a href="#" class="clients-btn delete"   object-type="project">Удалить</a>
        </div>
    </td>
<!--</tr>-->