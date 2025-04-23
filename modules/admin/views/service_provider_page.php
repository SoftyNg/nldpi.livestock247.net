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
                            <div>Capitalization</div>
                            <h5>&#x20A6;<?= number_format($record_obj->capitalization); ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Years in Operation</div>
                            <h5><?= $record_obj->year_in_operation; ?></h5>
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
                            <div>Website</div>
                            <h5><?= $record_obj->website; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Address</div>
                            <h5><?= $record_obj->address; ?></h5>
                        </div>
                    </div>
                    <div>
                        <div class="div-content">
                            <div>State</div>
                            <h5><?= $record_obj->state; ?></h5>
                        </div>
                    </div>
                </div>


                <hr>
                <div class="service-span">
                    <h4>Management Team</h4>
                    <div>
                        <div class="div-content">
                            <div>Name</div>
                            <h5><?= $record_obj->team_name_1; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Email Address</div>
                            <h5><?= $record_obj->team_email_1; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Position</div>
                            <h5><?= $record_obj->team_position_1; ?></h5>
                        </div>
                    </div>
                    <hr/>
                    <div>
                        <div class="div-content">
                            <div>Name</div>
                            <h5><?= $record_obj->team_name_2; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Email Address</div>
                            <h5><?= $record_obj->team_email_2; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Position</div>
                            <h5><?= $record_obj->team_position_2; ?></h5>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="service-span">
                    <h4>Veterinary Professional</h4>
                    <div>
                        <div class="div-content">
                            <div>Name</div>
                            <h5><?= $record_obj->vet_name; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Email Address</div>
                            <h5><?= $record_obj->vet_email; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Position</div>
                            <h5><?= $record_obj->vet_position; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Registration Number</div>
                            <h5><?= $record_obj->vet_reg_number; ?></h5>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="service-span-upload-document">
                    <h4>Uploaded Document</h4>
                    <div>
                        <div class="div-content">
                            <div>Registration Certficate</div>
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
                            <div>Company Logo</div>
                            <?php if (!empty($record_obj->company_logo)) { ?>
                            <div class="upload-document">
                                <a href="<?= $record_obj->company_logo_link ?>" target="_blank"><img src="<?= THEME_DIR?>img/file-icon.png" alt="" class="fa-file-icon"> <?= $record_obj->company_logo;?></a>
                            </div>
                            <?php } else { ?>
                            <div class="upload-document">
                                <span>No Document</span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="div-content">
                            <div>Veterinary Professional Certificate</div>
                            <?php if (!empty($record_obj->vet_reg_certificate)) { ?>
                            <div class="upload-document">
                                <a href="<?= $record_obj->vet_reg_certificate_link ?>" target="_blank"><img src="<?= THEME_DIR?>img/file-icon.png" alt="" class="fa-file-icon"> <?= $record_obj->vet_reg_certificate;?></a>
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