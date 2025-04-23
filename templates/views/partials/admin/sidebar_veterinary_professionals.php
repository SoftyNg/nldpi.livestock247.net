<li class="nav-item <?= segment(2) === 'livestock_registry' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= BASE_URL . 'veterinary_professionals/livestock_registry'?>">
        <?php if (segment(2) === 'livestock_registry') : ?>
            <img src="<?= THEME_DIR?>img/Notepad2.png" alt="Livestock Registry">
        <?php else : ?>
            <img src="<?= THEME_DIR?>img/Notepad.png" alt="Livestory Registry">
        <?php endif ?>
        <span>Livestock Registry</span>
    </a>
</li>

<li class="nav-item <?= segment(2) === 'transport_permit' ? 'active' : '' ?>">

    <a class="nav-link" href="<?= BASE_URL ?>veterinary_professionals/transport_permit">
        <?php if (segment(2) === 'transport_permit') : ?>
            <img src="<?= THEME_DIR?>img/Truck2.png" alt="Transport Permit">
        <?php else : ?>
            <img src="<?= THEME_DIR?>img/Truck.png" alt="Transport Permit">
        <?php endif ?>  
        <span>Transport Permit</span>
    </a>
</li>