<?php
use yii\helpers\Url;
?>
<tr id="tr-id-<?=$project -> id?>">
    <td>
        <div class="service del-name" object-id="<?= $project->id ?>"><?=$project->name?></div>
        <a href="<?= Url::to(['project/show', 'id' => $project -> client])?>" class="name" client-id="<?=$project -> client?>"><?= $project -> clientinfo -> name ?></a>
        <div class="category">
            <?php
            if (isset($project -> taginfo)){
                echo $project -> taginfo -> tag;
            } else {
                echo 'расходы фирмы';
            } ?></div>
    </td>
    <td>
        <div class="price"> <?= $project -> price ?> ₽</div>
        <div class="price minus"><span>Долг:</span> <?= $project -> credit ?> ₽</div>
        <?php
        if ($project -> price != 0){
            $proc = round($project -> debet / $project -> price *100, 1);
        } else {
            $proc = 0;
        }?>
        <div class="price plus"><span>Текущий баланс:</span> <?= $project -> debet ?> ₽ (<?= $proc ?>%)</div>
    </td>
    <?php
    $debetAll = 0;
    $debetString = '';
    $creditAll = 0;
    $creditString = '';
    foreach ($project -> transactions as $transaction):
        if ($transaction->type == 'enrollment'){
            $debetAll += $transaction->price;
            $debetString .= '<div class="price-detail-item"><span class="value">+'. $transaction->price .' ₽</span> <span class="date">'.date('d.m.Y', $transaction->date).'</span><span class="info" transactionid="' . $transaction->id . '"><span class="icon"></span><span class="content">' . $transaction->comment . '</span></span></div>';
        } else {
            $creditAll += $transaction->price;
            $creditString .= '<div class="price-detail-item"><span class="value">-'. $transaction->price .' ₽</span> <span class="date">'.date('d.m.Y', $transaction->date).'</span><span class="info" transactionid="' . $transaction->id . '"><span class="icon"></span><span class="content">' . $transaction->comment . '</span></span></div>';
        }
    endforeach;
    ?>
    <td>
        <div class="price plus"><?= $debetAll ?> ₽</div>
        <div class="price-detail-items"> <?= $debetString ?></div>
        <a href="#" class="add-price-btn plus">+ Поступление</a>
    </td>
    <td>
        <div class="price minus"><?= $creditAll ?> ₽</div>
        <div class="price-detail-items"><?= $creditString ?></div>
        <a href="#" class="add-price-btn minus">- Расход</a>
    </td>
    <td>
        <div class="clients-bts">
            <?php
            if ($project -> status == 1){
                echo '<a href="#" class="clients-btn close">Закрыть</a>';
            } else{
                echo '<a href="#" class="clients-btn close open">Открыть</a>';
            }
            ?>
            <a href="#" class="clients-btn edit">Изменить</a>
            <a href="#" class="clients-btn delete">Удалить</a>
        </div>
    </td>
</tr>