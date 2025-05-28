<?php foreach ($service_providers as $sp): ?>
    <div class="border rounded p-3 mb-3">
        <h5 class="fw-bold text-success"><?= $sp->company_name ?></h5>
        <p><strong>Location:</strong> <?= $sp->address ?></p>
        <p><strong>Phone Number:</strong> <?= $sp->phone_number ?></p>
      
        <?php if ($sp->status == 1): ?>
            <span class="badge bg-success">✔ Verified</span>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<!-- Pagination -->
<?php if ($total_pages > 1): ?>
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                    <a href="#" class="page-link pagination-link" data-page="<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>
