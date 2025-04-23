<div class="container-fluid">
    <?php require_once "header-top.php"; ?>
    <!-- header approval -->
    <?php require_once "header_approval.php"; ?>

    <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12 mt-5">
            <div class="card shadow p-4">
                <!-- Card Body -->
                <div class="service-span">
                    <h4><?= $registration_headline ?> <?= ($record_obj->status == 1) ?  ' - ID:'.$record_obj->nldpi_number : ''; ?></h4>
                    <div>
                        <div class="div-content">
                            <div>Type</div>
                            <h5><?= $record_obj->type; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Applied:</div>
                            <h5><?= $record_obj->reg_date; ?></h5>
                        </div>                        
                    </div>
                </div>
                <hr>
                <div class="service-span">
                    <h4>Contact Details</h4>
                    <div>
                        <div class="div-content">
                            <div>Name</div>
                            <h5><?= $record_obj->name; ?></h5>
                        </div>
                    </div>
                    <div>
                        <div class="div-content">
                            <div>Phone Number</div>
                            <h5><?= $record_obj->phone_number; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Email Address</div>
                            <h5><?= $record_obj->email; ?></h5>
                        </div>
                    </div>
                    <div>
                        <div class="div-content">
                            <div>Address</div>
                            <h5><?= $record_obj->address; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>State</div>
                            <h5><?= $record_obj->state; ?></h5>
                        </div>
                    </div>
                </div>                           
            </div>
        </div>
    </div>
</div>

<style>
    .btn-nldpi-red {
        background-color: #DC3545;
        border-color: #DC3545;
        color: #fff;
    }
    .btn-nldpi-red:hover {
        background-color: #c82333;
        border-color: #c82333;
        color: #fff;
    }

    .btn-nldpi-green:hover {
        background-color: #005229;
        border-color: #005229;
        color: #fff;
    }
    .btn-nldpi-green {
        background-color: green;
        border-color: green;
        color: #fff;
    }
</style>