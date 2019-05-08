<?php
use yii\helpers\Url;

?>
<tr id="tr-id-<?= $model->id ?>" data-key="<?= $model->id ?>">
    <td>
        <a href="<?= Url::to(['project/show', 'id' => $model->id]) ?>" class="name del-name" object-id="<?= $model->id ?>">
            <?= $model->name ?>
        </a>
    </td>
    <?php
    $debetAll = 0;
    $creditAll = 0;
    foreach ($model->projects as $project):
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
    <td><a href="#" class="clients-btn delete" object-type="client">Удалить</a></td>
</tr>