<!-- Veterinary Professionals List -->
<div class="row">
    <?php foreach ($veterinary_professionals as $index => $v): ?>
        <div class="col-md-4 mb-4">
            <div class="border rounded p-3 h-100 card">
                
                <!-- Header Row: Name and Verified Badge -->
                <div class="row align-items-center pr-3">
                    <div class="col">
                        <h5 class="fw-bold text-success">
                            <strong><?= $v->firstname ?></strong>
                        </h5>
                    </div>

                    <!-- Display "Verified" badge if status is 1 -->
                    <?php if ($v->status == 1): ?>
                        <div class="col-auto ms-auto">
                            <span class="label">Verified</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Professional Details -->
                <div class="row mt-2">
                    <div class="col">
                        <p>Professional Body:</p>
                        <p><strong><?= $v->professional_body ?></strong></p>

                        <p>Registration Number:</p>
                        <p><strong><?= $v->nldpi_number ?></strong></p>
                    </div>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Pagination -->
<!-- You can echo pagination links here if available -->
