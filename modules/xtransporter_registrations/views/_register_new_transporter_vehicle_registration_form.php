<?php  require_once ("_navigation.php"); ?>
<div class="baseline mb-4 p-4">
    <div class="base-only">
        <a href="register_transporter">About</a>
        <a href="transporter_document">Document Upload</a>
        <a href="transporter_vehicle_registration" class="<?= isset($_SESSION['transporter_upload_id']) &&  !empty($_SESSION['transporter_upload_id'])? 'active_transporter' : '' ?>">Vehicle Registration</a>
        <a href="create_password">Finish & Submit</a>
    </div>
</div>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">
        <div class="animal-form-name mb-5">
            <h5 class="h3 mb-0 ml-4">Register Vehicle 1 of 12</h5>
            <p class="pl-4 mt-1">Applying to be a verified Livestock service provice</p>
        </div>
        <?php
            if(isset($_SESSION['success'])){
                    echo "<div class=' alert alert-success alert-dismissable mt-2' style='text-align:center;'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>"
                            .$_SESSION['success'].
                        "</div>";
                        unset($_SESSION["success"]); 
            }

            if(isset($_SESSION['failure'])){
                    echo "<div class=' alert alert-danger alert-dismissable mt-2' style='text-align:center;'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>"
                            .$_SESSION['failure'].
                        "</div>";
                        unset($_SESSION["failure"]); 
            }

            if(isset($_SESSION['upload_error'])){
                echo "<div class=' alert alert-danger alert-dismissable mt-2' style='text-align:center;'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times</a>"
                        .$_SESSION['upload_error'].
                    "</div>";
                    unset($_SESSION["upload_error"]); 
            }           
        ?>
        <div class="register-animal-form my-4 px-4">
            <?php 
                
                echo form_open('transporter_registrations/add_transporter_vehicle_registration');
            ?>
            <input type="hidden" name="id" value="<?= isset($_SESSION['transporter_upload_id']) ? $_SESSION['transporter_upload_id'] : '' ?>">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Vehicle registration</label>
                            <input type="text" class="form-control" name="vehicle_reg" placeholder="Enter vehicle registration" required>
                            <?php  //echo (!empty(validation_errors('vehicle_reg')) ? validation_errors('vehicle_reg') : ''); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Vehicle Type</label>
                            <input type="text" class="form-control" name="vehicle_type" place="Enter vehicle type"required>
                            <?php  //echo (!empty(validation_errors('vehicle_type')) ? validation_errors('vehicle_type') : ''); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Carry Capacity</label>
                            <input type="text" class="form-control" name="carrying_cap"   placeholder="Enter carrying capacity" required>
                            <?php  //echo (!empty(validation_errors('carrying_cap')) ? validation_errors('carrying_cap') : ''); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Upload Vehicle Photo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-upload"></i></span>
                                </div>
                                <input type="file" name="vehicle_photo" class="form-control" required>
                            </div> 
                            <?php  //echo (!empty(validation_errors('vehicle_photo')) ? validation_errors('vehicle_photo') : ''); ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mt-4 transporter-span">

                    <div class="back-and-next-span">
                        <?php if($_SESSION['transporter_upload_id'] && !empty($_SESSION['transporter_upload_id'])):?>
                            <button type="submit" name="submit" value="Submit" class="btn btn-nldpi-green shadow-sm btn-next">Continue</button>
                        <?php else: ?>
                             <button type="submit" name="submit" value="" class="btn btn-nldpi-green shadow-sm btn-next">Continue</button>
                        <?php endif ?>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>

</div>
<script>

    function goBack(){
        window.history.back();
    }
</script>
<!-- /.container-fluid -->