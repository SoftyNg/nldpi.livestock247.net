<li class="nav-item <?= segment(2) === 'users' ? 'active' : '' ?>">

    <a class="nav-link" href="<?= BASE_URL ?>admin/users/service-provider">

        <?php if (segment(2) === 'users') : ?>

            <img src="<?= THEME_DIR?>img/Buildings.png" alt="User Registrations">

        <?php else : ?>

            <img src="<?= THEME_DIR?>img/Buildings2.png" alt="User Registrations">

        <?php endif ?>

        <span>User Registrations</span>

    </a>

</li>



<li class="nav-item <?= segment(1) === 'breed_registrations' ? 'active' : '' ?>">

    <a class="nav-link" href="<?= BASE_URL ?>breed_registrations">

        <?php if (segment(1) === 'breed_registrations') : ?>

            <img src="<?= THEME_DIR?>img/PawPrint2.png" alt="Breed Registry">

        <?php else : ?>

            <img src="<?= THEME_DIR?>img/PawPrint.png" alt="Breed Registry">

        <?php endif ?>

        <span>Breed Registry</span>

    </a>

</li>



<li class="nav-item <?= segment(1) === 'number_bank' ? 'active' : '' ?>">

    <a class="nav-link" href="<?= BASE_URL ?>number_bank">

        <?php if (segment(1) === 'number_bank') : ?>

            <img src="<?= THEME_DIR?>img/receipt-fill.png" alt="Number Banks">

        <?php else : ?>

            <img src="<?= THEME_DIR?>img/receipt-line.png" alt="Number Banks">

        <?php endif ?>

        <span>Number Banks</span>

    </a>

</li>



<li class="nav-item <?= segment(1) === 'market_registry' ? 'active' : '' ?>">

    <a class="nav-link" href="<?= BASE_URL . 'market_registry/dashboard'?>">

       

        <?php if (segment(1) === 'market_registry') : ?>

            <img src="<?= THEME_DIR?>img/MapPinLine2.png" alt="Market Registry">

        <?php else : ?>

            <img src="<?= THEME_DIR?>img/MapPinLine.png" alt="Market Registry">

        <?php endif ?>

        <span>Market Registry</span>

    </a>

</li>



<li class="nav-item <?= segment(2) === 'registries' ? 'active' : '' ?>">

    <a class="nav-link" href="<?= BASE_URL . 'registries/dashboard'?>">

       

        <?php if (segment(2) === 'number_bank') : ?>

            <img src="<?= THEME_DIR?>img/AddressBookTabs2.png" alt="Registries">

        <?php else : ?>

            <img src="<?= THEME_DIR?>img/AddressBookTabs.png" alt="Registries">

        <?php endif ?>

        <span>Registries</span>

    </a>

</li>