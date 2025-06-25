<?php  require_once ("_navigation.php"); ?>
<div class="baseline-container">
    <div class="baseline">
        <div class="base-left">
            <div class="dashboard-name">
                <a href="<?= BASE_URL . 'veterinary_professionals'?>"><i class="fa fa-arrow-left"></i> Back to User Registrations</a>
                <h1 class="h3 mb-0"><?= ucwords($vet_professional->firstname.' '.$vet_professional->lastname); ?></h1>
            </div>
        </div>
        <div class="base-right d-flex justify-content-between">
            <?php if(isset($veterinary_status) && $veterinary_status =="approved"): ?>
                <div class="user-approved">Verified Doctor</div>
            <?php elseif(isset($veterinary_status) && $veterinary_status =="rejected"): ?>
                <div class="user-rejected">Rejected</div>              
            <?php else: ?>    
            <a href="" class="d-none d-sm-inline-block btn btn-nldpi-red shadow-sm mr-2 reject"  id="reject<?= $vet_professional->id ?>" data-toggle="modal" title="Reject" data-target="#reject">Reject Application</a>
            <a href="" class="d-none d-sm-inline-block btn  btn-nldpi-green shadow-sm approve" id="approve<?= $vet_professional->id ?>" data-toggle="modal" title="Approve" data-target="#approve">Approve Application</a>
            <?php endif ?>
        </div>
    </div>
</div>

<!-- End of Topbar -->


<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">

        <!-- Table Area -->
        <div class="col-xl-12 col-md-12 col-sm-12 mt-5">
            <div class="card shadow p-4">
                <!-- Card Body -->
                <div class="service-span">
                    <h5>Veterinary Professional <?= (isset($veterinary_status) && $veterinary_status =="approved") ?  '- ID:'.$vet_professional->nldpi_number : ''; ?></h5>
                    <div>
                        <div class="div-content">
                            <div>Registration Number:</div>
                            <h5><?= $vet_professional->reg_number; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Applied:</div>
                            <h5><?= date('d F, Y',$vet_professional->date_created);?></h5>
                        </div>                        
                    </div>

                    <div>
                        <div class="div-content">
                            <div>Professional Body:</div>
                            <h5><?= $professional_body_options[$vet_professional->professional_body]; ?></h5>
                        </div>
                        
                    </div>

                </div>
                <hr>
                <div class="service-span">
                    <h5>Contact Details</h5>
                    <div>
                        <div class="div-content">
                            <div>First Name</div>
                            <h5><?= $vet_professional->firstname; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Last Name:</div>
                            <h5><?= $vet_professional->lastname; ?></h5>
                        </div>
                    </div>
                    <div>
                        <div class="div-content">
                            <div>Phone Number:</div>
                            <h5><?= $vet_professional->phone_number; ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Email Address:</div>
                            <h5><?= $vet_professional->email; ?></h5>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="service-span-upload-document">
                    <h5>Uploaded Documents</h5>
                    <div>
                        <div class="div-content">
                            <div>Registration Certficate</div>
                            <div class="upload-document">
                                <?php if (!empty($vet_professional->reg_certificate)) : ?>
                                    <?php
                                        $file_for_download =str_replace(' ' , '-',$vet_professional->reg_certificate);
                                    ?>
                                    <a href="<?= BASE_URL.'files/'.strtolower($file_for_download)?>" download="<?= $vet_professional->reg_certificate;?>">
                                        <img src="<?= THEME_DIR?>img/file-icon.png" alt="" class="fa-file-icon"> 
                                        <?= ucwords($vet_professional->reg_certificate);?>
                                    </a>

                                <?php else : ?>   
                                    <span>No Document</span>
                                <?php endif ?>

                            </div>
                            
                        </div>
                    </div>
                </div>                            
            </div>
        </div>
    </div>
</div>

    <?php

        $form_location_approve_vet_professional_registration= BASE_URL . 'veterinary_professionals/approve_vet_professional_registration';
        $form_location_reject_vet_professional_registration = BASE_URL . 'Veterinary_professionals/reject_vet_professional_registration';
    ?>

<!-- Approve MODAL-->
<div class="modal fade" id="approve" role="dialog" aria-labelledby="approveModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= $form_location_approve_vet_professional_registration ?>" method="POST">
            <input type="hidden" value="<?= isset($vet_professional->id)? $vet_professional->id : ''  ?>" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Are you sure you want to approve the application?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Click on approve button to approve the application.</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-dark" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-nldpi-green shadow-sm" >Approve</button>
                </div>
            </div>
        </form>    
    </div>
</div>



<!-- Reject MODAL-->
<div class="modal fade" id="reject" role="dialog" aria-labelledby="rejectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= $form_location_reject_vet_professional_registration ?>" method="POST">
            <input type="hidden" value="<?= isset($vet_professional->id)? $vet_professional->id : ''  ?>" name="id">
            <div class="modal-content">
                <div class="modal-header">
                        <div class="form-group">
                            <label>Rejection Reason</label>
                            <textarea name="reason" class="form-control" placeholder="Enter reasons for rejection.." rows="4" cols="50"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-white shadow-sm" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-nldpi-red shadow-sm" >Reject Application</button>
                </div>
            </div>
        </form>    
    </div>
</div>