<li class="nav-item <?= segment(2) === 'number_banks' ? 'active' : '' ?>">

    <a class="nav-link" href="<?= BASE_URL ?>service_providers/number_banks">
        <?php if (segment(2) === 'number_banks') : ?>
            <img src="<?= THEME_DIR?>img/receipt-fill.png" alt="Number Banks">
        <?php else : ?>
            <img src="<?= THEME_DIR?>img/receipt-line.png" alt="Number Banks">
        <?php endif ?>
        <span>Number Banks</span>
    </a>
</li>

<li class="nav-item <?= segment(2) === 'livestock_registry' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= BASE_URL . 'service_providers/livestock_registry'?>">
        <?php if (segment(2) === 'livestock_registry') : ?>
            <img src="<?= THEME_DIR?>img/Notepad2.png" alt="Livestock Registry">
        <?php else : ?>
            <img src="<?= THEME_DIR?>img/Notepad.png" alt="Livestock Registry">
        <?php endif ?>
        <span>Livestock Registry</span>
    </a>
</li>