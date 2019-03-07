<!-- projects popup -->
<div class="projects-overlay"></div>
<div class="projects-popup">
    <div class="projects-items">

        <div class="projects-col">
            <div class="projects-item">
                <?php
                if ($clientPrice != 0) {
                    $clientProc = round($clientDebet / $clientPrice * 100, 1);
                } else {
                    $clientProc = 0;
                } ?>
                <div class="title"><?= $clientName ?>:</div>
                <div class="count">
                    <?= $projectsOpen; ?> открыто /<?php echo $projectsCount - $projectsOpen; ?> закрыто
                </div>
                <div class="all-price minus"><span>Общий долг:</span> - <?= number_format($clientCredit, 0, ',', ' ') ?> ₽</div>
                <div class="all-price plus"><span>Общий баланс:</span> + <?= number_format($clientDebet, 0, ',', ' ') ?>
                    ₽(<?= $clientProc ?>%)
                </div>
                <div class="list">
                    <ul>
                        <?php foreach ($summTags as $arr): ?>
                            <?php
                            if (isset($arr->taginfo)) {
                                $tagname = $arr->taginfo->tag;
                            } else {
                                $tagname = 'расходы фирмы';
                            }
                            if ($arr->sumPrice != 0) {
                                $tagProc = round($arr->sumDebet / $arr->sumPrice * 100, 1);
                            } else {
                                $tagProc = 0;
                            }
                            ?>
                            <li>
                                <strong><?= $tagname ?>:</strong>
                                            <span class="value"><?= number_format($arr->sumDebet, 0, ',', ' ') ?> ₽
                                                <span class="percent">(<?= $tagProc ?>%)</span>
                                            </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>


                </div>
            </div>
        </div>


    </div>
</div>