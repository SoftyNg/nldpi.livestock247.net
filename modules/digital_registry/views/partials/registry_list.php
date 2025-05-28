<?php  foreach ($service_providers as $sp): ?>
    <div class="border rounded p-3 mb-3">
     <div class="row align-items-center pr-3">
    <div class="col">
        <h5 class="fw-bold text-success"><?= $sp->company_name ?></h5>
    </div>

    <?php if ($sp->status == 1): ?>
        <div class="col-auto ms-auto">
            <span class="badge bg-success">✔ Verified</span>
        </div>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col">
        <p><strong>Location:</strong> </p>
        <p><?= $sp->address ?></p>
        </div>
         <div class="col">
        <p><strong>Phone Number:</strong> </p>
        <p><?= $sp->phone_number ?></p>
        </div>
        <div class="col">
        <p><strong>Email:</strong> </p>
         <p><?= $sp->email ?></p>
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
                    <a href="#" class="page-link pagination-link" data-page="<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>
