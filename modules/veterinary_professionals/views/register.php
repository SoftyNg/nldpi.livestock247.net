<div class="content-wrapper">
    <div class="container-fluid">
        <div class="animal-form-name mb-5">
            <h5 class="h3 mb-0 ml-4">Veterinary Professional</h5>
            <p class="pl-4 mt-1">Apply to Become a Verified Veterinary Professional</p>
        </div>
     
        <div class="register-animal-form my-4 px-4">
            <?php echo form_open_upload($location);?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter First Name',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('First Name');
                                echo form_input('firstname', $firstname,  $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('firstname')) ? validation_errors('firstname') : ''); ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Last Name',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Last Name');
                                echo form_input('lastname', $lastname,  $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('lastname')) ? validation_errors('lastname') : ''); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Phone Number',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Phone Number');
                                echo form_input('phone_number', $phone_number,  $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('phone_number')) ? validation_errors('phone_number') : ''); ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Email Address',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Email Address');
                                echo form_input('email', $email,  $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('email')) ? validation_errors('email') : ''); ?></span>
                        </div>
                    </div>
                
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Professional Body',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Professional Body');
                                echo form_dropdown('professional_body', $professional_body_options, $professional_body, $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('professional_body')) ? validation_errors('professional_body') : ''); ?></span>
                        </div>
                    </div>                 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Registration Number',
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Registration Number');
                                echo form_input('reg_number', $reg_number,  $attr1);
                            ?>
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
                                <?php
                                    $attr1 = [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Registration Number',
                                        'autocomplete' => 'off',
                                        'required' => true,
                                        'accept' => '.jpg, .png, .pdf'
                                    ];
                                    echo form_file_select('reg_certificate', $attr1);
                                ?>
                            </div>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('reg_certificate')) ? validation_errors('reg_certificate') : ''); ?></span>
                        </div>

                    </div> 
                </div>

                <div class="row mt-3">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label><strong>Password</strong></label>
                            <p>Create a secure password to use with your email address for logging into this portal and managing your account.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <!-- <label>Password<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" autocomplete="off" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-eye" onclick="revealPassword()"></i></span>
                                </div>
                            </div> -->
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Password',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Password');
                                echo form_password('password', '',  $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('password')) ? validation_errors('password') : ''); ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Confirm Password',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Confirm Password');
                                echo form_password('confirm_password', '',  $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('confirm_password')) ? validation_errors('confirm_password') : ''); ?></span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-footer d-flex justify-content-between"> 
                    <div>
                        <?php
                        $btn_cancel_attr = [
                            'class' => 'btn btn-outline-dark'
                        ];
                        echo anchor($cancel_url, 'Cancel', $btn_cancel_attr);
                        ?>
                    </div>
                    <div id="step1Buttons" class="step-buttons d-flex flex-row"> 
                        <?php
                        $btn_submit_application_attr = [
                            'class' => 'btn btn-success'
                        ];
                        echo form_submit('submit', 'Submit Application', $btn_submit_application_attr);
                        ?>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>

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

<style>
    .validation-error-alert {
        display: block;
    }
</style>