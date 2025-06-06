<?php
$count = 0;

foreach ($all_services as $item):
    if ($count % 2 === 0): ?>
        <div class="row"> <!-- Start new row -->
    <?php endif;

    $title = '';
    $location = '';

    switch (strtolower($item['type'] ?? '')) {
        case 'service-provider':
            $title = $item['company_name'] ?? 'Unknown Company';
            $location = $item['address'] ?? '';
            break;

        case 'vet-professional':
            $title = trim(($item['firstname'] ?? '') . ' ' . ($item['lastname'] ?? ''));
            $location = $item['address'] ?? '';
            break;

        case 'market':
            $title = $item['market_name'] ?? 'Unknown Market';
            $location = $item['address'] ?? '';
            break;

        case 'transporter':
            $title = $item['name'] ?? 'Unknown Transporter';
            $location = $item['origin'] ?? '';
            break;

        case 'farmerskeepers':
            $title = $item['name'] ?? 'Unknown Farmer/Keeper';
            $location = $item['address'] ?? '';
            break;

        default:
            $title = $item['name'] ?? $item['company_name'] ?? 'Unknown';
            $location = $item['address'] ?? '';
            break;
    }
    ?>

    <div class="col-md-6 border p-2 mb-2 rounded bg-white">
      <h5 class="mb-0"><?= htmlentities($title) ?></h5>
      <small><?= htmlentities($location) ?></small>
    </div>

    <?php
    $count++;

    if ($count % 2 === 0): ?>
        </div> <!-- End row -->
    <?php endif;
endforeach;

if ($count % 2 !== 0): ?>
    </div> <!-- Close last row if odd -->
<?php endif; ?>
