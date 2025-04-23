<div class="baseline mb-4 p-4">
    <div class="base-left">
        <div class="dashboard-name">
            <h1 class="h3 mb-0"><?= $headline ?></h1>
        </div>
    </div>
    <div class="base-right">
    <a href="breed_registrations" class="btn btn-outline-dark shadow-sm">View All Breeds</a>
    <a href="breed_registrations/create/<?= $update_id ?>" class="btn btn-success shadow-sm">Update Details</a>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12 mt-5">
            <div class="card shadow p-4">
                <!-- Card Body -->
                <div class="service-span">
                    <div>
                        <div class="div-content">
                            <div>Status</div>
                            <h5><?= $status_options[$status] ?></h5>
                        </div>                     
                    </div>
                    <div>
                        <div class="div-content">
                            <div>Name</div>
                            <h5><?= out($name) ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Livestock Type</div>
                            <h5><?= out($livestock_type) ?></h5>
                        </div>                        
                    </div>
                    <div>
                        <div class="div-content">
                            <div>Breed Type</div>
                            <h5><?= out($breed_type) ?></h5>
                        </div>
                        <div class="div-content">
                            <div>Description</div>
                            <h5><?= nl2br(out($description)) ?></h5>
                        </div>                        
                    </div>
                    <div>
                        <div class="div-content">
                            <div>Additional Note</div>
                            <h5><?= nl2br(out($additional_note)) ?></h5>
                        </div>   
                        <div class="div-content">
                            <?php if (!empty($picture)) { ?>
                            <div class="upload-document">
                                <img src="<?= $picture_link ?>" alt="<?= $picture ?>" class="img-fluid">
                            </div>
                            <?php } else { ?>
                            <div class="upload-document">
                                <span>No Picture</span>
                            </div>
                            <?php } ?>
                        </div>                   
                    </div>
                </div>                         
            </div>
        </div>
    </div>
</div>