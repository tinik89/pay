<?php
use yii\helpers\Url;
use app\models\Transaction;


$curDate = Yii::$app->formatter->asDate($model->date, 'd MMMM');
$curDay = Yii::$app->formatter->asDate($model->date, 'EEEE');
$beginOfDay = Transaction::$beginOfDay;
if ($beginOfDay == 0) {
    $beginOfDay = strtotime("midnight", $model->date);
    $beginTable = '<div class="trans-col"><div class="title">' . $curDate . '<span>' . $curDay . '</span></div><div class="trans-item"> <table>';
} else if ($model->date < $beginOfDay) {
    $beginOfDay = strtotime("midnight", $model->date);
    $beginTable = '</table></div></div><div class="trans-col"><div class="title">' . $curDate . '<span>' . $curDay . '</span></div><div class="trans-item"> <table>';

} else {
    $beginTable = '';
} ?>

<?= $beginTable ?>

    <tr id="tr-id-<?= $model->id ?>" data-key="<?= $model->id ?>">
        <td>
            <div class="date"><?= $model->id ?>|<?= $curDate ?><span><?= $curDay ?></span></div>
        </td>
        <td>
            <a href="<?= Url::to(['project/show', 'id' => $model->client_id]) ?>"
               class="name"><?= $model->client->name ?></a>
            <div class="category"><?= $model->project->name ?></div>
        </td>
        <td>
            <?php if ($model->type == 'enrollment') {
                echo '<div class="price del-name" object-id="' . $model->id . '">+' . number_format($model->price, 0, ',', ' ') . '₽ </div>';
            } else {
                $implementer = (isset($model->implementerinfo)) ? $model->implementerinfo->name : '';
                echo '<div class="price minus del-name" object-id="' . $model->id . '">-' . number_format($model->price, 0, ',', ' ') . '₽ <p>' . $implementer . '</p></div>';
            } ?>
        </td>
        <td>
            <div class="method"><?php if ($model->cash == 1) {
                    echo 'Наличный';
                } else {
                    echo 'Безналичный';
                } ?></div>
        </td>
        <td>
            <div class="info"><?php
                if (!empty($model->comment)) {
                    echo $model->comment;
                } ?>
            </div>
        </td>

        <td><a href="#" class="clients-btn delete" object-type="transaction">Удалить</a></td>
    </tr>
<?php Transaction::$beginOfDay = $beginOfDay; ?>