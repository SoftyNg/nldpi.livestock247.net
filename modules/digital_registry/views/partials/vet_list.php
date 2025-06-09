<div class="row">
<?php foreach ($veterinary_professionals as $index => $v): ?>
    <div class="col-md-4 mb-4">
        <div class="border rounded p-3 h-100">
            <div class="row align-items-center pr-3">
                <div class="col">
                    <h5 class="fw-bold text-success"><?= $v->firstname ?></h5>
                </div>
                <?php if ($v->status == 1): ?>
                    <div class="col-auto ms-auto">
                        <span class="badge bg-success">✔ Verified</span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col">
                    <p><strong>Professional Body:</strong></p>
                    <p><?= $v->reg_number ?></p>
                </div>
                <div class="col">
                    <p><strong>Phone Number:</strong></p>
                    <p><?= $v->phone_number ?></p>
                </div>
                <div class="col">
                    <p><strong>Email:</strong></p>
                    <p><?= $v->email ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<!-- Pagination -->
