<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
    <div class="sidebar-brand-icon">
        <img class="img-logo" src="<?= THEME_DIR?>img/nldpi-logo.png" alt="Company Logo">
    </div>
</a>

<hr class="sidebar-divider my-0">

<li class="nav-item <?= segment(2) === 'dashboard' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= BASE_URL . segment(1) . '/dashboard' ?>">
        <?php if (segment(2) === 'dashboard') : ?>
            <img src="<?= THEME_DIR?>img/House.png" alt="Dashboard">
        <?php else : ?>
            <img src="<?= THEME_DIR?>img/House2.png" alt="Dashboard">
        <?php endif ?>
        <span>Dashboard</span>
    </a>
</li>

<hr class="sidebar-divider">

<li class="nav-item <?= segment(2) === 'users' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= BASE_URL ?>admin/users">
        <?php if (segment(2) === 'users') : ?>
            <img src="<?= THEME_DIR?>img/Buildings.png" alt="User Registrations">
        <?php else : ?>
            <img src="<?= THEME_DIR?>img/PawPrint.png" alt="User Registrations">
        <?php endif ?>
        <span>User Registrations</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?= BASE_URL ?>">
        <img src="<?= THEME_DIR?>img/PawPrint.png" alt="Service Providers Registry">
        <span>Service Providers Registry</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?= BASE_URL . 'breed_registrations'?>">
        <img src="<?= THEME_DIR?>img/PawPrint.png" alt="Breed Registry">
        <span>Breed Registry</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?= BASE_URL . 'breed_registrations/dashboard'?>">
        <img src="<?= THEME_DIR?>img/PawPrint.png" alt="Number Banks">
        <span>Number Banks</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?= BASE_URL . 'animal_registrations/dashboard'?>">
        <img src="<?= THEME_DIR?>img/Notepad.png" alt="Livestock Registry">
        <span>Livestock Registry</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?= BASE_URL . 'breed_registrations/dashboard'?>">
        <img src="<?= THEME_DIR?>img/PawPrint.png" alt="Market Registry">
        <span>Market Registry</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?= BASE_URL . 'breed_registrations/dashboard'?>">
        <img src="<?= THEME_DIR?>img/PawPrint.png" alt="Registries">
        <span>Registries</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?= BASE_URL . 'breed_registrations/dashboard'?>">
        <img src="<?= THEME_DIR?>img/PawPrint.png" alt="Transport Permits">
        <span>Transport Permits</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?= BASE_URL . 'breed_registrations/dashboard'?>">
        <img src="<?= THEME_DIR?>img/PawPrint.png" alt="Livestock Health">
        <span>Livestock Health</span>
    </a>
</li>

<hr class="sidebar-divider custom-divider">

<li class="nav-item ">
    <a class="nav-link" href="users/logout" data-toggle="modal" data-target="#logoutModal">
        <img src="<?= THEME_DIR?>img/logout-box-r-line.png" alt="Log Out">
        <span>Log Out</span>
    </a>
</li>

<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>