<li class="nav-item <?= segment(2) === 'livestock_registry' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= BASE_URL . 'livestock_keepers/livestock_registry'?>">
        <?php if (segment(2) === 'livestock_registry') : ?>
            <img src="<?= THEME_DIR?>img/Notepad2.png" alt="Livestock Registry">
        <?php else : ?>
            <img src="<?= THEME_DIR?>img/Notepad.png" alt="Livestory Registry">
        <?php endif ?>
        <span>Livestock Registry</span>
    </a>
</li>