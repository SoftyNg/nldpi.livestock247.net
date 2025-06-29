<?php

$count = 0;

foreach ($all_services as $item):
    // Open a new row for every two items
    if ($count % 2 === 0): ?>
        <div class="row"> <!-- Start new row -->
    <?php endif;

    // Initialize display variables
    $title = '';
    $location = '';
    $vet = '';
    $bank = '';

    // Determine content based on service type
    switch (strtolower($item['type'] ?? '')) {
        case 'service-provider':
            $type     = $item['type'];
            $title    = $item['company_name'] ?? 'Unknown Company';
            $location = $item['address'] ?? '';

            $vet = (!empty($item['vet_services']) && $item['vet_services'] == 1)
                ? '<img src="' . BASE_URL . 'images/Hospital.png" width="24" height="24"><span>Vet</span>'
                : '';

            $bank = (!empty($item['bank']) && $item['bank'] == 1)
                ? '<img src="' . BASE_URL . 'images/Bank.png" width="24" height="24"><span>Bank</span>'
                : '';
            break;

        case 'vet professional':
            $type     = $item['type'];
            $title    = trim(($item['firstname'] ?? '') . ' ' . ($item['lastname'] ?? ''));
            $location = $item['reg_number'] ?? '';

            $vet = (!empty($item['vet_services']) && $item['vet_services'] == 1)
                ? '<img src="' . BASE_URL . 'images/Hospital.png" width="24" height="24"><span>Vet</span>'
                : '';

            $bank = (!empty($item['bank']) && $item['bank'] == 1)
                ? '<img src="' . BASE_URL . 'images/Bank.png" width="24" height="24"><span>Bank</span>'
                : '';
            break;

        case 'market':
            $type     = $item['type'];
            $title    = $item['name'] ?? 'Unknown Market';
            $location = $item['address'] ?? '';

            $vet = (!empty($item['vet_services']) && $item['vet_services'] == 1)
                ? '<img src="' . BASE_URL . 'images/Hospital.png" width="24" height="24"><span>Vet</span>'
                : '';

            $bank = (!empty($item['bank']) && $item['bank'] == 1)
                ? '<img src="' . BASE_URL . 'images/Bank.png" width="24" height="24"><span>Bank</span>'
                : '';
            break;

        case 'transporter':
            $type     = $item['type'];
            $title    = $item['name'] ?? 'Unknown Transporter';
            $location = $item['origin'] ?? '';
            break;

        case 'farmerskeepers':
            $type     = $item['type'];
            $title    = $item['name'] ?? 'Unknown Farmer/Keeper';
            $location = $item['address'] ?? '';
            break;

        default:
            $type     = $item['type'];
            $title    = $item['name'] ?? $item['company_name'] ?? 'Unknown';
            $location = $item['address'] ?? '';
            break;
    }
    ?>

    <!-- Card block for service -->
    <div class="col border card mt-4 p-2 pl-2 mb-2 rounded ml-2">
        <p style="color:green"><?= htmlentities($type); ?></p>
        <h5 class="mb-0"><?= htmlentities($title) ?></h5>

        <!-- Row with icons and labels -->
        <div style="display: flex; gap: 20px; align-items: center;">
            <!-- Location -->
            <div style="display: flex; align-items: center; gap: 5px;">
                <img src="<?= BASE_URL ?>images/location.png" width="24" height="24">
                <small><?= htmlentities($location) ?></small>
            </div>

            <!-- Vet Icon -->
            <div style="display: flex; align-items: center; gap: 5px;">
                <?= $vet ?>
            </div>

            <!-- Bank Icon -->
            <div style="display: flex; align-items: center; gap: 5px;">
                <?= $bank ?>
            </div>
        </div>
    </div>

    <?php
    $count++;

    // Close row after every 2 items
    if ($count % 2 === 0): ?>
        </div> <!-- End row -->
    <?php endif;
endforeach;

// If the final row is not closed, close it
if ($count % 2 !== 0): ?>
    </div> <!-- Close last row if odd -->
<?php endif; ?>
