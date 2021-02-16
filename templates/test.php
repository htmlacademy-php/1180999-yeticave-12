<ul class="lots__list">
    <!--заполните этот список из массива с товарами-->
    <?php foreach($lots as $lot): ?>
        <li class="lots__item lot">
            <div class="lot__image">
                <img src="<?= $lot['image']?>" width="350" height="260" alt="<?= $lot['name']?>">
            </div>
            <div class="lot__info">
                <span class="lot__category"><?= htmlspecialchars($lot['category_name']) ?></span>
                <h3 class="lot__title"><a class="text-link" href="/lot.php?id=<?= $lot['id'] ?>"><?= htmlspecialchars($lot['name'])?></a></h3>
                <div class="lot__state">
                    <div class="lot__rate">

                        <!-- Блок цена - если ставок нет, то отобр-ся стартовая цена, иначе цена со ставкой -->
                        <?php if (!$lot['current_price']): ?>
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?= format_price($lot['price']); ?></span>
                        <?php else: ?>
                            <span class="lot__amount">Текущая цена</span>
                            <span class="lot__cost"><?= format_price($lot['current_price']); ?></span>
                        <?php endif; ?>

                    </div>
                    <!-- Формаирование класса с красной плашкой -->
                    <?php
                    $timer = get_time_before($lot['dt_end']);
                    $time_finishing_class = ($timer[0] < 1) ? 'timer--finishing':  '';
                    ?>
                    <!-- Вывод таймера лота -->
                    <div class="lot__timer timer <?= $time_finishing_class; ?>">
                        <?= $timer[0].":".sprintf("%02d", $timer[1]); ?>
                    </div>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
