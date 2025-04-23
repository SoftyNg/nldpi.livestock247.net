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
                            <div>Registration Number</div>
                            <h5><?= $record_obj->reg_number; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Applied:</div>
                            <h5><?= $record_obj->reg_date; ?></h5>
                        </div>                        
                    </div>
                    <div>
                        <div class="div-content">
                            <div>Trade License Number</div>
                            <h5><?= $record_obj->trade_license_number; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>No. of Vehicles in Fleet</div>
                            <h5><?= $record_obj->no_vehicle_in_fleet; ?></h5>
                        </div>                        
                    </div>
                </div>
                <hr>
                <div class="service-span">
                    <h4>Contact Details</h4>
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
                            <div>Operating States</div>
                            <h5><?= nl2br(out($record_obj->operating_states)); ?></h5>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="service-span-upload-document">
                    <h4>Uploaded Document</h4>
                    <div>
                        <div class="div-content">
                            <div>CAC Registration Certficate</div>
                            <?php if (!empty($record_obj->reg_certificate)) { ?>
                            <div class="upload-document">
                                <a href="<?= $record_obj->reg_certificate_link ?>" target="_blank"><img src="<?= THEME_DIR?>img/file-icon.png" alt="" class="fa-file-icon"> <?= $record_obj->reg_certificate;?></a>
                            </div>
                            <?php } else { ?>
                            <div class="upload-document">
                                <span>No Document</span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="div-content">
                            <div>Transportation License</div>
                            <?php if (!empty($record_obj->transport_certificate)) { ?>
                            <div class="upload-document">
                                <a href="<?= $record_obj->transport_certificate_link ?>" target="_blank"><img src="<?= THEME_DIR?>img/file-icon.png" alt="" class="fa-file-icon"> <?= $record_obj->transport_certificate;?></a>
                            </div>
                            <?php } else { ?>
                            <div class="upload-document">
                                <span>No Document</span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="div-content">
                            <div>Insurance Certificate</div>
                            <?php if (!empty($record_obj->insurance_certificate)) { ?>
                            <div class="upload-document">
                                <a href="<?= $record_obj->insurance_certificate_link ?>" target="_blank"><img src="<?= THEME_DIR?>img/file-icon.png" alt="" class="fa-file-icon"> <?= $record_obj->insurance_certificate;?></a>
                            </div>
                            <?php } else { ?>
                            <div class="upload-document">
                                <span>No Document</span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="div-content">
                            <div>Tax Certificate</div>
                            <?php if (!empty($record_obj->tax_certificate)) { ?>
                            <div class="upload-document">
                                <a href="<?= $record_obj->tax_certificate_link ?>" target="_blank"><img src="<?= THEME_DIR?>img/file-icon.png" alt="" class="fa-file-icon"> <?= $record_obj->tax_certificate;?></a>
                            </div>
                            <?php } else { ?>
                            <div class="upload-document">
                                <span>No Document</span>
                            </div>
                            <?php } ?>
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