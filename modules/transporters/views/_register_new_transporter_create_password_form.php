<?php  require_once ("_navigation.php"); ?>
<div class="baseline mb-4 p-4">
    <div class="base-only">
        <a href="register_transporter">About</a>
        <a href="transporter_document">Document Upload</a>
        <a href="transporter_vehicle_registration">Vehicle Registration</a>
        <a href="create_password" class="<?= isset($_SESSION['transporter_vehicle_id']) &&  !empty($_SESSION['transporter_vehicle_id']) ? 'active_transporter' : '' ?>">Finish & Submit</a>
    </div>
</div>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

        <div class="animal-form-name mb-5">
            <h5 class="h3 mb-0 ml-4">Create Password</h5>
            <p class="pl-4 mt-1">Applying to be a verified Livestock service provice</p>
        </div>
        <div class="animal-form-name mb-5">
            <strong class="ml-4">Create Password</strong>
            <p class="pl-4 mt-1">please create a password for the service provider to use when logging into this portal.</p>
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
        ?>        
        <div class="register-animal-form my-4 px-4">
            <?php 
                
                echo form_open('transporter_registrations/add_password');
            ?>
            <input type="hidden" name="id" value="<?= isset($_SESSION['transporter_vehicle_id']) ? $_SESSION['transporter_vehicle_id'] : '' ?>">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Password </label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required >
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-eye" onclick="revealPassword()"></i></span>
                                </div>
                            </div>
                            <?php  //echo (!empty(validation_errors('password')) ? validation_errors('password') : ''); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Comfirm Password</label>
                            <div class="input-group mb-3">
                                <input type="confirm_password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-eye" onclick="revealConfirmPassword()"></i></span>
                                </div>
                            </div>
                            <?php  //echo (!empty(validation_errors('confirm_password')) ? validation_errors('confirm_password') : ''); ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mt-4 transporter-span">

                    <div class="back-and-next-span">
                        <?php if($_SESSION['transporter_vehicle_id'] && !empty($_SESSION['transporter_vehicle_id'])):?>
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

    function revealPassword() {
        var password = document.getElementById("password");
        if (password.type === "password") {
            password.type = "text";
        } else {
            password.type = "password";
        }
    }

    function revealConfirmPassword() {
        var confirm_password = document.getElementById("confirm_password");
        if (confirm_password.type === "password") {
            confirm_password.type = "text";
        } else {
            confirm_password.type = "password";
        }
    }

</script>
<!-- /.container-fluid -->