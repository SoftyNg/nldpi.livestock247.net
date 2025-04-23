<?php  require_once ("_navigation.php"); ?>
<div class="baseline mb-4 p-4">
    <div class="base-only">
        <a href="register_transporter"class="<?= !isset($_SESSION['transporter_id']) ? 'active_transporter' : '' ?>" >About</a>
        <a href="transporter_document">Document Upload</a>
        <a href="transporter_vehicle_registration">Vehicle Registration</a>
        <a href="create_password">Finish & Submit</a>
    </div>
</div>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">
        <div class="animal-form-name mb-5">
            <h5 class="h3 mb-0 ml-4">Livestock transporter registration</h5>
            <p class="pl-4 mt-1">Applying to be a verified Livestock service provider</p>
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
                
                echo form_open('transporter_registrations/add_transporter_registration');
            ?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control" name="company_name" placeholder="Enter company's name">
                            <?php  echo (!empty(validation_errors('company_name')) ? validation_errors('company_name') : ''); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>CAC Registration Number</label>
                            <input type="text" class="form-control" name="registration_number" place="Enter CAC registration number">
                            <?php  echo (!empty(validation_errors('registration_number')) ? validation_errors('registration_number') : ''); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phone_number"   placeholder="Enter phone number">
                            <?php  echo (!empty(validation_errors('phone_number')) ? validation_errors('phone_number') : ''); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email address">
                            <?php  echo (!empty(validation_errors('email')) ? validation_errors('email') : ''); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Operating State</label>
                            <select name="operating_state" id="state" class="form-control .state" multiple="multiple">

                            </select>
                            <?php  echo (!empty(validation_errors('state')) ? validation_errors('state') : ''); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Number of Vehicle in fleet</label>
                            <input type="text" name="no_of_vehicle_in_fleet" class="form-control" placeholder="Enter email address">
                            <?php  echo (!empty(validation_errors('no__of_vehicle_in_fleet')) ? validation_errors('no_of_vehicle_in_fleet') : ''); ?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mt-4 transporter-span">

                    <div class="back-and-next-span">
                        <button type="button" onclick="goBack()" class="btn btn-outline-dark shadow-sm mr-2">Back</button>
                        <button type="submit" name="submit" value="Submit" class="btn btn-nldpi-green shadow-sm btn-next">Continue</button>
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