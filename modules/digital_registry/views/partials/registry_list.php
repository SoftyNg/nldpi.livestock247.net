<?php
/**
 * Service Providers List Partial
 * Displays service provider records with optional pagination.
 */
?>

<?php foreach ($service_providers as $sp): ?>
    <div class="border rounded p-3 mb-3 card">
        <div class="row align-items-center pr-3">
            <div class="col">
                <h5 class="company-name"><?= $sp->company_name ?></h5>
            </div>

            <?php if ($sp->status == 1): ?>
                <div class="col-auto ms-auto">
                    <span class="label">Verified</span>
                </div>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col">
                <p>Location:</p>
                <p><strong><?= $sp->address ?></strong></p>
            </div>

            <div class="col">
                <p>Phone Number:</p>
                <p><strong><?= $sp->phone_number ?></strong></p>
            </div>

            <div class="col">
                <p>Email:</p>
                <p><strong><?= $sp->email ?></strong></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Pagination -->
<?php if ($total_pages > 1): ?>
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                    <a href="#" class="page-link pagination-link" data-page="<?= $i ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>
