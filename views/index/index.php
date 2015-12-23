<? /** @var $results Array */ ?>

<? if ($results['bulls'] == \Components\BullsCow::MAX_LENGTH): ?>
    Поздравляем! Вы выиграли.
<? else: ?>
    <p>Быков: <?= $results['bulls'] ?></p>
    <p>Коров: <?= $results['cow'] ?></p>
<? endif ?>