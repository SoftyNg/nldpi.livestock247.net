<div class="sidebar-brand d-flex align-items-center justify-content-center">

    <div class="sidebar-brand-icon">

        <img class="img-logo" src="<?= THEME_DIR?>img/nldpi-logo.png" alt="Company Logo">

    </div>

</div>



<?php 

$link = BASE_URL . segment(1) . '/dashboard';

if (segment(1) == 'admin' || segment(1) == 'breed_registrations' ||segment(1) == 'number_bank') {

    $link = BASE_URL . 'admin/dashboard';

}else if (segment(1) == 'service_providers' ) {

    $link = BASE_URL . 'service_providers/dashboard';

}





?>





<hr class="sidebar-divider my-0">



<li class="nav-item <?= segment(2) === 'dashboard' ? 'active' : '' ?>">

    <a class="nav-link" href="<?= $link ?>">

        <?php if (segment(2) === 'dashboard') : ?>

            <img src="<?= THEME_DIR?>img/House.png" alt="Dashboard">

        <?php else : ?>

            <img src="<?= THEME_DIR?>img/House2.png" alt="Dashboard">

        <?php endif ?>

        <span>Dashboard</span>

    </a>

</li>



<hr class="sidebar-divider">



<?php if (segment(1) === 'admin' || segment(1) === 'breed_registrations' || segment(1) === 'number_bank'
          || segment(1) === 'market_registry') : ?>

<?= Template::partial('partials/admin/sidebar_administrator') ?>

<?php endif ?>





<?php if (segment(1) === 'service_providers') : ?>

<?= Template::partial('partials/admin/sidebar_service_providers') ?>

<?php endif ?>



<?php if (segment(1) === 'veterinary_professionals') : ?>

<?= Template::partial('partials/admin/sidebar_veterinary_professionals') ?>

<?php endif ?>



<?php if (segment(1) === 'livestock_keepers') : ?>

<?= Template::partial('partials/admin/sidebar_livestock_keepers') ?>

<?php endif ?>



<?php if (segment(1) === 'tranporter_registrations') : ?>

<?= Template::partial('partials/admin/sidebar_transporter_registrations') ?>

<?php endif ?>



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