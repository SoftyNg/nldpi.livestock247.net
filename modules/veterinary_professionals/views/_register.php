
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="animal-form-name mb-5">
            <h5 class="h3 mb-0 ml-4">Veterinary Service Provider</h5>
            <p class="pl-4 mt-1">Applying to be a verified Veterinary service provider</p>
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
                
                echo form_open_upload('veterinary_professionals/submit_application');
            ?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label> First Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="firstname" placeholder="Enter first name">
                            <span class="text-danger"><?php  echo (!empty(validation_errors('firstname')) ? validation_errors('firstname') : ''); ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label> Last Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="lastname" placeholder="Enter last name">
                            <span class="text-danger"><?php  echo (!empty(validation_errors('lastname')) ? validation_errors('lastname') : ''); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Phone<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone_number" placeholder="Enter phone number">
                            <span class="text-danger"><?php  echo (!empty(validation_errors('phone_number')) ? validation_errors('phone_number') : ''); ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Email Address<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email">
                            <span class="text-danger"><?php  echo (!empty(validation_errors('email')) ? validation_errors('email') : ''); ?></span>
                        </div>
                    </div>
                
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Professional Body<span class="text-danger">*</span></label>
                            <select name="professional_body" class="form-control">
                            <?php foreach($professional_body_options as $key => $value): ?>
                                <option value="<?= $key ?>"> <?= $value ?> </option>
                            <?php endforeach ?>
                            </select>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('professional_body')) ? validation_errors('professional_body') : ''); ?></span>
                        </div>
                    </div>                 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Registration Number<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="reg_number" placeholder="Enter registration number">
                            <span class="text-danger"><?php  echo (!empty(validation_errors('reg_number')) ? validation_errors('reg_number') : ''); ?></span>
                        </div>
                    </div>                
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Upload Registration Certificate<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-upload"></i></span>
                                </div>
                                <!--<input type="file" name="reg_certificate"  class="form-control adjust-form-control">-->
                                <?php echo form_file_select('reg_certificate', ['accept' => '.pdf','class'=>'form-control adjust-form-control']); ?>
                                
                            </div>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('reg_certificate')) ? validation_errors('reg_certifcate') : ''); ?></span>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Password</label>
                            <p>Please create a password to use with your email address when login in to this portal to manage your account</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Password<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-eye" onclick="revealPassword()"></i></span>
                                    </div>
                                </div>
                                <span class="text-danger"><?php  echo (!empty(validation_errors('password')) ? validation_errors('password') : ''); ?></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Comfirm Password<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm your password">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-eye" onclick="revealConfirmPassword()"></i></span>
                                    </div>
                                </div>
                                <span class="text-danger"><?php  echo (!empty(validation_errors('confirm_password')) ? validation_errors('confirm_password') : ''); ?></span>
                            </div>
                        </div>
                    </div>
                <hr>
                <!--<div class="mt-4 vetinary-span">

                   <div class="back-and-next-span">
                        <button type="submit" name="submit" value="Submit" class="btn btn-nldpi-green shadow-sm btn-next">Submit Application</button>
                    </div>
                </div>-->
                <div class="mt-4 vetinary-span">
                    <div>
                        <a href="<?= $cancel_url ?>" class="btn btn-outline-dark">Cancel</a>
                    </div>
                   <div class="back-and-next-span mb-3">
                        <input type="submit" name="submit" value="Submit Application" class="btn btn-success">
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
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