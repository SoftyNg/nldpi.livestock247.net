<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="no-gutters align-items-center">
                    <div class="animal-registered-container">
                        <span>Registered Breeds</span>
                        <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2"><?= number_format($total_registered_breed, 0) ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="no-gutters align-items-center">
                    <div class="animal-registered-container">
                        <span>Local Breeds</span>
                        <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2"><?= number_format($total_registered_local_breed, 0) ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="no-gutters align-items-center">
                    <div class="animal-registered-container">
                        <span>Exotic Breeds</span>
                        <span class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></span>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800 mt-2"><?= number_format($total_registered_exotic_breed, 0) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>